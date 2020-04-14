@extends('layouts.app-teacher')
@section('content')
    <style>
        .nav-item > .profile-active{
            color: white !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
    <style>
        .filepond--drop-label {
            font-weight: bolder;
            color: #3956A3;
            font-family: 'Prompt', sans-serif;
        }

        .filepond--label-action {
            text-decoration-color: #3956A3#;
        }

        .filepond--panel-root {
            background-color: #222222!important;
            background: url("https://www.w3schools.com/css/ocean.jpg");
            opacity: .5;
            background-size: 100% auto;

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
                        </style>

                        <div class="vertical-menu text-center mb-3">
                            <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}" class="">โปรไฟล์</a>
                            <a href="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}/change-password" class="active">เปลี่ยนรหัสผ่าน</a>
                        </div>
                        <div class="vertical-menu text-center mb-2">
                            <a href="/logout" class="btn btn-submit" style=" width:100%; background: #5e5d5d; color: white;">ออกจากระบบ</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card box-shadow" style="width: 100%; border-radius: 20px; border: none;">
                    <div class="card-body">
                        <form method="POST" action="/teacher/profile/{{ $user->firstname.'-'.$user->lastname }}/change-password/update" enctype="multipart/form-data">
                            @csrf
                        <div class="row mt-5">
                                <div class="col-md-12 text-center">
                                    <img src="/uploads/profileImage/{{ $user->profile_img }}" alt="Avatar" style="width: 150px;border-radius: 50%;">
                                    <h5 class="card-title mt-2" style="font-weight: bolder;">
                                        {{ $user->firstname.' '.$user->lastname }}
                                    </h5>
                                    <h6>{{ $user->email }}</h6>
                                </div>
                        </div>
                        <div class="container mt-4">
                            <div class="row mb-2">
                                {{--<label class="col-md-4 text-right">ชื่อจริง : </label>--}}
                                <div class="input-group col-md-8" style="margin-left: auto;margin-right: auto;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                                    </div>
                                    <input id="old-password" type="password" class="form-control form-control-login @error('password') is-invalid @enderror" name="oldPassword" required autocomplete="new-password" placeholder="รหัสผ่านเดิม">

                                    @error('password')
                                    <span class="invalid-feedback text-left pl-2" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="input-group col-md-8" style="margin-left: auto;margin-right: auto;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                                    </div>
                                    <input id="password" type="password" class="form-control form-control-login @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="รหัสผ่าน">

                                    @error('password')
                                    <span class="invalid-feedback text-left pl-2" role="alert">
                            <span>{{ $message }}</span>
                         </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="input-group col-md-8" style="margin-left: auto;margin-right: auto;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control form-control-login" name="password_confirmation" required autocomplete="new-password" placeholder="ยืนยันรหัสผ่าน">
                                </div>
                            </div>
                            <div class="col-md-5 item-center mt-5 mb-3">
                                <input class="btn btn-submit" type="submit" value="บันทึก" style="width: 100%;background: #FF8574; border: none; color: white">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection