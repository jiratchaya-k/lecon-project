@extends('layouts.appForLogin')

@section('content')

    <style>
        .mobile-box{
            display: none;
        }
        @media (min-width: 320px) and (max-width: 480px)
        {
            .l-box {
                display: none!important;
            }
            .mobile-box{
                display: block;
            }
            .right-box {
                margin-top: 30px!important;
            }
        }
        @media (min-width: 481px) and (max-width: 767px)
        {
            .l-box {
                display: none!important;
            }
            .mobile-box{
                display: block;
            }
            .right-box {
                margin-top: 30px!important;
            }
        }
    </style>

    <div class="container-fluid full-height">
        <div class="row full-height">
            <div class="col-md-5 left-box l-box">
                <div class="container mt-10 text-center text-white">
                    <br><br>
                    <h1 class="ls-3">สวัสดี อาจารย์ !</h1>
                    <br><br><br><br>
                    <span>คุณมีบัญชีอยู่แล้ว ? ?</span><br>
                    <div class="button-login button-3">
                        <a href="/sign-in"><div class="circle circle-short"></div>เข้าสู่ระบบ</a>
                    </div>
                    <br><br>
                    <h6>หรือ</h6>
                    <br><br>
                    <span>คุณคือนักศึกษาใช่ไหม ?</span><br>
                    <div class="button-login button-3">
                        <a href="/sign-up"><div class="circle"></div>สมัครสมาชิกของนักศึกษา</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xs-12 right-box mt-10 text-center pt-3">
                <img src="/uploads/logo-blue.png" alt="" style="width: 150px;">
                <h3 class="mt-3">สมัครสมาชิก</h3>
                <span style="color: dimgray;">ผู้สอน</span>
                <br>
                <a class="btn btn-link mt-2 mobile-box" href="/sign-up" style="color: #5e5d5d; font-size: 10px">
                    {{ __('สมัครสมาชิกของนักศึกษา') }}
                </a>
                <br>




                <form method="POST" action="/teacher/sign-up" enctype="multipart/form-data" class="align-items-center col-md-8 col-xs-12 needs-validation" novalidate style="margin-left: auto;margin-right: auto;">
                    @csrf

                    <div class="row">
                        <div class="input-group mb-4 col-md-6 col-xs-12" style="margin-left: auto;margin-right: auto;">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-id-card"></i></div>
                            </div>
                            <input id="firstname" type="text" class="form-control form-control-login @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus placeholder="ชื่อจริง">

                            @error('firstname')
                            <span class="invalid-feedback text-left pl-2" role="alert">
                            <span>{{ $message }}</span>
                         </span>
                            @enderror
                        </div>
                        <div class="input-group mb-4 col-md-6 col-xs-12" style="margin-left: auto;margin-right: auto;">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-id-card"></i></div>
                            </div>
                            <input id="lastname" type="text" class="form-control form-control-login @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus placeholder="นามสกุล">

                            @error('lastname')
                            <span class="invalid-feedback text-left pl-2" role="alert">
                            <span>{{ $message }}</span>
                         </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                        </div>
                        <input id="email" type="email" class="form-control form-control-login @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="อีเมล">
                        @error('email')
                        <span class="invalid-feedback text-left pl-2" role="alert">
                            <spam>{{ $message }}</spam>
                         </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="input-group mb-4 col-md-6 col-xs-12" style="margin-left: auto;margin-right: auto;">
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
                        <div class="input-group mb-4 col-md-6 col-xs-12" style="margin-left: auto;margin-right: auto;">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                            </div>
                            <input id="password-confirm" type="password" class="form-control form-control-login" name="password_confirmation" required autocomplete="new-password" placeholder="ยืนยันรหัสผ่าน">

                        </div>
                    </div>

                    <div class="form-group row mt-4 mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-submit">
                                {{ __('สมัครสมาชิก') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="left-box mt-5 text-center text-white mobile-box pt-4 pb-4" style="height: auto;">
                <span>คุณมีบัญชีอยู่แล้ว ?</span><br>
                <div class="button-login button-3">
                    <a href="/sign-in">
                        <div class="circle circle-short"></div>
                        เข้าสู่ระบบ</a>
                </div>
                <br>
            </div>

        </div>
    </div>
@endsection
