<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Package;
use Illuminate\Support\Facades\DB;


class CourseController extends Controller
{
    public function coursecreate()
    {
    	$user = Auth::user();
        $departments = DB::table('departments')->get()->all();
    	return view ('courses.create', compact('user', 'departments'));
    }

    public function coursestore(Request $request)
    {
    		 $this->validate($request, [
                'cname' => 'min:3|max:50',
                'department' => 'required|min:1|max:200',
                'rno' => 'required',
                'sdate' => 'required|date',
                'image' => 'required',
                'edate' => 'required|date|after_or_equal:sdate',
                'ccolor' => 'required',
                'sessions' => 'required',
                'cdescription' => 'required',
            ]);
             if ($files = $request->file('image')) {
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            // $request->image->move(public_path('storage/'), $image);
            $request->image->move(public_path() .'/assets/img/upload', $image);
       }
    	$str = strtolower($request->cname);
        $slug = preg_replace('/\s+/', '-', $str);
        $data = array(
            'course_name'=> $request->cname,
            'image'=> $image,
            'department'=> $request->department,
            'room_number'=> $request->rno,
            'start_date'=> $request->sdate,
            'end_date'=> $request->edate,
            'course_color'=> $request->ccolor,
            'sessions'=> $request->sessions,
            'slug'=> $slug,
            'course_description'=> $request->cdescription,
        );

		        $success = DB::table('courses')->insert($data);
		        if($success){
                    Session::flash('message', 'Course created successfully');
		            return redirect('/course');
		        }else{
                    Session::flash('message', 'Something went wrong');
		            return redirect()->back();
		        }
    }

    public function course()
    {
    	$user = Auth::user();
        $courses = DB::table('courses')->get();
        // $courses = DB::table('courses')->paginate(2);
        return view('courses.index', compact('courses', 'user'));
    }

    public function course_wise_url(Request $request)
    {
    	$user = Auth::user();
    	// $cat = Course::where('slug',$request->cat)->first();
        $cat = DB::table('courses')->where('slug',$request->cat)->first();
        if($cat){
               $course_name = $cat->course_name;
               return view('courses.course_wise_url', compact('course_name','cat', 'user'));
           }else{
               Session::flash('error','URL Category not found');
               return redirect('/course');
           }
    }
       public function course_replicate($id)
    {
        $oldcourse = DB::table('courses')->where('id',$id)->first();
        $data = array(
            'course_name'=> $oldcourse->course_name,
            'department'=> $oldcourse->department,
            'room_number'=> $oldcourse->room_number,
            'image'=> $oldcourse->image,
            'start_date'=> $oldcourse->start_date,
            'end_date'=> $oldcourse->end_date,
            'course_color'=> $oldcourse->course_color,
            'sessions'=> $oldcourse->sessions,
            'slug'=> $oldcourse->slug,
            'course_description'=> $oldcourse->course_description,
        );
        $success = DB::table('courses')->insert($data);
                if($success){
                    Session::flash('message', 'Course created successfully');
                    return redirect('/course');
                }else{
                    Session::flash('message', 'Something went wrong');
                    return redirect()->back();
                }
    }

    public function course_edit($id)
    {
    	$user = Auth::user();
        $course = DB::table('courses')->where('id',$id)->first();
        $departments = DB::table('departments')->get()->all();
        return view('courses.edit', compact('course', 'user', 'departments'));
    }

   public function course_update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
                'cname' => 'required|min:3|max:50',
                'department' => 'required|min:2|max:200',
                'rno' => 'required',
                'sdate' => 'required|date',
                'edate' => 'required|date|after_or_equal:sdate',
                'ccolor' => 'required',
                'sessions' => 'required',
                'cdescription' => 'required',
            ]);
        $course = DB::table('courses')->where('id',$id)->get()->first();
        if ($files = $request->file('image')) {
            $path="assets/img/upload/$course->image";
            @unlink($path);
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            // $request->image->move(public_path('storage/'), $image);
            $request->image->move(public_path() .'/assets/img/upload', $image);
           }
           else{
            $image = $course->image;
           }
        $str = strtolower($request->cname);
        $slug = preg_replace('/\s+/', '-', $str);
        $data = Course::find($id);
        $data->course_name=$request->input('cname');
        $data->image=$image;
        $data->department=$request->input('department');
        $data->room_number=$request->input('rno');
        $data->start_date=$request->input('sdate');
        $data->end_date=$request->input('edate');
        $data->course_color=$request->input('ccolor');
        $data->sessions=$request->input('sessions');
        $data->slug=$slug;
        $data->course_description=$request->input('cdescription');
        $success = $data->save();

        if($success){
            Session::flash('message', 'Course updated successfully');
            return redirect('/course')->with('success', 'Update Successfuly');
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back()->with('alert', 'Update Unsuccessfuly');
        }
    }
    
    public function destroy(Request $request)
    {
			$id = $request->id;  
            $course = DB::table('courses')->where('id',$id)->get()->first();
            $path="/assets/img/upload/$course->image";
            File::delete($path);
			DB::table('courses')->where('id',$id)->delete();
            Session::flash('message', 'Course deleted successfully');
    }
}