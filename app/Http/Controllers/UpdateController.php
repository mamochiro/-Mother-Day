<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function index()
    {
        return view('update');
    }

    public function update(Request $request, $id)
    {
      $user= App\User::find($id);


      echo $request->name;
      // $user->name = 'New Flight Name';
      //
      // $user->save()
        // return view('update');
    }
}
