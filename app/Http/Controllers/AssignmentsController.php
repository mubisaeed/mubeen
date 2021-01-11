<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentsController extends Controller
{
    public function create(){
        $user = Auth::user();
    	return view ('assignments.create', compact('user'));
    }
}
