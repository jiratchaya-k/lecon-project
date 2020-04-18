<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lecon Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="\css\style.css">
    <link rel="shortcut icon" href="uploads/favicon.ico" type="image/x-icon">
    <link rel="icon" href="uploads/favicon.ico" type="image/x-icon">
</head>
<style>
    html, body {
        height: 100% !important;
        margin: 0 auto;
    }

    .full-height {
        height: 100%;
    }

</style>
<body>

    {{--@include('inc.message')--}}
    @include('sweetalert::alert')

    @yield('content')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>--}}

<script>
    $('.datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
</script>

{{--<script type="text/javascript">--}}
    {{--let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });--}}
    {{--scanner.addListener('scan', function (content) {--}}
        {{--alert(content);--}}
    {{--});--}}
    {{--Instascan.Camera.getCameras().then(function (cameras) {--}}
        {{--if (cameras.length > 0) {--}}
            {{--scanner.start(cameras[0]);--}}
        {{--} else {--}}
            {{--console.error('No cameras found.');--}}
        {{--}--}}
    {{--}).catch(function (e) {--}}
        {{--console.error(e);--}}
    {{--});--}}
{{--</script>--}}


</body>
</html>
