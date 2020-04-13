@extends('layouts.app')
@section('content')
    <div class="container mt-10">
        <div class="row">
            <div class="col-md-4">
                <div class="card box-shadow" style="width: 100%; border: 2px solid #454cad; border-radius: 20px; background-color: white;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="/uploads/profileImage/{{ $user->profile_img }}" alt="Avatar" style="width: 50px;border-radius: 50%;">
                            </div>
                            <div class="col-md-10 pl-4 mt-1">
                                <h6 class="card-title" style="font-weight: bolder;">
                                    {{ $user->firstname.' '.$user->lastname }}
                                </h6>
                                <p class="card-text" style="line-height: 1px; font-size: 15px; color: #5e5d5d;">{{ $user->email }}</p>
                            </div>
                        </div>
                        <hr>

                        <style>
                            .vertical-menu {
                                width: 100%;
                                border-radius: 20px;
                                overflow: hidden;
                            }

                            .vertical-menu a {
                                background-color: #eee;
                                color: black;
                                display: block;
                                padding: 12px;
                                text-decoration: none;
                            }

                            .vertical-menu a:hover {
                                background-color: #ccc;
                            }

                            .vertical-menu a.active {
                                background-color: #3956A3;
                                color: white;
                            }
                        </style>

                        <div class="vertical-menu text-center mb-3">
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}" class="">โปรไฟล์</a>
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/checkname" class="active">การเข้าเรียน</a>
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/change-password" class="">เปลี่ยนรหัสผ่าน</a>
                        </div>
                        <div class="vertical-menu text-center mb-2">
                            <a href="/logout" class="btn btn-submit" style=" width:100%; background: #5e5d5d; color: white;">ออกจากระบบ</a>
                            {{--<a href="#">Link 2</a>--}}
                            {{--<a href="#">Link 3</a>--}}
                            {{--<a href="#">Link 4</a>--}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card box-shadow" style="width: 100%; border-radius: 20px; border: 2px solid #FF8574;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold mt-1" style="color: #3956A3;">กลุ่ม {{ $section->section }}</h5>
                                <h6 class="fs-15">{{ $section->code.' '.$section->name }}</h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <h6 class="mt-2 font-weight-bold">{{ 'วัน'.$date }}</h6>
                                <h6 class="mt-1 font-weight-bold">{{ 'เวลา '.substr($section->startTime,0,-3) .' - '.substr($section->endTime,0,-3) }} น.</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive-xl">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="table-head text-center" style="">วันที่เช็ค</th>
                                    <th class="table-head text-center">เข้าเรียน</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($checks)>0)
                                    @foreach($checks as $check)
                                        <?php

                                            $strYear = date("Y",strtotime($check->check_date))+543;
                                            $strMonth= date("n",strtotime($check->check_date));
                                            $strDay= date("j",strtotime($check->check_date));
                                            $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                                            $strMonthThai=$strMonthCut[$strMonth];

                                            $checkdate = "$strDay $strMonthThai $strYear";

                                            $stdCheck = DB::table('student_checks')->where('student_checks.sectionCheck_id',$check->id)
                                            ->select('*')->first();

                                            $check_date = strtotime($check->check_date);
                                            $date = strtotime(date("Y-m-d"));

                                        ?>
                                        <tr>
                                            <td class="text-center">{{ $checkdate}}</td>
                                            <td class="text-center">
                                                @if(!empty($stdCheck))
                                                    @if( $stdCheck->status == 'checked')
                                                        <i class="fas fa-check-circle" style="color: #00ab6c; font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="เข้าเรียน"></i>
                                                    @elseif ( $status == 'checked late')
                                                        <i class="fas fa-check-circle" style="color: sandybrown; font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="เข้าสาน"></i>
                                                    @elseif ( $status == 'leave')
                                                        <i class="fas fa-exclamation-circle" style="color: #f3b600; font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="ลา"></i>
                                                    @endif
                                                @elseif ($date < $check_date)
                                                    <i class="fas fa-minus-circle" style="color: grey; font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="ไม่มีการเช็คชื่อ"></i>
                                                @else
                                                    <i class="fas fa-times-circle" style="color: firebrick; font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="ขาดเรียน"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center" style="color: lightgray;">
                                            <i class="fas fa-exclamation-triangle mt-3" style="font-size: 40px;"></i>
                                            <br>
                                            <span>ไม่มีข้อมูล</span>
                                        </th>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection