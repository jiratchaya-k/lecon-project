<?php

namespace App\Http\Controllers;

use App\Location;
use App\SectionCheck;
use App\StudentCheck;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CheckStudentController extends Controller
{
    public function index()
    {
        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            $assignments = DB::table('assignments')->select('*')->orderBy('created_at','desc')->get();
            $subject = DB::table('attend_sections as attend')->where('user_id', '=',Auth::id())
                ->join('sections_in_subjects as sis','attend.sis_id','=','sis.id')
                ->join('subjects','sis.subject_id','=','subjects.id')
                ->select('code','name')->distinct()
                ->get();
            $subjects = json_decode($subject);

            $locations = DB::table('locations')->where('user_id',Auth::id())->get();

//            dd($locations);


//            dd(Auth::id());

//            foreach($subject_groups as $subject){
//                $code = DB::table('subjects')->select('code')->where('name',$subject->name)
//                    ->groupBy('code')
//                    ->get();
//                $sections = DB::table('subjects')->where('name',$subject->name)
//                    ->join('sections','subjects.section_id', '=','sections.id')
//                    ->select('sections.section')
//                    ->get();
//                $years = DB::table('subjects')->where('name',$subject->name)
//                    ->join('years','subjects.year_id', '=','years.id')
//                    ->select('years.year','years.term')
//                    ->get();
//                $subjects = DB::table('subjects')->select('*','sections.section')->where('name',$subject->name)
//                    ->join('sections','subjects.section_id', '=','sections.id')
//                    ->orderBy('sections.section')
//                    ->get();
//            }

//            dd($code);


            return view('teacher.check',compact('assignments','subjects','locations'));
//            return view('teacher.home');
        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
//            $assignments = DB::table('assignments')->select('*')->orderBy('dueDate','asc')->orderBy('dueTime','asc')->get();

            $assignments = DB::table('assignments')
                ->join('subjects','subjects.id', '=','assignments.subject_id')
                ->join('sections','subjects.section_id','=','sections.id')
                ->select('*','assignments.id')->orderBy('dueDate','asc')->orderBy('dueTime','asc')
                ->get();

//            dd($assignments);
            return view('student.home',compact('assignments'));
        }else{
            return redirect('/');
        }
    }

    public function createCheck(Request $request)
    {
        $check = New SectionCheck();
        $check->check_date = $request->input('check_date');
        $check->location_id = $request->input('location_id');
        $check->sis_id = $request->input('sis_id');
        $check->save();

        $check = SectionCheck::all()->last();

//        dd(json_decode($check));

        return redirect('/teacher/student-check/check='.$check->id.'/get-qrcode')->withSuccessMessage('Success.');
    }

    public function getQrcode($check_id)
    {

        if (session('success_message')){
            Alert::success('สร้างคิวอาร์โค้ดสำเร็จ')->autoClose($milliseconds = 2000);
        }

        $section = DB::table('section_checks')->where('section_checks.id','=',$check_id)
        ->join('sections_in_subjects as sis','sis.id','=','section_checks.sis_id')
            ->join('sections','sections.id','=','sis.section_id')
        ->join('subjects','sis.subject_id','=','subjects.id')
        ->join('years','sis.year_id','=','years.id')
        ->select('*','section_checks.id')->first();


//        dd($teachers);

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

//        dd($section);

        return view('teacher.check-qrcode',compact('section','date'));

    }

    public function update ($id,$time) {
//        dd($request->input('currentTime'));
//        $check = StudentCheck::all()->where('id','=',$id);
//        $check = DB::table('section_checks')->where('id',$id)->first();
////        dd($check);
//        $check->updated_at = $request->input('currentTime');

        $time = time();
        $currentTime = date('Y-m-d H:i:s',$time);

        DB::table('section_checks')->where('id', $id) -> update(['updated_at' => $currentTime]);


//        $check = SectionCheck::all()->last();

        $message = 'Success';

//        dd(json_decode($check));

        return $message;

//        return redirect('/teacher/student-check/check='.$check->id.'/get-qrcode')->withSuccessMessage('Success.');
    }

    public function detail ($subjec_code,$section,$sis_id) {

        $check_date = DB::table('section_checks')->where('sis_id',$sis_id)
            ->orderBy('check_date','asc')
            ->get();


        $subject = DB::table('sections_in_subjects as sis')->where('sis.id', '=',$sis_id)
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->join('sections','sis.section_id','=','sections.id')
            ->join('years','sis.year_id','=','years.id')
            ->select('*','sis.id as sis_id')
            ->first();

        $allStd = DB::table('sections_in_subjects as sis')->where('sis.id', '=',$sis_id)
            ->join('attend_sections as attend','attend.sis_id','=','sis.id')
            ->join('users','users.id','=','attend.user_id')->where('users.role',User::role_student)
//            ->select('*')
            ->count();

//        $subject = json_decode($subject);

//        dd($subject);

        return view('teacher.check-detail',compact('check_date','subject','allStd'));

    }


    public function studentList($subjec_code,$section,$sis_id,$check_date) {

        $lists = DB::table('attend_sections')->where('attend_sections.sis_id','=',$sis_id)
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role',User::role_student)
            ->select('*')
            ->get();

//        dd($lists);

        $subject = DB::table('sections_in_subjects as sis')->where('sis.id', '=',$sis_id)
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->join('sections','sis.section_id','=','sections.id')
            ->join('years','sis.year_id','=','years.id')
            ->select('*','sis.id as sis_id')
            ->first();

        $check_date = date('d M Y', strtotime($check_date));

//        dd($lists);

        return view('teacher.check-detail-list',compact('lists','subject','check_date'));
    }

    public function studentStatusUpdate(Request $request,$subjec_code,$section,$sis_id,$check_date,$student_id)
    {
        $user = DB::table('users')->where('role',User::role_student)
            ->where('student_id','=',$student_id)
            ->select('*')
            ->first();

        $section_check = DB::table('section_checks')->where('section_checks.check_date',$check_date)
            ->select('*')
            ->first();

        $check = DB::table('section_checks')->where('section_checks.check_date',$check_date)
            ->join('student_checks','student_checks.sectionCheck_id','=','section_checks.id')
            ->join('users','users.id','=','student_checks.user_id')->where('users.id',$user->id)
            ->select('section_checks.id as sectCheck_id','student_checks.status as status','student_checks.created_at as std_check','student_checks.id as stdCheck_id')
            ->first();


//        dd($section_check);

        if ($check != null){
//            dd('update');
            $student = StudentCheck::find($check->stdCheck_id);
            $student->status = $request->input('check_status');
            $student->save();
        }else {
//            dd('new');
            $student = new StudentCheck;
            $student->user_id = $user->id;
            $student->sectionCheck_id = $section_check->id;
            $student->status = $request->input('check_status');
            $student->save();
        }


        return redirect()->back();
    }

}
