<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    //
    public function index($name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);

        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

//        dd($user);

        return view('teacher.profile',compact('user'));
    }

    public function edit($name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);

        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

//        dd($user);

        return view('teacher.profile-edit',compact('user'));
    }

    public function update(Request $request, $name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);


        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

        if ($request->file('profile_img') != ''){
            // get file with extension
            $filenameWithExt = $request->file('profile_img')->getClientOriginalName();

            // get file name = 1
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            // get extention = jpg
            $extension = $request->file('profile_img')->getClientOriginalExtension();

            // crete new file name = 1_1223322.jpg
            $filenameToStore = date("YmdHis").'_'.$filename.'.'.$extension;

            // upload image
            $request->file('profile_img')->move('uploads/profileImage/',$filenameToStore);
        }else {
            $filenameToStore = null;
        }

//        dd($filenameToStore);

        $user = User::find($user->id);
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->profile_img = $filenameToStore;
        $user->save();

        return redirect('/teacher/profile/'.$request->input('firstname').'-'.$request->input('lastname'));

    }

}
