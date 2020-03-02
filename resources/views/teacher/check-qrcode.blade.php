@extends('layouts.app')
@section('content')

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
            <div class="card card-overlap card-shadow col-md-12 item-center">
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
                    <h5>เช็คชื่อเข้าเรียน</h5>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            {!! QrCode::size(250)->encoding('UTF-8')->generate('lecon.com/check-in/'.$section->id); !!}
                        </div>
                        <div class="col-md-6 text-center" style="padding: 50px">
                            <h5>QR Code เช็คชื่อ</h5>
                            <?php
                                $time = $section->startTime;
                                $inTime = strtotime("+15 minutes",strtotime($time));
                            ?>
                            <h5>ภายใน {{ date('h:i', $inTime) }} น.</h5>
                        </div>
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
@endsection