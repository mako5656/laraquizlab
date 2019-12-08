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
//          $questions = Question::whereIn('category_name',[1])->inRandomOrder()->limit(5)->get();
        if($userability == 0.00){
            $questions1 = Question::whereIn('category_name',[0])->inRandomOrder()->limit(1);
            $questions2 = Question::whereIn('category_name',[1])->inRandomOrder()->limit(1);
            $questions3 = Question::whereIn('category_name',[10])->inRandomOrder()->limit(1);
            $questions4 = Question::whereIn('category_name',[100])->inRandomOrder()->limit(1);
            $questions5 = Question::whereIn('category_name',[1000])->inRandomOrder()->limit(1);
            $questions = $questions1->union($questions2)->union($questions3)->union($questions4)->union($questions5)->get();
        }elseif($userability <= 0){
            $questions1 = Question::whereIn('category_name',[0])->inRandomOrder()->limit(2);
            $questions2 = Question::whereIn('category_name',[1])->inRandomOrder()->limit(2);
            $questions3 = Question::whereIn('category_name',[10])->inRandomOrder()->limit(1);
            $questions = $questions1->union($questions2)->union($questions3)->get();
        }elseif($userability > 0 and $userability<0.7){
            $questions1 = Question::whereIn('category_name',[1])->inRandomOrder()->limit(1);
            $questions2 = Question::whereIn('category_name',[10])->inRandomOrder()->limit(1);
            $questions3 = Question::whereIn('category_name',[111])->inRandomOrder()->limit(1);
            $questions3 = Question::whereIn('category_name',[1100])->inRandomOrder()->limit(1);
            $questions3 = Question::whereIn('category_name',[1010])->inRandomOrder()->limit(1);
            $questions = $questions1->union($questions2)->union($questions3)->get();
        }elseif($userability >= 0.7){
            $questions1 = Question::whereIn('category_name',[11])->inRandomOrder()->limit(1);
            $questions2 = Question::whereIn('category_name',[101])->inRandomOrder()->limit(1);
            $questions3 = Question::whereIn('category_name',[1000])->inRandomOrder()->limit(1);
            $questions4 = Question::whereIn('category_name',[1100])->inRandomOrder()->limit(1);
            $questions5 = Question::whereIn('category_name',[1011])->inRandomOrder()->limit(1);
            $questions = $questions1->union($questions2)->union($questions3)->union($questions4)->union($questions5)->get();
        }

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
