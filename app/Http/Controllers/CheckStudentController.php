<?php

namespace App\Http\Controllers;

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


            return view('teacher.check',compact('assignments','subjects'));
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
            redirect('/');
        }
    }

    public function createCheck(Request $request)
    {
        $check = New SectionCheck();
        $check->check_date = $request->input('check_date');
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
}
