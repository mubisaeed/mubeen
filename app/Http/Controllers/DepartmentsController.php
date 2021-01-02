<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class DepartmentsController extends Controller
{
    public function index(){
        $departments = Department::all();
        $user = Auth::user();
        return view ('departments.index', ['departments'=>$departments], compact('user'));
    }

    public function create(){
        $user = Auth::user();
    	return view ('departments.create', compact('user'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required|min:3|max:255'
        ]);

        $department=new Department;

        $department->name=$request->name;
        $department->save();
        Session::flash('message', 'Successfully Saved');
        return redirect('/departments');
    }

    public function destroy(Request $request){
        $id = $request->input("id");
        $department = department::find($id);
        $department->delete();
    }

    public function edit($id){
        $department = Department::find($id);
        $user = Auth::user();
    	return view ('departments.edit', ['department'=>$department], compact('user'));
    }

    public function update($id, Request $request){
        $department = Department::find($id);
        
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
        ]);
        
        $department->name=$request->name;
        $department->save();
        Session::flash('message', 'Successfully Updated');
        return redirect('/departments');
    }
}
