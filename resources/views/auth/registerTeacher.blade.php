@extends('layouts.appForLogin')

@section('content')
    <div class="container-fluid full-height">
        <div class="row full-height">
            <div class="col-md-5 left-box">
                <div class="container mt-10 text-center text-white">
                    <br><br>
                    <h1 class="ls-3">Welcome Teacher !</h1>
                    <br><br><br><br>
                    <span>Do you have an account ?</span><br>
                    <div class="button-login button-3">
                        <a href="/sign-in"><div class="circle circle-short"></div>SIGN IN</a>
                    </div>
                    <br><br>
                    <h6>OR</h6>
                    <br><br>
                    <span>You are teacher ?</span><br>
                    <div class="button-login button-3">
                        <a href="/sign-up"><div class="circle"></div>SIGN UP as STUDENT</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7 right-box mt-10 text-center">
                <h2 class="mt-5">SIGN UP</h2>
                <span style="color: dimgray;">as teacher</span>
                <br><br><br>




                <form method="POST" action="/teacher/sign-up" enctype="multipart/form-data" class="align-items-center col-8 needs-validation" novalidate style="margin-left: auto;margin-right: auto;">
                    @csrf

                    <div class="row">
                        <div class="input-group mb-4 col-6" style="margin-left: auto;margin-right: auto;">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-id-card"></i></div>
                            </div>
                            <input id="firstname" type="text" class="form-control form-control-login @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus placeholder="firstname">

                            @error('firstname')
                            <span class="invalid-feedback text-left pl-2" role="alert">
                            <span>{{ $message }}</span>
                         </span>
                            @enderror
                        </div>
                        <div class="input-group mb-4 col-6" style="margin-left: auto;margin-right: auto;">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-id-card"></i></div>
                            </div>
                            <input id="lastname" type="text" class="form-control form-control-login @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus placeholder="lastname">

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
                        <input id="email" type="email" class="form-control form-control-login @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email@silpakorn.edu or @su.ac.th">
                        @error('email')
                        <span class="invalid-feedback text-left pl-2" role="alert">
                            <spam>{{ $message }}</spam>
                         </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="input-group mb-4 col-6" style="margin-left: auto;margin-right: auto;">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                            </div>
                            <input id="password" type="password" class="form-control form-control-login @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="password">

                            @error('password')
                            <span class="invalid-feedback text-left pl-2" role="alert">
                            <span>{{ $message }}</span>
                         </span>
                            @enderror
                        </div>
                        <div class="input-group mb-4 col-6" style="margin-left: auto;margin-right: auto;">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                            </div>
                            <input id="password-confirm" type="password" class="form-control form-control-login" name="password_confirmation" required autocomplete="new-password" placeholder="confirm password">

                        </div>
                    </div>

                    <div class="form-group row mt-4 mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-submit">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{--<form method="POST" action="/register" enctype="multipart/form-data">--}}
{{--@csrf--}}

{{--<div class="form-group row">--}}
{{--<label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>--}}

{{--@error('firstname')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>--}}

{{--@error('lastname')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--@error('email')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--@error('password')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row mb-0">--}}
{{--<div class="col-md-6 offset-md-4">--}}
{{--<button type="submit" class="btn btn-primary">--}}
{{--{{ __('Register') }}--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</form>--}}
