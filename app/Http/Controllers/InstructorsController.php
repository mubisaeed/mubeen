<?php



namespace App\Http\Controllers;



use App\Instructor;

use App\User;

use File;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\DB;

use DB;



class InstructorsController extends Controller

{

    

    public function store_permission_ins(Request $request){

        

       $is_assigned_any_permissions = DB::table('module_permissions_store_instructors')->where('user_id' , $request->id)->first();

       if($is_assigned_any_permissions != null){

       $data = $request->permiss;

       if($data == null)

       {

              $data = ['nodata , nodata'];

       }

            $new = implode(',', $data);

            $result = DB::table('module_permissions_store_instructors')->where('user_id' , $request->id)->update([ 

                 "user_id" => $request->id,

                 "allowed_module" => $new

            ]);



             Session::flash('message', 'Permissions are updated for instructor');

             return redirect('/instructors');

           

       }

       elseif ($is_assigned_any_permissions == null) {

            # code...

            $data = $request->permiss;

            if($data == null)

               {

                     $data = ['nodata , nodata'];

               }

            $new = implode(',', $data);

            $result = DB::table('module_permissions_store_instructors')->insert([ 

                "user_id" => $request->id,

               "allowed_module" => $new

            ]);

           

             Session::flash('message', 'Permissions are updated for instructor');

             return redirect('/instructors');



        } 

        

      

      

    }

    

    public function change_permission_instructor($id){

        // dd($id);

        $user = Auth::user();

        $granted_permissions;

        $granted_permissions = DB::table('module_permissions_store_instructors')->where('user_id' , $id)->first();

        if($granted_permissions == null)

             {

             $granted_permissions = [' ' , ' '];

             

             }

         elseif ($granted_permissions != null) {

                 # code...

                 $granted_permissions = explode(',',$granted_permissions->allowed_module);

              

             } 

       $title = "Change Instructor Permissions";

       $permissions = DB::table('module_permissions_instructors')->pluck('module');

       $page='instructor';

       return view('permissions.addd_remove_permission',compact('user' , 'page' ,'title' , 'id' , 'permissions' , 'granted_permissions'));

    }

    

    public function index(){

        

          

          $user = Auth::user()->id;

          

          if(auth()->user()->role_id != '5'){

            $assigned_permissions =array();

            $data = DB::table('module_permissions_users')->where('user_id' , $user)->pluck('allowed_module');



            if($data != null){

                 foreach ($data as $value) {

                $assigned_permissions = explode(',',$value);

                 

            }

            }

            if(!in_array('All Instructors', $assigned_permissions)){

                return redirect('dashboard');

            }

          }

            

        $user = Auth::user();

        // $instructors = DB::table('instructor_school')->where('sch_u_id', Auth::user()->id)->paginate(5);

        $instructors = DB::table('instructor_school')->where('sch_u_id', Auth::user()->id)->get()->all();

    	return view ('instructors.index', compact('user', 'instructors'));

    }



    public function create(){

        

         $user = Auth::user()->id;

            $assigned_permissions =array();

            $data = DB::table('module_permissions_users')->where('user_id' , $user)->pluck('allowed_module');



            if($data != null){

                 foreach ($data as $value) {

                $assigned_permissions = explode(',',$value);

                 

            }

            }

            if(!in_array('Add Instructor', $assigned_permissions)){

                return redirect('dashboard');

            }

            

            

        $user = Auth::user();

        $schools = DB::table('schools')->get()->all();

    	return view ('instructors.create', compact('user', 'schools'));

    }



    public function store(Request $request){

        $this->validate($request, [

            'name'=>'required|min:3|max:50',

            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'email'=>'required|email|unique:users|max:255',

            'password' => 'required|string|min:8|max:20|confirmed',

            'phno' => 'required|min:12|max:12',

            'cnic' => 'required|min:15|max:15',

            'add' => 'required|min:3|max:200'

        ]);

        if ($files = $request->file('image')) {

            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalName();

            $request->image->move(public_path() .'/assets/img/upload', $imageName);

        }



        $udata = new User();

        $udata->name=$request->input('name');

        $udata->role_id=$request->input('role');

        $udata->email=$request->input('email');

        $udata->contact=$request->input('phno');

        $udata->image=$imageName;

        $udata->password = Hash::make($request['password']);

        $udata->save();



        $instructor=new Instructor;



        $instructor->i_u_id=$udata->id;

        $instructor->phone=$request->phno;

        $instructor->cnic=$request->cnic;

        $instructor->address=$request->add;

        $instructor->save();

            $i_sch_data = array(

            'i_u_id' => $instructor->i_u_id,

            'sch_u_id' => Auth::user()->id,

        ); 

        $success = DB::table('instructor_school')->insert($i_sch_data);

        if($success){

            

            

             $all_perm = DB::table('module_permissions_instructors')->pluck('module')->toArray();

          

            $new = implode(',', $all_perm);

            $result = DB::table('module_permissions_store_instructors')->insert([ 

                 "user_id" => $instructor->i_u_id,

                 "allowed_module" => $new

            ]);

            

            

            Session::flash('message', 'Instructor create successfully');

            return redirect('/instructors');

        }else{

            Session::flash('message', 'Something went wrong');

            return redirect()->back();

        }

    }

    

    public function destroy(Request $request)

    {

        $id = $request->id;

        $user = DB::table('users')->where('id',$id)->get()->first();

        $path="assets/img/upload/$user->image";

        File::delete($path);

        DB::table('instructor_school')->where('i_u_id',$id)->delete();

        DB::table('instructors')->where('i_u_id',$id)->delete();

        DB::table('users')->where('id',$id)->delete();

        Session::flash('message', 'Instructor deleted successfully');

    }   

    public function show($id)

    {

        $user = Auth::user();

        $instructordetail = DB::table('instructors')->where('i_u_id',$id)->get()->first();

        return view('instructors.show', compact('instructordetail', 'user'));

    }

   

    public function edit($id){

        $user = Auth::user();

        $instructor = DB::table('users')->join('instructors','instructors.i_u_id','=','users.id')->where('users.id',$id)->first();

    	return view ('instructors.edit', compact('instructor', 'user'));

    }



    public function update($id, Request $request)

    {

        // dd($request->all());

        $instructor = DB::table('instructors')->where('id',$id)->get()->first();

        $user = DB::table('users')->where('id',$instructor->i_u_id)->get()->first();


        $this->validate($request, [

            'name'=>'required|min:3|max:50',

            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,

            'phno' => 'required|min:12|max:12',

            'cnic' => 'required|min:15|max:15',

            'add' => 'required|min:3|max:200'

        ]);

        // $instructor = Instructor::find($id);

       
        

       

        if ($files = $request->file('image')) {

            $path="assets/img/upload/$user->image";

            @unlink($path);

            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalName();  

            $image->move(public_path() .'/assets/img/upload', $imageName);

           }

           else{

            $imageName = $user->image;

           }



           $udata = User::find($instructor->i_u_id);

           $udata->name=$request->input('name');

           $udata->contact=$request->input('phno');

           $udata->email=$request->input('email');

           $udata->image=$imageName;

           $udata->save();

    

            $data = Instructor::find($id);

            $data->phone=$request->input('phno');

            $data->cnic=$request->input('cnic');

            $data->address=$request->input('add');

            $data->save();

            Session::flash('message', 'Updated successfully');

            return redirect('/instructors');

    }

}

