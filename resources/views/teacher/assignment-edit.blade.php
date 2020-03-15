<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/style-teacher.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">

    <link rel="shortcut icon" href="/uploads/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/uploads/favicon.ico" type="image/x-icon">

    <title>LECON - Teacher</title>
</head>

<body>
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->

    <div class="dashboard-header" style="border: none;">
        @include('inc.navbar-teacher')
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            <?php $user = \Illuminate\Support\Facades\DB::table('users')->where('id','=',\Illuminate\Support\Facades\Auth::id())->first();
                            ?>
                            {{ $user->firstname.' '.$user->lastname }}
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="/teacher/subject"><i class="fa fa-fw fa-angle-right"></i>วิชาทั้งหมด<span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="/teacher/student-check"><i class="fa fa-fw fa-angle-right"></i>เช็คชื่อนักศึกษา<span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="/teacher/subject/create"><i class="fa fa-fw fa-angle-right"></i>สร้างวิชา<span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            {{--<a class="nav-link active" href="/teacher/assignment"><i class="fa fa-fw fa-angle-right"></i>งามที่มอบหมาย<span class="badge badge-success">6</span></a>--}}
                            <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fa fa-fw fa-angle-right"></i>งามที่มอบหมาย</a>
                            <div id="submenu-9" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/teacher/assignment"><i class="fa fa-fw fa-angle-right"></i>งานที่มอบหมายทั้งหมด</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/teacher/assignment/compare"><i class="fa fa-fw fa-angle-right"></i>เปรียบเทียบงาน</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="/teacher/manage"><i class="fa fa-fw fa-angle-right"></i>การจัดการ<span class="badge badge-success">6</span></a>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">มอบหมายงาน</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        {{--<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">วิชาทั้งหมด</a></li>--}}
                                        {{--<li class="breadcrumb-item active" aria-current="page">> วิชาทั้งหมด</li>--}}
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="ecommerce-widget">
    {{--<div class="container-fluid mt-10">--}}
        <div class="container">
            <div class="card box-shadow mb-2">
                <div class="card-body">
                    <form method="POST" action="/teacher/assignment/{{ $assignment->id }}/update" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group col-md-4">
                            <label for="title" class="control-label">ชื่องาน</label>
                            <input class="form-control f-input" name="assignment_title" type="text" id="title" value="{{ $assignment->title }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description" class="control-label">คำอธิบาย</label>
                            <textarea class="form-control f-input" name="assignment_description" cols="50" rows="5" id="description">{{ $assignment->description }}</textarea>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">มอบหมายให้กลุ่มเรียน</label>
                            <select class="f-input ml-2 mt-2" name="sis_id" style="width: auto; height: 32px; padding-left: 10px;">
                                @if(count($sections)>0)
                                    @foreach($sections as $section)
                                        <option name="sect_opt[]" value="{{ $section->sis_id }}">{{ 'กลุ่ม '.$section->section.' ('.$section->code.' '.$section->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <input type="hidden" id="sis_id" value="{{ $assignment->sis_id }}">
                        </div>

                        <div class="row container">
                            <div class="form-group col-md-4">
                                <label for="date" class="control-label">กำหนดวันส่ง</label>
                                <input class="form-control f-input" name="assignment_dueDate" type="date" id="date" value="{{ $assignment->dueDate }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="time" class="control-label">กำหนดเวลาส่ง</label>
                                <input class="form-control f-input" name="assignment_dueTime" type="time" id="time" value="{{ $assignment->dueTime }}">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="file" class="control-label">แนบไฟล์</label>
                            <input class="form-control f-input" name="assignment_file" type="file">
                        </div>



                        <br>
                        <div class="row">
                            <div class="col-3">
                                <h5 class="container">เงื่อนไขงาน</h5>
                            </div>
                            <div class="col-2">
                                <label class="switch">
                                    <input type="checkbox" id="toggle-event" checked>
                                    <span class="slider"></span>
                                </label>

                            </div>
                        </div>


                        <div class="row container mt-3 ml-2" id="wr-box" >
                            <div class="form-group col-md-4 card" style="padding: 5px;">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="container">นามสกุลไฟล์</h5>
                                    </div>
                                    <div class="col-3">
                                        <label class="switch">
                                            <input type="checkbox" id="toggle-fileType">
                                            <span class="slider"></span>
                                        </label>

                                    </div>
                                </div>

                                <div class="container" id="fileType-box" style="display: block"><hr>
                                    @if($fileType > 0)
                                    @foreach($fileType as $type)
                                        <input type="hidden" name="type[]" value="{{ $type }}">
                                    @endforeach
                                        @elseif ($fileType == null)
                                        <input type="hidden" name="type[]" value="{{ $fileType }}">
                                    @endif
                                    <input type="checkbox" name="fileType[]" id="type_jpg" class="fileType" value="jpg"> JPEG (.JPG , .JPEG)</input><br>
                                    <input type="checkbox" name="fileType[]" id="type_png" class="fileType" value="png"> PNG (.PNG)</input><br>
                                    <input type="checkbox" name="fileType[]" id="type_gif" class="fileType" value="gif"> GIF (.GIF)</input><br>
                                    <input type="checkbox" name="fileType[]" id="type_pdf" class="fileType" value="pdf"> PDF (.PDF)</input><br>
                                    <input type="checkbox" name="fileType[]" id="type_mp4" class="fileType" value="mp4"> MPEG4 (.MP4)</input>
                                    <hr>
                                    <div class="row mt-1">
                                        <div class="col-8">
                                            <span class="fs-10">หากผิดเงื่อนไข จะปรับเป็น DELETE</span>
                                        </div>
                                        <div class="col">
                                            <label class="switch">

                                                <input type="checkbox" id="autoGrade-fileType" name="autoGrade-fileType" value="1">
                                                <span class="slider"></span>
                                            </label>
                                            <input type="hidden" id="auto-fileType" value="{{ $assignment->autoGrade_fileType }}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group card col-md-7 ml-3" style="padding: 5px;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5 class="container">ขนาดไฟล์</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="switch">
                                            <input type="checkbox" id="toggle-dimensions" checked>
                                            <span class="slider"></span>
                                        </label>

                                    </div>
                                </div>
                                <div class="container" id="dimensions-box" style="display: block">
                                    {{--<div class="row mt-2">--}}
                                        {{--<label for="dimensionsType" class="control-label col-md-3">Type</label>--}}
                                        {{--<select class="custom-select col-md-3 f-input" id="dimensionsType" name="dimensionsType">--}}
                                            {{--<option selected value="null">Select</option>--}}
                                            {{--<option value="px">Pixels</option>--}}
                                            {{--<option value="in">Inches</option>--}}
                                            {{--<option value="cm">Centimeters</option>--}}
                                            {{--<option value="mm">Millimeters</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    <div class="row mt-3">
                                        <label for="dimensionsWidth" class="control-label col-md-2">กว้าง</label>
                                        <input class="form-control col-md-2 f-input" name="dimensions_width" type="text" id="dimensionsWidth" value="{{ $width }}">
                                        <span class="col-md-1 text-center">x</span>
                                        <label for="dimensionsHeight" class="control-label col-md-2">สูง</label>
                                        <input class="form-control col-md-2 f-input mr-3" name="dimensions_height" type="text" id="dimensionsHeight" value="{{ $height }}">
                                        <span class="col-md-2 text-center">px</span>
                                    </div>
                                    <hr>
                                    <div class="row mt-1">
                                        <div class="col-8">
                                            <span class="fs-10">หากผิดเงื่อนไข จะปรับเป็น DELETE</span>
                                        </div>
                                        <div class="col">
                                            <label class="switch">
                                                <input type="checkbox" id="autoGrade-dimensions" name="autoGrade-dimensions" value="1">
                                                <span class="slider"></span>
                                            </label>
                                            <input type="hidden" id="auto-dimension" value="{{ $assignment->autoGrade_dimensions }}">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-md-5 item-center mt-5 mb-3">
                            <input class="btn btn-dark btn-submit" type="submit" value="มอบหมายงาน" style="background: #3956A3 !important; border: none; width: 100%">
                        </div>
                    </form>
                </div>
            </div>
    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end main wrapper  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<!-- jquery 3.3.1 -->
<script src="/js/jquery-3.3.1.min.js"></script>
<!-- bootstap bundle js -->
<script src="/js/bootstrap.bundle.js"></script>
<!-- slimscroll js -->
<script src="/js/jquery.slimscroll.js"></script>
<!-- main js -->
<script src="/js/main-js.js"></script>

<script>

    var types = document.getElementsByName("type[]");
    var auto_filetype = document.getElementById("auto-fileType");

    console.log(auto_filetype.value);

    for (var x =0; x < types.length;x++) {
        if ((types[x].value == null) || (types[x].value == "")) {
            $('#toggle-fileType').prop('checked', false);
            $('#fileType-box').hide();
        }
        else {
            $('#toggle-fileType').prop('checked', true);

            // console.log(types.length);

            for (var i = 0; i < types.length; i++) {
                // console.log(types[i].value);

                if (types[i].value == "jpg") {
                    $('#type_jpg').prop('checked', true)
                } else if (types[i].value == "png") {
                    $('#type_png').prop('checked', true)
                } else if (types[i].value == "gif") {
                    $('#type_gif').prop('checked', true)
                } else if (types[i].value == "pdf") {
                    $('#type_pdf').prop('checked', true)
                } else if (types[i].value == "mp4") {
                    $('#type_mp4').prop('checked', true)
                }

            }

            if (auto_filetype.value == 1) {
                $('#autoGrade-fileType').prop('checked', true)
            } else {
                $('#autoGrade-fileType').prop('checked', false)
            }

        }
    }

</script>

<script>

    var dimension = document.getElementById("dimensionsWidth");
    var auto_dimension = document.getElementById("auto-dimension");


    console.log(auto_dimension.value);

        if ((dimension.value == null) || (dimension.value == "")) {
            $('#toggle-dimensions').prop('checked', false);
            $('#dimensions-box').hide();
        }
        else {
            $('#toggle-dimensions').prop('checked', true);

            // console.log(types.length);


            if (auto_dimension.value == 1) {
                $('#autoGrade-dimensions').prop('checked', true)
            } else {
                $('#autoGrade-dimensions').prop('checked', false)
            }

        }

</script>

<script>

    var sis_id = document.getElementById("sis_id");
    var sect_opt = document.getElementsByName("sect_opt[]");

    for (var i = 0; i < sect_opt.length; i++) {
        if (sis_id.value == sect_opt[i].value){
            sect_opt[i].selected = true;
        }
    }

</script>



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
</body>

</html>
