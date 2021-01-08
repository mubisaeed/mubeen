<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class InstructorsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $instructors = DB::table('instructor_school')->where('sch_u_id', Auth::user()->id)->get()->all();
    	return view ('instructors.index', compact('user', 'instructors'));
    }

    public function create(){
        $user = Auth::user();
    	return view ('instructors.create', compact('user'));
    }

    public function store(Request $request){
        // dd($request);
        $this->validate($request, [
            'name'=>'required|min:3|max:50',
            'image'=>'required|max:5000',
            'email'=>'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|max:20|confirmed',
            'phno' => 'required|min:12|max:12',
            'cnic' => 'required|min:15|max:15',
            'add' => 'required|min:3|max:200'
        ]);
        if ($files = $request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $request->image->move(public_path() .'\img\upload', $imageName);
        }

        $udata = new User();
        $udata->name=$request->input('name');
        $udata->role_id=$request->input('role');
        $udata->email=$request->input('email');
        $udata->contact=$request->input('phno');
        $udata->image=$imageName;
        $udata->password = Hash::make($request['password']);
        $udata->save();

        $instructor=new Instructor;

        $instructor->i_u_id=$udata->id;
        $instructor->phone=$request->phno;
        $instructor->cnic=$request->cnic;
        $instructor->address=$request->add;
        $instructor->save();
        $i_sch_data = array(
            'i_u_id' => $instructor->i_u_id,
            'sch_u_id' => Auth::user()->id,
        ); 
        $success = DB::table('instructor_school')->insert($i_sch_data);
        if($success){
            Session::flash('message', 'Instructor create successfully');
            return redirect('/instructors');
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }
    
    public function destroy(Request $request)
    {
        $id = $request->id;   
        $user = DB::table('users')->where('id',$id)->get()->first();
        $path="img/upload/$user->image";
        File::delete($path);
        DB::table('instructor_school')->where('i_u_id',$id)->delete();
        DB::table('instructors')->where('i_u_id',$id)->delete();
        DB::table('users')->where('id',$id)->delete();
        Session::flash('message', 'Instructor deleted successfully');
    }   
    public function show($id)
    {
        $user = Auth::user();
        $instructordetail = DB::table('instructors')->where('i_u_id',$id)->get()->first();
        return view('instructors.show', compact('instructordetail', 'user'));
    }
   
    public function edit($id){
        $user = Auth::user();
        $instructor = DB::table('users')->join('instructors','instructors.i_u_id','=','users.id')->where('users.id',$id)->first();
    	return view ('instructors.edit', compact('instructor', 'user'));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name'=>'required|min:3|max:50',
            'image'=>'max:5000',
            'email'=>'required|max:255',
            'phno' => 'required|min:12|max:12',
            'cnic' => 'required|min:15|max:15',
            'add' => 'required|min:3|max:200'
        ]);
        // $instructor = Instructor::find($id);
        $instructor = DB::table('instructors')->where('id',$id)->get()->first();
        
        $user = DB::table('users')->where('id',$instructor->i_u_id)->get()->first();
        if ($files = $request->file('image')) {
            $path="img/upload/$user->image";
            @unlink($path);
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();  
            $image->move(public_path('img/upload'), $imageName);
           }
           else{
            $imageName = $user->image;
           }

           $udata = User::find($instructor->i_u_id);
           $udata->name=$request->input('name');
           $udata->contact=$request->input('phno');
           $udata->email=$request->input('email');
           $udata->image=$imageName;
           $udata->save();
    
            $data = Instructor::find($id);
            $data->phone=$request->input('phno');
            $data->cnic=$request->input('cnic');
            $data->address=$request->input('add');
            $data->save();
            Session::flash('message', 'Updated successfully');
            return redirect('/instructors');
    }
}
