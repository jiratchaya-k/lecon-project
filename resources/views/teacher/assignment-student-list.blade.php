@extends('layouts.app-teacher')
@section('content')
    <style>
        .nav-item > .home-active{
            color: white !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
    <style>
        .card-shadow:hover {
            box-shadow: 0 5px 19px 0 rgba(0,0,0,0.1),0 10px 20px 0 rgba(0,0,0,0.1);
        }
        .entry:not(:first-of-type)
        {
            margin-top: 10px;
        }

        .glyphicon
        {
            font-size: 18px;
        }
    </style>
    <div class="container-fluid banner">
    </div>

    <div class="container-fluid">
        <div class="container mt-4">
            <div class="card card-overlap card-shadow col-md-12 item-center mb-5">
                <div class="card-body container">
                    <div class="row">
                        <div class="col-md-8">
                            <h5><strong>งานที่มอบหมาย</strong> - <br class="mobile-box"> กลุ่มเรียน {{ $sections->section}}</h5>
                            <span>{{ $sections->code.' '.$sections->name  }}</span>
                        </div>
                        <?php

                        $strYear = date("Y",strtotime($assignment->dueDate))+543;
                        $strMonth= date("n",strtotime($assignment->dueDate));
                        $strDay= date("j",strtotime($assignment->dueDate));
                        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                        $strMonthThai=$strMonthCut[$strMonth];

                        $dueDate = "$strDay $strMonthThai $strYear";

                        ?>
                        <div class="col-md-4 col-xs-12 text-right due-box">
                            <h5 style="color: #FF8574;"><span style="color: #5e5d5d; font-size: 16px;">ส่งภายใน</span> {{ $dueDate }} <br>
                                เวลา {{substr($assignment->dueTime, 0,-3)}}</h5>
                        </div>
                    </div>
                    <hr>
                    <h6 style="font-weight: bold; color: #3956A3; margin: 10px 0;">ส่งงาน</h6>
                    <div class="row mt-3" style="clear: both;">
                        @foreach($allWorks as $work)
                            <div class="col-md-3">
                                <div class="card" style="width: 100%; border: 2px solid #3956A3; border-radius: 20px; background-color: white;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="/uploads/profileImage/{{ $work->profile_img }}" alt="Avatar" style="width: 40px;border-radius: 50%;">
                                            </div>
                                            <div class="col-md-9">
                                                <span class="card-title" style="font-size: 13px; font-weight: bold; color: #5e5d5d;">
                                                    {{ $work->student_id }}
                                                </span>
                                                <h6 class="card-title" style="font-weight: bolder; font-size: 15px;">
                                                    {{ $work->firstname.' '.$work->lastname }}
                                                </h6>
                                            </div>
                                        </div>
                                        <hr style="margin-bottom: 0px; margin-top: 0px;">
                                        <div class="">
                                            <span style="font-size: 12px; color: #818182;">งานที่ส่ง</span><br>
                                            <?php
                                            $files = \Illuminate\Support\Facades\DB::table('files')->where('work_id','=',$work->id)
                                                ->get();
                                            ?>
                                            @foreach($files as $file)
                                                <span style="font-size: 14px; font-weight: bold;">{{ $file->file }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr>
                    <h6 style="font-weight: bold; color: #FF8574; margin: 10px 0;">ไม่ส่งงาน</h6>
                    <div class="row mt-3" style="clear: both;">
                        @foreach($std_notsend as $notsend)
                            <div class="col-md-3">
                                <div class="card" style="width: 100%; border: 2px solid #FF8574; border-radius: 20px; background-color: white;">
                                    <div class="card-body" style="padding-bottom: 0px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="/uploads/profileImage/{{ $notsend->profile_img }}" alt="Avatar" style="width: 40px;border-radius: 50%;">
                                            </div>
                                            <div class="col-md-9">
                                                <span class="card-title" style="font-size: 13px; font-weight: bold; color: #5e5d5d;">
                                                    {{ $notsend->student_id }}
                                                </span>
                                                <h6 class="card-title" style="font-weight: bolder; font-size: 15px;">
                                                    {{ $notsend->firstname.' '.$notsend->lastname }}
                                                </h6>
                                            </div>
                                        </div>
                                        <hr style="margin-bottom: 0px; margin-top: 0px;">
                                        <div >
                                            <span style="font-size: 12px; color: #818182;">งานที่ส่ง</span><br>
                                            -
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        // Get the modal
        var modalTeacher = document.getElementById("modelTeacher");
        var modalStudent = document.getElementById("modelStudent");
        // var modalLocation = document.getElementById("modelLocation");

        // Get the button that opens the modal
        var btnTeacher = document.getElementById("myBtn-teacher");
        var btnStudent = document.getElementById("myBtn-student");
        // var btnLocation = document.getElementById("myBtn-location");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var spanStudent = document.getElementsByClassName("close-student")[0];
        // var spanLocation = document.getElementsByClassName("close-location")[0];

        // When the user clicks on the button, open the modal
        btnTeacher.onclick = function() {
            modalTeacher.style.display = "block";
        }
        btnStudent.onclick = function() {
            modalStudent.style.display = "block";
        }
        // btnLocation.onclick = function() {
        //     modalLocation.style.display = "block";
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modalTeacher.style.display = "none";
        }
        spanStudent.onclick = function() {
            modalStudent.style.display = "none";
        }
        // spanLocation.onclick = function() {
        //     modalLocation.style.display = "none";
        // }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalTeacher) {
                modalTeacher.style.display = "none";
            }
            if (event.target == modalStudent) {
                modalStudent.style.display = "none";
            }
            // if (event.target == modalLocation) {
            //     modalLocation.style.display = "none";
            // }
        }
    </script>


@endsection