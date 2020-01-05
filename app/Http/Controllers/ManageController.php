<?php

namespace App\Http\Controllers;

use App\Section;
use App\Term;
use App\User;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageController extends Controller
{
    //
    public function index()
    {
        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            $years = DB::table('years')->select('*')->orderBy('year','asc')->get();
            $sections = DB::table('sections')->select('*')->orderBy('section','asc')->get();
//            $terms = DB::table('terms')->select('*')->orderBy('term','asc')->get();
            $teachers = DB::table('users')->select('*')->where('role',2)->orderBy('firstname','asc')->get();

            return view('teacher.manage',compact('years','sections','teachers'));
        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
            return view('student.home');
        }else{
            redirect('/');
        }
    }

    public function create() {
        return view('teacher.manage-create');
    }

    public function storeSection(Request $request){
        $sections = $request->input('sections');

        foreach ($sections as $sect){
            $section = new Section;
            $section->section = $sect;
            $section->save();
        }

        return redirect('/teacher/manage');
    }

    public function storeYear_Term(Request $request){
        $years = $request->input('years');
        $terms = $request->input('terms');
        $count = 0;
//        dd($years[0]);
        foreach ($years as $year){
            $count++;
        }

        for ($x=0;$x < $count;$x++){
            $Tyear = new Year;
            $Tyear->year = $years[$x];
            $Tyear->term = $terms[$x];
            $Tyear->save();
        }
//        foreach ($terms as $term){
//            $Tterm = new Term;
//            $Tterm->term = $term;
//            $Tterm->save();
//        }

        return redirect('/teacher/manage');
    }

    public function show($id){

    }

}
