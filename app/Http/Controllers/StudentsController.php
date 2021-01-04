<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function students()
    {
        
    	$user = Auth::user();
        $students = DB::table('users')->where('role_id', 5)->get()->all();
        return view('students.index', compact('students', 'user'));
    }

    public function create()
    {
    	$user = Auth::user();
    	return view ('students.create', compact('user'));
    }
    public function store(Request $request)
    {
		$this->validate($request, [
            'sname' => 'required','min:3','max:20',
            'fname' => 'required','min:3','max:50',
            'phno' => 'required','min:11','max:11',
            'image' => 'required',
            'cnic' => 'required','min:13','max:15',
            'add' => 'required','min:3','max:200',
            'class' => 'required','min:3','max:20',
            'diabetes' => 'required',
            'alergy' => 'required',
            'rno' => 'required',
        ]);
        $udata = new User();
        $udata->name=$request->input('sname');
        $udata->role_id=$request->input('role');
        $udata->email=$request->input('email');
        $udata->password = Hash::make($request['password']);
        $udata->save();
        if ($files = $request->file('image')) {
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path() .'\img\upload', $image);
       }
        $sdata = array(
            's_u_id'=> $udata->id,
            'father_name'=> $request->fname,
            'father_name'=> $request->fname,
            'cnic'=> $request->cnic,
            'phone'=> $request->phno,
            'address'=> $request->add,
            'class'=> $request->class,
            'rollno'=> $request->rno,
            'diabetes'=>$request->diabetes,
            'alergy'=>$request->alergy,
            'blood_group'=>$request->blood,
        );
        $success = DB::table('students')->insert($sdata);
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
        if ($files = $request->file('image')) {
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path() .'\img\upload', $image);
           }
           else{
            $image = $user->image;
           }
           $udata = User::find($student->s_u_id);
           $udata->name=$request->input('sname');
           $udata->email=$request->input('email');
           $udata->image=$image;
           $udata->save();

            $data = Student::find($id);
            $data->father_name=$request->input('fname');
            $data->phone=$request->input('phno');
            $data->cnic=$request->input('cnic');
            $data->address=$request->input('add');
            $data->class=$request->input('class');
            $data->rollno=$request->input('rno');
            $data->blood_group=$request->input('blood');
            $data->diabetes=$request->input('diabetes');
            $data->alergy=$request->input('alergy');
            $data->save();
            Session::flash('message', 'Updated successfully');
            return redirect('/students');
    }

    public function destroy(Request $request)
    {
			$id = $request->id;   
            DB::table('users')->where('id',$id)->delete();
			DB::table('students')->where('s_u_id',$id)->delete();
            Session::flash('message', 'Student deleted successfully');
        }
}
