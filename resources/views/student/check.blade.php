@extends('layouts.app')
@section('content')

    <body onload="getLocation()">
    <div class="container mt-10">
        <form method="POST" action="/check-in/check" enctype="multipart/form-data">
            @csrf
        <p>Your current location.</p>

        {{--<button onclick="getLocation()">Try It</button>--}}

        <p id="demo"></p>
        Latitude: <input type="text" name="latitude" id="lat" value="">
        <br>Longitude: <input type="text" name="longitude" id="long" value="">
            <div class="col-md-6 mt-5 mb-3">
                <input class="btn btn-dark btn-submit" type="submit" value="check in" style="background: #3956A3 !important; border: none; width: 50%">
            </div>
        </form>
    </div>
    </body>
@endsection