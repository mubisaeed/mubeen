<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class InstructorsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $instructors = DB::table('users')->where('role_id', 4)->get()->all();
    	return view ('instructors.index', ['instructors'=>$instructors], compact('user'));
    }

    public function create(){
        $user = Auth::user();
    	return view ('instructors.create', compact('user'));
    }

    public function store(Request $request){
        // dd($request);
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'image'=>'required|max:5000',
            'email'=>'required|email|unique:users|max:255'
        ]);
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalName();  
        $image->move(public_path('img/instructors'), $imageName);

        $udata = new User();
        $udata->name=$request->input('name');
        $udata->role_id=$request->input('role');
        $udata->email=$request->input('email');
        $udata->image=$image;
        $udata->password = Hash::make($request['password']);
        $udata->save();

        $instructor=new Instructor;

        $instructor->i_u_id=$udata->id;
        $instructor->phone=$request->phno;
        $instructor->cnic=$request->cnic;
        $instructor->address=$request->add;
        $instructor->save();
        Session::flash('message', 'Successfully Saved');
        return back();
    }
    
    public function destroy(Request $request)
    {
        $id = $request->id;   
        DB::table('users')->where('id',$id)->delete();
        DB::table('instructors')->where('i_u_id',$id)->delete();
        Session::flash('message', 'Instructor deleted successfully');
    }   
    //     $path="img/instructors/$instructor->image";
    //     File::delete($path);
    public function show($id)
    {
        $user = Auth::user();
        $instructordetail = DB::table('instructors')->where('i_u_id',$id)->get()->all();
        return view('instructors.show', compact('instructordetail', 'user'));
    }
   
    public function edit($id){
        $user = Auth::user();
        $instructor = DB::table('users')->join('instructors','instructors.i_u_id','=','users.id')->where('users.id',$id)->first();
    	return view ('instructors.edit', compact('instructor', 'user'));
    }

    public function update($id, Request $request){
        // $instructor = Instructor::find($id);
        $instructor = DB::table('instructors')->where('id',$id)->get()->first();
        // dd($instructor);
        $user = DB::table('users')->where('id',$instructor->i_u_id)->get()->first();
        if ($files = $request->file('image')) {
            $path="img/instructors/$instructor->image";
            File::delete($path);
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();  
            $image->move(public_path('img/instructors'), $imageName);
           }
           else{
            $imageName = $user->image;
           }

           $udata = User::find($instructor->i_u_id);
           $udata->name=$request->input('name');
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
