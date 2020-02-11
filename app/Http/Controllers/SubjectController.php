<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\attendSection;
use App\Section;
use App\SectionsInSubject;
use App\Subject;
use App\User;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //
    public function index()
    {
        $subject = DB::table('attend_sections as attend')->where('user_id', '=',Auth::id())
            ->join('sections_in_subjects as sis','attend.sis_id','=','sis.id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->select('code','name')->distinct()
            ->get();
        $subjects = json_decode($subject);

        return view('teacher.home',compact('subjects'));
    }


    public function create()
    {
        $years = Year::all();
        $sections = Section::all();

        $teachers = DB::table('users')->select('id','firstname','lastname','email')
            ->where('role',User::role_teacher)
            ->where('id','!=',Auth::id())
            ->get();
        $students = DB::table('users')->select('id','firstname','lastname','email')
            ->where('role',User::role_student)->get();


        return view('teacher.subject-create',compact('years','sections','teachers','students'));
    }

    public function show($id){

        $assignment = Assignment::all()->find($id);
        $assignment_id = $id;
//        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)
//            ->join('subjects','subjects.id', '=','assignments.subject_id')
//            ->join('sections','subjects.section_id','=','sections.id')
//            ->select('subjects.id','sections.section','subjects.code','subjects.name')->get();

        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)
            ->join('sections_in_subjects as sis','assignments.sis_id','=','sis.id')
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('subjects.id','sections.section','subjects.code','subjects.name')->first();

//        dd($sections);

        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            $allWorks = DB::table('works')->where('assignment_id',$id)
                ->join('users','users.id','=','works.student_id')
                ->select('*','works.id')->distinct('users.student_id')->get();

//            dd($allWorks);

            $fileType = json_decode($assignment->fileType);

            return view('teacher.subject-show',compact('assignment','fileType','sections','allWorks'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {

            $assignmentWork = Work::all()->where('student_id',Auth::id())->where('assignment_id',$id)->first();
            $workFile = DB::table('works')->join('files','works.id','=','files.work_id')
                ->where('works.student_id','=',Auth::id())->where('works.assignment_id','=',$id)
                ->select('files.file')->get();

            $files = [];

            foreach ($workFile as $wfile){
                $files[] = $wfile->file;
            }

            $fileType = json_decode($assignment->fileType);


            // change string of date,time(2019-12-05) to number of date,time (1575478800)
            $dueDate = strtotime($assignment->dueDate);
            $dueTime = strtotime($assignment->dueTime);
            $date = strtotime(date("Y-m-d"));
            $time = strtotime(date("H:i:s"));

            $status = '';

//            dd($dueDate);


            if (!empty($assignmentWork)){
                $works = $files;
                $status = $assignmentWork->status;
            }else {
                $works = null;

                //if student not send -> status = Missed
                if ((($date > $dueDate) && ($time > $dueTime)) || (($date > $dueDate) && ($time <= $dueTime)) ) {
                    $status = 'Missed';
                }
            }

            return view('student.assignment-show',compact('assignment','assignmentWork','sections','works','fileType','status','sections'));
        }

    }

    public function store(Request $request){


//        function getBetween($content,$start,$end){
//            $r = explode($start, $content);
//            if (isset($r[1])){
//                $r = explode($end, $r[1]);
//                return $r[0];
//            }
//            return '';
//        }


//        dd($tcs,$std);


//        dd(count($request->input('subject_teacher')));

//        $teachers = $request->input('subject_teacher');
//
//        dd($teachers);

        $subject = new Subject;
        $subject->code = $request->input('subject_code');
        $subject->name = $request->input('subject_name');
        $subject->save();

        $subject_id = DB::table('subjects')->select('id')->orderBy('id','DESC')->limit('1')->first();

//        dd($subject_id);

//        dd(DB::table('sections_in_subject')
//            ->insertGetId(['section_id' => $request->input('subject_section'),
//                'subject_id' => $subject_id , 'year_id' => $request->input('subject_year'),
//                'date' => $request->input('subject_date'), 'startTime' => $request->input('subject_startTime'),
//                'endTime' => $request->input('subject_endTime')]));

        $sis = new SectionsInSubject;
        $sis->section_id = $request->input('subject_section');
        $sis->subject_id = $subject_id->id;
        $sis->year_id = $request->input('subject_year');
        $sis->date = $request->input('subject_date');
        $sis->startTime = $request->input('subject_startTime');
        $sis->endTime = $request->input('subject_endTime');
        $sis->save();

//        dd($request->input('subject_endTime'));

        $sis_id = DB::table('sections_in_subjects')->select('id')->orderBy('id','DESC')->limit('1')->first();

        $attend = new AttendSection;
        $attend->user_id =  $request->input('subject_createby');
        $attend->sis_id = $sis_id->id;
        $attend->save();

        function getBetween($content,$start,$end){
            $r = explode($start, $content);
            if (isset($r[1])){
                $r = explode($end, $r[1]);
                return $r[0];
            }
            return '';
        }

        $teachers = $request->input('subject_teacher');

//        dd($teachers);

        if (!empty($teachers)){
            for ($i=0;$i < count($teachers);$i++){
                $start = "(";
                $end = ")";
                $teacher_email = getBetween($teachers[$i],$start,$end);

                $teacher_id = DB::table('users')->select('id')->where('email',$teacher_email)->first();

                $attend = new AttendSection;
                $attend->user_id = $teacher_id->id;
                $attend->sis_id = $sis_id->id;
                $attend->save();


            }
        }

        $students = $request->input('subject_student');
        if (!empty($students)){
            for($i=0;$i < count($students);$i++){
                $start = "(";
                $end = ")";
                $student_email = getBetween($students[$i],$start,$end);
                $student_id = DB::table('users')->select('id')->where('email',$student_email)->first();

                $attend = new AttendSection;
                $attend->user_id = $student_id->id;
                $attend->sis_id = $sis_id->id;
                $attend->save();
            }
        }

//        dd($tcs,$std);



//        foreach ($tcs as $t){
//            $teacher_email = getBetween($t,$start,$end);
//            $teacher_id = DB::table('users')->select('id')->where('email',$teacher_email)->get();
//            $attend = new AttendSection;
//            $attend->user_id = $teacher_id;
//            $attend->sis_id = $sis_id;
//            $attend->save();
//        }
//
//        foreach ($std as $s){
//            $student_email = getBetween($s,$start,$end);
//            $student_id = DB::table('users')->select('id')->where('email',$student_email)->get();
//            $attend = new AttendSection;
//            $attend->user_id = $student_id;
//            $attend->sis_id = $sis_id;
//            $attend->save();
//        }


        return redirect('/teacher/subject');
    }

    public function addSection($id)
    {
        $years = Year::all();
        $sections = Section::all();

        $subject_id = $id;

        $teachers = DB::table('users')->select('id','firstname','lastname','email')->where('role',User::role_teacher)->get();
        $students = DB::table('users')->select('id','firstname','lastname','email')->where('role',User::role_student)->get();

        $subject = DB::table('subjects')->where('id','=',$subject_id)->first();


        return view('teacher.section-add',compact('years','sections','teachers','students','subject_id','subject'));
    }


    public function sectionStore(Request $request, $id){


//        function getBetween($content,$start,$end){
//            $r = explode($start, $content);
//            if (isset($r[1])){
//                $r = explode($end, $r[1]);
//                return $r[0];
//            }
//            return '';
//        }


//        dd($tcs,$std);


//        dd(count($request->input('subject_teacher')));


        $subject_id = $id;

//        dd($subject_id);

//        dd(DB::table('sections_in_subject')
//            ->insertGetId(['section_id' => $request->input('subject_section'),
//                'subject_id' => $subject_id , 'year_id' => $request->input('subject_year'),
//                'date' => $request->input('subject_date'), 'startTime' => $request->input('subject_startTime'),
//                'endTime' => $request->input('subject_endTime')]));

        $sis = new SectionsInSubject;
        $sis->section_id = $request->input('subject_section');
        $sis->subject_id = $subject_id;
        $sis->year_id = $request->input('subject_year');
        $sis->date = $request->input('subject_date');
        $sis->startTime = $request->input('subject_startTime');
        $sis->endTime = $request->input('subject_endTime');

//        dd($subject_id);

        $sis->save();

//        dd($request->input('subject_endTime'));

        $sis_id = DB::table('sections_in_subjects')->select('id')->orderBy('id','DESC')->limit('1')->first();

        $attend = new AttendSection;
        $attend->user_id =  $request->input('subject_createby');
        $attend->sis_id = $sis_id->id;
        $attend->save();

        function getBetween($content,$start,$end){
            $r = explode($start, $content);
            if (isset($r[1])){
                $r = explode($end, $r[1]);
                return $r[0];
            }
            return '';
        }

        $teachers = $request->input('subject_teacher');

        if (!empty($teachers)){
            for ($i=0;$i < count($teachers);$i++){
                $start = "(";
                $end = ")";
                $teacher_email = getBetween($teachers[$i],$start,$end);

                $teacher_id = DB::table('users')->select('id')->where('email',$teacher_email)->first();

                $attend = new AttendSection;
                $attend->user_id = $teacher_id->id;
                $attend->sis_id = $sis_id->id;
                $attend->save();


            }
        }

        $students = $request->input('subject_student');
        if (!empty($students)){
            for($i=0;$i < count($students);$i++){
                $start = "(";
                $end = ")";
                $student_email = getBetween($students[$i],$start,$end);
                $student_id = DB::table('users')->select('id')->where('email',$student_email)->first();

                $attend = new AttendSection;
                $attend->user_id = $student_id->id;
                $attend->sis_id = $sis_id->id;
                $attend->save();
            }
        }


        return redirect('/teacher/subject');
    }


}
