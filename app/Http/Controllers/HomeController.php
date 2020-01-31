<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            $assignments = DB::table('assignments')->select('*')->orderBy('created_at','desc')->get();

//            $subject = DB::table('attend_section as attend')->where('user_id', '=',Auth::id())
//                ->join('sections_in_subject as sis','attend.sis_id','=','sis.id')
//                ->join('subjects','sis.subject_id','=','subjects.id')
//                ->join('sections','sis.section_id','=','sections.id')
//                ->join('years','sis.year_id','=','years.id')
//                ->select('*','attend.id')
//                ->get();

            $subject = DB::table('attend_sections as attend')->where('user_id', '=',Auth::id())
                ->join('sections_in_subjects as sis','attend.sis_id','=','sis.id')
                ->join('subjects','sis.subject_id','=','subjects.id')
                ->select('code','name')->distinct()
                ->get();

            $subjects = json_decode($subject);
//            $subj_groups = DB::table('sections_in_subject')->where('teacher_id',Auth::id())->select('name','code')
//                ->groupBy('name','code')->get();
//            $subject_groups = json_decode($subj_groups);

//            dd(Auth::id());

            return view('teacher.home',compact('assignments','subjects'));
//            return view('teacher.home');
        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
//            $assignments = DB::table('assignments')->select('*')->orderBy('dueDate','asc')->orderBy('dueTime','asc')->get();

            $assignments = DB::table('attend_sections')->where('attend_sections.user_id','=',Auth::id())
                ->join('sections_in_subjects as sis','sis.id', '=','attend_sections.sis_id')
                ->join('sections','sis.section_id','=','sections.id')
                ->join('assignments','sis.id','=','assignments.sis_id')
                ->select('*','assignments.id')->orderBy('dueDate','asc')->orderBy('dueTime','asc')
                ->get();

//            dd($assignments);
            return view('student.home',compact('assignments'));
        }else{
            redirect('/');
        }
    }
}
