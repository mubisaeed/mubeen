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

    public function index($id){
         //dd('asd');
        $id = $id;

        $user = Auth::user();

        $cresources=DB::table('resources')->where('course_id', $id)->get()->all();

        return view ('course_resources.index', compact ('user','cresources', 'id'));

    }



    public function resourcevideo($id){

        $id = $id;

        $user = Auth::user();

        $cresources=DB::table('resources')->where('course_id', $id)->get()->all();

        return view ('course_resources.videos', compact ('user','cresources', 'id'));

    }



    public function resourcevideos($id){

        $id = $id;

        $user = Auth::user();

        $cresources=DB::table('resources')->where('course_id', $id)->get()->all();

        return view ('course_resources.videos', compact ('user','cresources', 'id'));

    }



    public function Storefile(Request $req){
            //dd($req);
        $this->validate($req,

         [

        'file' => 'max:10000|mimes:doc,docx,ppt,pptx,pdf|max:2048',

        'title'=>'required|min:3|max:20',

        'short_des'=>'required|min:10|max:5000',

    ]);

        $cress= new CourseResources;

        $cress->course_id=$req->input('course_id');

        $cress->title=$req->input('title');

        $cress->short_description=$req->input('short_des');

        $file = $req->file('file');

        $fileName = time().'.'.$file->getClientOriginalName();

        $file->move(public_path('storage/'), $fileName);

        $cress->file=$fileName;

        $fileType =$file->getClientOriginalExtension();

        $cress->type=$fileType;

        $cress->save();

        $id = $req->input('course_id');

        if($cress){

            Session::flash('message', 'File Stored Successfully');

            return redirect('/courseresourse/'.$id);

        }

    }



    public function Storevid(Request $req){

        $this->validate($req,[

        'video' => 'max:2048|mimes:mp4,wmv',

        'title'=>'required|min:3|max:20',

        'short_des'=>'required|min:10|max:5000',

    ]);

        $cress= new CourseResources;

        $cress->course_id=$req->input('course_id');

        $cress->title=$req->input('title');

        

        $cress->short_description=$req->input('short_des');

        if ($files = $req->file('video')) {


        $file = $req->file('video');

        $fileName = time().'.'.$file->getClientOriginalName();

        $file->move(public_path('storage/'), $fileName);

        $cress->file=$fileName;

        $fileType =$file->getClientOriginalExtension();

        $cress->type=$fileType;

        }
        else

        $cress->link=$req->input('link');

        $cress->save();

        $id = $req->input('course_id');

        if($cress){

            // dd($cress);

            Session::flash('message', 'Resource Stored Successfully');

            return redirect('/courseresoursevideo/'.$id);

        }

    }



    public function editfile($id, $main){

        $id = $id;

        $cress = CourseResources::find($id);

        $user = Auth::user();

    	return view ('course_resources.edit', compact('user', 'cress', 'id', 'main'));

    }





    public function editvid($id, $main){

        $id = $id;

        $cress = CourseResources::find($id);

        $user = Auth::user();

    	return view ('course_resources.editvid', compact('user', 'cress', 'id', 'main'));

    }



    public function updateres($id, Request $request){



        $this->validate($request, [

            'file' => 'max:2048|mimes:doc,docx,ppt,pptx,pdf|max:2048',

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

        $cress->title=$request->input('title');

        $cress->short_description=$request->input('short_des');

        $cress->file=$fileName;

        $cress->type=$fileType;

        $cress->save();

        Session::flash('message', 'File Updated Successfully');

        return redirect('courseresourse/'.$request->main);        

    }





    public function updatevid(Request $request){



        $this->validate($request, ['video' => 'max:2048|mimes:mp4,wmv',

            'title'=>'required|min:3|max:20',

            'short_des'=>'required|min:10|max:5000',

        ]);



        $cress = CourseResources::find($request->id);

        $user = Auth::user();   

        $cress->title=$request->input('title');

        $cress->short_description=$request->input('short_des');

        if ($files = $request->file('video')) {

            $path="storage/$cress->file";

            File::delete($path);

            $file = $request->file('video');

            $fileName = time().'.'.$file->getClientOriginalName();  

            $file->move(public_path('storage/'), $fileName);

            $fileType =$file->getClientOriginalExtension();

        }

        else{

            $fileName = $cress->file;

            $fileType = $cress->type;

        }

        $cress->title=$request->input('title');

        $cress->short_description=$request->input('short_des');

        $cress->file=$fileName;

        $cress->type=$fileType;

    $cress->link=$req->input('link');

        $cress->save();

        Session::flash('message', 'Resource Updated Successfully');

        return redirect('courseresoursevideo/'.$request->main);        

    }



    public function deleteres(Request $request)

    {

        $id = $request->input("id");

        $res = CourseResources::find($id);

        $path="storage/$res->file";

        File::delete($path);

        CourseResources::where("id", $id)->delete();

        

    }



    public function deletevid(Request $request)

    {

        $id = $request->input("id");

        $res = CourseResources::find($id);

        $path="storage/$res->file";

        File::delete($path);

        CourseResources::where("id", $id)->delete();



    }



    public function download($id){

        $cress = CourseResources::find($id);

        $path='http://127.0.0.1:8000/storage/';

        return response()->download(public_path('/storage/'. $cress->file));

        return Storage::download($path, $cress->file);

    }



    public function resources()

    {

        $user = Auth::user();

        $cress=DB::table('resources')->get()->all();

        return view ('course_resources.index', compact ('user','cress'));

    }

}

