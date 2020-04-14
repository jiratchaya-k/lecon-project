@extends('layouts.app')
@section('content')
    <style>
        .nav-item > .profile-active{
            color: #3956A3 !important;
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
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}" class="active">โปรไฟล์</a>
                            <a href="/profile/{{ $user->firstname.'-'.$user->lastname }}/checkname" class="">การเข้าเรียน</a>
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
                        <form method="POST" action="/profile/{{ $user->firstname.'-'.$user->lastname }}/update" enctype="multipart/form-data">
                            @csrf
                        <div class="row" >
                            <div class="col-md-6 text-center" style="margin: 0 auto;">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="profile_img" accept=".png, .jpg, .jpeg" />
                                            <label class="upload-icon" for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url('/uploads/profileImage/{{ $user->profile_img }}');">
                                            </div>
                                        </div>
                                    </div>
                                {{--<img src="https://www.w3schools.com/css/ocean.jpg" alt="Avatar" style="width: 150px;border-radius: 50%;">--}}
                                {{--<input type="file" name="profile_img">--}}
                                {{--<img src="https://www.w3schools.com/css/ocean.jpg" alt="Avatar" style="width: 150px;border-radius: 50%;">--}}
                            </div>
                        </div>
                        <div class="container mt-4">
                            <div class="row mb-2">
                                <div class="input-group col-md-8" style="margin-left: auto;margin-right: auto;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                                    </div>
                                    <input id="student_id" type="text" class="form-control form-control-login @error('student_id') is-invalid @enderror" name="student_id" value="{{ $user->student_id }}" required autocomplete="student_id" placeholder="รหัสนักศึกษา">
                                    @error('student_id')
                                    <span class="invalid-feedback text-left pl-2" role="alert">
                                <span>{{ $message }}</span>
                             </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                {{--<label class="col-md-4 text-right">ชื่อจริง : </label>--}}
                                <div class="input-group col-md-8" style="margin-left: auto;margin-right: auto;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-id-card"></i></div>
                                    </div>
                                    <input id="firstname" type="text" class="form-control form-control-login @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" placeholder="ชื่อจริง">

                                    @error('firstname')
                                    <span class="invalid-feedback text-left pl-2" role="alert">
                            <span>{{ $message }}</span>
                         </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="input-group col-md-8" style="margin-left: auto;margin-right: auto;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-id-card"></i></div>
                                    </div>
                                    <input id="lastname" type="text" class="form-control form-control-login @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" placeholder="นามสกุล">

                                    @error('lastname')
                                    <span class="invalid-feedback text-left pl-2" role="alert">
                            <span>{{ $message }}</span>
                         </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="input-group col-md-8" style="margin-left: auto;margin-right: auto;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                    </div>
                                    <input id="email" type="email" class="form-control form-control-login @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="อีเมล">
                                    @error('email')
                                    <span class="invalid-feedback text-left pl-2" role="alert">
                            <spam>{{ $message }}</spam>
                         </span>
                                    @enderror
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