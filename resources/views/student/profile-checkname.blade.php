@extends('layouts.app')
@section('content')
    <style>
        .nav-item > .profile-active{
            color: #3956A3 !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
    <div class="container mt-10">
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="card box-shadow" style="width: 100%; border: 2px solid #454cad; border-radius: 20px; background-color: white;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-xs-2 col-2">
                                <img src="/uploads/profileImage/{{ $user->profile_img }}" alt="Avatar" style="width: 50px;border-radius: 50%;">
                            </div>
                            <div class="col-md-10 col-xs-10 col-10 pl-4 mt-1">
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
                            .mobile-box{
                                display: none;
                            }
                            .desk-box {
                                display: block;
                            }
                            @media (min-width: 320px) and (max-width: 480px)
                            {
                                .banner {
                                    height: 180px;
                                    margin-top: 30px;
                                }
                                .mobile-box{
                                    display: block;
                                }
                                .desk-box {
                                    display: none;
                                }
                            }
                            @media (min-width: 481px) and (max-width: 767px)
                            {
                                .banner {
                                    height: 180px;
                                    margin-top: 30px;
                                }
                                .mobile-box{
                                    display: block;
                                }
                                .desk-box {
                                    display: none;
                                }
                            }
                        </style>

                        <div class="vertical-menu text-center mb-3 desk-box">
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}" class="">โปรไฟล์</a>
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/checkname" class="active">การเข้าเรียน</a>
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/change-password" class="">เปลี่ยนรหัสผ่าน</a>
                        </div>
                        <div class="vertical-menu text-center mb-3 mobile-box">
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}"  style="width:27%; float: left;border-right: 2px solid white;">โปรไฟล์</a>
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/checkname" class="active" style="width:35%;float: left; border-right: 2px solid white;">การเข้าเรียน</a>
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/change-password">เปลี่ยนรหัสผ่าน</a>
                        </div>
                        <div class="vertical-menu text-center mb-2 desk-box">
                            <a href="/logout" class="btn btn-submit" style=" width:100%; background: #5e5d5d; color: white;">ออกจากระบบ</a>
                            {{--<a href="#">Link 2</a>--}}
                            {{--<a href="#">Link 3</a>--}}
                            {{--<a href="#">Link 4</a>--}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="mobile-box" style="margin: 10px;"></div>
            <div class="col-md-8 col-xs-12">
                <div class="card box-shadow" style="width: 100%; border-radius: 20px; border: 2px solid #FF8574;">
                    <div class="card-body">
                        <h5 class="font-weight-bold mt-1">กลุ่มเรียนที่เข้าร่วมทั้งหมด</h5>
                        <hr>
                        <div class="row">
                            @foreach($sections as $section)
                            <div class="col-md-6 col-xs-12 col-12">
                                <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/checkname/sect={{$section->id}}" class="cardLink">
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

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection