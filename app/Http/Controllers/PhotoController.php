<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Log;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PhotoController extends Controller
{
    //
    public function index()
    {
        //get photo all in your db and folder
        $images = Photo::all();

        //get last vote form user
        $checkLog = Log::where('user_id' , Auth::id() )
                        ->orderBy('created_at' , 'desc')
                        ->first()->created_at;

        $time = Carbon::now();
        $dtToronto = Carbon::now()->addDays(1);
        $diffRemine = $time->diffInMinutes($checkLog);
        $diff = $time->diffInHours($checkLog);
        $timeRemine = $dtToronto->subRealMinutes($diffRemine);
        
        return view('allPhoto',['images' => $images,
                                'diff'  =>  $diff,
                                'time'  => $time ,
                                'timeRemine' => $timeRemine,
                                    ]);
    }
    public function vote(Request $request)
    {
        //compare data for log
        $photoId = $request->id;
        //save data into logs
        $log            =   new Log;
        $log->photo_id  =   $photoId;
        $log->user_id   =   Auth::id();
        $log->fbid      =   Auth::user()->fbid;
        $log->created_ip=   \Request::ip() ;
        $log->save();

        // die($photo_log);
        // update vote
        //get data form db
        $photo = Photo::find($photoId);
        $vote_score =  $photo->vote;
        //new vote
        $new_score = $vote_score+1;
        //save data in db
        $photo->vote = $new_score;
        $photo->save();

        return response()->json(['status' => true]);

    }

    public function testLog()
    {
          return view('share');
    }
}
