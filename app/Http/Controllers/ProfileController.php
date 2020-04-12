<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //
    public function index($name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);

        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

//        dd($user);
        if (session('success_message')) {
            Alert::success('เปลี่ยนรหัสผ่านสำเร็จ')->autoClose($milliseconds = 2000);
        }

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

    public function editPassword($name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);

        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

//        dd($user);

        return view('teacher.profile-change-password',compact('user'));
    }

    public function updatePassword(Request $request, $name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);


        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

        $oldPassword = $request->input('oldPassword');
        $password = $request->input('password');
        $cf_password = $request->input('password_confirmation');

//        dd(strlen($password));



        if (Hash::check($oldPassword, $user->password)){
            $user = User::find($user->id);
            $user->password = Hash::make($request->input('password'));
            $user->save();
//            dd('success');

            if (strlen($password) < 8 || strlen($cf_password) < 8) {
                Alert::error('กรุณากรอกรหัสผ่านให้ครบ 8 ตัว', 'ลองใหม่อีกครั้ง');
                return redirect('teacher/profile/' . $user->firstname . '-' . $user->lastname . '/change-password');
            }

            if ($password != $cf_password){
                Alert::error('ยืนยันรหัสผ่านไม่ตรงกัน', 'ลองใหม่อีกครั้ง');
                return redirect('teacher/profile/' . $user->firstname . '-' . $user->lastname . '/change-password');
            }


            return redirect('teacher/profile/'.$user->firstname.'-'.$user->lastname)->withSuccessMessage('Success.');
        }else {
            Alert::error('รหัสผ่านเดิมไม่ถูกต้อง', 'ลองใหม่อีกครั้ง');
            return redirect('teacher/profile/'.$user->firstname.'-'.$user->lastname.'/change-password');
        }



//        $user->save();

//        return redirect('/teacher/profile/'.$request->input('firstname').'-'.$request->input('lastname'));

    }

}
