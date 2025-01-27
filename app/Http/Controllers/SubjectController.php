<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\attendSection;
use App\Imports\CsvImport;
use App\Lesson;
use App\Post;
use App\Section;
use App\SectionsInSubject;
use App\Subject;
use App\User;
use App\Year;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\New_;

class SubjectController extends Controller
{
    //
    public function index()
    {
        $subject = DB::table('attend_sections as attend')->where('user_id', '=',Auth::id())
            ->join('sections_in_subjects as sis','attend.sis_id','=','sis.id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->where('attend.status','=','active')
            ->where('sis.status','=','active')
            ->select('code','name')->distinct()
            ->get();
        $subjects = json_decode($subject);

        $sections = DB::table('attend_sections')->where('attend_sections.user_id','=',Auth::id())
            ->join('sections_in_subjects as sis','sis.id', '=','attend_sections.sis_id')
            ->where('attend_sections.status','=','active')
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->join('years','sis.year_id','=','years.id')
            ->select('sis.id','subjects.code','subjects.name','sections.section','sis.date','sis.startTime','sis.endTime','years.year','years.term')
            ->where('sis.status','=','active')
            ->get();

//        dd($subject);

        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            return view('teacher.home',compact('subjects'));
        }
        else if (Auth::check() && auth()->user()->role == User::role_student) {
            return view('student.subject',compact('sections'));
        }
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

        $sis_id = $id;
//        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)
//            ->join('subjects','subjects.id', '=','assignments.subject_id')
//            ->join('sections','subjects.section_id','=','sections.id')
//            ->select('subjects.id','sections.section','subjects.code','subjects.name')->get();

        $sections = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('sis.id as sis_id','sis.date','sis.startTime','sis.endTime','subjects.id','sections.section','subjects.code','subjects.name')->first();

//        dd($sections);

        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            $assignments = DB::table('assignments')->where('assignments.sis_id',$id)->where('status','=','active')
                ->select('*')->get();


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

            $teachers = DB::table('attend_sections')->where('attend_sections.sis_id','=',$sections->sis_id)->get();

            $posts = DB::table('posts')->where('posts.sis_id','=',$id)
                ->where('posts.status','=','active')->get();
            $lessons = DB::table('lessons')->where('lessons.sis_id','=',$id)
                ->where('lessons.status','=','active')->get();

            foreach ($teachers as $teacher) {
                $teach = DB::table('users')->where('users.role','=',User::role_teacher)->where('users.id','=',$teacher->user_id)->select('users.firstname','users.lastname')->first();
                if ($teach != null){
                    $allTeacher[] = $teach;
                }

            }

//            dd($allTeacher);

            return view('teacher.subject-show',compact('sections','assignments','date','allTeacher','posts','lessons'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {

            $assignments = DB::table('assignments')->where('assignments.sis_id',$id)->where('status','=','active')
                ->select('*')->get();


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

            $teachers = DB::table('attend_sections')->where('attend_sections.sis_id','=',$sections->sis_id)->get();


            $posts = DB::table('posts')->where('posts.sis_id','=',$id)->get();
            $lessons = DB::table('lessons')->where('lessons.sis_id','=',$id)->get();

            foreach ($teachers as $teacher) {
                $teach = DB::table('users')->where('users.role','=',User::role_teacher)->where('users.id','=',$teacher->user_id)->select('users.firstname','users.lastname')->first();
                if ($teach != null){
                    $allTeacher[] = $teach;
                }

            }

//            dd($allTeacher);

            return view('student.subject-show',compact('sections','assignments','date','allTeacher','posts','lessons'));
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
        $sis->status = 'active';
        $sis->save();

//        dd($request->input('subject_endTime'));

        $sis_id = DB::table('sections_in_subjects')->select('id')->orderBy('id','DESC')->limit('1')->first();

        $attend = new AttendSection;
        $attend->user_id =  $request->input('subject_createby');
        $attend->sis_id = $sis_id->id;
        $attend->status = 'active';
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
                $attend->status = 'active';
                $attend->save();


            }
        }

        $csv_file = $request->file('file');
        if (!empty($csv_file)){
            Excel::import(new CsvImport, $request->file('file'));
        }
        else {
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
                    $attend->status = 'active';
                    $attend->save();
                }
            }
        }


//        dd($tcs,$std);



        return redirect('/teacher/subject');
    }

    public function edit($id)
    {
        $years = Year::all();
        $sections = Section::all();

        $section = DB::table('sections_in_subjects as sis')->where('sis.id',$id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('sis.id as sis_id','sis.date','sis.startTime','sis.endTime','subjects.id as subject_id','sections.section','subjects.code','subjects.name','sis.year_id','sis.section_id')
            ->first();

        $teachers = DB::table('sections_in_subjects as sis')->where('sis.id',$id)
            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_teacher)
            ->where('users.id','!=',Auth::id())
            ->where('attend_sections.status','=','active')
            ->select('users.id','users.firstname','users.lastname','users.email')->get();

        $allTeachers = DB::table('users')->where('role',User::role_teacher)
            ->where('id','!=',Auth::id())->get();
        $allStudents = DB::table('users')->where('role',User::role_student)->get();

        $students = DB::table('sections_in_subjects as sis')->where('sis.id',$id)
            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_student)
            ->where('attend_sections.status','=','active')
            ->select('users.id','users.firstname','users.lastname','users.email','users.student_id')->get();

//            dd($section,$teachers,$students);

            return view('teacher.subject-edit',compact('section','teachers','students','years','sections','allStudents','allTeachers'));

    }

    public function update(Request $request,$id){

        $subject_id = $request->input('subject_id');

        $subject = Subject::find($subject_id);
        $subject->code = $request->input('subject_code');
        $subject->name = $request->input('subject_name');
        $subject->save();

//        $subject_id = DB::table('subjects')->select('id')->orderBy('id','DESC')->limit('1')->first();

//        dd($subject_id);

//        dd(DB::table('sections_in_subject')
//            ->insertGetId(['section_id' => $request->input('subject_section'),
//                'subject_id' => $subject_id , 'year_id' => $request->input('subject_year'),
//                'date' => $request->input('subject_date'), 'startTime' => $request->input('subject_startTime'),
//                'endTime' => $request->input('subject_endTime')]));

        $sis = SectionsInSubject::find($id);
        $sis->section_id = $request->input('subject_section');
        $sis->subject_id = $subject_id;
        $sis->year_id = $request->input('subject_year');
        $sis->date = $request->input('subject_date');
        $sis->startTime = $request->input('subject_startTime');
        $sis->endTime = $request->input('subject_endTime');
        $sis->status = 'active';
        $sis->save();

//        dd($request->input('subject_endTime'));

//        $sis_id = DB::table('sections_in_subjects')->select('id')->orderBy('id','DESC')->limit('1')->first();

//        $attend = new AttendSection;
//        $attend->user_id =  $request->input('subject_createby');
//        $attend->sis_id = $id;
//        $attend->status = 'active';
//        $attend->save();

        function getBetween($content,$start,$end){
            $r = explode($start, $content);
            if (isset($r[1])){
                $r = explode($end, $r[1]);
                return $r[0];
            }
            return '';
        }

        $teachers = $request->input('subject_teacher');


        if (!empty($teachers) && $teachers[0] != null){

            for ($i=0;$i < count($teachers);$i++){
                $start = "(";
                $end = ")";
                $teacher_email = getBetween($teachers[$i],$start,$end);

                $teacher_id = DB::table('users')->select('id')->where('email',$teacher_email)->first();

                $haveTeacher = DB::table('attend_sections')->where('sis_id',$id)
                    ->where('user_id',$teacher_id->id)->count();

                if ($haveTeacher > 0) {
                    DB::table('attend_sections')
                        ->where('user_id', $teacher_id->id)->where('sis_id',$id)
                        ->update(['status' => 'active']);
                }else {
                    $attend = new AttendSection;
                    $attend->user_id = $teacher_id->id;
                    $attend->sis_id = $id;
                    $attend->status = 'active';
                    $attend->save();
                }
            }

        }

//        $csv_file = $request->file('file');
//        if (!empty($csv_file)){
//            Excel::import(new CsvImport, $request->file('file'));
//        }
//        else {
            $students = $request->input('subject_student');
            if (!empty($students) && $students[0] != null){
                for($i=0;$i < count($students);$i++){
                    $start = "(";
                    $end = ")";
                    $student_email = getBetween($students[$i],$start,$end);
                    $student_id = DB::table('users')->select('id')->where('email',$student_email)->first();

                    $haveStudent = DB::table('attend_sections')->where('sis_id',$id)
                        ->where('user_id',$teacher_id->id)->count();

                    if ($haveStudent > 0) {
                        DB::table('attend_sections')
                            ->where('user_id', $student_id->id)->where('sis_id',$id)
                            ->update(['status' => 'active']);
                    }else {
                        $attend = new AttendSection;
                        $attend->user_id = $student_id->id;
                        $attend->sis_id = $id;
                        $attend->status = 'active';
                        $attend->save();
                    }

                }
            }
//        }


//        dd($tcs,$std);



        return redirect('/teacher/subject');
    }

    public function deleteUser($sis_id,$user_id){



        DB::table('attend_sections')
            ->where('user_id', $user_id)->where('sis_id',$sis_id)
            ->update(['status' => 'inactive']);


//        $check = SectionCheck::all()->last();

        $message = 'Success';

//        dd(json_decode($check));

        return $message;
    }

    public function destroy($id)
    {
        //
        $sis = SectionsInSubject::find($id);
        $sis->status = 'inactive';
        $sis->save();
        return redirect('/teacher/subject');
    }

    public function addSection($id)
    {
        $years = Year::all();
        $sections = Section::all();

        $subject_id = $id;

        $teachers = DB::table('users')->select('id','firstname','lastname','email')
            ->where('role',User::role_teacher)
            ->where('id','!=',Auth::id())
            ->get();
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
        $sis->status = 'active';
        $sis->startTime = $request->input('subject_startTime');
        $sis->endTime = $request->input('subject_endTime');

//        dd($subject_id);

        $sis->save();

//        dd($request->input('subject_endTime'));

        $sis_id = DB::table('sections_in_subjects')->select('id')->orderBy('id','DESC')->limit('1')->first();

        $attend = new AttendSection;
        $attend->user_id =  $request->input('subject_createby');
        $attend->sis_id = $sis_id->id;
        $attend->status = 'active';
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

        if (!empty($teachers) && $teachers[0] != null){
            for ($i=0;$i < count($teachers);$i++){
                $start = "(";
                $end = ")";
                $teacher_email = getBetween($teachers[$i],$start,$end);

                dd($teachers[$i]);

                $teacher_id = DB::table('users')->select('id')->where('email',$teacher_email)->first();

                $attend = new AttendSection;
                $attend->user_id = $teacher_id->id;
                $attend->sis_id = $sis_id->id;
                $attend->status = 'active';
                $attend->save();


            }
        }

        $csv_file = $request->file('file');
        if (!empty($csv_file)){
            Excel::import(new CsvImport, $request->file('file'));
        }
        else {
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
                    $attend->status = 'active';
                    $attend->save();
                }
            }
        }


        return redirect('/teacher/subject');
    }

    public function postStore(Request $request, $id){
        $post = New Post;
        $post->topic = $request->input('post_topic');
        $post->description = $request->input('post_description');
        $post->user_id = Auth::id();
        $post->sis_id = $id;
        $post->status = 'active';
        $post->save();
        return redirect('/teacher/subject/section/'.$id);
    }
    public function lessonStore(Request $request, $id){

        $lesson_files = $request->file('lesson_file');

        foreach ($lesson_files as $file) {
            // get file with extension
            $filenameWithExt = $file->getClientOriginalName();

            // get file name = 1
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            // get extention = jpg
            $extension = $file->getClientOriginalExtension();

            // crete new file name = 1_1223322.jpg
            $filenameToStore = date("YmdHis").'_'.$filename.'.'.$extension;

            // upload image
            $file->move('uploads/LessonFiles/'.$id,$filenameToStore);

            $fileStore[] = $filenameToStore;

        }

//        dd($request->input('lesson_description'));

        $lesson = New Lesson;
        $lesson->topic = $request->input('lesson_topic');
        $lesson->description = $request->input('lesson_description');
        $lesson->file = json_encode($fileStore);
        $lesson->user_id = Auth::id();
        $lesson->sis_id = $id;
        $lesson->status = 'active';
        $lesson->save();
        return redirect('/teacher/subject/section/'.$id);
    }

    public function lessonShow($sis_id,$id){

//        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)
//            ->join('subjects','subjects.id', '=','assignments.subject_id')
//            ->join('sections','subjects.section_id','=','sections.id')
//            ->select('subjects.id','sections.section','subjects.code','subjects.name')->get();

        $sections = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('sis.id as sis_id','sis.date','sis.startTime','sis.endTime','subjects.id','sections.section','subjects.code','subjects.name')->first();

        $assignments = DB::table('assignments')->where('assignments.sis_id',$sis_id)
            ->where('status','=','active')
            ->select('*')->get();


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

        $teachers = DB::table('attend_sections')->where('attend_sections.sis_id','=',$sections->sis_id)->get();

        $lesson = DB::table('lessons')->where('lessons.id','=',$id)->first();

        foreach ($teachers as $teacher) {
            $teach = DB::table('users')->where('users.role','=',User::role_teacher)
                ->where('users.id','=',$teacher->user_id)
                ->select('users.firstname','users.lastname')
                ->first();
            if ($teach != null){
                $allTeacher[] = $teach;
            }

        }

        $files = json_decode($lesson->file);

//        dd($sections);

        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            return view('teacher.subject-lesson-show',compact('sections','assignments','date','allTeacher','lesson','files'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {

            return view('student.subject-lesson-show',compact('sections','assignments','date','allTeacher','lesson','files'));
        }

    }

    public function lessonDetail($sis_id,$lesson_id,$filename){

//        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)
//            ->join('subjects','subjects.id', '=','assignments.subject_id')
//            ->join('sections','subjects.section_id','=','sections.id')
//            ->select('subjects.id','sections.section','subjects.code','subjects.name')->get();

        $sections = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('sis.id as sis_id','sis.date','sis.startTime','sis.endTime','subjects.id','sections.section','subjects.code','subjects.name')->first();

//        dd($sections);

        $ext = substr($filename, strrpos($filename, '.') + 1);

        $assignments = DB::table('assignments')->where('assignments.sis_id',$sis_id)
            ->where('status','=','active')
            ->select('*')->get();


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

        $teachers = DB::table('attend_sections')->where('attend_sections.sis_id','=',$sections->sis_id)->get();

        $lesson = DB::table('lessons')->where('lessons.id','=',$lesson_id)->first();

        foreach ($teachers as $teacher) {
            $teach = DB::table('users')->where('users.role','=',User::role_teacher)
                ->where('users.id','=',$teacher->user_id)
                ->select('users.firstname','users.lastname')
                ->first();
            if ($teach != null){
                $allTeacher[] = $teach;
            }

        }

//        dd($ext);

        if (Auth::check() && auth()->user()->role == User::role_teacher) {
            return view('teacher.subject-lesson-detail',compact('sections','assignments','date','allTeacher','lesson','filename','ext'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {
            return view('student.subject-lesson-detail',compact('sections','assignments','date','allTeacher','lesson','filename','ext'));
        }

    }

    public function post_edit($sis_id, $id)
    {
        $years = Year::all();
        $sections = Section::all();

        $section = DB::table('sections_in_subjects as sis')->where('sis.id',$id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('sis.id as sis_id','sis.date','sis.startTime','sis.endTime','subjects.id as subject_id','sections.section','subjects.code','subjects.name','sis.year_id','sis.section_id')
            ->first();

        $teachers = DB::table('sections_in_subjects as sis')->where('sis.id',$id)
            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_teacher)
            ->where('users.id','!=',Auth::id())
            ->where('attend_sections.status','=','active')
            ->select('users.id','users.firstname','users.lastname','users.email')->get();

        $allTeachers = DB::table('users')->where('role',User::role_teacher)
            ->where('id','!=',Auth::id())->get();
        $allStudents = DB::table('users')->where('role',User::role_student)->get();

        $students = DB::table('sections_in_subjects as sis')->where('sis.id',$id)
            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_student)
            ->where('attend_sections.status','=','active')
            ->select('users.id','users.firstname','users.lastname','users.email','users.student_id')->get();

        $post = DB::table('posts')->where('id',$id)
        ->first();
//            dd($post);

        return view('teacher.post-edit',compact('post','section','teachers','students','years','sections','allStudents','allTeachers'));

    }

    public function post_update(Request $request, $sis_id, $id){
        $post = Post::find($id);
        $post->topic = $request->input('post_topic');
        $post->description = $request->input('post_description');
        $post->user_id = Auth::id();
        $post->save();

        return redirect('/teacher/subject/section/'.$sis_id);
    }

    public function post_destroy($sis_id, $id)
    {
        //
        $post = Post::find($id);
        $post->status = 'inactive';
        $post->save();
        return redirect('/teacher/subject/section/'.$sis_id);
    }

    public function lesson_edit($sis_id, $id)
    {
        $years = Year::all();
        $sections = Section::all();

        $section = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('sis.id as sis_id','sis.date','sis.startTime','sis.endTime','subjects.id as subject_id','sections.section','subjects.code','subjects.name','sis.year_id','sis.section_id')
            ->first();

        $teachers = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_teacher)
            ->where('users.id','!=',Auth::id())
            ->where('attend_sections.status','=','active')
            ->select('users.id','users.firstname','users.lastname','users.email')->get();

        $allTeachers = DB::table('users')->where('role',User::role_teacher)
            ->where('id','!=',Auth::id())->get();
        $allStudents = DB::table('users')->where('role',User::role_student)->get();

        $students = DB::table('sections_in_subjects as sis')->where('sis.id',$id)
            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_student)
            ->where('attend_sections.status','=','active')
            ->select('users.id','users.firstname','users.lastname','users.email','users.student_id')->get();

        $lesson = DB::table('lessons')->where('id',$id)
            ->first();
//            dd($lesson);
        $files = json_decode($lesson->file);

        return view('teacher.lesson-edit',compact('lesson','files','section','teachers','students','years','sections','allStudents','allTeachers'));

    }

    public function lesson_update(Request $request, $sis_id, $id){

        $lesson_files = $request->file('lesson_file');

        if ($lesson_files != null){
            foreach ($lesson_files as $file) {
                // get file with extension
                $filenameWithExt = $file->getClientOriginalName();

                // get file name = 1
                $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

                // get extention = jpg
                $extension = $file->getClientOriginalExtension();

                // crete new file name = 1_1223322.jpg
                $filenameToStore = date("YmdHis").'_'.$filename.'.'.$extension;

                // upload image
                $file->move('uploads/LessonFiles/'.$id,$filenameToStore);

                $fileStore[] = $filenameToStore;

            }
        }


//        dd($request->input('lesson_description'));

        $lesson = Lesson::find($id);
        $lesson->topic = $request->input('lesson_topic');
        $lesson->description = $request->input('lesson_description');
        if ($lesson_files != null) {
            $lesson->file = json_encode($fileStore);
        }
        $lesson->save();

        return redirect('/teacher/subject/section/'.$sis_id.'/lesson='.$id);
    }

    public function lesson_destroy($sis_id, $id)
    {
        //
        $lesson = Lesson::find($id);
        $lesson->status = 'inactive';
        $lesson->save();
        return redirect('/teacher/subject/section/'.$sis_id);
    }

    public function joinList_show($sis_id){

//        $sections = DB::table('assignments')->where('assignments.id',$assignment_id)
//            ->join('subjects','subjects.id', '=','assignments.subject_id')
//            ->join('sections','subjects.section_id','=','sections.id')
//            ->select('subjects.id','sections.section','subjects.code','subjects.name')->get();

        $sections = DB::table('sections_in_subjects as sis')->where('sis.id',$sis_id)
            ->join('sections','sis.section_id','=','sections.id')
            ->join('subjects','subjects.id','=','sis.subject_id')
            ->select('sis.id as sis_id','sis.date','sis.startTime','sis.endTime','subjects.id','sections.section','subjects.code','subjects.name')->first();

        $assignments = DB::table('assignments')->where('assignments.sis_id',$sis_id)
            ->where('status','=','active')
            ->select('*')->get();


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
            ->select('users.id','users.firstname','users.lastname','users.email','users.student_id','users.profile_img')->get();



        $allTeachers = DB::table('users')->where('role',User::role_teacher)
            ->where('id','!=',Auth::id())->get();
        $allStudents = DB::table('users')->where('role',User::role_student)->get();

        if (Auth::check() && auth()->user()->role == User::role_teacher) {

            return view('teacher.subject-joinlist-show',compact('sections','assignments','date','teachers','students','allTeachers','allStudents'));
        }else if (Auth::check() && auth()->user()->role == User::role_student) {

            return redirect('/');
        }

    }

    public function joinList_delete($sis_id,$id){
        DB::table('attend_sections')
            ->where('user_id', $id)->where('sis_id',$sis_id)
            ->update(['status' => 'inactive']);
        return redirect()->back();
    }

    public function joinList_add(Request $request, $id){
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

                $haveTeacher = DB::table('attend_sections')->where('sis_id',$id)
                    ->where('user_id',$teacher_id->id)->count();

                if ($haveTeacher > 0) {
                    DB::table('attend_sections')
                        ->where('user_id', $teacher_id->id)->where('sis_id',$id)
                        ->update(['status' => 'active']);
                }else {
                    $attend = new AttendSection;
                    $attend->user_id = $teacher_id->id;
                    $attend->sis_id = $id;
                    $attend->status = 'active';
                    $attend->save();
                }
            }

        }

        $students = $request->input('subject_student');
        if (!empty($students)){
            for($i=0;$i < count($students);$i++){
                $start = "(";
                $end = ")";
                $student_email = getBetween($students[$i],$start,$end);
                $student_id = DB::table('users')->select('id')->where('email',$student_email)->first();

                $haveStudent = DB::table('attend_sections')->where('sis_id',$id)
                    ->where('user_id',$student_id->id)->count();

                if ($haveStudent > 0) {
                    DB::table('attend_sections')
                        ->where('user_id', $student_id->id)->where('sis_id',$id)
                        ->update(['status' => 'active']);
                }else {
                    $attend = new AttendSection;
                    $attend->user_id = $student_id->id;
                    $attend->sis_id = $id;
                    $attend->status = 'active';
                    $attend->save();
                }

            }
        }

        return redirect()->back();
    }

}
