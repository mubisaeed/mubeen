<?php

namespace App\Http\Controllers;

use App\CourseResources;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class CourseResourcesController extends Controller
{
    public function index(){
        $user = Auth::user();
        $cress=CourseResources::all();
        return view ('course_resources.index', compact ('user','cress'));
    }

    public function create(){
        $user = Auth::user();
        $courses=Course::all();
    	return view ('course_resources.create', compact('user','courses'));
    }

    public function Store(Request $req){
        $this->validate($req,
         [
        'file' => 'required',
        'title'=>'required|min:3|max:20',
        'short_des'=>'required|min:10|max:5000',
    ]);
        $cress= new CourseResources;
        $cress->course_id=$req->input('course');
        $cress->title=$req->input('title');
        $cress->short_description=$req->input('short_des');
        $file = $req->file('file');
        $fileName = time().'.'.$file->getClientOriginalName();
        $file->move(public_path('storage/'), $fileName);
        $cress->file=$fileName;
        $fileType =$file->getClientOriginalExtension();
        $cress->type=$fileType;
        $cress->save();
        if($cress){
            Session::flash('message', 'Resource Stored Successfully');
            return redirect('/courseresourse');
        }
    }

    public function edit($id){
        $cress = CourseResources::find($id);
        $user = Auth::user();
        $courses=Course::all();
    	return view ('course_resources.edit', compact('user', 'cress','courses'));
    }

    public function update($id, Request $request){

        $this->validate($request, [
            'title'=>'required|min:3|max:20',
            'short_des'=>'required|min:10|max:5000',
        ]);

        $cress = CourseResources::find($id);
        $user = Auth::user();   
        if ($files = $request->file('file')) {
            $path="storage/$cress->file";
            File::delete($path);
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalName();  
            $file->move(public_path('storage/'), $fileName);
            $fileType =$file->getClientOriginalExtension();
        }
        else{
            $fileName = $cress->file;
            $fileType = $cress->type;
        }
        $cress->course_id=$request->input('course');
        $cress->title=$request->input('title');
        $cress->short_description=$request->input('short_des');
        $cress->file=$fileName;
        $cress->type=$fileType;
        $cress->save();
        Session::flash('message', 'Resource Updated Successfully');
        return redirect('/courseresourse');        
    }

    public function deleteres(Request $request)
    {
        $id = $request->input("id");
        CourseResources::where("id", $id)->delete();
    }

    public function download($id){
        $cress = CourseResources::find($id);
        $path='http://127.0.0.1:8000/storage/';
        return response()->download(public_path('/storage/'. $cress->file));
        return Storage::download($path, $cress->file);
    }
}
