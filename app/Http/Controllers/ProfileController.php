<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            return view('teacher.profile',compact('user'));
        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
            return view('student.profile',compact('user'));
        }

    }

    public function edit($name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);

        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

//        dd($user);
        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            return view('teacher.profile-edit',compact('user'));
        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
            return view('student.profile-edit',compact('user'));
        }
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
        }else{
            $filenameToStore = $user->profile_img;
        }

//        dd($filenameToStore);

        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            $user = User::find($user->id);
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->profile_img = $filenameToStore;
            $user->save();

            return redirect('/teacher/profile/'.$request->input('firstname').'-'.$request->input('lastname'));
        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
            $user = User::find($user->id);
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->student_id = $request->input('student_id');
            $user->email = $request->input('email');
            $user->profile_img = $filenameToStore;
            $user->save();

            return redirect('/profile/'.$request->input('firstname').'-'.$request->input('lastname'));
        }


    }

    public function editPassword($name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);

        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

//        dd($user);
        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            return view('teacher.profile-change-password',compact('user'));
        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
            return view('student.profile-change-password',compact('user'));
        }

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

//            dd('success');

            if (strlen($password) < 8 || strlen($cf_password) < 8) {
                Alert::error('กรุณากรอกรหัสผ่านให้ครบ 8 ตัว', 'ลองใหม่อีกครั้ง');
                if (Auth::check() && auth()->user()->role == User::role_teacher) {
                    return redirect('teacher/profile/' . $user->firstname . '-' . $user->lastname . '/change-password');
                }elseif (Auth::check() && auth()->user()->role == User::role_student) {
                    return redirect('profile/' . $user->firstname . '-' . $user->lastname . '/change-password');
                }
            }

            if ($password != $cf_password){
                Alert::error('ยืนยันรหัสผ่านไม่ตรงกัน', 'ลองใหม่อีกครั้ง');
                if (Auth::check() && auth()->user()->role == User::role_teacher) {
                    return redirect('teacher/profile/' . $user->firstname . '-' . $user->lastname . '/change-password');
                }elseif (Auth::check() && auth()->user()->role == User::role_student) {
                    return redirect('profile/' . $user->firstname . '-' . $user->lastname . '/change-password');
                }
            }

            $user = User::find($user->id);
            $user->password = Hash::make($request->input('password'));
            $user->save();
            if (Auth::check() && auth()->user()->role == User::role_teacher) {
                return redirect('teacher/profile/'.$user->firstname.'-'.$user->lastname)->withSuccessMessage('Success.');
            }elseif (Auth::check() && auth()->user()->role == User::role_student) {
                return redirect('profile/'.$user->firstname.'-'.$user->lastname)->withSuccessMessage('Success.');
            }

        }else {
            Alert::error('รหัสผ่านเดิมไม่ถูกต้อง', 'ลองใหม่อีกครั้ง');
            if (Auth::check() && auth()->user()->role == User::role_teacher) {
                return redirect('teacher/profile/' . $user->firstname . '-' . $user->lastname . '/change-password');
            }elseif (Auth::check() && auth()->user()->role == User::role_student) {
                return redirect('profile/' . $user->firstname . '-' . $user->lastname . '/change-password');
            }
        }



//        $user->save();

//        return redirect('/teacher/profile/'.$request->input('firstname').'-'.$request->input('lastname'));

    }

    public function showCheckName($name) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);

        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

        $sections = DB::table('attend_sections')->where('attend_sections.user_id','=',Auth::id())
            ->join('sections_in_subjects as sis','sis.id', '=','attend_sections.sis_id')
            ->where('attend_sections.status','=','active')
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->join('years','sis.year_id','=','years.id')
            ->select('sis.id','subjects.code','subjects.name','sections.section','years.year','years.term',
                'sis.date','sis.startTime','sis.endTime')
            ->get();

        return view('student.profile-checkname',compact('user','sections'));
    }
    public function detailCheckName($name, $sis_id) {
        $firstname = strtok($name, '-' );
        $lastname = substr($name,strpos($name,'-')+1);

        $user = DB::table('users')->where('firstname',$firstname)->where('lastname',$lastname)
            ->first();

        $section = DB::table('sections_in_subjects as sis')->where('sis.id', '=',$sis_id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->join('years','sis.year_id','=','years.id')
            ->select('sis.id','subjects.code','subjects.name','sections.section','years.year','years.term',
                'sis.date','sis.startTime','sis.endTime')
            ->first();

        switch( $section->date ) {
            case('Sunday') :
                $date = 'อาทิตย์';
                break;
            case('Monday') :
                $date = 'จันทร์';
                break;
            case('Tuesday') :
                $date = 'อังคาร';
                break;
            case('Wednesday') :
                $date = 'พุธ';
                break;
            case('Thursday') :
                $date = 'พฤหัสบดี';
                break;
            case('Friday') :
                $date = 'ศุกร์';
                break;
            case('Saturday') :
                $date = 'เสาร์';
                break;
        }

        $checks = DB::table('section_checks')->where('section_checks.sis_id',$sis_id)
        ->select('*')->get();


        return view('student.profile-checkname-detail',compact('user','section','date','checks'));
    }

}
