<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Setting;
class SettingsController extends Controller
{
    public function setting()
    {
        $user = Auth::user();
        $setting = Setting::get()->first();
        return view('settings.settings', compact('setting','user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
        'phone' => 'max:11|min:11',
        ]);

        $data=Setting::where('id', 1)->first();
        $data->facebook_url=$request->input('fb');
        $data->twitter_url=$request->input('twitter');
        $data->youtube_url=$request->input('youtube');
        $data->contact_email=$request->input('contact');
        $data->notification_email=$request->input('Noti');
        $data->phone_number=$request->input('phone');
        $data->save();
        // Session::flash('message', 'Updated successfully');
        return redirect('/setting');
    }
}




// public function update(Request $request, $id)
//     {
//     	$school = DB::table('schools')->where('id',$id)->get()->first();
//     	$this->validate($request, [
//                 'sname' => ['required', 'string', 'max:255'],
//                 'image' => ['mimes:jpeg,png'],
//                 'add' => ['required'],
//                 'oname' => ['required'],
//                 'oadd' => ['required'],
//             ]);
//         if ($files = $request->file('image')) {
// 	    	$name=$files->getClientOriginalName();
// 	        $image = time().'.'.$request->image->getClientOriginalExtension();
// 	        $request->image->move(public_path() .'\img\upload', $image);
// 	       }
// 	       else{
// 	       	$image = $school->logo;
// 	       }
// 	       	$data = School::find($id);
// 	        $data->name=$request->input('sname');
// 	        $data->owner_name=$request->input('oname');
// 	        $data->owner_address=$request->input('oadd');
// 	        $data->address=$request->input('add');
// 	        $data->logo = $image;
// 	        $data->save();
//             Session::flash('message', 'Updated successfully');
//             return redirect('/schools');
//     }