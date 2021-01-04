<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ContactPageController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$contact = DB::table('contactpage')->where('id', 1)->first();
        return view('pages.contact', compact('contact', 'user'));
    }
    public function update(Request $request)
    {
        $contact = DB::table('contactpage')->where('id',1)->get()->first();
        
        $this->validate($request, [
            'title'=>'required|min:3|max:50',
            'image'=>'max:5000',
            'email'=>'required|email|unique:contactpage|max:255'
        ]);

        if ($files = $request->file('image')) {
            $name=$files->getClientOriginalName();
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path() .'\img\upload', $image);
           }
           else{
            $image = $contact->image;
           }
           $data = ContactPage::find(1);
            $data->title=$request->input('title');
            $data->email=$request->input('email');
            $data->address=$request->input('add');
            $data->phone=$request->input('phno');
            $data->image = $image;
            $data->save();
            Session::flash('message', 'Updated Successfully');
            return redirect('/contactpage');
    }
}
