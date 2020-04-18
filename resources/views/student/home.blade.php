@extends('layouts.app')
@section('content')
    <style>
        .nav-item > .home-active{
            color: #3956A3 !important;
            font-weight: bold;
            font-style: italic;
        }
        @media (min-width: 320px) and (max-width: 480px)
        {
            .banner {
                height: 180px;
                margin-top: 30px;
            }
        }
        @media (min-width: 481px) and (max-width: 767px)
        {
            .banner {
                height: 180px;
                margin-top: 30px;
            }
        }

    </style>
    <div class="container-fluid banner">
    </div>

    <div class="container-fluid">
        <div class="container mt-4">

            <h4 style="font-weight: bolder; color: #3956A3;"><img src="/uploads/icons/icon-work.png" style="width: 35px; margin-right: 10px;">งานที่มอบหมาย</h4>
            <hr>
            <div class="row">
                @if(count($assignments)>0)
                    @foreach($assignments as $assignment)
                        <?php

                        $strYear = date("Y",strtotime($assignment->dueDate))+543;
                        $strMonth= date("n",strtotime($assignment->dueDate));
                        $strDay= date("j",strtotime($assignment->dueDate));
                        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                        $strMonthThai=$strMonthCut[$strMonth];

                        $dueDate = "$strDay $strMonthThai $strYear";

                        ?>

                        <a href="/assignment/{{ $assignment->id }}" class="cardLink col-md-3 col-sm-6">
                            <div class="card card-shadow  mt-3 mb-2">
                                <div class="card-header bg-gradient" style="border-radius: 20px 20px 0px 0px;">
                                    <span>กลุ่มเรียน {{ $assignment->section }}</span>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold fs-18">{{ $assignment->title }}</h5>
                                    <p class="card-text fs-12">ส่งภายใน {{ $dueDate }} เวลา {{substr($assignment->dueTime, 0,-3)}} </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="text-center">
                        <img src="/uploads/icons/icon-no-assignment.png" alt="" style="width: 100px; opacity: .5;">
                        <br>
                        <span>ไม่มีงานที่มอบหมาย</span>
                    </div>
                @endif
            </div>

            <br><br>

            <h4 style="font-weight: bolder; color: #FF8574;"><img src="/uploads/icons/icon-play.png" style="width: 35px; margin-right: 10px;">กลุ่มเรียนที่เข้าร่วม</h4>
            <hr>
            <div class="row">
                @if(count($sections)>0)
                    @foreach($sections as $section)
                        <div class="col-md-4 col-sm-6">
                                <a href="/subject/section/{{ $section->id }}" class="cardLink">
                                    <div class="card card-shadow mt-2 mb-2" style="padding: 0;">
                                        <div class="row">
                                            <div class="col-md-4 col-4 col-sm-5">
                                                <div class="card-header bg-gradient bg-gradient-or text-center" style="border-radius: 20px 0px 0px 20px; border: none; width: 100%; height: 100%;padding-top: 40%;">
                                                    <span>กลุ่ม {{ $section->section }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-8 col-sm-7" style="padding: 0;">
                                                <div class="card-body" style="padding-left: 0;">
                                                    <span style="font-size: 14px;">{{ $section->code }}</span>
                                                    <h6 class="font-weight-bold fs-15">{{ $section->name }}</h6>
                                                    <p class="card-text fs-12" style="color: #5e5d5d;">
                                                    @switch( $section->date )
                                                        @case('Sunday')
                                                        <td>อาทิตย์</td>
                                                        @break
                                                        @case('Monday')
                                                        <td>จันทร์</td>
                                                        @break
                                                        @case('Tuesday')
                                                        <td>อังคาร</td>
                                                        @break
                                                        @case('Wednesday')
                                                        <td>พุธ</td>
                                                        @break
                                                        @case('Thursday')
                                                        <td>พฤหัสบดี</td>
                                                        @break
                                                        @case('Friday')
                                                        <td>ศุกร์</td>
                                                        @break
                                                        @case('Saturday')
                                                        <td>เสาร์</td>
                                                        @break
                                                    @endswitch
                                                    {{substr($section->startTime,0,-3) .' - '.substr($section->endTime,0,-3) }} น.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        </div>

                    @endforeach
                @else
                    <div class="text-center">
                        <img src="/uploads/icons/icon-no-information.png" alt="" style="width: 100px; opacity: .5;">
                        <br>
                        <span>ไม่มีกลุ่มเรียน</span>
                    </div>
                @endif
            </div>
    </div>
@endsection
{{--<center><h1>Lecon Project</h1></center>--}}
{{--<a href="/qrcode" class="btn btn-primary">gen qrcode</a>--}}
{{--<a href="/reader" class="btn btn-primary">scan qrcode</a>--}}