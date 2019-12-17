<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Test;
use App\TestAnswer;
use App\Topic;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;

class TestsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $topics = Topic::inRandomOrder()->limit(10)->get();

        $userability = Auth::user()->ability;

        //10問以上なら能力に応じた
//        非斉次系の場合特殊解と一般解を追加
//        if($userability < 0.4){
//            //5問取得して表示
//            $questions = Question::inRandomOrder()->limit(5)->get();
//        }elseif($userability < 0.8){
//            $questions = Question::whereIn('category_name',[0000,0001])->inRandomOrder()->limit(5)->get();
//        }elseif($userability < 2){
//            $questions = Question::whereIn('category_name',[0000,0001,0010,0100,1000])->inRandomOrder()->limit(5)->get();
//        }elseif($userability < 3){
//            $questions = Question::whereIn('category_name',[0000,0001,0010,0100,1000,0011,0101,1001])->inRandomOrder()->limit(5)->get();
////     }else
//        if($userability <= $userability+2 or $userability >=$userability-2){
////            $questions = Question::where('item_difficulty', '<', 3)->inRandomOrder()->limit(5)->get();
////        }else{
//            $questions = Question::inRandomOrder()->limit(5)->get();
////        }
///
//        $questions1 = Question::whereIn('category_name',[1001,0101])->inRandomOrder()->limit(4);
//        $questions2 = Question::whereIn('category_name',[0001,0000])->inRandomOrder()->limit(1);
//        $questions = $questions2->union($questions1)->get();

//        $questions = Question::whereIn('category_name',[0000])->inRandomOrder()->limit(5)->get();//0から1問0.0168で5問正解すると0.0813
//        $questions = Question::whereIn('category_name',[0001])->inRandomOrder()->limit(5)->get();//0から5問正解すると0.5854
//         $questions = Question::whereIn('category_name',[1])->inRandomOrder()->limit(5)->get();
        $level1 =-2.0;
        $level2 =-0.4;
        $level3 =1.2;
        $level4 =3.05;
        $level5 = 4;
        $level6 = 6;
        $lil = [2,1,0,0,0];
        $lim = [3,4,5,4,3];
        $lir = [0,0,0,1,2];

        if($userability < $level1 or $userability >= $level6){
            $questions = Question::inRandomOrder()->limit(5)->get();
        }elseif($userability >= $level1 and $userability < $level2){
            $dis=abs(($level1-$level2)/5);
            $range=$level1;
            for($i=0;$i<5;$i++){
                $range+=$dis;
                if($userability<$range){
                    $questions1 = Question::inRandomOrder()->limit($lil[$i]);
                    $questions2 = Question::whereBetween('item_difficulty', [-1.6,-1.5])->inRandomOrder()->limit($lim[$i]);
                    $questions3 = Question::whereBetween('item_difficulty', [0.7, 0.9])->inRandomOrder()->limit($lir[$i]);
                    $questions = $questions2->union($questions3)->union($questions1)->get();
                    break;
                }
            }
        }elseif($userability >= $level2 and $userability < $level3){//kの値2倍で能力値0から5問全問正解で0.7710
            $dis=abs(($level2-$level3)/5);
            $range=$level2;
            for($i=0;$i<5;$i++){
                $range= $range + $dis;
                if($userability < $range){
                    $questions1 = Question::whereBetween('item_difficulty', [-1.6,-1.5])->inRandomOrder()->limit($lil[$i]);
                    $questions2 = Question::whereBetween('item_difficulty', [0.7, 0.9])->inRandomOrder()->limit($lim[$i]);
                    $questions3 = Question::whereBetween('item_difficulty', [1.6,2.1])->inRandomOrder()->limit($lir[$i]);
                    $questions = $questions1->union($questions2)->union($questions3)->get();
                    break;
                }
            }
        }elseif($userability >= $level3 and $userability < $level4){
            $dis=abs(($level3-$level4)/5);
            $range=$level3;
            for($i=0;$i<5;$i++){
                $range+=$dis;
                if($userability<$range){
                    $questions1 = Question::whereBetween('item_difficulty', [0.7,0.9])->inRandomOrder()->limit($lil[$i]);
                    $questions2 = Question::whereBetween('item_difficulty', [1.6,2.1])->inRandomOrder()->limit($lim[$i]);
                    $questions3 = Question::whereBetween('item_difficulty', [4,4.1])->inRandomOrder()->limit($lir[$i]);
                    $questions = $questions1->union($questions2)->union($questions3)->get();
                    break;
                }
            }
        }elseif($userability >= $level4 and $userability < $level5){
            $dis=abs(($level4-$level5)/5);
            $range=$level4;
            for($i=0;$i<5;$i++){
                $range+=$dis;
                if($userability<$range){
                    $questions1 = Question::whereBetween('item_difficulty', [1.6,2.1])->inRandomOrder()->limit($lil[$i]);
                    $questions2 = Question::whereBetween('item_difficulty', [4,4.1])->inRandomOrder()->limit($lim[$i]);
                    $questions3 = Question::whereBetween('item_difficulty', [5.3,5.1])->inRandomOrder()->limit($lir[$i]);
                    $questions = $questions1->union($questions2)->union($questions3)->get();
                    break;
                }
            }
        }elseif($userability >= $level5 and $userability < $level6){
            $dis=abs(($level4-$level5)/5);
            $range=$level4;
            for($i=0;$i<5;$i++){
                $range+=$dis;
                if($userability<$range){
                    $questions1 = Question::whereBetween('item_difficulty', [4,4.1])->inRandomOrder()->limit($lil[$i]);
                    $questions2 = Question::whereBetween('item_difficulty', [5.3,5.1])->inRandomOrder()->limit($lim[$i]);
                    $questions3 = Question::inRandomOrder()->limit($lir[$i]);
                    $questions = $questions1->union($questions2)->union($questions3)->get();
                    break;
                }
            }
        }
//        $questions = Question::inRandomOrder()->limit(5)->get();

        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
            $question->optionss = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        /*
        foreach ($topics as $topic) {
            if ($topic->questions->count()) {
                $questions[$topic->id]['topic'] = $topic->title;
                $questions[$topic->id]['questions'] = $topic->questions()->inRandomOrder()->first()->load('options')->toArray();
                shuffle($questions[$topic->id]['questions']['options']);
            }
        }
        */

        return view('tests.create', compact('questions'));
    }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = 0;

        $test = Test::create([
            'user_id' => Auth::id(),
            'result'  => $result,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if($question <= 160) {
                if ($request->input('answers.' . $question) != null && QuestionsOption::find($request->input('answers.' . $question))->correct) {
                    $status = 1;
                    $result++;
                }
            }else {
                if ($request->input('answers.' . $question) != null && QuestionsOption::find($request->input('answers.' . $question))->correct) {
                    if ($request->input('answerss.' . $question) != null && QuestionsOption::find($request->input('answerss.' . $question))->correct) {
                        $status = 1;
                        $result++;
                    }
                }
            }

            TestAnswer::create([
                'user_id'     => Auth::id(),
                'test_id'     => $test->id,
                'question_id' => $question,
                'option_id'   => $request->input('answers.'.$question),
                'options_id'  => $request->input('answerss.'.$question),
                'correct'     => $status,
            ]);
        }

        $test->update(['result' => $result]);

        return redirect()->route('results.show', [$test->id]);
    }
}
