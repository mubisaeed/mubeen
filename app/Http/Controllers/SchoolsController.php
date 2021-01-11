<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SchoolsController extends Controller
{
    public function schools()
    {
    	$user = Auth::user();
        $schools = DB::table('school_super')->where('sup_u_id', Auth::user()->id)->paginate(5);
        // $schools = DB::table('school_super')->where('sup_u_id', Auth::user()->id)->get()->all();
        return view('schools.index', compact('schools', 'user'));
    }
    public function create()
    {
    	$user = Auth::user();
    	return view ('schools.create', compact('user'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'sname' => 'required|min:3|max:20',
            'name' => 'required|min:3|max:20',
            'fname' => 'required|min:3|max:50',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'required',
            'simage' => 'required',
            'phno' => 'required|min:12|max:12',
            'cnic' => 'required|min:13|max:15',
            'sadd' => 'required|min:3|max:200',
            'add' => 'required|min:3|max:200',
        ]);
        if ($files = $request->file('image')) {
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path() .'/assets/img/upload', $image);
       }
       if ($files = $request->file('simage')) {
            $name=$files->getClientOriginalName();
            $simage = time().'.'.$request->simage->getClientOriginalExtension();
            $request->simage->move(public_path() .'/assets/img/upload', $simage);
       }
        $udata = new User();
        $udata->name=$request->input('name');
        $udata->role_id=$request->input('role');
        $udata->email=$request->input('email');
        $udata->contact=$request->input('phno');
        $udata->image=$image;
        $udata->password = Hash::make($request['password']);
        $udata->save();

        $sdata = new School();
        $sdata->sch_u_id = $udata->id;
        $sdata->father_name = $request->fname;
        $sdata->cnic = $request->cnic;
        $sdata->phone = $request->phno;
        $sdata->address = $request->add;
        $sdata->school_address = $request->sadd;
        $sdata->school_name = $request->sname;
        $sdata->school_image = $simage;
        $sdata->save();
        $sup_sch_data = array(
            'sch_u_id' => $sdata->sch_u_id,
            'sup_u_id' => Auth::user()->id,
        );
        $success = DB::table('school_super')->insert($sup_sch_data);
        if($success){
            Session::flash('message', 'Schodol create successfully');
            return redirect('/schools');
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $user = Auth::user();
        $schooldetail = DB::table('schools')->where('sch_u_id',$id)->get()->first();
        return view('schools.show', compact('schooldetail', 'user'));
    }

    public function edit($id)
    {
    	$user = Auth::user();
        $school = DB::table('users')->join('schools','schools.sch_u_id','=','users.id')->where('users.id',$id)->first();
        return view('schools.edit', compact('school', 'user'));
    }

   public function update(Request $request, $id)
    {
       $this->validate($request, [
            'name' => 'required|min:3|max:20',
            'sname' => 'required|min:3|max:20',
            'fname' => 'required|min:3|max:50',
            'phno' => 'required|min:12|max:12',
            'cnic' => 'required|min:13|max:15',
            'add' => 'required|min:3|max:200',
            'sadd' => 'required|min:3|max:200',
        ]);
    	$school = DB::table('schools')->where('id',$id)->get()->first();
        $user = DB::table('users')->where('id',$school->sch_u_id)->get()->first();
        if ($files = $request->file('image')) {
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path() .'/assets/img/upload', $image);
           }
           else{
            $image = $user->image;
           }
           if ($files = $request->file('simage')) {
            $name=$files->getClientOriginalName();
            $simage = time().'.'.$request->simage->getClientOriginalExtension();
            $request->simage->move(public_path() .'/assets/img/upload', $simage);
           }
           else{
            $simage = $school->school_image;
           }
           $udata = User::find($school->sch_u_id);
           $udata->name=$request->input('name');
           $udata->email=$request->input('email');
           $udata->contact=$request->input('phno');
           $udata->image=$image;
           $udata->save();

            $sdata = School::find($id);
            $sdata->school_name=$request->input('sname');
            $sdata->school_address=$request->input('sadd');
            $sdata->school_image=$simage;
            $sdata->father_name=$request->input('fname');
            $sdata->phone=$request->input('phno');
            $sdata->cnic=$request->input('cnic');
            $sdata->address=$request->input('add');
            $success = $sdata->save();
        if($success){
            Session::flash('message', 'Student updated successfully');
            return redirect('/schools');
        }else{
            Session::flash('message', 'Something went wrong');
            return back();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;  
        $user = DB::table('users')->where('id',$id)->get()->first();
        $path="assets/img/upload/$user->image";
        File::delete($path); 
        DB::table('school_super')->where('sch_u_id',$id)->delete();
        DB::table('users')->where('id',$id)->delete();
        DB::table('schools')->where('sch_u_id',$id)->delete();
        Session::flash('message', 'School deleted successfully');
        }
}
