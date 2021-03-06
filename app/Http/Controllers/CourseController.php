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

            if(auth()->user()->role_id == '4')
            {
              $data = DB::table('module_permissions_store_instructors')->where('user_id' , $user)->pluck('allowed_module');
            }

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


            'building' => 'required',


            'sdate' => 'required|date',

            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // 'edate' => 'required|date|after_or_equal:sdate',

            'ccolor' => 'required',

            'sessions' => 'required',
            
            'cdescription' => 'required',

            ]);

             if ($files = $request->file('image')) {

            $name=$files->getClientOriginalName();

            $image = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path() .'/assets/img/upload', $image);

       }

    	$str = strtolower($request->cname);

        $slug = preg_replace('/\s+/', '-', $str);

        if($request->sessions == 1)
        {
            $weeks = 9;
        }
        elseif($request->sessions == 2)
        {
            $weeks = 18;
        }
        elseif($request->sessions == 3)
        {
            $weeks = 27;
        }
        elseif($request->sessions == 4)
        {
            $weeks = 36;
        }

        // $time = \Carbon\Carbon::now()->format('Y-m-d');
        $sdate = $request->sdate;
        $days = $weeks * 7;
        $enddate = (new \Carbon\Carbon($sdate))->addDays($days);
        $edate = $enddate->format('y-m-d');


        $data = array(

            'course_name'=> $request->cname,

            'image'=> $image,

            'user_id'=> Auth::user()->id,

            'room_number'=> $request->rno,

            'building'=> $request->building,

            'start_date'=> $request->sdate,

            'end_date'=> $edate,

            'course_color'=> $request->ccolor,

            'sessions'=> $request->sessions,

            'weeks'=> $weeks,

            'slug'=> $slug,

            'course_description'=> $request->cdescription,

        );
		$c = DB::table('courses')->insertGetId($data);

        $AAgrade = array(
           'course_id' => $c,
            'marks_from' => 95.5, 
            'marks_to' => 100, 
            'grade' => 'A+', 
        );

        $Agrade = array(
            'course_id' => $c,
            'marks_from' => 90.5, 
            'marks_to' => 95, 
            'grade' => 'A', 
        );
        $BBgrade = array(
            'course_id' => $c,
            'marks_from' => 80.5, 
            'marks_to' => 90, 
            'grade' => 'B+', 
        );
        $Bgrade = array(
            'course_id' => $c,
            'marks_from' => 75.5, 
            'marks_to' => 80, 
            'grade' => 'B', 
        );
        $CCgrade = array(
            'course_id' => $c,
            'marks_from' => 70.5, 
            'marks_to' => 75, 
            'grade' => 'C+', 
        );
        $Cgrade = array(
            'course_id' => $c,
            'marks_from' => 60.5, 
            'marks_to' => 70, 
            'grade' => 'C', 
        );
        $DDgrade = array(
            'course_id' => $c,
            'marks_from' => 55.5, 
            'marks_to' => 60, 
            'grade' => 'D+', 
        );
        $Dgrade = array(
            'course_id' => $c,
            'marks_from' => 45.5, 
            'marks_to' => 55, 
            'grade' => 'D', 
        );
        $EEgrade = array(
            'course_id' => $c,
            'marks_from' => 30.5, 
            'marks_to' => 45, 
            'grade' => 'E+', 
        );
        $Egrade = array(
           'course_id' => $c,
            'marks_from' => 20.5, 
            'marks_to' => 30, 
            'grade' => 'E', 
        );
        $Fgrade = array(
            'course_id' => $c,
            'marks_from' => 0, 
            'marks_to' => 20, 
            'grade' => 'F', 
        );


        $success = DB::table('grades')->insert($AAgrade);
        $success = DB::table('grades')->insert($Agrade);
        $success = DB::table('grades')->insert($BBgrade);
        $success = DB::table('grades')->insert($Bgrade);
        $success = DB::table('grades')->insert($CCgrade);
        $success = DB::table('grades')->insert($Cgrade);
        $success = DB::table('grades')->insert($DDgrade);
        $success = DB::table('grades')->insert($Dgrade);
        $success = DB::table('grades')->insert($EEgrade);
        $success = DB::table('grades')->insert($Egrade);
        $success = DB::table('grades')->insert($Fgrade);


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

        
        $user = Auth::user()->id;
         if(auth()->user()->role_id != '5'){

          $user = Auth::user()->id;

            $assigned_permissions =array();

            $data = DB::table('module_permissions_users')->where('user_id' , $user)->pluck('allowed_module');


            if(auth()->user()->role_id == '4')
            {
              $data = DB::table('module_permissions_store_instructors')->where('user_id' , $user)->pluck('allowed_module');
            }

            if($data != null){

                foreach ($data as $value) 
                 {

                    $assigned_permissions = explode(',',$value);

                 }

            }

            if(!in_array('All Courses', $assigned_permissions)){

                return redirect('dashboard');

            }

         }

    	$user = Auth::user();

        if(auth()->user()->role_id == '4')
        {
            $courses = DB::table('course_instructor')->where('i_u_id', Auth::user()->id)->orderBy('id', 'desc')->get()->all();

        }
        else
        {
            $courses = DB::table('courses')->orderBy('id', 'desc')->get();
        }
        return view('courses.index', compact('courses', 'user'));

    }

    public function course_grades($id)
    {
       $grades = DB::table('grades')->where('course_id', $id)->get()->all();
        return view('courses.grades', compact('grades'));
    }


    public function show_details($id, $clasid)
    {
        $course = DB::table('courses')->where('id', $id)->get()->first();
        $weeks = $course->weeks;
        $instructor_id = Auth::user()->id;
        return view('courses.show_details', compact('course', 'weeks', 'instructor_id', 'clasid'));
    }

    public function show_week_details($insid, $cid, $week, $clasid)
    {
        $mquizzes = DB::table('quizzes')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'monday'],
        ])->orderBy('id', 'desc')->get()->all();
        $tuesquizzes = DB::table('quizzes')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'tuesday'],
        ])->orderBy('id', 'desc')->get()->all();
        $wedquizzes = DB::table('quizzes')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'wednesday'],
        ])->orderBy('id', 'desc')->get()->all();
        $tquizzes = DB::table('quizzes')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'thursday'],
        ])->orderBy('id', 'desc')->get()->all();
        $fquizzes = DB::table('quizzes')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', "friday"],
        ])->orderBy('id', 'desc')->get()->all();


        $mlinks = DB::table('courselink')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'monday'],
        ])->orderBy('id', 'desc')->get()->all();
        $tueslinks = DB::table('courselink')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'tuesday'],
        ])->orderBy('id', 'desc')->get()->all();
        $wedlinks = DB::table('courselink')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'wednesday'],
        ])->orderBy('id', 'desc')->get()->all();
        $tlinks = DB::table('courselink')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'thursday'],
        ])->orderBy('id', 'desc')->get()->all();
        $flinks = DB::table('courselink')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'friday'],
        ])->orderBy('id', 'desc')->get()->all();




        $mlectures = DB::table('lectures')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'monday'],
        ])->orderBy('id', 'desc')->get()->all();
         $tueslectures = DB::table('lectures')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'tuesday'],
        ])->orderBy('id', 'desc')->get()->all();
          $wedlectures = DB::table('lectures')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'wednesday'],
        ])->orderBy('id', 'desc')->get()->all();
           $thlectures = DB::table('lectures')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'thursday'],
        ])->orderBy('id', 'desc')->get()->all();
            $flectures = DB::table('lectures')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', 'friday'],
        ])->orderBy('id', 'desc')->get()->all();





        $mvideoos = DB::table('resources')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', "monday"],
        ])->orderBy('id', 'desc')->get()->all();
        $tuesvideoos = DB::table('resources')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', "tuesday"],
        ])->orderBy('id', 'desc')->get()->all();
        $wedvideoos = DB::table('resources')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', "wednesday"],
        ])->orderBy('id', 'desc')->get()->all();
        $tvideoos = DB::table('resources')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', "thursday"],
        ])->orderBy('id', 'desc')->get()->all();
        $fvideoos = DB::table('resources')->where([
            ['instructor_id', '=', $insid],
            ['course_id', '=', $cid],
            ['week', '=', $week],
            ['day', '=', "friday"],
        ])->orderBy('id', 'desc')->get()->all();


        
        return view('courses.show_week_details', compact('mquizzes','tuesquizzes','wedquizzes' ,'tquizzes' ,'fquizzes', 'mlinks', 'tueslinks', 'wedlinks', 'tlinks', 'flinks', 'mlectures', 'tueslectures', 'wedlectures', 'thlectures', 'flectures', 'mvideoos', 'tuesvideoos', 'wedvideoos', 'tvideoos', 'fvideoos', 'insid', 'cid', 'week', 'clasid'));
    }

    public function students_courses($id)
    {
        $courses = DB::table('courses')->where('clas_id', $id)->get()->all();
        return view('courses.student_courses', compact('courses', 'id'));
    }


    public function class_course($id)

    { 
        $courses = DB::table('courses')->where('clas_id', $id)->get();
        return view('courses.class_courses', compact('courses', 'id'));

    }

    public function class_stds($id)
    { 
        $students = DB::table('classes_students')->where('class_id', $id)->get()->all();
        return view('clases.no_students_of_class', compact('students'));

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

    public function course_replicate(Request $request)
    {
        $oldcourse = DB::table('courses')->where('id', $request->course_id)->first();

        $data = new Course();
        $data->course_name = $oldcourse->course_name;
        $data->building = $oldcourse->building;
        $data->room_number = $oldcourse->room_number;
        $data->image = $oldcourse->image;
        $data->user_id = $oldcourse->user_id;
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

                'building' => 'required',

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

        $data->room_number=$request->input('rno');

        $data->building=$request->input('building');

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