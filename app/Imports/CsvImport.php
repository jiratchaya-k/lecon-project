<?php

namespace App\Imports;

use App\attendSection;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {

//        dd($row["student_id"]);

        $user = DB::table('users')->where('student_id','=',$row["student_id"])->first();

//        dd($user);

        $user_id = DB::table('users')->select('id')->orderBy('id','desc')->first();
        $sis_id = DB::table('sections_in_subjects as sis')->select('id')->orderBy('id','desc')->first();
//
//        dd($user_id->id+1);

        if (!empty($user)){
            $attend = new AttendSection;
            $attend->user_id = $user->id;
            $attend->sis_id = $sis_id->id;
            $attend->status = 'active';
            $attend->save();
        }else {
            $attend = new AttendSection;
            $attend->user_id = $user_id->id+1;
            $attend->sis_id = $sis_id->id;
            $attend->status = 'active';
            $attend->save();

            return new User([
                'firstname'      =>  $row["firstname"],
                'lastname'      =>  $row["lastname"],
                'student_id'      =>  $row["student_id"],
                'email'     =>  null,
                'role'     =>  User::role_student,
                'password'  =>  \Hash::make($row['password']),
            ]);
        }





    }
}
