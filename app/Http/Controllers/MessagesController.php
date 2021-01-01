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
    public function index($id)
    {	
    	$user = Auth::user();
    	$sideid = $id;
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
    	return view('chats.chatroom', compact('user', 'student', 'instructor', 'sideid', 'messages'));
    }
    public function sendMessage(Request $request)
    {
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
