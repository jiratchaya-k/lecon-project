<?php

namespace App\Http\Controllers;

use App\Section;
use App\Subject;
use App\User;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //
    public function index()
    {
        $subj_groups = DB::table('subjects')->select('name')->groupBy('name')->get();
        $subject_groups = json_decode($subj_groups);

        foreach($subject_groups as $subject){
            $code = DB::table('subjects')->select('code')->where('name',$subject->name)->groupBy('code')->get();
            $sections = DB::table('subjects')->where('name',$subject->name)->join('sections','subjects.section_id', '=','sections.id')->select('sections.section')->get();
            $years = DB::table('subjects')->where('name',$subject->name)->join('years','subjects.year_id', '=','years.id')->select('years.year','years.term')->get();
        }


        return view('teacher.home',compact('subject_groups','code','sections','years'));
    }


    public function create()
    {
        $years = Year::all();
        $sections = Section::all();

        $teachers = DB::table('users')->select('id','firstname','lastname','email')->where('role',User::role_teacher)->get();
        $students = DB::table('users')->select('id','firstname','lastname','email')->where('role',User::role_student)->get();


        return view('teacher.subject-create',compact('years','sections','teachers','students'));
    }

    public function store(Request $request){


        function getBetween($content,$start,$end){
            $r = explode($start, $content);
            if (isset($r[1])){
                $r = explode($end, $r[1]);
                return $r[0];
            }
            return '';
        }
        $teacher = $request->input('subject_teacher');
        $student = $request->input('subject_student');
        $start = "(";
        $end = ")";
        $teacher_email = getBetween($teacher,$start,$end);
        $student_email = getBetween($student,$start,$end);

        $teacher_id = DB::table('users')->select('id')->where('email',$teacher_email)->get();
        $student_id = DB::table('users')->select('id')->where('email',$student_email)->get();


        $subject = new Subject;
        $subject->code = $request->input('subject_code');
        $subject->name = $request->input('subject_name');
        $subject->year_id = $request->input('subject_year');
        $subject->section_id = $request->input('subject_section');
        $subject->date = $request->input('subject_date');
        $subject->startTime = $request->input('subject_startTime');
        $subject->endTime = $request->input('subject_endTime');
        $subject->teacher_id = $teacher_id[0]->id;
        $subject->student_id = $student_id[0]->id;
        $subject->save();

        return redirect('/teacher/subject');
    }

    public function addSection()
    {
        $years = Year::all();
        $sections = Section::all();

        $teachers = DB::table('users')->select('id','firstname','lastname','email')->where('role',User::role_teacher)->get();
        $students = DB::table('users')->select('id','firstname','lastname','email')->where('role',User::role_student)->get();


        return view('teacher.subject-create',compact('years','sections','teachers','students'));
    }

}
