<?php

namespace App\Http\Controllers;

use App\Assignment;
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
                $filenameToStore = date("YmdHis").'_'.$filename.'.'.$extension;

                // upload image
                $work->move('uploads/workFiles/',$filenameToStore);

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
            if (($time <= $dueTime) || ($time > $dueTime)){
                $status = 'Submitted';
            }
        }
        else {
            $status = 'Submitted Late';
        }

        $work = new Work;
        $work->file = json_encode($fileStore);
        $work->student_id = Auth::id();
        $work->grade = $grade;
        $work->status = $status;
        $work->remark = $remark;
        $work->assignment_id = $request->input('assignment_id');
        $work->save();





        return redirect('/assignment/'.$request->input('assignment_id'));

//        dd($request->all());
    }
}
