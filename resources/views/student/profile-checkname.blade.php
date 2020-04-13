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
                        <h5 class="font-weight-bold mt-1">กลุ่มเรียนที่เข้าร่วมทั้งหมด</h5>
                        <hr>
                        <div class="row">
                            @foreach($sections as $section)
                            <div class="col-md-6">
                                <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/checkname/sect={{$section->id}}" class="cardLink">
                                    <div class="card card-shadow mt-2 mb-2" style="padding: 0;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card-header bg-gradient text-center" style="border-radius: 20px 0px 0px 20px; border: none; width: 100%; height: 100%;padding-top: 40%;">
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

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection