<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Student;

use App\User;

use File;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ProjectsImport;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Concerns\WithValidation;

use Throwable;

use Illuminate\Support\Facades\DB;



class StudentsController extends Controller

{
    public function import(Request $request)
    {
        $validator = Validator::make(
          [
              'select_file'      => $request->select_file,
              'extension' => strtolower($request->select_file->getClientOriginalExtension()),
          ],
          [
              'select_file'          => 'required',
              'extension'      => 'required|in:xlsx,xls',
          ]
        );
        if ($validator->fails()) 
        {
             return back()->withErrors($validator);
           }

        $file=$request->file('select_file')->store('import');
        //Excel::import(new ProjectsImport, request()->file('file'));
        (new ProjectsImport)->import($file);

        return redirect('/students')->with('message', 'File imported Successfully');
    }

    public function addsample()
    {
        return view('students.sample');
    }

    public function storesample(Request $request)
    {

        $this->validate($request, [

            'file' => 'required|xlsx',

        ]);
        $file = $request->file('file');

        $fileName = time().'.'.$file->getClientOriginalName();

        $file->move(public_path('storage/'), $fileName);

        $fileType =$file->getClientOriginalExtension();

        $sample = array(
            'file' => $fileName,
            'type' => $fileType,
            'school_id' => Auth::user()->id,
        );
        DB::table('student_excel_samples')->insert($sample);
        Session::flash('message', 'File Stored Successfully');
        return view('students.sample');
    }


    public function students()

    {

           $user = Auth::user()->id;
           $students = DB::table('students')->get()->all();

        $schools  = DB::table('schools')->get()->all();

        return view('students.index', compact('students', 'user', 'schools'));

    }


    public function create()

    {
        $user = Auth::user()->id;
    	


        $schools = DB::table('schools')->get()->all();

        $instructors = DB::table('users')->where('id', 4)->get()->all();

        $samples = DB::table('student_excel_samples')->where('school_id', Auth::user()->id)->get()->all();

    	return view ('students.create', compact('user', 'schools', 'instructors', 'samples'));

    }

    public function store(Request $request)

    {
		$this->validate($request, [

            'sname' => 'required|min:3|max:20',

            'lname' => 'required|min:1|max:50',

            'email' => 'required|unique:users|max:255',

            'phno' => 'required|min:12|max:12',

            'password' => 'required|string|min:8|confirmed',

            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'add' => 'required|min:3|max:200',

            'hadd' => 'required|min:3|max:200',

            'gl' => 'required',

            'alergy' => 'required',

            'gender' => 'required',

            'record_no' => 'required',

        ]);

        if ($file = $request->file('image')) {

            $name=$file->getClientOriginalName();

            $image = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path() .'/assets/img/upload', $image);

       }
        // dd($image);

        if($request->iep == 1)
        {
            $iep = '1st Grade(Elementary)';
        }
        elseif($request->iep == 2)
        {
            $iep = '2nd Grade(Elementary)';
        }
        elseif($request->iep == 3)
        {
            $iep = '3rd Grade(Elementary)';
        }
        elseif($request->iep == 4)
        {
            $iep = '4th Grade(Elementary)';
        }
        elseif($request->iep == 5)
        {
            $iep = '5th Grade(Elementary)';
        }
        elseif($request->iep == 6)
        {
            $iep = '6th Grade(Elementary)';
        }
        elseif($request->iep == 7)
        {
            $iep = '7th Grade(Middle)';
        }
        elseif($request->iep == 8)
        {
            $iep = '8th Grade(Middle)';
        }
        elseif($request->iep == 9)
        {
            $iep = '9th Grade(Highschool)';
        }
        elseif($request->iep == 10)
        {
            $iep = '10th Grade(Highschool)';
        }
        elseif($request->iep == 11)
        {
            $iep = '11th Grade(Highschool)';
        }
        elseif($request->iep == 12)
        {
            $iep = '12th Grade(Highschool)';
        }

        $udata = new User();

        $udata->name=$request->input('sname');

        $udata->role_id=$request->input('role');

        $udata->email=$request->input('email');

        $udata->contact=$request->input('phno');

        $udata->image= $image;

        $udata->password = Hash::make($request['password']);

        $udata->save();


        $alrgy = implode(", ", $request->input('alergy'));

        $sdata = new Student();

        $sdata->s_u_id = $udata->id;

        $sdata->last_name = $request->lname;

        $sdata->record_no = $request->record_no;

        $sdata->home_address = $request->hadd;

        $sdata->gender = $request->gender;

        $sdata->grade_level = $request->gl;

        $sdata->alergy = $alrgy;

        $sdata->iep = $iep;

        $sdata->parent_first_name = $request->pfname;

        $sdata->parent_last_name = $request->plname;

        $sdata->parent_email = $request->pemail;

        $sdata->relation = $request->relation;

        $sdata->phone = $request->phno;

        $sdata->address = $request->add;

        $sdata->save();

        $success = DB::table('users')->where('id' , $udata->id)->update([
            'unique_id' => $udata->name . '' . $udata->id,
        ]);

        //     $student_created_by_data = array(

        //         's_u_id' => $sdata->s_u_id,

        //         'created_by_id' => Auth::user()->id,

        //     );

        // $success = DB::table('instructor_student')->insert($student_created_by_data);

        // if($success){

            Session::flash('message', 'Student saved successfully');

            return redirect('/students');

        // }else{

        //     Session::flash('message', 'Something went wrong');

        //     return redirect()->back();

        // }

    }



    public function show($id)

    {

        $user = Auth::user();

        $studentsdetail = DB::table('students')->where('s_u_id',$id)->get()->all();

        return view('students.show', compact('studentsdetail', 'user'));

    }



    public function edit($id)

    {

    	$user = Auth::user();

        $student = DB::table('users')->join('students','students.s_u_id','=','users.id')->where('users.id',$id)->first();

        return view('students.edit', compact('student', 'user'));

    }

   public function update(Request $request, $id)

    {
        $student = DB::table('students')->where('id',$id)->get()->first();

        $user = DB::table('users')->where('id',$student->s_u_id)->get()->first();

        $this->validate($request, [

            'sname' => 'required|min:3|max:20',

            'fname' => 'required|min:3|max:50',

            'phno' => 'required|min:12|max:12',

            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'adate' => 'required|date',

            'cnic' => 'required|min:13|max:15',

            'add' => 'required|min:3|max:200',

            'class' => 'required|min:3|max:20',

            'diabetes' => 'required',

            'alergy' => 'required',

            'rno' => 'required',

        ]);



        if ($files = $request->file('image')) {

            $path="assets/img/upload/$user->image";

            @unlink($path);

            $name=$files->getClientOriginalName();

            $image = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path() .'/assets/img/upload', $image);

           }

           else{

            $image = $user->image;

           }

           $udata = User::find($student->s_u_id);

           $udata->name=$request->input('sname');

           $udata->email=$request->input('email');

           $udata->contact=$request->input('phno');

           $udata->image=$image;

           $udata->save();



            $data = Student::find($id);

            $data->father_name=$request->input('fname');

            $data->phone=$request->input('phno');

            $data->cnic=$request->input('cnic');

            $data->address=$request->input('add');

            $data->admission_date=$request->input('adate');

            $data->gender=$request->input('gender');

            $data->class=$request->input('class');

            $data->rollno=$request->input('rno');

            $data->diabetes=$request->input('diabetes');

            $data->alergy=$request->input('alergy');

            $data->save();

            Session::flash('message', 'Updated successfully');

            return redirect('/students');

    }

   public function destroy(Request $request)

      {

          $id = $request->id;   

          $user = DB::table('users')->where('id',$id)->get()->first();

          $path="assets/img/upload/$user->image";

          File::delete($path);

          DB::table('instructor_student')->where('s_u_id',$id)->delete();

          DB::table('students')->where('s_u_id',$id)->delete();

          DB::table('users')->where('id',$id)->delete();

          Session::flash('message', 'Student deleted successfully');

      }

}

