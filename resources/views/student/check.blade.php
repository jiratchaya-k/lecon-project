@extends('layouts.app')
@section('content')

    <style>
        .mobile-box{
            display: none;
        }
        .desk-box {
            display: block;
        }
        @media (min-width: 320px) and (max-width: 480px)
        {
            .mobile-box{
                display: block;
            }
            .desk-box {
                display: none;
            }
        }
        @media (min-width: 481px) and (max-width: 767px)
        {
            .mobile-box{
                display: block;
            }
            .desk-box {
                display: none;
            }
        }
    </style>

    <body onload="getLocation()">
    <div class="container mt-10">
        <form method="POST" action="/check-in/check" enctype="multipart/form-data">
            @csrf
            <div class="col-12 text-center">
                <span style="color: #5e5d5d; font-size: 15px;">{{ $section->code.' '.$section->name }}</span>
                <h4 class="mt-3" style="font-weight: bolder; color: #FF8574;">กลุ่มเรียน {{ $section->section }}</h4>
            </div>
            <div class="desk-box">
                <div class="row mt-3">
                    <div class="col-md-6 text-right" style="padding-right: 80px; margin-right: 0px;">
                        วัน{{ $date }}
                    </div>
                    <div class="col-md-6">
                        {{substr($section->startTime,0,-3) .' - '.substr($section->endTime,0,-3) }} น.
                    </div>
                </div>
            </div>
            <div class="mobile-box">
                <div class="row mt-3">
                    <div class="col-md-6 col-xs-6 col-6 text-center">
                        วัน{{ $date }}
                    </div>
                    <div class="col-md-6 col-xs-6 col-6 text-center" style="padding-left: 0px;">
                        {{substr($section->startTime,0,-3) .' - '.substr($section->endTime,0,-3) }} น.
                    </div>
                </div>
            </div>

            <div class="col-12 text-center mt-3">
                <span style="color: #818182; font-size: 15px;">ผู้สอน</span>
                @for( $i=0; $i<count($teachers); $i++)
                    <span style="font-size: 15px;">
                        อาจารย์ {{ $teachers[$i]->firstname.' '.$teachers[$i]->lastname }}
                    </span>
                    @if($i != count($teachers)-1)
                        <span style="font-size: 15px;">
                        ,
                        </span>
                    @endif
                @endfor
                    <?php $user = \Illuminate\Support\Facades\DB::table('users')->where('id','=',\Illuminate\Support\Facades\Auth::id())->first();
                    ?>
                    <br>


                <div class="row">
                    <div class="box col-md-6 col-xs-12 col-12 mt-5" style="background-color: #BCEDFF; border-radius: 20px; margin: 0 auto; padding: 20px; position: relative;">
                        <?php
                        $time = $section->startTime;
                        $inTime = strtotime("+15 minutes",strtotime($time));
                        ?>
                        <img src="/uploads/icons/clock.png" alt="" class="desk-box" style="position: absolute; top:-10%; left: 44%;">
                        <img src="/uploads/icons/clock.png" alt="" class="mobile-box" style="position: absolute; top:-10%; left: 40%;">
                        <h5 class="mt-4 font-weight-bold">เช็คชื่อเข้าเรียน</h5>
                        <span class="mt-3" style="font-size: 14px;">ภายในเวลา </span>
                            <br>
                            <span style="font-size:20px; font-weight: bold; color: #3956A3;">{{ date('H:i', $inTime) }} น.</span>
                            <hr style="width: 80%; margin: 20px auto;">
                            {{--<div class="card" style="border-radius: 20px; background: #F3B2A0; width: 50%; margin: 0 auto;">--}}
                                {{--<div class="card-body text-center">--}}
                                    <span style="color: #6c757d; font-size: 15px;">ผู้เช็คชื่อ</span> <br>
                                    {{ $user->firstname.' '.$user->lastname }}
                                {{--</div>--}}
                            {{--</div>--}}
                        <input type="hidden" name="latitude" id="lat" value="">
                        <input type="hidden" name="longitude" id="long" value="">
                        <input type="hidden" name="sectionCheck_id" value="{{ $section->id }}">
                        <div class="col-md-12 mt-4 mb-3">
                            <input class="btn btn-dark btn-submit" type="submit" value="เช็คชื่อเลย!" style="background: #3956A3 !important; border: none; width: 50%">
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
    </body>

@endsection