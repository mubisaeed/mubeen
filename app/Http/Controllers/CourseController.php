<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
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
    	return view ('courses.create', compact('user'));
    }
    public function coursestore(Request $request)
    {
        // dd($request->sessions);
    		 $this->validate($request, [
                'cname' => 'min:3|max:50',
                'department' => 'required|min:2|max:200',
                'rno' => 'required',
                'ccolor' => 'required',
                'sessions' => 'required',
                'cdescription' => 'required',
            ]);
    	$str = strtolower($request->clname);
        $slug = preg_replace('/\s+/', '-', $str);
        $data = array(
            'course_name'=> $request->cname,
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
            // }
    }

    public function course()
    {
    	$user = Auth::user();
        $courses = DB::table('courses')->get();
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
        return view('courses.edit', compact('course', 'user'));
    }

   public function course_update(Request $request, $id)
    {
        $this->validate($request, [
                'cname' => 'required|min:3|max:50',
                'department' => 'required|min:2|max:200',
                'rno' => 'required',
                'ccolor' => 'required',
                'sessions' => 'required',
                'cdescription' => 'required',
            ]);
        $str = strtolower($request->title);
        $slug = preg_replace('/\s+/', '-', $str);
        $data = Course::find($id);
        $data->course_name=$request->input('cname');
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
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $courses=DB::table('courses')->where('course_name','LIKE','%'.$request->search."%")->get();
            if($courses)
            {
                foreach ($courses as $key => $course)
                {
                    $output.='<tr>'.
                        '<td>'.$course->id.'</td>'.
                        '<td>'.$course->course_name.'</td>'.
                        '<td>'.$course->start_date - $course->end_date.'</td>'.
                        '<td>'.$course->department.'</td>'.
                        '<td>'.$course->room_number.'</td>'.
                    '</tr>';
                }
                return Response($output);
            }
        }
    }

    public function destroy(Request $request)
    {
			$id = $request->id;   
			DB::table('courses')->where('id',$id)->delete();
            Session::flash('message', 'Course deleted successfully');
    }
}