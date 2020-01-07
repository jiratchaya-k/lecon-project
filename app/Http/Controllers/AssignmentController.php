<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{

    public function index()
    {
        if (Auth::check() && auth()->user()->role == User::role_teacher) {
//            $assignments = DB::table('assignments')->select('*')->orderBy('created_at','desc')->get();
//            $sections = DB::table('assignments')->join('subjects','subjects.id', '=','assignments.subject_id')->join('sections','subjects.section_id','=','sections.id')->select('subjects.id','sections.section','subjects.code','subjects.name')->get();


            $assignments = DB::table('assignments')
                ->join('subjects','subjects.id', '=','assignments.subject_id')
                ->join('sections','subjects.section_id','=','sections.id')
//                ->join('works','works.assignment_id','=','assignments.id')
                ->select('*','assignments.id')
               ->get();

//            $submiited = DB::table('works')->where('assignment_id',1)->count();



            return view('teacher.assignment',compact('assignments'));
//            return view('teacher.home')

        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
//            $assignments = DB::table('assignments')->select('*')->orderBy('dueDate','asc')->orderBy('dueTime','asc')->get();
            $assignments = DB::table('assignments')
                ->join('subjects','subjects.id', '=','assignments.subject_id')
                ->join('sections','subjects.section_id','=','sections.id')
//                ->join('works','works.assignment_id','=','assignments.id')
                ->select('*')
                ->get();
            return view('student.home',compact('assignments'));
        }else{
            redirect('/');
        }
    }

    public function create(){
        //
        $sections = DB::table('subjects')->join('sections','subjects.section_id', '=','sections.id')->select('subjects.id','sections.section','subjects.code','subjects.name')->get();
        return view('teacher.assignment-create',compact('sections'));
    }

    public function store(Request $request){
        $this->validate($request,[

        ]);



        if ($request->file('assignment_file') != ''){
            // get file with extension
            $filenameWithExt = $request->file('assignment_file')->getClientOriginalName();

            // get file name = 1
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            // get extention = jpg
            $extension = $request->file('assignment_file')->getClientOriginalExtension();

            // crete new file name = 1_1223322.jpg
            $filenameToStore = date("YmdHis").'_'.$filename.'.'.$extension;

            // upload image
            $request->file('assignment_file')->move('uploads/assignmentFiles/',$filenameToStore);
        }else {
            $filenameToStore = null;
        }



        if ($request->input('dimensionsType') == 'null') {
            $dimensionsType = null;
        }else {
            $dimensionsType = $request->input('dimensionsType');
        }

        // auto grade
        if (($request->input('autoGrade-fileType') == '1') && ($request->input('autoGrade-dimensions') == '1')) {
            $autoGradeType = '1';
            $autoGradeDimensions = '1';
        } elseif (($request->input('autoGrade-dimensions') == '1')){
            $autoGradeType = '0';
            $autoGradeDimensions = '1';
        }elseif (($request->input('autoGrade-fileType') == '1')){
            $autoGradeType = '1';
            $autoGradeDimensions = '0';
        }
        else{
            $autoGradeType = 0;
            $autoGradeDimensions = 0;
        }


        //multi file
        $fileType = $request->input('fileType');
        $type = [];
        $inFileType = '';

        if (!empty($fileType)){
            foreach ($fileType as $fType) {
                $type[] = $fType;
            }
//        dd(json_encode($type));
            $inFileType = json_encode($type);
        }


        $dimensions = $request->input('dimensions_width').' x '.$request->input('dimensions_height');

        $assignment = new Assignment;
        $assignment->title = $request->input('assignment_title');
        $assignment->description = $request->input('assignment_description');
        $assignment->file = $filenameToStore;
        $assignment->dueDate = $request->input('assignment_dueDate');
        $assignment->dueTime = $request->input('assignment_dueTime');
        $assignment->subject_id = $request->input('subject_id');
        $assignment->autoGrade_fileType = $autoGradeType;
        $assignment->autoGrade_dimensions = $autoGradeDimensions;
        $assignment->fileType = $inFileType;
        $assignment->dimensions = $dimensions;
        $assignment->dimensionsType = $dimensionsType;
        $assignment->save();
//
//
        return redirect('/teacher/subject');
//        dd($request->all());
    }

    public function show($id){

        $assignment = Assignment::all()->find($id);
        $assignment_id = $id;
        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)->join('subjects','subjects.id', '=','assignments.subject_id')->join('sections','subjects.section_id','=','sections.id')->select('subjects.id','sections.section','subjects.code','subjects.name')->get();


        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            $allWorks = DB::table('works')->where('assignment_id',$id)->join('users','users.id','=','works.student_id')->select('*')->get();


            $fileType = json_decode($assignment->fileType);
            return view('teacher.assignment-show',compact('assignment','fileType','sections','allWorks'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {

            $assignmentWork = Work::all()->where('student_id',Auth::id())->where('assignment_id',$id)->first();


            $fileType = json_decode($assignment->fileType);


            // change string of date,time(2019-12-05) to number of date,time (1575478800)
            $dueDate = strtotime($assignment->dueDate);
            $dueTime = strtotime($assignment->dueTime);
            $date = strtotime(date("Y-m-d"));
            $time = strtotime(date("H:i:s"));

            $status = '';

//            dd($dueDate);

            if (!empty($assignmentWork)){
                $works = json_decode($assignmentWork->file);
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

}
