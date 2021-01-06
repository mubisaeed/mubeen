<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
    	$user = Auth::user();
    	return view ('dashboard', compact('user'));
    }

    public function show_profile()
    {
    	$user = Auth::user();
    	return view ('profile', compact('user'));
    }

    public function show_calender()
    {
        $user = Auth::user();
        return view ('calender', compact('user'));
    }
}
