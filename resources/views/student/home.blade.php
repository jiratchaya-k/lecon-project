@extends('layouts.app')
@section('content')
    <style>
        .nav-item > .home-active{
            color: #3956A3 !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
    <div class="container-fluid banner">
    </div>

    <div class="container-fluid">
        <div class="container mt-4">

            <h4 style="font-weight: bolder; color: #3956A3;">Assignment</h4>
            <hr>
            <div class="row">
                @if(count($assignments)>0)
                    @foreach($assignments as $assignment)
                        <a href="/assignment/{{ $assignment->id }}" class="cardLink col-md-3">
                            <div class="card card-shadow  mt-3 mb-2">
                                <div class="card-header bg-gradient" style="border-radius: 20px 20px 0px 0px;">
                                    <span>Sect. {{ $assignment->section }}</span>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold fs-18">{{ $assignment->title }}</h5>
                                    <p class="card-text fs-12">Due. {{ $assignment->dueDate }} {{substr($assignment->dueTime, 0,-3)}} </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div>
                        <p>No Assignment</p>
                    </div>
                @endif
            </div>

            <br><br>

            <h4 style="font-weight: bolder; color: #FF8574;">Your Section</h4>
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
                    <div>
                        <p>No Assignment</p>
                    </div>
                @endif
            </div>
    </div>
@endsection
{{--<center><h1>Lecon Project</h1></center>--}}
{{--<a href="/qrcode" class="btn btn-primary">gen qrcode</a>--}}
{{--<a href="/reader" class="btn btn-primary">scan qrcode</a>--}}