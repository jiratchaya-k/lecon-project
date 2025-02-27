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

    <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.min.css">

    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>
    <!-- include FilePond plugins -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

    <!-- include FilePond jQuery adapter -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <link rel="shortcut icon" href="/uploads/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/uploads/favicon.ico" type="image/x-icon">
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

{{--<script>--}}
    {{--/*--}}
{{--We need to register the required plugins to do image manipulation and previewing.--}}
{{--*/--}}
    {{--FilePond.registerPlugin(--}}
        {{--// encodes the file as base64 data--}}
        {{--FilePondPluginFileEncode,--}}

        {{--// validates files based on input type--}}
        {{--FilePondPluginFileValidateType,--}}

        {{--// corrects mobile image orientation--}}
        {{--FilePondPluginImageExifOrientation,--}}

        {{--// previews the image--}}
        {{--FilePondPluginImagePreview,--}}

        {{--// crops the image to a certain aspect ratio--}}
        {{--FilePondPluginImageCrop,--}}

        {{--// resizes the image to fit a certain size--}}
        {{--FilePondPluginImageResize,--}}

        {{--// applies crop and resize information on the client--}}
        {{--FilePondPluginImageTransform--}}
    {{--);--}}

    {{--// Select the file input and use create() to turn it into a pond--}}
    {{--// in this example we pass properties along with the create method--}}
    {{--// we could have also put these on the file input element itself--}}



    {{--FilePond.create(--}}
        {{--document.querySelector('.filepond'),--}}
        {{--{--}}
            {{--labelIdle: `<span class="filepond--label-action">เปลี่ยนรูปโปรไฟล์</span>`,--}}
            {{--imagePreviewHeight: 150,--}}
            {{--imageCropAspectRatio: '1:1',--}}
            {{--imageResizeTargetWidth: 150,--}}
            {{--imageResizeTargetHeight: 150,--}}
            {{--stylePanelLayout: 'compact circle',--}}
            {{--styleLoadIndicatorPosition: 'center bottom',--}}
            {{--styleButtonRemoveItemPosition: 'center bottom'--}}
        {{--}--}}
    {{--);--}}
{{--</script>--}}

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
    var button_fs = document.querySelector('.btn-fullscreen');
    button_fs.addEventListener('click', fullscreen);
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

<script>
    $(document).ready(function() {
        var max_fields      = 6; //maximum input boxes allowed
        var wrapper_teacher   		= $(".input_teacher_wrap"); //Fields wrapper
        var add_button_teacher      = $(".add_button_teacher"); //Add button Class
        var wrapper_student   		= $(".input_student_wrap"); //Fields wrapper
        var add_button_student      = $(".add_button_student"); //Add button Class
        // var wrapper_location   		= $(".input_location_wrap"); //Fields wrapper
        // var add_button_location      = $(".add_button_location"); //Add button Class

        var teacher = 1; //initlal text box count
        var student = 1;
        // var location = 1;

        if ($(add_button_teacher).click) {
            $(add_button_teacher).click(function (e) { //on add input button click
                e.preventDefault();
                if (teacher < max_fields) { //max input box allowed
                    teacher++; //text box increment
                    $(wrapper_teacher).append('<div class="col-md-6"><input class="form-control f-input"  name="subject_teacher[]" type="text" list="teachers" style="width: 90%;height: 35px;float: left; margin-bottom: 10px"><a href="#" class="remove_teacher ml-1 pt-1" style="float: left">X</a></div> '); //add input box
                }
            });

            $(wrapper_teacher).on("click", ".remove_teacher", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
        if ($(add_button_student).click) {
            $(add_button_student).click(function (e) { //on add input button click
                e.preventDefault();
                if (student < max_fields) { //max input box allowed
                    student++; //text box increment
                    $(wrapper_student).append('<div class="col-md-6"><input class="form-control f-input"  name="subject_student[]" type="text" list="students" style="width: 90%;height: 35px;float: left; margin-bottom: 10px"><a href="#" class="remove_teacher ml-1 pt-1" style="float: left">X</a></div> '); //add input box
                }
            });

            $(wrapper_student).on("click", ".remove_student", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }




    });
</script>

</body>
</html>
