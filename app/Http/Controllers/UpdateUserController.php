<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('update');
    }

    public function showSerial()
    {
        //
        return  view('updateSerial');
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
        // $user= App\User::find($id);
        // echo $request->name;
        //
        // echo "string";
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
    public function updateUser(Request $request, $id)
    {
        // $id = $request->id;
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;


        $user = User::find($id);
        $user->name = $name;
        $user->address = $address ;
        $user->phone = $phone ;
        $user->save();

        return redirect()->to('/update/serial');
    }

    public function updateSerial(Request $request, $id)
    {
        // $id = $request->id;
        // $name = $request->name;
        // $address = $request->address;
        // $phone = $request->phone;


        $user = User::find($id);
        $user->serial_id = $request->serial;
        $user->save();
        return redirect()->to('/uploadPicture');
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
}
