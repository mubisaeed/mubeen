<?php

namespace App\Http\Controllers;
use App\Icon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\File;
use Illuminate\support\Facades\Session;

class iconsController extends Controller
{
    //
    public function iconpage(){
        $user = Auth::user();
        return view ('icons.createicon', compact ('user'));
    }

    public function showicon(){
       $user = Auth::user();
        $icons = Icon::orderBy('ID', 'asc')->get();
        return view('icons.viewicon', compact('icons', 'user'));
    }

    public function createicon(Request $req){
        $this->validate($req, [
        'title'=>'required',
        'image'=>'required'
    ]);

        $icon= new Icon;
        $icon->title=$req->input('title');

        $image = $req->file('image');
        $imageName = time().'.'.$image->getClientOriginalName();
        $image->move(public_path('img/icons'), $imageName); 
        $icon->image=$imageName;
        $icon->save();
        if($icon){
        Session::flash('message', 'Successfully Saved');
        return redirect('/viewicon');
            }
        }

    public function editicon($id)
    {
        $user = Auth::user();
        $data=Icon::where('id',$id)->get()->first();
        return view('icons.editicon',compact('data', 'user'));
    }

    public function updateicon(Request $request, $id){
        $icon = Icon::find($id);

        $this->validate($request, [
            'title'=>'required'
        ]);

        
        if ($files = $request->file('image')) {
            $path="img/icons/$icon->image";
            File::delete($path);
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();  
            $image->move(public_path('img/icons'), $imageName);
        }
        else{
            $imageName = $icon->image;
        }
        $icon->title=$request->input('title');
        $icon->image=$imageName;
        $icon->save();
        if($icon){
        Session::flash('message', 'Successfully Updated');
        return redirect('/viewicon');
        }

    }
        
    public function deleteicon(Request $request)
    {
        $id = $request->input("id");
        $icon = Icon::find($id);
        $path="img/icons/$icon->image";
        File::delete($path);
        Icon::where("id", $id)->delete();
    }
}
    