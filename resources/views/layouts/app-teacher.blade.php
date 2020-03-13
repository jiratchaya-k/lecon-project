<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lecon Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="shortcut icon" href="uploads/favicon.ico" type="image/x-icon">
    <link rel="icon" href="uploads/favicon.ico" type="image/x-icon">
</head>
<body>


@include('inc.navbar-teacher')

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




{{--<script>--}}
    {{--$('#datepicker').datepicker({--}}
        {{--uiLibrary: 'bootstrap4'--}}
    {{--});--}}
{{--</script>--}}
</body>
</html>
