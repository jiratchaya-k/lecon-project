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
            $teachers = DB::table('users')->select('*')->where('role',User::role_teacher)->orderBy('firstname','asc')->get();

//            dd($years);

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

    public function edit_YearTerm($id){

        $year = DB::table('years')->where('id',$id)->select('*')->first();
//        dd($year);

        return view('teacher.manage-edit-year',compact('year'));

    }

    public function update_YearTerm(Request $request, $id){

//        $year = DB::table('years')->where('id',$id)->select('*')->first();
//        dd($year);

        $year = Year::find($id);
        $year->year = $request->input('year');
        $year->term = $request->input('term');
        $year->save();

//        dd($request->all());

        return redirect('/teacher/manage');

    }
    public function edit_section($id){

        $section = DB::table('sections')->where('id',$id)->select('*')->first();
//        dd($year);

        return view('teacher.manage-edit-section',compact('section'));

    }

    public function update_section(Request $request, $id){

//        $year = DB::table('years')->where('id',$id)->select('*')->first();
//        dd($year);

        $section = Section::find($id);
        $section->section = $request->input('section');
        $section->save();

//        dd($request->all());

        return redirect('/teacher/manage');
    }

    public function sectionAdd($id){

    }

}

