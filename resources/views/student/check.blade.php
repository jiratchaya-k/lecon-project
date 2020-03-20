@extends('layouts.app')
@section('content')

    <body onload="getLocation()">
    <div class="container mt-10">
        <form method="POST" action="/check-in/check" enctype="multipart/form-data">
            @csrf
            <div class="col-12 text-center">
                <span style="color: #5e5d5d">{{ $section->code.' '.$section->name }}</span>
                <h4 class="mt-3" style="font-weight: bolder">กลุ่มเรียน {{ $section->section }}</h4>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 text-right" style="padding-right: 80px;">
                    วัน{{ $date }}
                </div>
                <div class="col-md-6">
                    {{substr($section->startTime,0,-3) .' - '.substr($section->endTime,0,-3) }} น.
                </div>
            </div>
            <div class="col-12 text-center mt-3">
                @for( $i=0; $i<count($teachers); $i++)
                    อาจารย์ {{ $teachers[$i]->firstname.' '.$teachers[$i]->lastname }}
                    @if($i != count($teachers)-1)
                        ,
                    @endif
                @endfor
                {{--<span>อาจารย์ พลเอก สังฆกุล</span>--}}

                <div class="box mt-5" style="width: 600px; height: 250px; background-color: lightblue; border-radius: 20px; margin: 0 auto; padding: 20px;">
                    <?php
                    $time = $section->startTime;
                    $inTime = strtotime("+15 minutes",strtotime($time));
                    ?>
                        <h5 class="mt-5">เช็คชื่อเข้าเรียน</h5>
                        <h6 class="mt-3">ภายใน {{ date('H:i', $inTime) }} น.</h6>
                    <input type="hidden" name="latitude" id="lat" value="">
                    <input type="hidden" name="longitude" id="long" value="">
                    <input type="hidden" name="sectionCheck_id" value="{{ $section->id }}">
                    <div class="col-md-12 mt-5 mb-3">
                        <input class="btn btn-dark btn-submit" type="submit" value="เช็คชื่อเลย!" style="background: #3956A3 !important; border: none; width: 50%">
                    </div>
                </div>

            </div>


        {{--<button onclick="getLocation()">Try It</button>--}}

        {{--<p id="demo"></p>--}}
        {{--Latitude: <input type="text" name="latitude" id="lat" value="">--}}
        {{--<br>Longitude: <input type="text" name="longitude" id="long" value="">--}}
            {{--<div class="col-md-6 mt-5 mb-3">--}}
                {{--<input class="btn btn-dark btn-submit" type="submit" value="check in" style="background: #3956A3 !important; border: none; width: 50%">--}}
            {{--</div>--}}
        </form>
    </div>
    </body>

@endsection