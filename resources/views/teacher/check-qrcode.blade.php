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
                        <div class="col-md-6">
                            <span>กลุ่มเรียน {{ $section->section}} วัน{{$date}} </span>
                            <span>{{substr($section->startTime,0,-3) .' - '.substr($section->endTime,0,-3) }}</span>
                        </div>
                        <div class="col-md-6 text-right">
                            <span>วันที่ {{ date('d/m/Y',strtotime($section->check_date)) }}</span>
                        </div>
                    </div>
                    <h5 class="mt-3 mb-4">เช็คชื่อเข้าเรียน</h5>
                    <div class="row">
                        <?php
                        $time = $section->startTime;
                        $inTime = strtotime("+15 minutes",strtotime($time));

                        $currentTime = time();
//
                        ?>
                        <div class="col-md-6 text-center">
                            {!! QrCode::size(400)->encoding('UTF-8')->generate('lecon.com/check-in/'.$section->id.'/'.date('His',$currentTime)); !!}
                        </div>
                        <div class="col-md-6 text-center" style="padding-top: 80px;">
                            <h5>QR Code เช็คชื่อ</h5>
                            <br>
                            <span>ภายใน </span>

                            <h3><strong style="color: #3956A3;">{{ date('H:i', $inTime) }} น.</strong></h3>

                            <div class="count mt-5">
                                <div id="timer"><i class="fas fa-redo-alt fa-sm"></i> 00:30</div>
                            </div>

                            <button onclick="refresh()" class="btn btn-block btn-primary mt-2 box-shadow btn-submit" style="background:#FF8574; border: none; width: 200px; margin: 0 auto; ">
                                สร้าง QR Code ใหม่
                            </button>



                            <form method="POST" action="/teacher/student-check/check={{$section->id}}/get-qrcode/update" enctype="multipart/form-data">
                            @csrf
                                {{--<input type="text" value="{{ date('His',$currentTime) }}">--}}
                                <input type="hidden" class="currentTime" value="{{$currentTime}}">
                                <input type="hidden" class="check_id" value="{{ $section->id}}">
                                {{--<input class="btn btn-block btn-primary mt-5 box-shadow btn-submit" style="background:#FF8574; border: none; width: 200px; margin: 0 auto;" type="submit" value="สร้าง QR Code ใหม่">--}}
                            </form>

                        </div>
                    </div>
                    <div class="text-center">
                        <a href="javascript:history.back()" class="btn btn-submit mt-3" style="background: white; border: 2px solid #3956A3; color: #3956A3;  width: 150px;">ย้อนกลับ</a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{--<center><h1 class="mt-10">QR CODE</h1>--}}
        {{--{!! QrCode::size(250)->encoding('UTF-8')->generate('เช็คชื่อนักศึกษา'); !!}--}}
        {{--<br>--}}
        {{--<h5>เช็คชื่อวิชา <span style="color: #3956A3; font-weight: bolder">{{ $section->code.' '.$section->name }}</span></h5>--}}
    {{--</center>--}}

    <script>

        window.onbeforeunload = function () {
            var check_id = $('.check_id').val();
            var currentTime = $('.currentTime').val();
            console.log(currentTime);
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/check='+check_id+'/get-qrcode/update/'+currentTime,
                type : "POST",
                dataType : "json",
                success: function (data) {

                },
            })
        }



        
        function refresh() {
            var check_id = $('.check_id').val();
            var currentTime = $('.currentTime').val();
            console.log(currentTime);
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/check='+check_id+'/get-qrcode/update/'+currentTime,
                type : "POST",
                dataType : "json",
            success: function (data) {

                },
            })
            location.reload();
        }

        // $('#main-menu a').click(function(event) {
        //     event.preventDefault();



    </script>
    <script>
        var sec         = 30,
            countDiv    = document.getElementById("timer"),
            secpass,
            countDown   = setInterval(function () {
                'use strict';

                secpass();
            }, 1000);

        function secpass() {
            'use strict';

            var min     = Math.floor(sec / 60),
                remSec  = sec % 60;

            if (remSec < 10) {

                remSec = '0' + remSec;

            }
            if (min < 10) {

                min = '0' + min;

            }
            countDiv.innerHTML = "<i class=\"fas fa-redo-alt fa-sm\"></i> " + min + ":" + remSec;

            if (sec > 0) {

                sec = sec - 1;

            } else {

                clearInterval(countDown);

                refresh();

            }
        }
    </script>
@endsection