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
            $subj_groups = DB::table('subjects')->select('name')->groupBy('name')->get();
            $subject_groups = json_decode($subj_groups);

            foreach($subject_groups as $subject){
                $code = DB::table('subjects')->select('code')->where('name',$subject->name)->get();
                $sections = DB::table('subjects')->where('name',$subject->name)->join('sections','subjects.section_id', '=','sections.id')->select('sections.section')->get();
                $years = DB::table('subjects')->where('name',$subject->name)->join('years','subjects.year_id', '=','years.id')->select('years.year','years.term')->get();
            }

            return view('teacher.home',compact('assignments','subject_groups','code','sections','years'));
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
}
