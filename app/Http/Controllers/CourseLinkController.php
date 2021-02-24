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


    public function search_by_week($courseid, $week)
    {
        $week = $week;
        $id = $courseid;

        $courselink = DB::table('courselink')->where('course_id', $id)->where('week', $week)->orderBy('id', 'desc')->get();

        return view ('course_resources.links', compact ('user','courselink', 'id'));

    }


    public function index($insid, $cid, $week){

        $course_id = $cid;

        $user = Auth::user();
        $instructor_id = $insid;
        $week = $week;

        $courselink=DB::table('courselink')->where('course_id', $cid)->orderBy('id', 'desc')->get()->all();


        return view ('course_resources.links', compact ('user','courselink', 'course_id', 'week', 'instructor_id'));

    }



    public function Store(Request $req){

        $this->validate($req,

         [

        'link' => 'required',

        'week' => 'required',

        'title'=>'required|min:3|max:20',

        'short_des'=>'required|min:10|max:5000',

    ]);

        $courselinks= new CourseLink;

        $courselinks->course_id=$req->input('course_id');

        $courselinks->week=$req->input('week');

        $courselinks->instructor_id=$req->input('instructor_id');

        $courselinks->title=$req->input('title');

        $courselinks->short_description=$req->input('short_des');

        $courselinks->link=$req->input('link');

        $courselinks->save();


        if($courselinks){

            Session::flash('message', 'Link Stored Successfully');

            return redirect('/course/show_week_details/'. $req->instructor_id .'/'. $req->course_id .'/'. $req->week);

        }

    }

    public function edit($id, $main){


        $id = $id;

        $courselinks = CourseLink::find($id);

        $week = $courselinks->week;

        $instructor_id = Auth::user()->id;

        $course_id = $main;

    	return view ('course_resources.linkedit', compact('courselinks', 'id','course_id', 'instructor_id', 'week'));

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

        $courselinks->week=$req->input('week');

        $courselinks->short_description=$req->input('short_des');

        $courselinks->link=$req->input('link');

        $courselinks->save();

        $id = $req->input('course_id');

        $id = $req->input('instructor_id');

        Session::flash('message', 'Link Updated Successfully');

        return redirect('/course/show_week_details/'. $req->instructor_id .'/'. $req->course_id .'/'. $req->week);     

    }



    public function delete(Request $request)

    {

        $id = $request->input("id");

        CourseLink::where("id", $id)->delete();

    }



}

