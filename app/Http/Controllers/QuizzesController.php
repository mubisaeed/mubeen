<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizzesController extends Controller
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
    	dd('sdds');
    	$this->validate($request, [
    		'label' => 'required',
    	]);
        $user = Auth::user();
        $type = "mcq";
        DB::table('questions');
    	return view ('quizzes.mcq', compact('user'));
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
