<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public function create()
    {
        $user = Auth::user();
    	return view ('quizzes.create', compact('user'));
    }

    public function mcqcreate()
    {
        $user = Auth::user();
    	return view ('quizzes.mcq', compact('user'));
    }

    public function mcqstore(Request $request)
    {
        dd($request->input('correct'));
    	$this->validate($request, [
    		'label' => 'required',
    	]);

        $user = Auth::user();
        $type = "mcq";

        $mcq = new Question();
        $mcq->label=$request->input('label');
        $mcq->type=$type;
        $mcq->save();

        $options = array(
            '$opt1' => $request->input('opt1'),
            '$opt2' => $request->input('opt2'),
            '$opt3' => $request->input('opt3'),
            '$opt4' => $request->input('opt4'),
        );
        $option = new Option();
        $option->question_id=$mcq->id;
        $option->option = serialize($options);
        $option->save();
        Session::flash('message', 'Question create successfully');
    	return redirect('/mcq/create');
    }


    public function tfcreate()
    {
        $user = Auth::user();
    	return view ('quizzes.tf', compact('user'));
    }

    public function tfstore()
    {
        $user = Auth::user();
    	return view ('quizzes.mcq', compact('user'));
    }
}
