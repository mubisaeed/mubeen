<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class MessagesController extends Controller
{
    public function messages($id=0)
    {

        
        $curr_user = Auth::user();
        $user = Auth::user();
     
        $user_id =$curr_user->role_id;
        if(Auth::user()->role_id == 4)
        {
            $instructor_courses = DB::table('course_instructor')->where('i_u_id', $curr_user->id)->pluck('course_id')->toArray();
            $instructor_classes = DB::table('courses')->whereIn('id', $instructor_courses)->pluck('clas_id')->toArray();
            $instructor_students = DB::table('classes_students')->whereIn('class_id', $instructor_classes)->join('users', 'users.id', 'classes_students.s_u_id')->get();
        }
        if(Auth::user()->role_id == 5)
        {    
            $student_classes = DB::table('classes_students')->where('s_u_id', $curr_user->id)->join('courses', 'courses.clas_id', 'classes_students.class_id')->get()->pluck('id')->toArray();
            
            $instructor_courses = DB::table('course_instructor')->whereIn('course_id', $student_classes)->get()->pluck('i_u_id');

            $instructors = DB::table('users')->whereIn('id', $instructor_courses)->get();

        }


          
              // $selected_user_message = null;
              //  if($id != 0){
              //      if(auth()->user()->role_id == 4){
              //       $selected_user_message = DB::table('messages')->where('student' , $id)->orderBy('id' , 'asc')->get();
              //      }
              //      else{
              //       $selected_user_message = DB::table('messages')->where('instructor' , $id)->orderBy('id' , 'asc')->get();
                             
              //      } 
                
              //   }

              return view ('messages.messages', compact('student_instructor', 'instructor_students', 'instructors'));
    }

    public function get_messages($id)
    {
        // return $id;
        $my_id = Auth::user()->id;

        if(Auth::user()->role_id == 4)
        {

            $messages = DB::table('messages_instructor_student')->where(function ($querry) use ($id, $my_id)
            {
                $querry->where([
                    'ins_id' => $my_id,
                    'std_id' => $id,
                ]);
            })->get();
        }
        elseif(Auth::user()->role_id == 5)
        {
            $messages = DB::table('messages_instructor_student')->where(function ($querry) use ($id, $my_id)
            {
                 $querry->where([
                    'ins_id' => $id,
                    'std_id' => $my_id,
                ]);
            })->get();

        }

        $msg_user = DB::table('users')->where('id', $id)->get()->first();

        return view ('messages.chat_area', compact('messages', 'msg_user', 'id'));
    }

    // public function index($id)
    // {

    // 	$user = Auth::user();
    // 	$sideid = $id;
    //     $suser = DB::table('users')->where('id', $sideid)->get()->first();
    // 	if(Auth::user()->role_id==4)
    // 	{
    // 		$student = $sideid;
    // 		$instructor = Auth::user()->id;
    // 		$messages = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->get()->all();
    // 	}
    // 	if(Auth::user()->role_id==5)
    // 		{
    // 		$instructor = $sideid;
    // 		$student = Auth::user()->id;
    // 		$messages = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->get()->all();
    // 	}
    // 	return view('messages.messages', compact('user', 'student', 'instructor', 'sideid', 'messages', 'suser'));
    // }
    public function sendMessage(Request $request)
    {        
        
        $time = \Carbon\Carbon::now();

        $recieveid = $request->receiver;

    	if(Auth::user()->role_id==4)
    	{
    		$std_id = $recieveid;
    		$ins_id = Auth::user()->id;
    	}
    	if(Auth::user()->role_id==5)
    		{
    		$ins_id = $recieveid;
    		$std_id = Auth::user()->id;
        }
        
    	$data = array(
            'content'=> $request->content,
            'std_id'=> $std_id,
            'ins_id'=> $ins_id,
            'sent_by'=> Auth::user()->id,
            'created_at'=> $time,
        );
		  $success = DB::table('messages_instructor_student')->insert($data);

          // Pusher

        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

          $data = ['recieveid' => $recieveid];
          $pusher->trigger('my-channel', 'my-event', $data);

          return $recieveid;
    }
}
