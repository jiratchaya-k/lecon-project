@extends('layouts.app')
@section('content')
    <center><h1>QR CODE</h1>
        {!! QrCode::size(250)->generate('google.com'); !!}</center>
@endsection