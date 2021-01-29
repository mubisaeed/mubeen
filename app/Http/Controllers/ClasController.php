<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clas;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ClasController extends Controller
{
    public function index()
    {
        //   for permission
        if(auth()->user()->role_id != '5'){
            $user = Auth::user()->id;
            $assigned_permissions =array();
            $data = DB::table('module_permissions_users')->where('user_id' , $user)->pluck('allowed_module');

            if(auth()->user()->role_id == '4')
            {
                $data = DB::table('module_permissions_store_instructors')->where('user_id' , $user)->pluck('allowed_module');
            }

            if($data != null){
                 foreach ($data as $value) {
                $assigned_permissions = explode(',',$value);
                 
            }
            }
            if(!in_array('All Classes', $assigned_permissions)){
                return redirect('dashboard');
            }
        }
            // end for permission
        if(auth()->user()->role_id == '5')
        {
            $classes = DB::table('classes_students')->where('s_u_id', auth()->user()->id)->pluck('class_id');
            return view ('clases.student_classes', compact('classes'));
        }

        if(auth()->user()->role_id == '4')
        {
            $courses = DB::table('course_instructor')->where('i_u_id', auth()->user()->id)->pluck('course_id');
            if(count($courses)>0)
            {
                $course_classes = DB::table('courses')->whereIn('id', $courses)->pluck('clas_id');
                if(count($course_classes)>0)
                {
                    $classes = DB::table('classes')->where('id', $course_classes)->get()->all();
                    return view ('clases.index', compact('classes'));
                }
                else{
                Session::flash('message', 'you have not assigned any class.');
                return redirect()->back();
            }
            }
            else{
                Session::flash('message', 'you have not assigned any class.');
                return redirect()->back();
            }
        }

        else
        {
            $classes = DB::table('classes')->get()->all();
    	   return view ('clases.index', compact('classes'));
        }
    }


    public function show_instructors_of_class($id)
    {
    	$class_courses = DB::table('courses')->where('clas_id', $id)->pluck('id');
        $instructors = DB::table('course_instructor')->whereIn('course_id', $class_courses)->join('instructors', 'instructors.i_u_id', '=', 'course_instructor.i_u_id')->get()->all();
        return view('clases.instructors_of_class' , compact('instructors', 'id'));  
    }

    public function see_courses_of_class($id){

           $courses = DB::table('courses')->where('clas_id' , $id)->get();
           return view('clases.all_courses_of_class' , compact('courses', 'id'));           
        
    }
    
    public function addcourse_to_class($id){
           $allCourses = DB::table('courses')->where('clas_id' , '0')->get();
           return view('clases.add_course_to_class' , compact('allCourses' , 'id'));           
        
    }
    public function storecourse_to_class(Request $request)
    {
   if(count($request->course_id) > 0 ){
        foreach( $request->course_id  as $course_id){
            DB::table('courses')->where('id' , $course_id)->update([
                'clas_id' => $request->class_id,
                ]);
        }
          Session::flash('message', 'Selected Course added to class'. DB::table('classes')->where('id',$request->class_id)->pluck('name')->first().'.');
          return redirect('/classes');
   }
   else{
       Session::flash('message', 'No Course Selected');

        return redirect('/classes');
   }
   
   
    }

    public function destroy_course_from_class(Request $request)

    {
        
            $id = $request->id;

            DB::table('courses')->where('clas_id',$request->clas_id)->where('id', $id)->update([
                'clas_id' => '0',
                ]);

            Session::flash('message', 'course removed successfully');
    }


    public function destroy_student_from_class(Request $request)

    {
        
            $id = $request->id;  

            DB::table('classes_students')->where('s_u_id',$id)->delete();

            Session::flash('message', 'Student removed successfully');

    }


    public function see_students_of_class($id){
           $stds = DB::table('classes_students')->where('class_id' , $id)->get()->all();
           return view('clases.all_students_of_class' , compact('stds', 'id'));           
        
    }
    
    public function addstudent_to_class($id){

        $stds = DB::table('classes_students')->pluck('s_u_id');

        $allStudents = DB::table('students')->whereNotIn('s_u_id', $stds)->join('users', 'users.id', '=' , 'students.s_u_id')->get()->all();

   return view('clases.add_std_to_class' , compact('allStudents' , 'id'));           
        
    }
    public function storestudent_to_class(Request $request)
    {
   if(count($request->student_id) > 0 ){
        foreach( $request->student_id  as $student_id){
            $class_student = array(
                'class_id' => $request->class_id,
                's_u_id' => $student_id,
            );
            DB::table('classes_students')->insert($class_student);
        }
          Session::flash('message', 'Selected Student added to class'. DB::table('classes')->where('id',$request->class_id)->pluck('name')->first().'.');
          return redirect('/classes');
   }
   else{
       Session::flash('message', 'No Student Selected');

        return redirect('/classes');
   }
   
   
    }

    public function create()
    {
        //   for permission
            $user = Auth::user()->id;
            $assigned_permissions =array();
            $data = DB::table('module_permissions_users')->where('user_id' , $user)->pluck('allowed_module');

            if($data != null){
                 foreach ($data as $value) {
                $assigned_permissions = explode(',',$value);
                 
            }
            }
            if(!in_array('Add New Class', $assigned_permissions)){
                return redirect('dashboard');
            }
            // end for permission
        $icons = DB::table('icons')->get();
        
    	return view('clases.create', compact('icons'));
    }

    public function store(Request $request)
    {
    	
        $this->validate($request, [
            'name'=>'required|min:1|max:50',
        ]);

        $class = array(
        	'name' => $request->name,
        	'icon_id' => $request->icon,
        );
        $success = DB::table('classes')->insert($class);
        if($success){
            Session::flash('message', 'Class create successfully');
            return redirect('/classes');
        }else{
	        Session::flash('message', 'Something went wrong');
	        return redirect()->back();
        }
    }

    public function edit($id)
    {
    	$icons = DB::table('icons')->get();
        $class = DB::table('classes')->where('id',$id)->first();
        return view ('clases.edit', compact('class', 'icons'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name'=>'required|min:1|max:50',
        ]);
        $class = Clas::find($id);
        $class->name=$request->input('name');
        $class->icon_id=$request->input('icon');

        $success = $class->save();

        // $class = DB::table('classes')->where('id',$id)->get()->first();
    
    	// DB::table('classes')->where('id', $id)->update(['name' => $request->name]);
        Session::flash('message', 'Updated successfully');
        return redirect('/classes');        
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::table('classes_students')->where('s_u_id',$id)->delete();
        DB::table('classes')->where('id',$id)->delete();
        Session::flash('message', 'Class deleted successfully');
    } 
}
