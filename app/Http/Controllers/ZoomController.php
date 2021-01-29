<?php

namespace App\Http\Controllers;

use App\Zoom;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function create_user(Request $request){
        $user =     Zoom::user();
        return $user->create([
            'first_name' => $request->f_name,
            'last_name' => $request->l_name,
            'email' => $request->email,
            'password' => $request->password,
            'type'=> $request->type ? $request->type : 1
        ]);
    }

    public function  get_user($id){
        $user =     Zoom::user();
        return $user->find($id);
    }
    public function user_list(){
        $user =     Zoom::user();
        return $user->all();
    }
    public function create_meeting($user_id){
        if($user_id){
            $user = Zoom::user()->find($user_id);

        }else{
            return false;
        }
        $user = Zoom::user()->find($user_id);

        $meeting = Zoom::meeting();
        $meeting = Zoom::meeting()->make([
            'topic' => 'Class 9 English with Sir Ali',
            'type' => 8
        ]);
        $meeting->recurrence()->make([
            'type' => 1,
            'repeat_interval' => 15,
            'weekly_days' => '5',
            'end_times' => 5
        ]);
        $meeting->settings()->make([
            'host_video' => true,
            'participant_video' => true,
            'join_before_host' => true,
            'approval_type' => 0,
            'registration_type' => 1,
            'enforce_login' => false,
            'waiting_room' => false
        ]);
        $user->meetings()->save($meeting);
        return $meeting;        
    }

    public function meeting_list($user_id){

        $user = Zoom::user()->find($user_id);

        return $user->meetings()->all();
    
    }
    public function get_meeting(){
        $meeting = Zoom::meeting();
        return $meeting->find($id);
    }

    public function add_student_to_meeting(){
        $meeting = Zoom::meeting()->find($meeting_id);
        return $meeting->registrants;
    
        $registrant = Zoom::meeting()->registrants()->create([
            "email" => $request->email,
            "first_name" => $request->f_name,
            "last_name" => $request->l_name,
            "address" => $request->address,
            "city" => $request->city,
            "country" => $request->country,
            "zip" => $request->zip,
            "state" => $request->state,
            "phone" => $request->phone,
            "industry" => $request->industry,
            "org" => $request->org,
            "job_title" => $request->job_title,
            "purchasing_time_frame" => "More Than 6 Months",
            "role_in_purchase_process" => "Influencer",
            "no_of_employees" => '10',
            "comments" => 'No Comment',
        ]);
        return $registrant;
    }
}
