<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizzesController extends Controller
{
    public function create(){
        $user = Auth::user();
    	return view ('quizzes.create', compact('user'));
    }
}
