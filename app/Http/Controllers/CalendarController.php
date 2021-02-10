<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view ('calendar.index', compact('user'));
    }

    public function addevent(Request $request)
    {
    	// dd($request);
    	// $this->validate($request, [

     //        'ename' => 'required|min:3|max:20',

     //        'edesc' => 'required|min:1|max:50',

     //        'ecolor' => 'required',

     //        'eicon' => 'required',

     //        'adate' => 'required|date',

     //    ]);

        $event = array(
        	'event_name' => $request->ename,
        	'event_description' => $request->edesc,
        	'event_color' => $request->ecolor,
        	'event_icon' => $request->eicon,
        	'event_date' => $request->edate,
        	'created_by' => Auth::user()->id,
        );

        $success = DB::table('calendar_events')->insert($event);
        if($success)
        {
        	Session::flash('message', 'Event created  successfully');

        	return redirect('/calendar');
        }
        else
        {
        	Session::flash('message', 'Something went wrong');

        	return redirect()->back();
        }
    }
}