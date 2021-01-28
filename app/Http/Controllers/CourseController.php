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

        

          $user = Auth::user()->id;

            $assigned_permissions =array();

            $data = DB::table('module_permissions_users')->where('user_id' , $user)->pluck('allowed_module');



            if($data != null){

                 foreach ($data as $value) {

                $assigned_permissions = explode(',',$value);

                 

            }

            }

            if(!in_array('Add New Course', $assigned_permissions)){

                return redirect('dashboard');

            }

    	$user = Auth::user();

        $id = auth()->user()->id;

        $school=DB::table('schools')->where('sch_u_id', $id)->first();
        $departments=DB::table('departments')->where('school_id', $id)->get()->all();


        $classes = DB::table('classes')->get()->all();

        // $departments = DB::table('departments')->get()->all();

    	return view ('courses.create', compact('user', 'departments', 'classes'));

    }



    public function coursestore(Request $request)

    {

    		 $this->validate($request, [

                'cname' => 'min:3|max:50',


                'rno' => 'required',


                'sdate' => 'required|date',

                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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

            // 'department'=> $request->department,

            'room_number'=> $request->rno,

            'start_date'=> $request->sdate,

            'end_date'=> $request->edate,

            'course_color'=> $request->ccolor,

            'sessions'=> $request->sessions,

            // 'clas_id'=> $request->cls,

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

            if(!in_array('All Courses', $assigned_permissions)){

                return redirect('dashboard');

            }

         }

    	$user = Auth::user();
        if(Auth::user()->role_id == '4')
        {
            $courses = DB::table('course_instructor')->where('i_u_id', Auth::user()->id)->join('courses', 'courses.id', '=', 'course_instructor.course_id')->get();

        }
        else{
            $courses = DB::table('courses')->orderBy('id', 'desc')->get();
        }
        return view('courses.index', compact('courses', 'user'));

    }

    public function students_courses($id)
    {
        $courses = DB::table('courses')->where('clas_id', $id)->get()->all();
        return view('courses.student_courses', compact('courses'));
    }


    public function class_course($id)

    { 
        $courses = DB::table('courses')->where('clas_id', $id)->get();
        return view('courses.index', compact('courses'));

    }


    public function course_wise_url(Request $request)

    {

    	$user = Auth::user();

    	// $cat = Course::where('slug',$request->cat)->first();

        $cat = DB::table('courses')->where('slug',$request->cat)->first();

        if($cat){

               $course_name = $cat->course_name;
                // dd($course_name);

               return view('courses.course_wise_url', compact('course_name','cat', 'user'));

           }else{

               Session::flash('error','URL Category not found');

               return redirect('/course');

           }

    }

    public function course_replicate(Request $request)
    {

        // dd($request->course_id);

        $oldcourse = DB::table('courses')->where('id', $request->course_id)->first();
        // dd($oldcourse);

        $data = new Course();
        $data->course_name = $oldcourse->course_name;
        $data->room_number = $oldcourse->room_number;
        $data->image = $oldcourse->image;
        $data->start_date = $oldcourse->start_date;
        $data->end_date = $oldcourse->end_date;
        $data->course_color = $oldcourse->course_color;
        $data->sessions = $oldcourse->sessions;
        $data->slug = $oldcourse->slug;
        $data->clas_id = $oldcourse->clas_id;
        $data->course_description = $oldcourse->course_description;

        $data->save();
        DB::table('course_instructor')->insert([
                'i_u_id' => Auth::user()->id,
                'course_id' => $data->id,
            ]);
        if($request->selected > 0)
	        foreach( $request->selected  as $sitems)
	        {
	            if($sitems == 'quiz')
	            {
	                $coursequiz = DB::table('quizzes')->where('course_id', $oldcourse->id)->get()->all();
	                if($coursequiz)
	                {
	                    foreach($coursequiz as $cq)
	                    {
	                        $dup_course_quiz = array(
	                            'quiz_date' => $cq->quiz_date,
	                            'negative_marking' => $cq->negative_marking,
	                            'name' => $cq->name,
	                            'duration' => $cq->duration,
	                            'start_time' => $cq->start_time,
	                            'end_time' => $cq->end_time,
	                            'instructor_id' => $cq->instructor_id,
	                            'course_id' => $data->id,
	                        );

	                        $dupcq = DB::table('quizzes')->insertGetId($dup_course_quiz);
	                        $dqqs = DB::table('quiz_questions')->where('quiz_id', $cq->id)->get()->all();
	                        if($dqqs)
	                        {
	                            foreach ($dqqs as $dqq) 
	                            {
	                                $dup_qq = array(
	                                    'sort_order' => $dqq->sort_order,
	                                    'quiz_id' => $dupcq,
	                                    'question_id' => $dqq->question_id,
	                                );
	                                $success = DB::table('quiz_questions')->insert($dup_qq);
	                                
	                            }
	                            Session::flash('message', 'Course duplicate successfully with its quiz and questions');

	                            return redirect('/course');
	                        }
	                        else
	                        {
	                            Session::flash('message', 'Course and its related quizzes are duplicate successfully.But this created quiz has no questions.');

	                            return redirect('/course');
	                        }
	                    }

	                }
	                else
	                {
	                    Session::flash('message', 'Course duplicate successfully. But it has no quiz and its relevant questions');

	                    return redirect('/course');
	                }
	            }
	            elseif($sitems == 'links')
	            {
	            	$courselink=DB::table('courselink')->where('course_id', $oldcourse->id)->get()->all();
	            	foreach ($courselink as $cl) {
	            	$dup_course_link = array(
	                            'title' => $cl->title,
	                            'short_description' => $cl->short_description,
	                            'link' => $cl->link,
	                            'course_id' => $data->id,
	                        );

	                        $success = DB::table('courselink')->insertGetId($dup_course_link);
	            	}
	            	if($success){

			            Session::flash('message', 'Course Links duplicated successfully');

			            return redirect('/course');

			        }else{

			            Session::flash('message', 'Something went wrong');

			            return redirect()->back();

			        }

	            }
	            elseif($sitems == 'downloadables')
	            {
	            	$cresources=DB::table('resources')->where('course_id', $oldcourse->id)->get()->all();
	            	foreach ($cresources as $cr) 
	            	{
		            	$dup_course_downloads = array(
		                            'title' => $cr->title,
		                            'file' => $cr->file,
		                            'short_description' => $cr->short_description,
		                            'type' => $cr->type,
		                            'course_id' => $data->id,
		                        );

		                $success = DB::table('resources')->insertGetId($dup_course_downloads);
	            	}
	            	if($success){

			            Session::flash('message', 'Course resources duplicated successfully');

			            return redirect('/course');

			        }else{

			            Session::flash('message', 'Something went wrong');

			            return redirect()->back();

			        }
	            }

	        }
	    else
	    {
	    	Session::flash('message', 'Course duplicated successfully without its quizzes and other data.');

            return redirect('/course');	
	    }
    }

    public function course_edit($id)

    {

    	$user = Auth::user();

        $course = DB::table('courses')->where('id',$id)->first();

        $departments = DB::table('departments')->get()->all();

        $classes = DB::table('classes')->get()->all();


        return view('courses.edit', compact('course', 'user', 'departments', 'classes'));

    }



   public function course_update(Request $request, $id)

    {


        $this->validate($request, [

                'cname' => 'required|min:3|max:50',

                // 'department' => 'required|min:2|max:200',

                'rno' => 'required',

                'sdate' => 'required|date',

                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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

        // $data->department=$request->input('department');

        // $data->clas_id=$request->input('cls');

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

            DB::table('quizzes')->where('course_id',$course->id)->delete();
            DB::table('questions')->where('course_id',$course->id)->delete();
            DB::table('resources')->where('course_id',$course->id)->delete();
            DB::table('courselink')->where('course_id',$course->id)->delete();
            DB::table('course_instructor')->where('course_id',$course->id)->delete();
			DB::table('courses')->where('id',$id)->delete();

            Session::flash('message', 'Course deleted successfully');

    }

    public function addinstructor_to_course($id){
            $ins = DB::table('course_instructor')->pluck('i_u_id');
            $instructors = DB::table('instructors')->whereNotIn('i_u_id', $ins)->join('users', 'users.id', '=' , 'instructors.i_u_id')->get()->all();
            return view('courses.add_instructor_to_course' , compact('instructors', 'id'));    
    }

    public function storeinstructor_to_course(Request $request){

         
        if(count($request->instructor_id) > 0 ){
            
        foreach( $request->instructor_id  as $i_u_id){
            DB::table('course_instructor')->insert([
                'i_u_id' => $i_u_id,
                'course_id' => $request->course_id
            ]);
    }
    Session::flash('message', 'Selected Instructor added to Course'. DB::table('courses')->where('id',$request->course_id)->pluck('course_name')->first().'.');
    return redirect('/course');
}
    else{
    Session::flash('message', 'No Class Selected');

    return redirect('/course');
    }

}

    public function see_instructors_of_course($id){

        $instructors = DB::table('course_instructor')->where('course_id' , $id)->get()->all();

        return view('courses.all_instructors_to_course' , compact('instructors', 'id'));
    }

    public function destroy_instructor_from_course(Request $request)

    {
        
			$id = $request->id;  

            $crs_ins = DB::table('course_instructor')->where('id',$id)->delete();

			// DB::table('course_instructor')->where('id',$id)->delete();

            Session::flash('message', 'course_instructor deleted successfully');

    }

}