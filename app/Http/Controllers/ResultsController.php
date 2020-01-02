<?php

namespace App\Http\Controllers;

use App\Question;
use Auth;
use App\Test;
use App\TestAnswer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResultsRequest;
use App\Http\Requests\UpdateResultsRequest;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'show');
    }

    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Test::all()->load('user');

        if (!Auth::user()->isAdmin()) {
            $results = $results->where('user_id', '=', Auth::id());
        }

        return view('results.index', compact('results'));
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $i=4;
        $test = Test::find($id)->load('user');

        if ($test) {
            $results = TestAnswer::where('test_id', $id)->with('question')->with('question.options')->get();
        }

        foreach ($results as $result) {
            if($result->correct){
                $Sa=1;
            }else{
                $Sa=0;
            }
            $finds=$result->question_id;
//            $finds = TestAnswer::select('question_id', 'id')->where('id', '=', $id*5-$i)->value("question_id");
            $b = Question::select('item_difficulty', 'id')->where('id', '=', $finds)->value("item_difficulty");
            $ajf = Question::select('discrimination_power', 'id')->where('id', '=', $finds)->value("discrimination_power");
            $userability=Auth::user()->ability;

            //定数K：イロレーティングの確率モデルK=32を3PLMの確率モデルに変換したもの。$K=0.1842
            $arg = log(10);
            $K = 7 * (32 / 400) * $arg;

            //偶然正解してしまう確率$cj=0.25
            $qnumber = 4;
            $cj = 1 / $qnumber;

            //scaling factor $D=1.7
            $D = 1.7;

            $matha = $b - $userability;
            $temp = $D * $ajf * $matha;

            //3PLM
            //pj(θi)=cj+(1-cj)/1+exp(-Daj(θi-bj))
            //pj(θi)は能力θiを持つ学生iが問題jに正解する確率
            $p = $cj + ((1 - $cj) / (1 + (exp($temp))));

            //レーティング更新式
            $mathb = $Sa - $p;
            $userability = $userability + $K * $mathb;


            //ユーザのレコードを取得
            $target = Auth::user();
            //abilityeカラムを変更
            $target->ability = $userability;
            // 更新
            $target->save();


            //四択の場合のみ
            //ユーザのレコードを取得
            $sample = TestAnswer::find($id*5-$i);
            //abilityeカラムを変更
            $sample->ability = $userability;
            // 更新
            $sample->save();
            $i=$i-1;
        }

        return view('results.show',compact('test', 'results','userability','p'));
    }
}
