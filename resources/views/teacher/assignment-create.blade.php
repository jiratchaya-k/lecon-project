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
    <style>
        .nav-item > .home-active{
            color: white !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
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
                    <form method="POST" action="/teacher/assignment/store" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group col-md-4">
                            <label for="title" class="control-label">ชื่องาน</label>
                            <input class="form-control f-input" name="assignment_title" type="text" id="title">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description" class="control-label">คำอธิบาย</label>
                            <textarea class="form-control f-input" name="assignment_description" cols="50" rows="5" id="description"></textarea>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">มอบหมายให้กลุ่มเรียน</label>
                            <select class="f-input ml-2 mt-2" name="sis_id" style="width: auto; height: 32px; padding-left: 10px;">
                                @if(count($sections)>0)
                                    @foreach($sections as $section)
                                        <option value="{{ $section->sis_id }}">{{ 'กลุ่ม '.$section->section.' ('.$section->code.' '.$section->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="row container">
                            <div class="form-group col-md-4">
                                <label for="date" class="control-label">ส่งภายในวันที่</label>
                                <input class="form-control f-input" name="assignment_dueDate" type="date" id="date" value="{{date(('Y-m-d'))}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="time" class="control-label">ส่งภายในเวลา</label>
                                <input class="form-control f-input" name="assignment_dueTime" type="time" id="time" value="22:00:00">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="file" class="control-label">แนบไฟล์</label>
                            <input class="form-control f-input" name="assignment_file" type="file">
                        </div>

                        <div class="form-group container">
                            <label for="filename" class="control-label mt-2">ชื่อไฟล์งาน</label><button class="btn btn-default btn-add ml-2 add_button_filename">+ เพิ่ม</button>
                            <div class="row input_filename_wrap mt-2">
                                <div class="col-md-4">
                                    <input class="form-control f-input"  name="assignment_filename[]" id="filename" type="text" style="width: 90%; height: 35px; margin-bottom: 10px; float: left">
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-3">
                                <h5 class="container">เงื่อนไขงาน</h5>
                            </div>
                            <div class="col-2">
                                <label class="switch">
                                    <input type="checkbox" id="toggle-event">
                                    <span class="slider"></span>
                                </label>

                            </div>
                        </div>


                        <div class="row container mt-3 ml-2" id="wr-box" style="display: none" >
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

                                <div class="container" id="fileType-box" style="display: none"><hr>
                                    <input type="checkbox" name="fileType[]" class="fileType" value="jpg"> JPEG (.JPG , .JPEG)</input><br>
                                    <input type="checkbox" name="fileType[]" class="fileType" value="png"> PNG (.PNG)</input><br>
                                    <input type="checkbox" name="fileType[]" class="fileType" value="gif"> GIF (.GIF)</input><br>
                                    <input type="checkbox" name="fileType[]" class="fileType" value="pdf"> PDF (.PDF)</input><br>
                                    <input type="checkbox" name="fileType[]" class="fileType" value="mp4"> MPEG4 (.MP4)</input>
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
                                            <input type="checkbox" id="toggle-dimensions">
                                            <span class="slider"></span>
                                        </label>

                                    </div>
                                </div>
                                <div class="container" id="dimensions-box" style="display: none">
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
                                        <input class="form-control col-md-2 f-input" name="dimensions_width" type="text" id="dimensionsWidth">
                                        <span class="col-md-1 text-center">x</span>
                                        <label for="dimensionsHeight" class="control-label col-md-2">สูง</label>
                                        <input class="form-control col-md-2 f-input mr-3" name="dimensions_height" type="text" id="dimensionsHeight">
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
    $(document).ready(function() {
        var max_fields_filename      = 5; //maximum input boxes allowed
        var max_fields_student      = 50; //maximum input boxes allowed
        var wrapper_filename  		= $(".input_filename_wrap"); //Fields wrapper
        var add_button_filename      = $(".add_button_filename"); //Add button Class
        var wrapper_student   		= $(".input_student_wrap"); //Fields wrapper
        var add_button_student      = $(".add_button_student"); //Add button Class

        var filename = 1; //initlal text box count
        var student = 1;

        if ($(add_button_filename).click) {
            $(add_button_filename).click(function(e){ //on add input button click
                e.preventDefault();
                if(filename < max_fields_filename){ //max input box allowed
                    filename++; //text box increment
                    $(wrapper_filename).append('' +
                        '<div class="col-md-4">' +
                        '<input class="form-control f-input"  name="assignment_filename[]" type="text"' +
                        'style="width: 90%; height: 35px; margin-bottom: 10px; float: left">' +
                        '<a href="#" class="remove_filename ml-1 pt-1" style="float: left; margin-top: 4px;">X</a></div> '); //add input box
                }
            });

            $(wrapper_filename).on("click",".remove_filename", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); teacher--;
            })
        }



    });
</script>

</body>

</html>
