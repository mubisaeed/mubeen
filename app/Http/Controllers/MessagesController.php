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
    public function messages($id=0)
    {

        
        $curr_user = Auth::user();
        $user = Auth::user();
     
           $user_id =$curr_user->role_id;
        //    if($user_id == 4){
               $user_ids = DB::table('instructor_student')->where('i_u_id' , $curr_user->id)->pluck('s_u_id');
               $students = DB::table('students')->wherein('s_u_id' , $user_ids)->get();
          
              $selected_user_message = null;
               if($id != 0){
                   if(auth()->user()->role_id == 4){
                    $selected_user_message = DB::table('messages')->where('student' , $id)->orderBy('id' , 'asc')->get();
                   }
                   else{
                    $selected_user_message = DB::table('messages')->where('instructor' , $id)->orderBy('id' , 'asc')->get();
                             
                   } 
                
                }

              return view ('messages.messages', compact('students','user' , 'selected_user_message' ,'id'));
        //    }  

       

        // return view ('messages.messages', compact('user'));
    }
    public function index($id)
    {

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

        $recieveid = $request->student_id;

    	if(Auth::user()->role_id==4)
    	{
    		$student = $recieveid;
    		$instructor = Auth::user()->id;
    	}
    	if(Auth::user()->role_id==5)
    		{
    		$instructor = $recieveid;
    		$student = Auth::user()->id;
        }
        
    	$data = array(
            'content'=> $request->message,
            'student'=> $student,
            'instructor'=> $instructor,
            'sent_by'=> Auth::user()->id,
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
