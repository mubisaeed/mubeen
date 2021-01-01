<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function students()
    {
        
    	$user = Auth::user();
        $students = DB::table('students')->get();
        return view('students.index', compact('students', 'user'));
    }
    public function create()
    {
    	$user = Auth::user();
    	return view ('students.create', compact('user'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
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
            if ($files = $request->file('image')) {
                $name=$files->getClientOriginalName();
                $image = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path() .'\img\upload', $image);
           }
        $data = array(
            'name'=> $request->sname,
            'father_name'=> $request->fname,
            'phone'=> $request->phno,
            'cnic'=> $request->cnic,
            'address'=> $request->add,
            'class'=> $request->class,
            'rollno'=> $request->rno,
            'image'=>$image,
            'diabetes'=>$request->diabetes,
            'alergy'=>$request->alergy,
            'blood_group'=>$request->blood,
        );
		        $success = DB::table('students')->insert($data);
                // dd($success);
		        if($success){
                    Session::flash('message', 'Student saved successfully');
		            return redirect('/students');
		        }else{
                    Session::flash('message', 'Something went wrong');
		            return redirect()->back();
		        }
    }
    public function edit($id)
    {
    	$user = Auth::user();
        $student = DB::table('students')->where('id',$id)->first();
        return view('students.edit', compact('student', 'user'));
    }

   public function update(Request $request, $id)
    {
        $student = DB::table('students')->where('id',$id)->get()->first();
        if ($files = $request->file('image')) {
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path() .'\img\upload', $image);
           }
           else{
            $image = $student->image;
           }
           $data = Student::find($id);
            $data->name=$request->input('sname');
            $data->father_name=$request->input('fname');
            $data->phone=$request->input('phno');
            $data->cnic=$request->input('cnic');
            $data->address=$request->input('add');
            $data->class=$request->input('class');
            $data->rollno=$request->input('rno');
            $data->blood_group=$request->input('blood');
            $data->diabetes=$request->input('diabetes');
            $data->alergy=$request->input('alergy');
            $data->image = $image;
            $data->save();
            Session::flash('message', 'Updated successfully');
            return redirect('/students');
        if($success){
            Session::flash('message', 'Student updated successfully');
            return redirect('/students');
        }else{
            Session::flash('message', 'Something went wrong');
            return back();
        }
    }

    public function destroy(Request $request)
    {
			$id = $request->id;   
			DB::table('students')->where('id',$id)->delete();
            Session::flash('message', 'Student deleted successfully');
        }
}
