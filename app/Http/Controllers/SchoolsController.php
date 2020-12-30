<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SchoolsController extends Controller
{
    public function schools()
    {
    	$user = Auth::user();
        $schools = DB::table('schools')->get();
        return view('schools.index', compact('schools', 'user'));
    }
    public function create()
    {
    	$user = Auth::user();
    	return view ('schools.create', compact('user'));
    }
    public function store(Request $request)
    {
    		$request->validate([
                'sname' => 'required','min:3','max:50',
                'image' => 'required',
                'add' => 'required','min:3','max:200',
                'oname' => 'required','min:3','max:70',
                'oadd' => 'required','min:3','max:200',
            ]);
	        if ($files = $request->file('image')) {
		    	$name=$files->getClientOriginalName();
		        $image = time().'.'.$request->image->getClientOriginalExtension();
		        $request->image->move(public_path() .'\img\upload', $image);
	       }
        $data = array(
            'name'=> $request->sname,
            'owner_name'=> $request->oname,
            'owner_address'=> $request->oadd,
            'address'=> $request->add,
            'logo'=>$image,
            );
		        $success = DB::table('schools')->insert($data);
		        if($success){
                    Session::flash('message', 'School saved successfully');
		            return redirect('/schools');
		        }else{
                    Session::flash('message', 'Something went wrong');
		            return redirect()->back();
		        }
    }
    public function edit($id)
    {
    	$user = Auth::user();
        $school = DB::table('schools')->where('id',$id)->first();
        return view('schools.edit', compact('school', 'user'));
    }

   public function update(Request $request, $id)
    {
        $request->validate([
                'sname' => 'required','min:3','max:50',
                'image' => 'required',
                'add' => 'required','min:3','max:200',
                'oname' => 'required','min:3','max:70',
                'oadd' => 'required','min:3','max:200',
            ]);
    	$school = DB::table('schools')->where('id',$id)->get()->first();
        if ($files = $request->file('image')) {
	    	$name=$files->getClientOriginalName();
	        $image = time().'.'.$request->image->getClientOriginalExtension();
	        $request->image->move(public_path() .'\img\upload', $image);
	       }
	       else{
	       	$image = $school->logo;
	       }
	       	$data = School::find($id);
	        $data->name=$request->input('sname');
	        $data->owner_name=$request->input('oname');
	        $data->owner_address=$request->input('oadd');
	        $data->address=$request->input('add');
	        $data->logo = $image;
	        $data->save();
            Session::flash('message', 'Updated successfully');
            return redirect('/schools');
    }

    public function destroy(Request $request)
    {
			$id = $request->id;   
			DB::table('schools')->where('id',$id)->delete();
            Session::flash('message', 'Deleted successfully');
        }
}
