<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;


use File;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ProjectsImport;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;



class StudentsController extends Controller

{
    public function import(Request $request)
    {

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

            'fname' => 'required|min:1|max:50',

            'email' => 'required|unique:users|max:255',

            'phno' => 'required|min:12|max:12',

            'adate' => 'required|date',

            'password' => 'required|string|min:8|confirmed',

            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'cnic' => 'required|min:13|max:15',

            'add' => 'required|min:3|max:200',

            'class' => 'required|min:3|max:20',

            'diabetes' => 'required',

            'alergy' => 'required',

            'gender' => 'required',

            'rno' => 'required',

        ]);

        if ($files = $request->file('image')) {

            $name=$files->getClientOriginalName();

            $image = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path() .'/assets/img/upload', $image);

       }

        $udata = new User();

        $udata->name=$request->input('sname');

        $udata->role_id=$request->input('role');

        $udata->email=$request->input('email');

        $udata->contact=$request->input('phno');

        $udata->image=$image;

        $udata->password = Hash::make($request['password']);

        $udata->save();



        $sdata = new Student();

        $sdata->s_u_id = $udata->id;

        $sdata->father_name = $request->fname;

        $sdata->cnic = $request->cnic;

        $sdata->admission_date = $request->adate;

        $sdata->phone = $request->phno;

        $sdata->gender = $request->gender;

        $sdata->address = $request->add;

        $sdata->class = $request->class;

        $sdata->rollno = $request->rno;

        $sdata->diabetes = $request->diabetes;

        $sdata->alergy = $request->alergy;

        $sdata->save();

        $success = DB::table('users')->where('id' , $udata->id)->update([
            'unique_id' => $udata->name . '' . $udata->id,
        ]);

            // $i_s_data = array(

            //     's_u_id' => $sdata->s_u_id,

            //     'i_u_id' => Auth::user()->id,

            // );

        // $success = DB::table('instructor_student')->insert($i_s_data);

        if($success){

            Session::flash('message', 'Student saved successfully');

            return redirect('/students');

        }else{

            Session::flash('message', 'Something went wrong');

            return redirect()->back();

        }

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

