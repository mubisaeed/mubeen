<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show_profile()
    {
    	$user = Auth::user();
    	return view ('profile.show', compact('user'));
    }

    public function edit_profile()
    {
    	$user = Auth::user();
        // $password = Crypt::decrypt($user->password);
    	return view ('profile.edit', compact('user'));
    }

    public function updateprofile(Request $request, $id)
    {
    	$user = User::find($id);
    	$this->validate($request, [
            'name' => 'required|min:2|max:20',
            'contact' => 'required|min:12|max:12',
            'bio' => 'required',
        ]);
    	if ($files = $request->file('image')) {
	    	$name=$files->getClientOriginalName();
	        $image = time().'.'.$request->image->getClientOriginalExtension();
	        $request->image->move(public_path() .'\img\upload', $image);
	       }
       else{
       	$image = $user->image;
       }
       if($request->input('password'))
       {
        $this->validate($request, [
            'password' => 'required|min:8|confirmed',
        ]);
        $password=$request->input('password');
       }
        else {
        $password = $user->password;
    }
        $data = User::find($id);
        $data->name=$request->input('name');
        $data->email=$request->input('email');
        $data->contact=$request->input('contact');
        $data->bio=$request->input('bio');
        $data->image = $image;
        $data->save();
        Session::flash('message', 'Updated  successfully');
        return redirect('/showprofile');
    }
}
