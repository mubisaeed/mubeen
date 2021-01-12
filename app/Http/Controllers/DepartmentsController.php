<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class DepartmentsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $id = auth()->user()->id;
        $school=School::where('sch_u_id', $id)->first();
        return view ('departments.index', ['departments'=>$school->departments], compact('user'));
    }

    public function create(){
        $user = Auth::user();
    	return view ('departments.create', compact('user'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required|min:1|max:50'
        ]);

        $id = $request->user()->id;
        $school=School::where('sch_u_id', $id)->first();
        $school->departments()->create([
            'name' => $request->name
        ]);
        
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
            'name'=>'required|min:1|max:50',
        ]);
        
        $department->name=$request->name;
        $department->save();
        Session::flash('message', 'Successfully Updated');
        return redirect('/departments');
    }
}
