<?php

namespace App\Http\Controllers;

use App\Section;
use App\Term;
use App\User;
use App\Year;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use phpDocumentor\Reflection\Location;

class ManageController extends Controller
{
    //
    public function index()
    {
        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            $years = DB::table('years')->where('user_id',Auth::id())
                ->where('status','=','active')
                ->select('*')->orderBy('year','asc')->get();
            $sections = DB::table('sections')
                ->where('user_id',Auth::id())
                ->where('status','=','active')
                ->select('*')->orderBy('section','asc')->get();
//            $terms = DB::table('terms')->select('*')->orderBy('term','asc')->get();
            $teachers = DB::table('users')->select('*')->where('role',User::role_teacher)->orderBy('firstname','asc')->get();
            $locations = DB::table('locations')
                ->where('user_id',Auth::id())
                ->where('status','=','active')
//                ->orderBy('id','ASC')
                ->select('*')->get();
//            dd($locations);

//            dd(url()->previous());
            return view('teacher.manage',compact('years','sections','teachers','locations'));
        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
            return view('student.home');
        }else{
            return redirect('/');
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

    public function storeLocation(Request $request){
        $names = $request->input('location_name');
        $lats = $request->input('location_latitude');
        $longs = $request->input('location_longitude');
        $count = 0;

        foreach ($names as $name){
            $count++;
        }
//        dd($names,$lats,$longs);
        for ($x=0;$x < $count;$x++){
            $location = new Location;
            $location->name = $names[$x];
            $location->latitude = $lats[$x];
            $location->longitude = $longs[$x];
            $location->status = 'active';
            $location->user_id = Auth::id();
            $location->save();
//            dd($names[$x],$lats[$x],$longs[$x]);
        }

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

    public function destroy_YearTerm($id)
    {
        //
        $year = Year::find($id);
        $year->status = 'inactive';
        $year->save();
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

    public function destroy_section($id)
    {
        //
        $section = Section::find($id);
        $section->status = 'inactive';
        $section->save();
        return redirect('/teacher/manage');
    }


    public function edit_location($id){

        $location = DB::table('locations')->where('id',$id)->select('*')->first();
//        dd($location);

        return view('teacher.manage-edit-location',compact('location'));

    }
    public function update_location(Request $request, $id){

        $location = Location::find($id);
        $location->name = $request->input('location_name');
        $location->latitude = $request->input('location_latitude');
        $location->longitude = $request->input('location_longitude');
        $location->save();

//        dd($request->all());

        return redirect('/teacher/manage');
    }

    public function destroy_location($id)
    {
        //
        $location = Location::find($id);
        $location->status = 'inactive';
        $location->save();
        return redirect('/teacher/manage');
    }
}

