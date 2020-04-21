<?php

namespace App\Http\Controllers;

use App\StudentCheck;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;
use RealRashid\SweetAlert\Facades\Alert;

class LocationController extends Controller
{
    public function index($id,$time)
    {

        $section = DB::table('section_checks')->where('section_checks.id','=',$id)
            ->join('sections_in_subjects as sis','sis.id','=','section_checks.sis_id')
            ->join('sections','sections.id','=','sis.section_id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->join('years','sis.year_id','=','years.id')
            ->select('*','section_checks.id','section_checks.updated_at as qrcode_update','section_checks.created_at as qrcode_create','section_checks.location_id')->first();


        $updateTime = date('H:i:s',strtotime($time));

        $qrcode_update = date('H:i:s',strtotime($section->qrcode_update));

        $createTime = strtotime('+1 second',strtotime($section->qrcode_create));

        $qrcode_create = date('H:i:s',$createTime);

        $teachers = DB::table('attend_sections')->where('attend_sections.sis_id','=',$section->sis_id)
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_teacher)->select('*')
            ->get();

        switch( $section->date ) {
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

        $inTime = strtotime("+1 second",strtotime($time));
        $checkupdate = date('H:i:s',$inTime);
//        dd(date('H:i:s',$inTime) , $qrcode_update ,$updateTime);

        if (!empty(Auth::check())) {
            if (($updateTime == $qrcode_update) || $checkupdate == $qrcode_update){
                if (session('error_message')) {
                    Alert::error('ไม่สามารถเช็คชื่อได้', 'เนื่องจากไม่อยู่ภายในพื้นที่ที่กำหนด');
                }else if (session('success_message')) {
                    Alert::success('เช็คชื่อสำเร็จ')->autoClose($milliseconds = 2000);
                }
                return view('student.check',compact('section','date','teachers'));
            }else {
                Alert::error('QR Code หมดอายุ', 'ไม่สามารถเช็คชื่อได้ ลองใหม่อีกครั้ง');
                return redirect('/');
            }
        }else {
            return redirect('/login');
        }




    }
    public function checkComplete($id)
    {

        $section = DB::table('section_checks')->where('section_checks.id','=',$id)
            ->join('sections_in_subjects as sis','sis.id','=','section_checks.sis_id')
            ->join('sections','sections.id','=','sis.section_id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->join('years','sis.year_id','=','years.id')
            ->select('*','sis.id as sis_id','section_checks.id')->first();

        $teachers = DB::table('attend_sections')->where('attend_sections.sis_id','=',$section->sis_id)
            ->join('users','users.id','=','attend_sections.user_id')
            ->where('users.role','=',User::role_teacher)->select('*')
            ->get();

        switch( $section->date ) {
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

        if (session('error_message')) {
            Alert::error('คุณไม่อยู่ภายในพื้นที่ที่กำหนด', 'ไม่สามารถเช็คชื่อได้ ลองใหม่อีกครั้ง');
        }else if (session('success_message')) {
            Alert::success('เช็คชื่อสำเร็จ')->autoClose($milliseconds = 2000);
        }

        $user = DB::table('users')->where('id',Auth::id())
            ->select('firstname','lastname')
            ->first();

//        return view('student.check-complete',compact('section','date','teachers'));
        return redirect('/profile/'.$user->firstname.'-'.$user->lastname.'/checkname/sect='.$section->sis_id);
    }
    public function location(Request $request)
    {
        $sectionCheck_id = $request->input('sectionCheck_id');
        $sectionCheck = DB::table('section_checks')->where('section_checks.id',$sectionCheck_id)
            ->join('sections_in_subjects as sis','sis.id','=','section_checks.sis_id')
            ->select('*','section_checks.location_id')->first();

        $location = DB::table('locations')->where('id',$sectionCheck->location_id)->first();

        $check_lat = $location->latitude;
        $check_long = $location->longitude;

//        dd($check_lat,$check_long);


        function getDistance($check_lat, $check_long, $user_lat, $user_long, $unit = '')
        {
            // Google API key
            $apiKey = 'AIzaSyA9rDCoMw1jOfZTkDcnDIn4anKekYFQwBI';


            $latitudeFrom = $check_lat;
            $longitudeFrom = $check_long;
//          $latitudeFrom = 13.85657;
//          $longitudeFrom = 100.55762;

            $latitudeTo = $user_lat;
            $longitudeTo = $user_long;

            // Calculate distance between latitude and longitude
            $theta = $longitudeFrom - $longitudeTo;
            $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            // Convert unit and return distance
            $unit = strtoupper($unit);
            if ($unit == "K") {
                return round($miles * 1.609344, 2) . ' km';
            } elseif ($unit == "M") {
                return round($miles * 1609.344, 2) . ' meters';
            } else {
                return round($miles, 2) . ' miles';
            }
        }

//        $addressFrom = 'มหาวิทยาลัยศิลปากร วิทยาเขตซิตี้แคมปัส เมืองทองธานี, Pakkret, Nonthaburi, TH';
//        $addressTo   = 'Ibis Bangkok Impact, Pakkret, Nonthaburi, TH';

        $user_lat = (float)($request->input('latitude'));
        $user_long = (float)($request->input('longitude'));
//        dd($user_lat);
//        dd($user_lat,$user_long);
        // Get distance in km
        $distance = getDistance($check_lat, $check_long, $user_lat, $user_long, "K");



//        dd($sectionCheck);

        if ((float)$distance > 0.10){
            return redirect()->back()->withErrorMessage('Check In Error.');
        }else{

            $checkDate = strtotime($sectionCheck->check_date);
            $checkTime = strtotime("+15 minutes",strtotime($sectionCheck->startTime));
            $date = strtotime(date("Y-m-d"));
            $time = strtotime(date("H:i:s"));


            if (($date == $checkDate)) {
                if (($time <= $checkTime)){
                    $status = 'checked';
                }else{
                    $status = 'checked late';
                }
            }
            else {
                $status = 'checked';
            }


            $check = New StudentCheck();
            $check->user_id = Auth::id();
            $check->sectionCheck_id = $sectionCheck_id;
            $check->status = $status;
            $check->save();

            return redirect('/check-in/'.$sectionCheck_id.'/complete')->withSuccessMessage('Check In Complete.');
        }

        dd((float)$distance);

    }

}
