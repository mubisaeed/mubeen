<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use calendar;

class CalendarController extends Controller
{
    public function index($type = 'School Calendar')
    {

        $user = Auth::user();

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

        
        $calendar = \Calendar::addEvents($cal_events);
        // return view ('dashboard', compact('user','calendar'));
        return view ('calendar.index', compact('user','calendar'));
    }


     public function index_post($type)
    {
        $user = Auth::user();
        // if(!$request->type){
        //  $request->type = 'School Calendar';
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
        return view ('calendar.index', compact('user','calendar','type'));
    }

    public function addevent(Request $request)
    {
    	// dd($request);
    	$this->validate($request, [

            'ename' => 'required|min:3|max:20',

            'edesc' => 'required|min:1|max:50',

            'sdate' => 'required|date',

            'edate' => 'required|date',

            'type' => 'required',

        ]);

        $event = array(
        	'event_name' => $request->ename,
        	'event_description' => $request->edesc,
        	'start_date' => $request->sdate,
            'end_date' => $request->edate,
            'type' => $request->type,
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

    public function add_event_from_calendar(Request $request)
    {
        // dd($request);

        $event = array(
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'start_date' => $request->event_start,
            'end_date' => $request->event_end,
            'type' => $request->event_type,
            'created_by' => Auth::user()->id,
        );

        $success = DB::table('calendar_events')->insert($event);
        if($success)
        {
            Session::flash('message', 'Event created  successfully');
            $events = DB::table('calendar_events')->where('type',$request->event_type)->get();
                    $user = Auth::user();
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

                    $type = $request->event_type;
                   
                    
                        return redirect('/dashboard/'.$type);
                   
                   
        }
        else
        {
            Session::flash('message', 'Something went wrong');

            return redirect()->back();
        }
    }
}