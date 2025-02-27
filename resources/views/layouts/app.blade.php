<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lecon Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="shortcut icon" href="/uploads/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/uploads/favicon.ico" type="image/x-icon">
</head>
<body>

@include('inc.navbar')

<div>
    @include('inc.message')
    @include('sweetalert::alert')
    @yield('content')
</div>
{{--<footer class="footer">--}}
    {{--<div class="container text-center">--}}
        {{--2019 Lecon Project by TW09--}}
    {{--</div>--}}
{{--</footer>--}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



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

{{--<script>--}}
    {{--$(function () {--}}
        {{--$("#showDimensions").hide();--}}

        {{--$("#fileTypeImg01").click(function () {--}}
            {{--if ($(this).is(":checked")) {--}}
                {{--$("#showDimensions").show();--}}
                {{--$("#hideDimensions").hide();--}}
            {{--} else {--}}
                {{--$("#showDimensions").hide();--}}
                {{--$("#hideDimensions").show();--}}
            {{--}--}}
        {{--});--}}
        {{--$("#fileTypeImg02").click(function () {--}}
            {{--if ($(this).is(":checked")) {--}}
                {{--$("#showDimensions").show();--}}
                {{--$("#hideDimensions").hide();--}}
            {{--} else {--}}
                {{--$("#showDimensions").hide();--}}
                {{--$("#hideDimensions").show();--}}
            {{--}--}}
        {{--});--}}
        {{--$("#fileTypeImg03").click(function () {--}}
            {{--if ($(this).is(":checked")) {--}}
                {{--$("#showDimensions").show();--}}
                {{--$("#hideDimensions").hide();--}}
            {{--} else {--}}
                {{--$("#showDimensions").hide();--}}
                {{--$("#hideDimensions").show();--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}

{{--check toggle--}}
<script>
    $(function() {
        $('#toggle-event').change(function() {
            if ($(this).is(":checked")) {
                $('#wr-box').show();
            } else {
                $('#wr-box').hide();
                $('#toggle-fileType').prop('checked', false);
                $('#autoGrade-fileType').prop('checked', false);
                $('#autoGrade-dimensions').prop('checked', false);
                $('#fileType-box').hide();
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);

                $('#toggle-dimensions').prop('checked', false);
                $('#dimensions-box').hide();
                $('#dimensionsType').val('null');
                $('#dimensionsWidth').val(null);
                $('#dimensionsHeight').val(null);

            }

        })

        $('#toggle-fileType').change(function() {
            if ($(this).is(":checked")) {
                $('#fileType-box').show();
            } else {
                $('#fileType-box').hide();
                $('#autoGrade-fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);

            }

        })

        $('#toggle-dimensions').change(function() {
            if ($(this).is(":checked")) {
                $('#dimensions-box').show();
            } else {
                $('#autoGrade-dimensions').prop('checked', false);
                $('#dimensions-box').hide();
                $('#dimensionsType').val('null');
                $('#dimensionsWidth').val(null);
                $('#dimensionsHeight').val(null);

            }

        })

    })
</script>


<script>
    $(function()
    {
        $(document).on('click', '.btn-addfile', function(e)
        {
            e.preventDefault();

            var controlForm = $('.controls:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-addfile')
                .removeClass('btn-addfile').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus">-</span>');
        }).on('click', '.btn-remove', function(e)
        {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>

<script>
    var x = document.getElementById("demo");
    var lat = document.getElementById("lat");
    var long = document.getElementById("long");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        // x.innerHTML = "Latitude: " + position.coords.latitude +
        //     "<br>Longitude: " + position.coords.longitude;
        lat.value = position.coords.latitude;
        long.value = position.coords.longitude;
    }
</script>
<script>
    var button = document.querySelector('.btn-fullscreen');
    button.addEventListener('click', fullscreen);
    // when you are in fullscreen, ESC and F11 may not be trigger by keydown listener.
    // so don't use it to detect exit fullscreen
    document.addEventListener('keydown', function (e) {
        console.log('key press' + e.keyCode);
    });
    // detect enter or exit fullscreen mode
    document.addEventListener('webkitfullscreenchange', fullscreenChange);
    document.addEventListener('mozfullscreenchange', fullscreenChange);
    document.addEventListener('fullscreenchange', fullscreenChange);
    document.addEventListener('MSFullscreenChange', fullscreenChange);

    function fullscreen() {
        // check if fullscreen mode is available
        if (document.fullscreenEnabled ||
            document.webkitFullscreenEnabled ||
            document.mozFullScreenEnabled ||
            document.msFullscreenEnabled) {

            // which element will be fullscreen
            var iframe = document.querySelector('iframe');
            // Do fullscreen
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen();
            } else if (iframe.webkitRequestFullscreen) {
                iframe.webkitRequestFullscreen();
            } else if (iframe.mozRequestFullScreen) {
                iframe.mozRequestFullScreen();
            } else if (iframe.msRequestFullscreen) {
                iframe.msRequestFullscreen();
            }
        }
        else {
            document.querySelector('.error').innerHTML = 'Your browser is not supported';
        }
    }

    function fullscreenChange() {
        if (document.fullscreenEnabled ||
            document.webkitIsFullScreen ||
            document.mozFullScreen ||
            document.msFullscreenElement) {
            console.log('enter fullscreen');
        }
        else {
            console.log('exit fullscreen');
        }
        // force to reload iframe once to prevent the iframe source didn't care about trying to resize the window
        // comment this line and you will see
        var iframe = document.querySelector('iframe');
        iframe.src = iframe.src;
    }
</script>

{{--<script>--}}
    {{--$('#datepicker').datepicker({--}}
        {{--uiLibrary: 'bootstrap4'--}}
    {{--});--}}
{{--</script>--}}
</body>
</html>
