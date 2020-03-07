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
            ->select('*','section_checks.id','section_checks.updated_at as qrcode_update','section_checks.created_at as qrcode_create')->first();

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

        if (($updateTime == $qrcode_update)){
            if (session('error_message')) {
                Alert::error('ไม่สามารถเช็คชื่อได้', 'เนื่องจากไม่อยู่ภายในพื้นที่ที่กำหนด');
            }else if (session('success_message')) {
                Alert::success('เช็คชื่อสำเร็จ')->autoClose($milliseconds = 2000);
            }
            return view('student.check',compact('section','date','teachers'));
        }else {
            Alert::error('ไม่สามารถเช็คชื่อได้', 'เนื่องจาก QR Code หมดอายุ');
            return redirect('/');
        }



    }
    public function checkComplete($id)
    {

        $section = DB::table('section_checks')->where('section_checks.id','=',$id)
            ->join('sections_in_subjects as sis','sis.id','=','section_checks.sis_id')
            ->join('sections','sections.id','=','sis.section_id')
            ->join('subjects','sis.subject_id','=','subjects.id')
            ->join('years','sis.year_id','=','years.id')
            ->select('*','section_checks.id')->first();

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
            Alert::error('ไม่สามารถเช็คชื่อได้', 'เนื่องจากไม่อยู่ภายในพื้นที่ที่กำหนด');
        }else if (session('success_message')) {
            Alert::success('เช็คชื่อสำเร็จ')->autoClose($milliseconds = 2000);
        }

        return view('student.check-complete',compact('section','date','teachers'));
    }
    public function location(Request $request)
    {

        function getDistance($addressFrom, $addressTo, $user_lat, $user_long, $unit = '')
        {
            // Google API key
            $apiKey = 'AIzaSyA9rDCoMw1jOfZTkDcnDIn4anKekYFQwBI';

            // Change address format
            $formattedAddrFrom = str_replace(' ', '+', $addressFrom);
            $formattedAddrTo = str_replace(' ', '+', $addressTo);


            // Geocoding API request with start address
//            $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrFrom . '&sensor=false&key=' . $apiKey);
//            $outputFrom = json_decode($geocodeFrom);
//
//
//
//            if (!empty($outputFrom->error_message)) {
//                return $outputFrom->error_message;
//            }

            // Geocoding API request with end address
            $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $apiKey);
            $outputTo = json_decode($geocodeTo);
            if (!empty($outputTo->error_message)) {
                return $outputTo->error_message;
            }
//            dd($geocodeTo);
            // Get latitude and longitude from the geodata
            $latitudeFrom = 13.9148435;
            $longitudeFrom = 100.5512695;
//            $latitudeTo = $outputTo->results[0]->geometry->location->lat;
//            $longitudeTo = $outputTo->results[0]->geometry->location->lng;
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

        $addressFrom = 'มหาวิทยาลัยศิลปากร วิทยาเขตซิตี้แคมปัส เมืองทองธานี, Pakkret, Nonthaburi, TH';
        $addressTo   = 'Ibis Bangkok Impact, Pakkret, Nonthaburi, TH';

        $user_lat = (float)($request->input('latitude'));
        $user_long = (float)($request->input('longitude'));
//        dd($user_lat);
        // Get distance in km
        $distance = getDistance($addressFrom, $addressTo, $user_lat, $user_long, "K");

        $sectionCheck_id = $request->input('sectionCheck_id');

        $sectionCheck = DB::table('section_checks')->where('section_checks.id',$sectionCheck_id)
            ->join('sections_in_subjects as sis','sis.id','=','section_checks.sis_id')->first();
//        dd($sectionCheck);

        if ((float)$distance < 0.10){
            return redirect()->back()->withErrorMessage('Check In Error.');
        }else{

            $checkDate = strtotime($sectionCheck->check_date);
            $checkTime = strtotime("+15 minutes",strtotime($sectionCheck->startTime));
            $date = strtotime(date("Y-m-d"));
            $time = strtotime(date("H:i:s"));


            if (($date == $checkDate)) {
                if (($time <= $checkTime)){
                    $status = 'Checked';
                }else{
                    $status = 'Checked Late';
                }
            }
            else {
                $status = '-';
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
