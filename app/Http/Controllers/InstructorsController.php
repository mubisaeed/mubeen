<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class InstructorsController extends Controller
{
    public function index(){
        $instructors = Instructor::all();
        $user = Auth::user();
    	return view ('instructors.index', ['instructors'=>$instructors], compact('user'));
    }

    public function create(){
        $user = Auth::user();
    	return view ('instructors.create', compact('user'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'image'=>'required|max:5000',
            'bio'=>'required|min:10|max:3000',
            'email'=>'required|email|unique:instructors|max:255'
        ]);

        $instructor=new Instructor;

        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalName();  
        $image->move(public_path('img/instructors'), $imageName);

        $instructor->name=$request->name;
        $instructor->image=$imageName;
        $instructor->bio=$request->bio;
        $instructor->email=$request->email;
        $instructor->save();
        return redirect('/instructors');
    }
    
    public function destroy($id){
        $instructor = Instructor::find($id);
        $path="img/instructors/$instructor->image";
        File::delete($path);
        $instructor->delete();
        return redirect('/instructors');
    }
   
    public function edit($id){
        $instructor = Instructor::find($id);
        $user = Auth::user();
    	return view ('instructors.edit', ['instructor'=>$instructor], compact('user'));
    }

    public function update($id, Request $request){
        $instructor = Instructor::find($id);
        
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'image'=>'max:5000',
            'bio'=>'required|min:10|max:3000',
            'email'=>'required|email|max:255'
        ]);

        if ($files = $request->file('image')) {
            $path="img/instructors/$instructor->image";
            File::delete($path);
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();  
            $image->move(public_path('img/instructors'), $imageName);
           }
           else{
            $imageName = $instructor->image;
           }
        
        $instructor->name=$request->name;
        $instructor->image=$imageName;
        $instructor->bio=$request->bio;
        $instructor->email=$request->email;
        $instructor->save();
        return redirect('/instructors');
    }
}
