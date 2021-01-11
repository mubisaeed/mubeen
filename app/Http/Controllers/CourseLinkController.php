<?php

namespace App\Http\Controllers;

use App\CourseLink;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CourseLinkController extends Controller
{
    public function index($id){
        $id = $id;
        $user = Auth::user();
        $courselink=DB::table('courselink')->where('course_id', $id)->get()->all();
        
        return view ('course_resources.links', compact ('user','courselink', 'id'));
    }

    public function Store(Request $req){
        $this->validate($req,
         [
        'link' => 'required',
        'title'=>'required|min:3|max:20',
        'short_des'=>'required|min:10|max:5000',
    ]);
        $courselinks= new CourseLink;
        $courselinks->course_id=$req->input('course_id');
        $courselinks->title=$req->input('title');
        $courselinks->short_description=$req->input('short_des');
        $courselinks->link=$req->input('link');
        $courselinks->save();
        $id = $req->input('course_id');
        if($courselinks){
            Session::flash('message', 'Resource Stored Successfully');
            return redirect()->back();
        }
    }

    public function edit($id, $main){
        //dd($id);
        $id = $id;
        $courselinks = CourseLink::find($id);
        $user = Auth::user();
    	return view ('course_resources.linkedit', compact('user', 'courselinks', 'id','main'));
    }

    public function update( Request $req){

        $this->validate($req, [
            'title'=>'required|min:3|max:20',
            'short_des'=>'required|min:10|max:5000',
            'link' => 'required',
        ]);
        $courselinks = CourseLink::find($req->id);
        $user = Auth::user();
        $courselinks->title=$req->input('title');
        $courselinks->short_description=$req->input('short_des');
        $courselinks->link=$req->input('link');
        $courselinks->save();
        $id = $req->input('course_id');
        Session::flash('message', 'Resource Updated Successfully');
        return redirect('courselink/'.$req->main);      
    }

    public function delete(Request $request)
    {
        $id = $request->input("id");
        CourseLink::where("id", $id)->delete();
    }

}
