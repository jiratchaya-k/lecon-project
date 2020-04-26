<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\File;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    //
    public function store(Request $request){
//        $this->validate($request,[
//
//        ]);

//        print_r(json_encode(['jpg','png']));exit();
//        DD($request->file('work_file'));
        $work_files = $request->file('work_file');
        $work_extensions = [];
        $grade = '';
        $remark = '';
        if (!empty($work_files)) {

            $assignment = DB::table('assignments')->where('id',$request->input('assignment_id'))->first();

            foreach ($work_files as $work) {
                // get file with extension
                $filenameWithExt = $work->getClientOriginalName();

                // get file name = 1
                $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

                // get extention = jpg
                $extension = $work->getClientOriginalExtension();

                // crete new file name = 1_1223322.jpg
                $filenameToStore = date("dMyhis").'_'.$filename.'.'.$extension;

                // upload image
//                $work->move('uploads/workFiles/',$filenameToStore);

//                $file = new File;
//                $file->file = $filenameToStore;
//                $file->save();

                $fileStore[] = $filenameToStore;

                $work_extensions[] = $extension;

                $array_stdname[] = $filename;

                //get image dimensions (width,height) : PIXEL(px)
                list($width, $height) = getimagesize($work);

                $dimensions[] = $width.' x '.$height;

            }

//            $filename_1 = 'cg2hw02_13590XXX_1';
//            $filename_2 = 'cg2hw02_13590XXX_2';
//            $std_filename_1 = 'hw01_13590252_01';
//            $std_filename_2 = 'hw01_13590252_02';


//            $array_name = array($filename_1,$filename_2);
            $array_name = json_decode($assignment->filename);
            sort($array_name);

//            $array_stdname = array($std_filename_1,$std_filename_2);
            sort($array_stdname);


            $arr_filename = array();
            $arr_std_filename = array();

            foreach ($array_name as $fname) {
                $arr_filename[] = explode("_", $fname, 5);
            }
            foreach ($array_stdname as $stdname) {
                $arr_std_filename[] = explode("_", $stdname, 5);
            }

            $user = DB::table('users')->where('id',Auth::id())->select('student_id')->first();

            $name = 'match';
            $remark='';

            if (count($array_name) == count($array_stdname)){
                for($i=0;$i<count($arr_filename);$i++){
                    if ($name == 'match'){
                        for($x=0;$x<count($arr_filename[$i]);$x++){
                            if (strlen($array_name[$i]) == strlen($array_stdname[$i])){
                                if (($arr_std_filename[$i][$x] != $user->student_id) && $name == 'match'){
                                    if ($arr_filename[$i][$x] == $arr_std_filename[$i][$x]) {
                                        $name = 'match';

                                        $fileType = json_decode($assignment->fileType);
                                        $fileDimensions[] = $assignment->dimensions;

                                        if ($assignment->autoGrade_fileType == '1') {
                                            foreach ($work_extensions as $ext){
                                                if (!in_array($ext,$fileType)) {
                                                    $grade = 'DELETE';
                                                    $remark = 'นามสกุลไฟล์ไม่ตรงกับเงื่อนไขงาน';
                                                    $name = 'unmatch';
                                                }
                                                if ($assignment->autoGrade_dimensions == '1'){
                                                    foreach ($dimensions as $dms){
                                                        if (!in_array($dms,$fileDimensions)) {
                                                            $grade = 'DELETE';
                                                            $remark = 'นามสกุลไฟล์และขนาดไฟล์ไม่ตรงกับเงื่อนไขงาน';
                                                            $name = 'unmatch';
                                                        }
                                                    }
                                                }
                                            }
                                        }else if ($assignment->autoGrade_dimensions == '1') {

                                            foreach ($dimensions as $dms){
                                                if (!in_array($dms,$fileDimensions)) {
                                                    $grade = 'DELETE';
                                                    $remark = 'ขนาดไฟล์ไม่ตรงกับเงื่อนไขงาน';
                                                    $name = 'unmatch';
                                                }
                                            }

                                        }

//            dd($grade , $work_extensions , $fileType ,$dimensions, $fileDimensions ,$assignment->autoGrade_dimensions);


                                    }else{
                                        $name = 'unmatch';
                                    }
                                }else {
                                    if ($arr_std_filename[$i][$x] == $user->student_id) {
                                        $name = 'match';
                                    }else {
                                        $name = 'unmatch';
                                    }
                                }
                            }else{
                                $name = 'unmatch';
                            }
                        }
                    }else {
                        $name = 'unmatch';
                    }
                }
                dd($name,$remark);
            }else {
                dd('ส่งไม่ครบ');
            }

//            $fileType = json_decode($assignment->fileType);
//            $fileDimensions[] = $assignment->dimensions;
//
//            if ($assignment->autoGrade_fileType == '1') {
//                foreach ($work_extensions as $ext){
//                    if (!in_array($ext,$fileType)) {
//                        $grade = 'DELETE';
//                        $remark = 'นามสกุลไฟล์ไม่ตรงกับเงื่อนไขงาน';
//                    }
//                    if ($assignment->autoGrade_dimensions == '1'){
//                        foreach ($dimensions as $dms){
//                            if (!in_array($dms,$fileDimensions)) {
//                                $grade = 'DELETE';
//                                $remark = 'นามสกุลไฟล์และขนาดไฟล์ไม่ตรงกับเงื่อนไขงาน';
//                            }
//                        }
//                    }
//                }
//            }else if ($assignment->autoGrade_dimensions == '1') {
//
//                    foreach ($dimensions as $dms){
//                        if (!in_array($dms,$fileDimensions)) {
//                              $grade = 'DELETE';
//                            $remark = 'ขนาดไฟล์ไม่ตรงกับเงื่อนไขงาน';
//                        }
//                    }
//
//            }

//            dd($grade , $work_extensions , $fileType ,$dimensions, $fileDimensions ,$assignment->autoGrade_dimensions);

        }


        $dueDate = strtotime($assignment->dueDate);
        $dueTime = strtotime($assignment->dueTime);
        $date = strtotime(date("Y-m-d"));
        $time = strtotime(date("H:i:s"));


        if (($date <= $dueDate)) {
            if (($time <= $dueTime)){
                $status = 'Submitted';
            }else{
                $status = 'Submitted Late';
            }
        }
        else {
            $status = 'Submitted Late';
        }

//        dd($status,$grade);

        $work = new Work;
        $work->student_id = Auth::id();
        $work->grade = $grade;
        $work->status = $status;
        $work->remark = $remark;
        $work->assignment_id = $request->input('assignment_id');
//        $work->save();

        $work_id = DB::table('works')->select('id')->orderBy('id','DESC')->limit('1')->first();

        foreach ($fileStore as $f) {
            $file = new File;
            $file->file = $f;
            $file->work_id = $work_id->id;
            $file->status = 'use';
//            $file->save();
//            dd($file->file, $file->work_id);
        }



//        $work = new Work;
//        $work->file = json_encode($fileStore);
//        $work->student_id = Auth::id();
//        $work->grade = $grade;
//        $work->status = $status;
//        $work->remark = $remark;
//        $work->assignment_id = $request->input('assignment_id');
//        $work->save();







        return redirect('/assignment/'.$request->input('assignment_id'));

//        dd($request->all());
    }


    public function update(Request $request, $id){
//        $this->validate($request,[
//
//        ]);

//        print_r(json_encode(['jpg','png']));exit();
//        DD($request->file('work_file'));
        $work_files = $request->file('work_file');
        $work_extensions = [];
        $grade = '';
        $remark = '';
        if (!empty($work_files)) {

            $assignment = DB::table('assignments')->where('id',$request->input('assignment_id'))->first();

            foreach ($work_files as $work) {
                // get file with extension
                $filenameWithExt = $work->getClientOriginalName();

                // get file name = 1
                $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

                // get extention = jpg
                $extension = $work->getClientOriginalExtension();

                // crete new file name = 1_1223322.jpg
                $filenameToStore = date("YmdHis").'_'.$filename.'.'.$extension;

                // upload image
                $work->move('uploads/workFiles/',$filenameToStore);

//                $file = new File;
//                $file->file = $filenameToStore;
//                $file->save();

                $fileStore[] = $filenameToStore;

                $work_extensions[] = $extension;

                //get image dimensions (width,height) : PIXEL(px)
                list($width, $height) = getimagesize("uploads/workFiles/$filenameToStore");

                $dimensions[] = $width.' x '.$height;

            }

            $fileType = json_decode($assignment->fileType);
            $fileDimensions[] = $assignment->dimensions;

            if ($assignment->autoGrade_fileType == '1') {
                foreach ($work_extensions as $ext){
                    if (!in_array($ext,$fileType)) {
                        $grade = 'DELETE';
                        $remark = 'นามสกุลไฟล์ไม่ตรงกับเงื่อนไขงาน';
                    }
                    if ($assignment->autoGrade_dimensions == '1'){
                        foreach ($dimensions as $dms){
                            if (!in_array($dms,$fileDimensions)) {
                                $grade = 'DELETE';
                                $remark = 'นามสกุลไฟล์และขนาดไฟล์ไม่ตรงกับเงื่อนไขงาน';
                            }
                        }
                    }
                }
            }else if ($assignment->autoGrade_dimensions == '1') {

                foreach ($dimensions as $dms){
                    if (!in_array($dms,$fileDimensions)) {
                        $grade = 'DELETE';
                        $remark = 'ขนาดไฟล์ไม่ตรงกับเงื่อนไขงาน';
                    }
                }

            }

//            dd($grade , $work_extensions , $fileType ,$dimensions, $fileDimensions ,$assignment->autoGrade_dimensions);

        }


        $dueDate = strtotime($assignment->dueDate);
        $dueTime = strtotime($assignment->dueTime);
        $date = strtotime(date("Y-m-d"));
        $time = strtotime(date("H:i:s"));


        if (($date <= $dueDate)) {
            if (($time <= $dueTime)){
                $status = 'Submitted';
            }else{
                $status = 'Submitted Late';
            }
        }
        else {
            $status = 'Submitted Late';
        }

        DB::table('works')
            ->where('student_id', Auth::id())->where('assignment_id',$id)
            ->update(['grade' => $grade],['status' => $status],['remark' => $remark]);

        $work = DB::table('works')
            ->where('student_id', Auth::id())->where('assignment_id',$id)->first();


        $oldfiles = DB::table('files')
            ->where('work_id', $work->id)->get();

        foreach ($oldfiles as $oldfile){
            DB::table('files')
                ->where('id', $oldfile->id)
                ->update(['status' => 'not use']);
        }

        foreach ($fileStore as $f) {
            $file = new File;
            $file->file = $f;
            $file->work_id = $work->id;
            $file->status = 'use';
            $file->save();
//            dd($file->file, $file->work_id);
        }



//        $work = new Work;
//        $work->file = json_encode($fileStore);
//        $work->student_id = Auth::id();
//        $work->grade = $grade;
//        $work->status = $status;
//        $work->remark = $remark;
//        $work->assignment_id = $request->input('assignment_id');
//        $work->save();







        return redirect('/assignment/'.$request->input('assignment_id'));

//        dd($request->all());
    }



}
