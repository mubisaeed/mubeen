<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function messages()
    {
       $user = Auth::user();
        return view ('messages.messages', compact('user'));
    }
    public function index($id)
    {	
        // dd($id);
    	$user = Auth::user();
    	$sideid = $id;
        $suser = DB::table('users')->where('id', $sideid)->get()->first();
    	if(Auth::user()->role_id==4)	
    	{
    		$student = $sideid;
    		$instructor = Auth::user()->id;
    		$messages = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->get()->all();
    	}
    	if(Auth::user()->role_id==5)
    		{
    		$instructor = $sideid;
    		$student = Auth::user()->id;
    		$messages = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->get()->all();
    	}
    	return view('messages.messages', compact('user', 'student', 'instructor', 'sideid', 'messages', 'suser'));
    }
    public function sendMessage(Request $request)
    {
        $time = \Carbon\Carbon::now();
        $sideid = $request->sideid;
    	if(Auth::user()->role_id==4)	
    	{
    		$student = $sideid;
    		$instructor = Auth::user()->id;
    	}
    	if(Auth::user()->role_id==5)
    		{
    		$instructor = $sideid;
    		$student = Auth::user()->id;
    	}
    	$data = array(
            'content'=> $request->message,
            'student'=> $student,
            'instructor'=> $instructor,
            'sent_by'=> $request->sentby,
            'created_at'=> $time,
        );
		  $success = DB::table('messages')->insert($data);
          if($success){
                    Session::flash('message', 'Message send');
                    return back();
                }else{
                    Session::flash('message', 'Something went wrong');
                    return back();
                }
    }
}
