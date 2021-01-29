<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\School;

use App\User;

use File;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;



class SchoolsController extends Controller

{

    

    public function store_permission_school(Request $request){

        

        // dd($request);

       $is_assigned_any_permissions = DB::table('module_permissions_users')->where('user_id' , $request->id)->first();

       if($is_assigned_any_permissions != null){

       $data = $request->permiss;

       if($data == null)

       {

              $data = ['nodata , nodata'];

       }

            $new = implode(',', $data);

            $result = DB::table('module_permissions_users')->where('user_id' , $request->id)->update([ 

                "user_id" => $request->id,

               "allowed_module" => $new

            ]);



             Session::flash('message', 'Permissions are updated for school');

             return redirect('/schools');

            // dd($result . 'record updated');

       }

       elseif ($is_assigned_any_permissions == null) {

            # code...

            $data = $request->permiss;

            if($data == null)

               {

                     $data = ['nodata , nodata'];

               }

            $new = implode(',', $data);

            $result = DB::table('module_permissions_users')->insert([ 

                "user_id" => $request->id,

               "allowed_module" => $new

            ]);

            // dd('permission set');

             Session::flash('message', 'Permissions are updated for school');

             return redirect('/schools');



        } 

    }

    

    public function change_permission_school($id){

        

        

       $user = Auth::user();

        $granted_permissions;

        $granted_permissions = DB::table('module_permissions_users')->where('user_id' , $id)->first();

        if($granted_permissions == null)

             {

             $granted_permissions = [' ' , ' '];

             

             }

         elseif ($granted_permissions != null) {

                 # code...

                 $granted_permissions = explode(',',$granted_permissions->allowed_module);

              

             } 

       $title = "Change School Permissions";

       $permissions = DB::table('module_permissions')->pluck('module');

       $page = 'school';

       return view('permissions.addd_remove_permission',compact('user' , 'page' ,'title' , 'id' , 'permissions' , 'granted_permissions'));

    }

    public function schools()

    {

        // dd('walla');

    	$user = Auth::user();

        // $schools = DB::table('school_super')->where('sup_u_id', Auth::user()->id)->paginate(5);

        $schools = DB::table('school_super')->where('sup_u_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('schools.index', compact('schools', 'user'));

    }

    public function create()

    {

    	$user = Auth::user();

    	return view ('schools.create', compact('user'));

    }

    public function store(Request $request)

    { 

        

        // dd('wadasd');

        $this->validate($request, [

            'sname' => 'required|min:3|max:20',

            'name' => 'required|min:3|max:20',

            'fname' => 'required|min:3|max:50',

            'password' => 'required|string|min:8|confirmed',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'simage' => 'required',

            'phno' => 'required|min:12|max:12',

            'cnic' => 'required|min:13|max:15',

            'sadd' => 'required|min:3|max:200',

            'add' => 'required|min:3|max:200',

        ]);

        if ($files = $request->file('image')) {

            $name=$files->getClientOriginalName();

            $image = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path() .'/assets/img/upload', $image);

       }

       if ($files = $request->file('simage')) {

            $name=$files->getClientOriginalName();

            $simage = time().'.'.$request->simage->getClientOriginalExtension();

            $request->simage->move(public_path() .'/assets/img/upload', $simage);

       }

        $udata = new User();

        $udata->name=$request->input('name');

        $udata->role_id=$request->input('role');

        $udata->email=$request->input('email');

        $udata->contact=$request->input('phno');

        $udata->image=$image;

        $udata->password = Hash::make($request['password']);

        $udata->save();



        $sdata = new School();

        $sdata->sch_u_id = $udata->id;

        $sdata->father_name = $request->fname;

        $sdata->cnic = $request->cnic;

        $sdata->phone = $request->phno;

        $sdata->address = $request->add;

        $sdata->school_address = $request->sadd;

        $sdata->school_name = $request->sname;

        $sdata->school_image = $simage;

        $sdata->save();

        

        

        $sup_sch_data = array(

            'sch_u_id' => $sdata->sch_u_id,

            'sup_u_id' => Auth::user()->id,

        );

        $success = DB::table('school_super')->insert($sup_sch_data);

        

        // dd($sdata);

        $all_perm = DB::table('module_permissions')->pluck('module')->toArray();

        // dd($all_perm);

          

          

            $new = implode(',', $all_perm);

            $result = DB::table('module_permissions_users')->insert([ 

                 "user_id" => $sdata->sch_u_id,

                 "allowed_module" => $new

            ]);

        

        if($success){

            Session::flash('message', 'Schodol create successfully');

            return redirect('/schools');

        }else{

            Session::flash('message', 'Something went wrong');

            return redirect()->back();

        }

    }



    public function show($id)

    {

        $user = Auth::user();

        $schooldetail = DB::table('schools')->where('sch_u_id',$id)->get()->first();

        return view('schools.show', compact('schooldetail', 'user'));

    }



    public function edit($id)

    {

    	$user = Auth::user();

        $school = DB::table('users')->join('schools','schools.sch_u_id','=','users.id')->where('users.id',$id)->first();

        return view('schools.edit', compact('school', 'user'));

    }



   public function update(Request $request, $id)

    {

        $school = DB::table('schools')->where('id',$id)->get()->first();

        $user = DB::table('users')->where('id',$school->sch_u_id)->get()->first();

       $this->validate($request, [

            'name' => 'required|min:3|max:20',

            'sname' => 'required|min:3|max:20',

            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

            'fname' => 'required|min:3|max:50',

            'phno' => 'required|min:12|max:12',

            'cnic' => 'required|min:13|max:15',

            'add' => 'required|min:3|max:200',

            'sadd' => 'required|min:3|max:200',

        ]);

    

        if ($files = $request->file('image')) {

            $path="assets/img/upload/$user->image";

            @unlink($path);

            $name=$files->getClientOriginalName();

            $image = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path() .'/assets/img/upload', $image);

           }

           else{

            $image = $user->image;

           }

           if ($files = $request->file('simage')) {

            $name=$files->getClientOriginalName();

            $simage = time().'.'.$request->simage->getClientOriginalExtension();

            $request->simage->move(public_path() .'/assets/img/upload', $simage);

           }

           else{

            $simage = $school->school_image;

           }

           $udata = User::find($school->sch_u_id);

           $udata->name=$request->input('name');

           $udata->email=$request->input('email');

           $udata->contact=$request->input('phno');

           $udata->image=$image;

           $udata->save();



            $sdata = School::find($id);

            $sdata->school_name=$request->input('sname');

            $sdata->school_address=$request->input('sadd');

            $sdata->school_image=$simage;

            $sdata->father_name=$request->input('fname');

            $sdata->phone=$request->input('phno');

            $sdata->cnic=$request->input('cnic');

            $sdata->address=$request->input('add');

            $success = $sdata->save();

        if($success){

            Session::flash('message', 'Student updated successfully');

            return redirect('/schools');

        }else{

            Session::flash('message', 'Something went wrong');

            return back();

        }

    }



    public function destroy(Request $request)

    {

        $id = $request->id;  

        $user = DB::table('users')->where('id',$id)->get()->first();

        $path="assets/img/upload/$user->image";

        File::delete($path); 

        DB::table('school_super')->where('sch_u_id',$id)->delete();

        DB::table('users')->where('id',$id)->delete();

        DB::table('schools')->where('sch_u_id',$id)->delete();

        Session::flash('message', 'School deleted successfully');

        }

}

