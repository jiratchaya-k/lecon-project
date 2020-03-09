@extends('layouts.appForLogin')

@section('content')


    <div class="container-fluid full-height">
        <div class="row full-height">
            <div class="col-md-5 left-box">
                <div class="container mt-10 text-center text-white">
                    <br><br>
                    <h1 class="ls-3">Welcome !</h1>
                    <br><br><br><br>
                    <span>Don't have an account ?</span><br>
                    <div class="button-login button-3">
                        <a href="/sign-up">
                            <div class="circle circle-short"></div>
                            SIGN UP as STUDENT</a>
                    </div>
                    <br><br>
                    <h6>OR</h6>
                    <br><br>
                    <span>You are teacher ?</span><br>
                    <div class="button-login button-3">
                        <a href="/teacher/sign-up">
                            <div class="circle"></div>
                            SIGN UP as TEACHER</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7 right-box mt-10 text-center">
                <h2 class="mt-5">SIGN IN</h2>
                <br><br>




                <form method="POST" action="{{ route('login') }}" class="align-items-center col-8 needs-validation" novalidate style="margin-left: auto;margin-right: auto;">
                    {{--<form method="POST" action="/login" class="align-items-center col-8 needs-validation" novalidate style="margin-left: auto;margin-right: auto;">--}}
                    @csrf


                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                        </div>
                        {{--<input id="email" name="email" type="text" class="form-control{{ $errors->has('student_id') || $errors->has('email') ? ' is-invalid' : '' }} form-control-login " name="email" value="{{ old('student_id') ?: old('email') }}" required autocomplete="email" placeholder="email@silpakorn.edu or @su.ac.th">--}}
                        {{--@if ($errors->has('student_id') || $errors->has('email'))--}}
                            {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('student_id') ?: $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                        {{--@endif--}}

                        <input id="login" type="text"
                               class="form-control{{ $errors->has('student_id') || $errors->has('email') ? ' is-invalid' : '' }} form-control-login"
                               name="login" value="{{ old('student_id') ?: old('email') }}" required placeholder="email or student id">

                        @if ($errors->has('student_id') || $errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('student_id') ?: $errors->first('email') }}</strong>
                                    </span>
                        @endif

                        {{--@error('email')--}}
                        {{--<span class="invalid-feedback text-left pl-2" role="alert">--}}
                            {{--<spam>{{ $message }}</spam>--}}
                         {{--</span>--}}
                        {{--@enderror--}}
                    </div>

                    <div class="input-group mb-4">
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

                    <div class="form-group row mt-5 mb-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-submit">
                                {{ __('SIGN IN') }}
                            </button>
                        </div>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #5e5d5d; font-size: 10px">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                </form>
            </div>
        </div>
    </div>
@endsection


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Login') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('login') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

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
                                {{--<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

                                {{--@error('password')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<div class="form-check">--}}
                                    {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                    {{--<label class="form-check-label" for="remember">--}}
                                        {{--{{ __('Remember Me') }}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-8 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Login') }}--}}
                                {{--</button>--}}

                                {{--@if (Route::has('password.request'))--}}
                                    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                        {{--{{ __('Forgot Your Password?') }}--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
