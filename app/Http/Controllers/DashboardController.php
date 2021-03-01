<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    public function index($type = 'School Calendar')
    {
    	$user = Auth::user();

    	$events = DB::table('calendar_events')->where('type',$type)->get();

    	$cal_events = [];
    	foreach($events as $event)
        {
	    		$even = \Calendar::event(
			    $event->event_name, //event title
			    true, //full day event?
			     $event->start_date, //start time (you can also use Carbon instead of DateTime)
			     $event->end_date, //end time (you can also use Carbon instead of DateTime)
				 $event->id,  //optionally, you can specify an event ID
				);
    		array_push($cal_events, $even);
    	}

    	
    	$calendar = \Calendar::addEvents($cal_events);
    	return view ('dashboard', compact('user','calendar'));
    }

    public function index_post($type)
    {
    	$user = Auth::user();
    	// if(!$request->type){
    	// 	$request->type = 'School Calendar';
    	// }

    	$events = DB::table('calendar_events')->where('type',$type)->get();

    	$cal_events = [];
    	foreach($events as $event){
	    		$even = \Calendar::event(
			    $event->event_name, //event title
			    true, //full day event?
			     $event->start_date, //start time (you can also use Carbon instead of DateTime)
			     $event->end_date, //end time (you can also use Carbon instead of DateTime)
				 $event->id,  //optionally, you can specify an event ID
				);
    		array_push($cal_events, $even);
    	}

    	$type = $type;

    	$calendar = \Calendar::addEvents($cal_events);
    	return view ('dashboard', compact('user','calendar','type'));
    }
}