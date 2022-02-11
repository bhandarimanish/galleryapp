<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Album;
use Image as Interventionimage;

class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['only' => ['index', 'addimage','destroy','store','addcoverimage']]);

   }
    public function index() {
        $images=Image::get();
        return view('home',compact('images'));
    }

    public function album() {
        $albums=Album::with('images')->get();
        return view('welcome',compact('albums'));
    }

    public function show($id)
    {
        $albums=Album::find($id);
        return view('gallery',compact('albums'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'image'=>'required',
            'album'=>'required|min:3|max:20'
        ]);
        $album=Album::create(['name'=>$request->album]);
        if($request->hasFile('image')) {
            foreach($request->file('image') as $image){
            $path=$image->store('uploads','public');
            Image::create([
            'name'=>$path,
            'album_id'=>$album->id
              ]);
        }
    }
    return "<div class='alert alert-success'>Album created Successfully</div>";
    }
    public function destroy()
    {
       $id=request('id');
       $imagedel=Image::find($id);
       $file=$imagedel->name;
       $imagedel->delete();
       \Storage::delete('public/'.$file);
       return redirect()->back()->with('message','Image deleted!!');
    }

    public function addimage(Request $request)
    {
        $this->validate($request,[
            'image'=>'required'
        ]);
        $albumid=request('id');
        if($request->hasFile('image')) {
            foreach($request->file('image') as $image){
            $path=$image->store('uploads','public');
            Image::create([
            'name'=>$path,
            'album_id'=>$albumid
              ]);
        }
    }
    return redirect()->back()->with('messages','Images added!!');
    }

    public function addcoverimage(Request $request)
    {
        $this->validate($request,[
            'image'=>'required'
        ]);
        $albumid=request('id');
        if($request->hasFile('image')) {
            $file=$request->file('image');
            $path=$file->store('uploads','public');
            Album::where('id',$albumid)->update([
            'image'=>$path,
              ]);
    }
    return redirect()->back()->with('messages','Cover Images changed!!');
    }


        /*Image Resize */
        public function upload(){
            $albums = Album::get();
            return view('upload',compact('albums'));
        }
        /*Image Resize */
        public function postUpload(Request $request){
            if($request->hasFile('image')){
                    $file = $request->file('image');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    Interventionimage::make($file)->resize(100,100)->save('avatars/'.$filename);
    
                    Album::create([
                        'image'=>$filename,
                        'name'=>'resizing image'
                    ]);
                    return back();
            }
    
        }
    
    
}
