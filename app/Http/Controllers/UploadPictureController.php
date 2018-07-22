<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use File;

class UploadPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $images = Photo::all();
        return  view('uploadPicture',['images' => $images,]);
    }
    public function index2()
    {
        return  view('uploadPicture2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImage(Request $request)
    {
         // dd($request->hasFile('image'));
        $validator = Validator::make($request->all(), [
                    'image'   =>  'required | mimes:jpeg,jpg,png | max:1000',
                ]);

        if (($request->hasFile('image'))) {
          try {
            if ($validator->fails())
            {
                return back()->with('warning', 'fail ');
            }else{
            $file =  $request->file('image');
            $fileName = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $file->move("image/", $fileName);


            // save filename to DB
            $photo = new Photo();
            $photo->user_id = Auth::id();
            $photo->image = $fileName;
            $photo->fb_name = Auth::user()->fb_name;
            $photo->fbid = Auth::user()->fbid;
            // $photo->FileExtension = $ext ;
            $photo->save();
            return back()->with('success', 'upload image success');
            }
          } catch (\Exception $e) {
            dd($e);
            }
          }else {
            return back()->with('warning', 'no file ');
          }
  }

      public function deleteImage(Request $request)
      {

          $image_path = "image/".$request->image;  // Value is not URL but directory file path
          if(File::exists($image_path)) {
              File::delete($image_path);
          }


          // $image = Image::withTrashed()
          //           ->where('fileName', $request->fileName)
          //           ->get();
          DB::table('photos')->where('image', $request->image)->delete();
          return back();
      }

      public function crop(Request $request)
      {
          //compare data for log
          die($request);
          // return response()->json(['status' => true]);
      }

      public function uploadImageAjax(Request $request)
      {

          dd($request);
          // return response()->json(['status' => true]);
          // $validator = Validator::make($request->all(), [
          //             'image'   =>  'required | mimes:jpeg,jpg,png | max:1000',
          //         ]);
          //
          // if (($request->hasFile('image'))) {
          //   try {
          //     if ($validator->fails())
          //     {
          //         return back()->with('warning', 'fail ');
          //     }else{
          //     $file =  $request->file('image');
          //     $fileName = $file->getClientOriginalName();
          //     $ext = $file->getClientOriginalExtension();
          //     $file->move("image/", $fileName);
          //
          //
          //     // save filename to DB
          //     $photo = new Photo();
          //     $photo->user_id = Auth::id();
          //     $photo->image = $fileName;
          //     $photo->fb_name = Auth::user()->fb_name;
          //     $photo->fbid = Auth::user()->fbid;
          //     // $photo->FileExtension = $ext ;
          //     $photo->save();
          //     return back()->with('success', 'upload image success');
          //     }
          //   } catch (\Exception $e) {
          //     dd($e);
          //     }
          //   }else {
          //     return back()->with('warning', 'no file ');
          //   }
    }

}
