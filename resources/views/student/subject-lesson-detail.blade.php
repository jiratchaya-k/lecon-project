@extends('layouts.app')
@section('content')
    <style>
        .nav-item > .section-active{
            color: #3956A3 !important;
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
                            <h5 style="padding-top: 10px; margin-bottom: 5px;">Assignment Sect. {{ $sections->section}}</h5>
                            <span>{{ $sections->code.' '.$sections->name  }}</span>
                        </div>
                        <div class="col-md-4 text-right">
                            <h4 style="color: #3956A3; padding-top: 10px;"></h4>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="color: black">{{ $lesson->topic }}</h2>
                            <span style="font-size: 12px; color: #818182;">รายละเอียด</span><br>
                            <span style="font-size: 16px; color: black;">{{ $lesson-> description }}</span>
                        </div>

                                <div class="container mt-3 text-center">

                                    @if(($ext == 'pdf'))
                                        <button class="btn-fullscreen btn btn-submit mb-3" style="width: 150px; background: #FF8574; color: white; float: right; margin-right: 120px;">ขยายเต็มจอ</button>
                                        <br style="clear: both;">
                                        <iframe src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $filename }}" scrolling="no" style="width:80%; height: 600px; border: none; clear: both;">
                                            <p>Your browser does not support iframes.</p>
                                        </iframe>
                                    @elseif(($ext == 'mp4'))
                                        <video controls style="width: 80%; border: none;">
                                            <source src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $filename }}">
                                        </video>
                                    @else
                                        <img class="item-center" src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $filename }}"  alt="Card image cap" style="height: 100%; border: none; align-items: center;">
                                    @endif
                                    <h6 style="color: #818182;">{{ $filename }}</h6>
                                        <a href="javascript:history.back()" class="btn btn-submit mt-3 mb-3" style="background: #3956A3; width: 150px; color: white;">ย้อนกลับ</a>
                                </div>


                    </div>
                </div>
            </div>

            <!-- The Modal Section-->
            {{--<div id="modelImg" class="modal" style="padding-top: 90px;">--}}

                {{--<!-- Modal content -->--}}
                {{--<div class="modal-content modal-content-img" style="height: 90%">--}}
                    {{--<span class="close">&times;</span>--}}
                    {{--<input type="hidden" class="filename" value="">--}}
                    {{--<div class="container" style="padding: 30px;">--}}
                    {{--@if(($ext == 'pdf') || ($ext == 'mp4'))--}}
                        {{--<iframe src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $file }}" scrolling="no" style="height: 100%; border: none;">--}}
                            {{--<p>Your browser does not support iframes.</p>--}}
                        {{--</iframe>--}}
                    {{--@else--}}
                        {{--<img class="item-center" src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $file }}"  alt="Card image cap" style="height: 100%; border: none; align-items: center;">--}}
                    {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


        </div>
    </div>



@endsection