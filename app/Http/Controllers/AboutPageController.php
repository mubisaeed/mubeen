<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AboutPageController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$about = DB::table('aboutpage')->where('id', 1)->first();
        return view('pages.about', compact('about', 'user'));
    }
    public function update(Request $request)
    {
        $about = DB::table('aboutpage')->where('id',1)->get()->first();
        
        $this->validate($request, [
            'title'=>'required|min:3|max:255',
            'image'=>'max:5000',
            'content'=>'required'
        ]);

        if ($files = $request->file('image')) {
            $path="img/upload/$about->image";
            @unlink($path);
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();  
            $image->move(public_path('img/upload'), $imageName);
        }
        else{
         $imageName = $about->image;
        }

           $data = AboutPage::find(1);
            $data->title=$request->input('title');
            $data->content=$request->input('content');
            $data->image = $imageName;
            $data->save();
            Session::flash('message', 'Updated Successfully');
            return redirect('/aboutpage');
    }
}
