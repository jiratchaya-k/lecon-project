<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Mail\AssignmentMail;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
                ->join('sections_in_subjects as sis','assignments.sis_id','=','sis.id')
                ->join('sections','sis.section_id','=','sections.id')
                ->join('attend_sections','attend_sections.sis_id','=','sis.id')
                ->join('users','attend_sections.user_id','=','users.id')
//                ->join('works','works.assignment_id','=','assignments.id')
                ->select('*','assignments.id')
//                ->select('works.assignment_id',DB::raw('COUNT(grade) as count'))->groupBy('works.assignment_id')
                ->where('users.id','=',Auth::id())
                ->where('assignments.status','=','active')
                ->where('attend_sections.status','=','active')
                ->get();

//            dd(count($assignments));



//            $submiited = DB::table('works')->where('assignment_id',1)->count();



            return view('teacher.assignment',compact('assignments'));
//            return view('teacher.home')

        }elseif (Auth::check() && auth()->user()->role == User::role_student) {
//            $assignments = DB::table('assignments')->select('*')->orderBy('dueDate','asc')->orderBy('dueTime','asc')->get();
            $assignments = DB::table('attend_sections')->where('attend_sections.status','active')
                ->where('attend_sections.user_id','=',Auth::id())
                ->join('sections_in_subjects as sis','sis.id', '=','attend_sections.sis_id')
                ->join('sections','sis.section_id','=','sections.id')
                ->join('assignments','sis.id','=','assignments.sis_id')
                ->select('*','assignments.id')->orderBy('dueDate','asc')->orderBy('dueTime','asc')
                ->where('assignments.status','=','active')
                ->where('attend_sections.status','=','active')
                ->get();

//            dd($asm);
            return view('student.home',compact('assignments'));
        }else{
            return redirect('/');
        }
    }

    public function create(){
        //
//        $sections = DB::table('subjects')->join('sections','subjects.section_id', '=','sections.id')
//            ->select('subjects.id','sections.section','subjects.code','subjects.name')->get();

        $sections = DB::table('attend_sections')->where('attend_sections.user_id','=',Auth::id())
            ->join('sections_in_subjects as sis','sis.id', '=','attend_sections.sis_id')
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->select('*','sis.id as sis_id')
            ->orderBy('subjects.id','ASC')
            ->orderBy('sections.section','ASC')
            ->get();

//            dd($sections);

        return view('teacher.assignment-create',compact('sections'));
    }

    public function store(Request $request){
        $this->validate($request,[

        ]);


//        dd($filenames);


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

        $filenames = json_encode($request->input('assignment_filename'));



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

        if ($request->input('dimensions_width') != null && $request->input('dimensions_height') != null){
            $dimensions = $request->input('dimensions_width').' x '.$request->input('dimensions_height');
        }else {
            $dimensions = null;
        }


        if ($dimensions == null) {
            $dimensionsType = null;
        }else {
            $dimensionsType = 'px';
        }

//        dd($dimensionsType);


        $assignment = new Assignment;
        $assignment->title = $request->input('assignment_title');
        $assignment->description = $request->input('assignment_description');
        $assignment->file = $filenameToStore;
        $assignment->dueDate = $request->input('assignment_dueDate');
        $assignment->dueTime = $request->input('assignment_dueTime');
        $assignment->showGrade = 'hidden';
        $assignment->sis_id = $request->input('sis_id');
        $assignment->filename = $filenames;
        $assignment->autoGrade_fileType = $autoGradeType;
        $assignment->autoGrade_dimensions = $autoGradeDimensions;
        $assignment->fileType = $inFileType;
        $assignment->dimensions = $dimensions;
        $assignment->dimensionsType = $dimensionsType;
        $assignment->status = 'active';
        $assignment->save();

        $asm = DB::table('assignments')->select('*')->orderBy('id','DESC')->first();

        $subject = DB::table('sections_in_subjects as sis')->where('sis.id',$request->input('sis_id'))
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('subjects.id','sections.section','subjects.code','subjects.name')->first();

        $students = DB::table('attend_sections')->where('attend_sections.sis_id',$request->input('sis_id'))
            ->where('attend_sections.status','=','active')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_student)
            ->select('users.firstname','users.lastname','users.student_id','users.email')
            ->get();

//        dd($asm);

        foreach ($students as $student){
            $asm_id = $asm->id;
            $asm_name = $request->input('assignment_title');
            $asm_dueDate = $request->input('assignment_dueDate');
            $asm_dueTime = $request->input('assignment_dueTime');
            $asm_section = $subject->section;
            $asm_subject = $subject->code.' '.$subject->name;
            $std_name = $student->firstname.' '.$student->lastname;
            $std_id = $student->student_id;

        Mail::to($student->email)
            ->send(new AssignmentMail($asm_id,$asm_name,$asm_dueDate,$asm_dueTime,$asm_section,$asm_subject,$std_name,$std_id));
        }



        return redirect('/teacher/assignment');
//        dd($request->all());
    }

    public function show($id){

        $assignment = Assignment::find($id);
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

//        dd($assignment);
        if (!empty(Auth::check())) {
        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            $allWorks = DB::table('works')->where('assignment_id',$id)
                ->join('users','users.id','=','works.student_id')
                ->select('*','works.id')->distinct('users.student_id')->get();

            $arr_allWorks = json_decode($allWorks);

            $arr_workId = array();

            foreach ($arr_allWorks as $arr_work){
                $arr_workId[] = $arr_work->id;
            }

            $value = 1;

            function Search($value, $array)
            {
                return(array_search($value, $array));
            }

//            dd(Search($value, $arr_workId));

            $fileType = json_decode($assignment->fileType);
            $filenames = json_decode($assignment->filename);

//            dd($assignment->showGrade);

            if ($assignment->showGrade == "show"){
                $showGrade = "แสดง";
            }else{
                $showGrade = "ไม่แสดง";
            }

//            dd($assignment->id);

            return view('teacher.assignment-show',compact('assignment','sections','fileType','sections','allWorks','arr_workId','showGrade','filenames'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {


            $assignmentWork = Work::all()->where('student_id',Auth::id())->where('assignment_id',$id)->first();
            $workFile = DB::table('files')->where('files.status','=','use')
                ->join('works','works.id','=','files.work_id')
                ->where('works.student_id','=',Auth::id())
                ->where('works.assignment_id','=',$id)
                ->select('files.file')->get();
//
//            dd($workFile);

            $files = [];

            foreach ($workFile as $wfile){
                $files[] = $wfile->file;
            }

            $fileType = json_decode($assignment->fileType);
            $filenames = json_decode($assignment->filename);


            // change string of date,time(2019-12-05) to number of date,time (1575478800)
            $dueDate = strtotime($assignment->dueDate);
            $dueTime = strtotime($assignment->dueTime);
            $date = strtotime(date("Y-m-d"));
            $time = strtotime(date("H:i:s"));

            $status = '';

//            dd($assignmentWork);


//            dd($assignmentWork->grade);


            if (!empty($assignmentWork)){

                if ($assignment->showGrade == 'hidden') {
                    if ($assignmentWork->remark != ''){
                        $grade = $assignmentWork->grade;
                    }else {
                        $grade = '';
                    }
                }else {
                    $grade = $assignmentWork->grade;
                }

                $works = $files;

                if ($assignmentWork->status == 'Submitted'){
                    $status = 'ส่งแล้ว';
                }elseif ($assignmentWork->status == 'Submitted Late'){
                    $status = 'ส่งล่าช้า';
                }
            }else {
                $works = null;
                $grade = '';
                //if student not send -> status = Missed
                if ((($date > $dueDate) && ($time > $dueTime)) || (($date > $dueDate) && ($time <= $dueTime)) ) {
                    $status = 'ขาดส่ง';
                }
            }

//            dd($assignmentWork);

            return view('student.assignment-show',compact('assignment','assignmentWork','sections','works','fileType','status','sections','grade','filenames'));
        }
        }else {
            return redirect('/login');
        }

    }

    public function edit($id){

        $assignment = DB::table('assignments')->where('id',$id)->first();

        $fileType = json_decode($assignment->fileType);
        $filenames = json_decode($assignment->filename);

        $sections = DB::table('attend_sections')->where('attend_sections.user_id','=',Auth::id())
            ->join('sections_in_subjects as sis','sis.id', '=','attend_sections.sis_id')
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->select('*','sis.id as sis_id')
            ->get();

        $width = '';
        $height = '';

        if ($assignment->dimensions != null){

            $width = substr("$assignment->dimensions",0,-6);
            $height = substr("$assignment->dimensions",-3);
//            dd($height);
        }

//        dd($assignment->dueDate);

        return view('teacher.assignment-edit',compact('assignment','fileType','width','height','sections','filenames'));
    }

    public function update(Request $request,$id){

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



        $filenames = json_encode($request->input('assignment_filename'));

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

        if ($request->input('dimensions_width') != null && $request->input('dimensions_height') != null){
            $dimensions = $request->input('dimensions_width').' x '.$request->input('dimensions_height');
        }else {
            $dimensions = null;
        }


        if ($dimensions == null) {
            $dimensionsType = null;
        }else {
            $dimensionsType = 'px';
        }

//        dd($dimensionsType);


        $assignment = Assignment::find($id);
        $assignment->title = $request->input('assignment_title');
        $assignment->description = $request->input('assignment_description');
        $assignment->file = $filenameToStore;
        $assignment->dueDate = $request->input('assignment_dueDate');
        $assignment->dueTime = $request->input('assignment_dueTime');
        $assignment->sis_id = $request->input('sis_id');
        $assignment->filename = $filenames;
        $assignment->autoGrade_fileType = $autoGradeType;
        $assignment->autoGrade_dimensions = $autoGradeDimensions;
        $assignment->fileType = $inFileType;
        $assignment->dimensions = $dimensions;
        $assignment->dimensionsType = $dimensionsType;

//        dd($request->all(),$filenameToStore,$autoGradeType,$autoGradeDimensions,$inFileType,$dimensions,$dimensionsType);

        $assignment->save();
//
//
        return redirect('/teacher/assignment/'.$id);
//        dd($request->all());
    }

    public function destroy($id)
    {
        //
        $assignment = Assignment::find($id);
        $assignment->status = 'inactive';
        $assignment->save();
        return redirect('/teacher/assignment');
    }

    public function showWorkDetail($title, $arr_index, $id) {

//        $works = DB::table('works')->select('*')->where('id',$id)->first();

        $asm_id = DB::table('assignments')->where('title','=',$title)->select('id')->first();

        $asm_title = $title;

        $works = DB::table('works')->select('*','works.id')->where('works.id',$id)
            ->join('users','works.student_id','=','users.id')
            ->join('files','works.id','=','files.work_id')
            ->first();

        $files = DB::table('works')->where('works.id',$id)
            ->join('users','works.student_id','=','users.id')
            ->join('files','works.id','=','files.work_id')
            ->select('files.file','files.id')
            ->get();

        $allworks = DB::table('works')->where('assignment_id','=',$asm_id->id)->orderBy('student_id')->get();

        $arr_allWorks = json_decode($allworks);

//        dd($arr_allWorks);

        foreach ($arr_allWorks as $arr_work){
            $arr_workId[] = $arr_work->id;
        }

        $value = $id;

        function Search($value, $array)
        {
            return(array_search($value, $array));
        }

        $arrayCount = count($arr_workId);

        $arrayIndex = Search($value, $arr_workId);
//            dd(Search($value, $arr_workId));


//        dd($files);
        return view('teacher.assignment-grade',compact('works','files','asm_id','arrayIndex','asm_title','arrayCount'));
    }

    public function nextWork($title, $arr_index, $id)
    {
        $asm_id = DB::table('assignments')->where('title','=',$title)->select('id')->first();
        $allworks = DB::table('works')->where('assignment_id','=',$asm_id->id)->orderBy('student_id')->get();

        $arr_allWorks = json_decode($allworks);

//        dd($arr_allWorks);

        foreach ($arr_allWorks as $arr_work){
            $arr_workId[] = $arr_work->id;
        }

//        dd($arr_workId[$arr_index+1]);

        return redirect('/teacher/assignment/'.$title.'/index='.($arr_index+1).'/work='.$arr_workId[$arr_index+1]);

    }
    public function previousWork($title, $arr_index, $id)
    {
        $asm_id = DB::table('assignments')->where('title','=',$title)->select('id')->first();
        $allworks = DB::table('works')->where('assignment_id','=',$asm_id->id)->orderBy('student_id')->get();

        $arr_allWorks = json_decode($allworks);

//        dd($arr_allWorks);

        foreach ($arr_allWorks as $arr_work){
            $arr_workId[] = $arr_work->id;
        }

//        dd($arr_workId[$arr_index+1]);

        return redirect('/teacher/assignment/'.$title.'/index='.($arr_index-1).'/work='.$arr_workId[$arr_index-1]);

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
            $assignments = DB::table('assignments')
                ->join('sections_in_subjects as sis','assignments.sis_id','=','sis.id')
                ->join('sections','sis.section_id','=','sections.id')
                ->join('attend_sections','attend_sections.sis_id','=','sis.id')
                ->join('users','attend_sections.user_id','=','users.id')
                ->where('users.id','=',Auth::id())
                ->select('*','assignments.id')
                ->get();

            return view('teacher.assignment-compare',compact('assignments'));
        }else{
            redirect('/');
        }
    }

    public function compareShow($id) {
        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            $assignment_id = $id;


            return view('teacher.assignment-comparegrade',compact('assignment_id'));
        }else{
            redirect('/');
        }
    }

    public function getWork($asm_id,$grade)
    {
        $works = DB::table("works")->where('assignment_id',$asm_id)->where("grade",$grade)
            ->join('files','works.id','=','files.work_id')
            ->join('users','works.student_id','=','users.id')
            ->select('files.file','files.id','users.student_id')->get();

        return json_encode($works);

    }

    public function getAllWork($asm_id,$grade)
    {
        $works = DB::table("works")->where('assignment_id',$asm_id)->where("grade",$grade)
            ->join('files','works.id','=','files.work_id')
            ->join('users','works.student_id','=','users.id')
            ->select('files.file','files.id','users.student_id')->get();

        return json_encode($works);

    }

    public function compareDetail($id) {
//        $works = DB::table('works')->select('*')->where('id',$id)->first();

        $work = DB::table('files')->where('id',$id)->select('work_id')->first();

        $works = DB::table('works')->select('*','works.id')->where('works.id',$work->work_id)
            ->join('users','works.student_id','=','users.id')
            ->join('files','works.id','=','files.work_id')
            ->first();

        $files = DB::table('works')->where('works.id',$work->work_id)
            ->join('users','works.student_id','=','users.id')
            ->join('files','works.id','=','files.work_id')
            ->select('files.file','files.id')
            ->get();

        $asm_id = DB::table('files')->where('files.id','=',$id)->join('works','files.work_id','=','works.id')->select('works.assignment_id')->first();

        $allworks = DB::table('works')->where('assignment_id','=',$asm_id->assignment_id)->orderBy('student_id')->get();

        $arr_allWorks = json_decode($allworks);

//        dd($arr_allWorks);

        foreach ($arr_allWorks as $arr_work){
            $arr_workId[] = $arr_work->id;
        }

        $value = $id;

        function Search($value, $array)
        {
            return(array_search($value, $array));
        }

        $arrayCount = count($arr_workId);

        $arrayIndex = Search($value, $arr_workId);


        return view('teacher.assignment-compare-detail',compact('works','files','asm_id','arrayIndex','arrayCount'));
    }

    public function showGrade(Request $request, $id){

        $assignment = Assignment::find($id);
        $assignment->showGrade = $request->input('showGrade');
//        dd($request->all());
        $assignment->save();

        return redirect()->back();
    }

    public function showFile($id,$filename){

        $my_url = url()->current();
        $folder_file = substr($my_url, strrpos($my_url, '/' )+1);
        $folder = strstr($folder_file,'=' ,true);

//        dd($folder);

        $assignment = Assignment::find($id);
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

        $ext = substr($filename, strrpos($filename, '.') + 1);


        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            $asm_id = $id;

//            $asm_title = $title;

            $works = DB::table('works')->select('*','works.id')->where('works.id',$id)
                ->join('users','works.student_id','=','users.id')
                ->join('files','works.id','=','files.work_id')
                ->first();

            $files = DB::table('works')->where('works.id',$id)
                ->join('users','works.student_id','=','users.id')
                ->join('files','works.id','=','files.work_id')
                ->select('files.file','files.id')
                ->get();

            return view('teacher.assignment-show-file',compact('assignment','sections','filename','ext','folder','works','files'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {
            return view('student.assignment-show-file',compact('assignment','sections','filename','ext','folder'));
        }

    }

    public function studentList_show($id){

        $assignment = Assignment::find($id);
        $sis_id = $assignment->sis_id;
//        dd($sis_id);

        $sections = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('sis.id as sis_id','sis.date','sis.startTime','sis.endTime','subjects.id','sections.section','subjects.code','subjects.name')->first();


        switch( $sections->date ) {
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

        $teachers = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_teacher)
//            ->where('users.id','!=',Auth::id())
            ->where('attend_sections.status','=','active')
            ->select('users.id','users.firstname','users.lastname','users.email','users.profile_img')->get();

        $students = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_student)
            ->where('attend_sections.status','=','active')
            ->orderBy('users.student_id')
            ->select('users.id','users.firstname','users.lastname','users.email','users.student_id','users.profile_img')->get();

        $allWorks = DB::table('works')->where('assignment_id',$id)
            ->join('users','users.id','=','works.student_id')
            ->select('*','works.id')->distinct('users.student_id')->orderBy('users.student_id')->get();



        $std_notsend = array();

        foreach ($students as $student){
            foreach ($allWorks as $work){
                if ($student->student_id != $work->student_id){
                    $std_notsend[] = $student;
                }
            }
        }


        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            return view('teacher.assignment-student-list',compact('sections','assignment','date','teachers','students','allWorks','std_notsend'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {

            return redirect('/');
        }

    }

}
