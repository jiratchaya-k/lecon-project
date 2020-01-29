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


//            $assignments = DB::table('assignments')
//                ->join('subjects','subjects.id', '=','assignments.subject_id')->where('subjects.teacher_id','=',Auth::id())
//                ->join('sections','subjects.section_id','=','sections.id')
////                ->join('works','works.assignment_id','=','assignments.id')
//                ->select('*','assignments.id')
//                ->get();

            $assignments = DB::table('assignments')
                ->join('sections_in_subject as sis','assignments.sis_id','=','sis.id')
                ->join('sections','sis.section_id','=','sections.id')
                ->join('attend_sections','attend_sections.sis_id','=','sis.id')
                ->join('users','attend_sections.user_id','=','users.id')
                ->where('users.id','=',Auth::id())
                ->select('*','assignments.id')
                ->get();

//            dd($assignments);


//            dd($assignments);

//            $submiited = DB::table('works')->where('assignment_id',1)->count();



            return view('teacher.assignment',compact('assignments'));
//            return view('teacher.home')

        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
//            $assignments = DB::table('assignments')->select('*')->orderBy('dueDate','asc')->orderBy('dueTime','asc')->get();
            $assignments = DB::table('attend_sections')->where('attend_sections.user_id','=',Auth::id())
                ->join('sections_in_subject as sis','sis.id', '=','attend_sections.sis_id')
                ->join('sections','sis.section_id','=','sections.id')
                ->join('assignments','sis.id','=','assignments.sis_id')
                ->select('*','assignments.id')->orderBy('dueDate','asc')->orderBy('dueTime','asc')
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
//        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)
//            ->join('subjects','subjects.id', '=','assignments.subject_id')
//            ->join('sections','subjects.section_id','=','sections.id')
//            ->select('subjects.id','sections.section','subjects.code','subjects.name')->get();

        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)
            ->join('sections_in_subject as sis','assignments.sis_id','=','sis.id')
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

            return view('teacher.assignment-show',compact('assignment','fileType','sections','allWorks'));
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

    public function showWorkDetail($title, $id) {
//        $works = DB::table('works')->select('*')->where('id',$id)->first();

        $works = DB::table('works')->select('*','works.id')->where('works.id',$id)->join('users','works.student_id','=','users.id')->first();
//        dd($works);
        return view('teacher.assignment-grade',compact('works'));
    }

    public function inputGrade(Request $request, $id)
    {
        //
        $work = Work::find($id);
        $work->grade = $request->input('grade');
        $work->save();

        return redirect()->back();
    }


    public function compareIndex() {
        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            return view('teacher.assignment-compare');
        }else{
            redirect('/');
        }
    }

    public function getWork($grade)
    {
        $works = DB::table("works")->where("grade",$grade)->join('files','works.id','=','files.work_id')->pluck('files.file','files.id');

        return json_encode($works);

    }

}
