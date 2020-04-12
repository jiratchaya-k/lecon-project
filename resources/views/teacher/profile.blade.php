@extends('layouts.app-teacher')
@section('content')
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
                        </style>

                        <div class="vertical-menu text-center mb-3">
                            <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}" class="active">โปรไฟล์</a>
                            <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}/change-password" class="">เปลี่ยนรหัสผ่าน</a>
                            {{--<a href="#">Link 2</a>--}}
                            {{--<a href="#">Link 3</a>--}}
                            {{--<a href="#">Link 4</a>--}}
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
                <div class="card box-shadow" style="width: 100%; border-radius: 20px; border: none;">
                    <div class="card-body">

                        <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}/edit" class="btn btn-submit" style="width:150px; float: right; color: white; background:#FF8574; "><i class="fas fa-user-edit"></i> แก้ไขโปรไฟล์</a>


                        <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <img src="/uploads/profileImage/{{ $user->profile_img }}" alt="Avatar" style="width: 150px;border-radius: 50%;">
                            </div>
                        </div>
                        <div class="container mt-5">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection