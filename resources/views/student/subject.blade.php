@extends('layouts.app')
@section('content')
    <style>
        .nav-item > .section-active{
            color: #3956A3 !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
    <div class="container-fluid banner">
    </div>

    <div class="container-fluid">
        <div class="container mt-4">
            <h4 style="font-weight: bolder; color: #FF8574;"><img src="/uploads/icons/icon-play.png" style="width: 35px; margin-right: 10px;">กลุ่มเรียนที่เข้าร่วม</h4>
            <hr>
            <div class="row">
                @if(count($sections)>0)
                    @foreach($sections as $section)
                        <div class="col-md-4">
                                <a href="/subject/section/{{ $section->id }}" class="cardLink">
                                    <div class="card card-shadow mt-2 mb-2" style="padding: 0;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card-header bg-gradient bg-gradient-or text-center" style="border-radius: 20px 0px 0px 20px; border: none; width: 100%; height: 100%;padding-top: 40%;">
                                                    <span>กลุ่ม {{ $section->section }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-8" style="padding: 0;">
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
                        <span>ไม่มีข้อมูล</span>
                    </div>
                @endif
            </div>
    </div>
@endsection
{{--<center><h1>Lecon Project</h1></center>--}}
{{--<a href="/qrcode" class="btn btn-primary">gen qrcode</a>--}}
{{--<a href="/reader" class="btn btn-primary">scan qrcode</a>--}}