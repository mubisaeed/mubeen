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
        if ($files = $request->file('image')) {
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path() .'\img\upload', $image);
           }
           else{
            $image = $about->image;
           }
           $data = AboutPage::find(1);
            $data->title=$request->input('title');
            $data->content=$request->input('content');
            $data->image = $image;
            $data->save();
            Session::flash('message', 'Updated successfully');
            return redirect('/aboutpage');
    }
}
