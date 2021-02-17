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
    public function index()
    {
        // $events = DB::table('calendar_events')->get()->all();
        // dd($data);
        // $data = [];
        // foreach($events as $row)
        // {
            // dd($row);
        //  $data[] = array(
        //   'id'   => $row->id,
        //   'event_name'   => $row->event_name,
        //   'start_date'   => $row->start_date,
        //   'end_date'   => $row->end_date
        //  );
        // }

        // echo json_encode($data);
        return view ('calendar.index');
    }

    public function addevent(Request $request)
    {
    	// dd($request);
    	$this->validate($request, [

            'ename' => 'required|min:3|max:20',

            'edesc' => 'required|min:1|max:50',

            'sdate' => 'required|date',

            'edate' => 'required|date',

        ]);

        $event = array(
        	'event_name' => $request->ename,
        	'event_description' => $request->edesc,
        	'start_date' => $request->sdate,
            'end_date' => $request->edate,
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