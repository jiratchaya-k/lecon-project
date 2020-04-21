@extends('layouts.app-teacher')
@section('content')
    <style>
        .nav-item > .profile-active{
            color: white !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
    <div class="container mt-10">
        <div class="row">
            <div class="col-md-4">
                <div class="card box-shadow" style="width: 100%; border: 2px solid #454cad; border-radius: 20px; background-color: white;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="/uploads/profileImage/{{ $user->profile_img }}" alt="Avatar" style="width: 50px;border-radius: 50%;">
                            </div>
                            <div class="col-md-9">
                                <h5 class="card-title" style="font-weight: bolder;">
                                    {{ $user->firstname.' '.$user->lastname }}
                                </h5>
                                <p class="card-text" style="line-height: 1px; font-size: 16px; color: #5e5d5d;">{{ $user->email }}</p>
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
                            <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}" class="active">โปรไฟล์</a>
                            <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}/change-password" class="">เปลี่ยนรหัสผ่าน</a>
                            {{--<a href="#">Link 2</a>--}}
                            {{--<a href="#">Link 3</a>--}}
                            {{--<a href="#">Link 4</a>--}}
                        </div>
                        <div class="vertical-menu text-center mb-2 desk-box">
                            <a href="/logout" class="btn btn-submit" style=" width:100%; background: #5e5d5d; color: white;">ออกจากระบบ</a>
                            {{--<a href="#">Link 2</a>--}}
                            {{--<a href="#">Link 3</a>--}}
                            {{--<a href="#">Link 4</a>--}}
                        </div>

                        <div class="vertical-menu text-center mb-3 mobile-box">
                            <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}" class="active" style="width:50%; float: left;border-right: 2px solid white;">โปรไฟล์</a>
                            <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}/change-password">เปลี่ยนรหัสผ่าน</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mobile-box" style="margin: 10px;"></div>
            <div class="col-md-8 col-xs-12">
                <div class="card box-shadow" style="width: 100%; border-radius: 20px; border: none;">
                    <div class="card-body">

                        <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}/edit" class="btn btn-submit" style="width:150px; float: right; color: white; background:#FF8574; "><i class="fas fa-user-edit"></i> แก้ไขโปรไฟล์</a>


                        <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <img src="/uploads/profileImage/{{ $user->profile_img }}" alt="Avatar" style="width: 150px;border-radius: 50%;">
                            </div>
                        </div>
                        <div class="container mt-5 desk-box">
                            <div class="row">
                                <label class="col-md-4 text-right">ชื่อจริง : </label>
                                <label class="col-md-8">{{ $user->firstname }}</label>
                            </div>
                            <hr style="margin: 0 auto; width: 80%;">
                            <div class="row mt-2">
                                <label class="col-md-4 text-right">นามสกุล : </label>
                                <label class="col-md-8">{{ $user->lastname }}</label>
                            </div>
                            <hr style="margin: 0 auto; width: 80%;">
                            <div class="row mt-2">
                                <label class="col-md-4 text-right">อีเมล : </label>
                                <label class="col-md-8">{{ $user->email }}</label>
                            </div>
                            <hr style="margin: 0 auto; width: 80%;">
                            <div class="row mt-2">
                                <label class="col-md-4 text-right">รหัสผ่าน : </label>
                                <label class="col-md-8">********</label>
                            </div>
                        </div>

                        <div class="container mt-4 mobile-box">
                            <div class="row">
                                <div class="col-xs-5 col-5 text-right" style="padding: 5px;">
                                    ชื่อจริง :
                                </div>
                                <div class="col-xs-7 col-7" style="padding: 5px;">
                                    {{ $user->firstname }}
                                </div>

                            </div>
                            <hr style="margin: 0 auto; width: 100%;">
                            <div class="row mt-2">
                                <div class="col-xs-5 col-5 text-right" style="padding: 5px;">
                                    นามสกุล :
                                </div>
                                <div class="col-xs-7 col-7" style="padding: 5px;">
                                    {{ $user->lastname }}
                                </div>
                            </div>
                            <hr style="margin: 0 auto; width: 100%;">
                            <div class="row mt-2">
                                <div class="col-xs-5 col-5 text-right" style="padding: 5px;">
                                    อีเมล :
                                </div>
                                <div class="col-xs-7 col-7" style="padding: 5px;">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <hr style="margin: 0 auto; width: 100%;">
                            <div class="row mt-2">
                                <div class="col-xs-5 col-5 text-right" style="padding: 5px;">
                                    รหัสผ่าน :
                                </div>
                                <div class="col-xs-7 col-7" style="padding: 5px;">
                                    ********
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection