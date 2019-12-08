<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Question;
use App\Result;
use App\Test;
use App\TestAnswer;
use App\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::count();
        $users = User::whereNull('role_id')->count();
        $quizzes = Test::count();
        $average = Test::avg('result');

        $userid = Auth::id();
        $sabilitys = TestAnswer::select('ability', 'user_id')->where('user_id', '=', $userid)->pluck('ability');

        return view('home', compact('questions', 'users', 'quizzes', 'average','sabilitys'));
    }
}
