@extends('layouts.app')
@section('content')
    <center><h1 class="mt-10">QR CODE</h1>
        {!! QrCode::size(250)->encoding('UTF-8')->generate('เช็คชื่อนักศึกษา'); !!}
        {{--<br>--}}
        <h5>เช็คชื่อวิชา <span style="color: #3956A3; font-weight: bolder">{{ $checkSubject }}</span></h5>
    </center>
@endsection