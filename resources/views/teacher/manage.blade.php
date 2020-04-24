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
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fa fa-fw fa-angle-right"></i>งามที่มอบหมาย</a>
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
                            <a class="nav-link active" href="/teacher/manage"><i class="fa fa-fw fa-angle-right"></i>การจัดการ<span class="badge badge-success">6</span></a>
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
                            <h2 class="pageheader-title">การจัดการ</h2>
                            {{--<div class="text-right mb-2">--}}
                                {{--<a href="/teacher/manage/create" class="btn btn-primary btn-submit" style="width: 20%;">--}}
                                    {{--สร้างทั้งหมด--}}
                                {{--</a>--}}
                            {{--</div>--}}

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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card box-shadow mb-2">
                                    <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">
                                        <span class="fs-18">ปีการศึกษา</span>
                                        <button class="btn btn-default btn-add ml-2" id="myBtn-year">+ เพิ่ม</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-xl">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="table-head">ปีการศึกษา</th>
                                                    <th class="table-head">เทอม</th>
                                                    <th class="table-head"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($years)>0)
                                                    @foreach($years as $year)
                                                        <?php
                                                            $useYear = \Illuminate\Support\Facades\DB::table('sections_in_subjects as sis')
                                                                ->where('sis.status','active')
                                                                ->where('sis.year_id','=',$year->id)
                                                                ->count();

//                                                            dd($useYear);
                                                        ?>

                                                        <tr>
                                                            <td>{{ $year->year }}</td>
                                                            <td>{{ $year->term }}</td>
                                                            <td>
                                                                {{--<a href="/teacher/manage/year-term/{{ $year->id }}/edit" class="btn btn-primary btn-dark btn-table" style="width: 80px;">--}}
                                                                    {{--edit--}}
                                                                {{--</a>--}}
                                                                @if($useYear > 0)
                                                                    <button class="btn" disabled onclick="return confirm('Are you sure to delete?')" style="background-color: transparent;">
                                                                        <i class="fas fa-trash-alt mt-2" data-toggle="tooltip" data-placement="bottom" title="ไม่สามารถลบได้" style="font-size: 20px; color: #818182; opacity: .5;"></i>
                                                                    </button>
                                                                @else
                                                                    <form method="POST" action="/teacher/manage/year-term/{{ $year->id }}/delete">
                                                                        @csrf
                                                                        <input name="_method" type="hidden" value="DELETE">
                                                                        <button class="btn" onclick="return confirm('Are you sure to delete?')" style="background-color: transparent;"> <i class="fas fa-trash-alt mt-2" data-toggle="tooltip" data-placement="bottom" title="ลบ" style="font-size: 20px; color: #818182;"></i></button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <th colspan="6" class="text-center" style="color: lightgray;">
                                                            <img src="/uploads/icons/icon-no-information.png" alt="" style="width: 50px; opacity: .5;">
                                                            <br>
                                                            <span style="font-family: 'Prompt', sans-serif;">ไม่มีข้อมูลปีการศึกษา</span>
                                                        </th>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card box-shadow mb-2">
                                    <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">
                                        <span class="fs-18">กลุ่มเรียน</span>
                                        <button class="btn btn-default btn-add ml-2" id="myBtn-section">+ เพิ่ม</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-xl">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="table-head">รหัสกลุ่มเรียน</th>
                                                    <th class="table-head"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($sections)>0)
                                                    @foreach($sections as $section)
                                                        <?php
                                                        $useSect = \Illuminate\Support\Facades\DB::table('sections_in_subjects as sis')
                                                            ->where('sis.status','active')
                                                            ->where('sis.section_id','=',$section->id)
                                                            ->count();

                                                        //                                                            dd($useYear);
                                                        ?>
                                                <tr>
                                                    <td>{{ $section->section }}</td>
                                                    <td>
                                                        @if($useSect > 0)
                                                            <button class="btn" disabled onclick="return confirm('Are you sure to delete?')" style="background-color: transparent;">
                                                                <i class="fas fa-trash-alt mt-2" data-toggle="tooltip" data-placement="bottom" title="ไม่สามารถลบได้" style="font-size: 20px; color: #818182; opacity: .5;"></i>
                                                            </button>
                                                        @else
                                                        <form method="POST" action="/teacher/manage/section/{{ $section->id }}/delete">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button class="btn" onclick="return confirm('Are you sure to delete?')" style="background-color: transparent;"> <i class="fas fa-trash-alt mt-2" data-toggle="tooltip" data-placement="bottom" title="ลบ" style="font-size: 20px; color: #818182;"></i></button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <th colspan="6" class="text-center" style="color: lightgray;">
                                                            <img src="/uploads/icons/icon-no-information.png" alt="" style="width: 50px; opacity: .5;">
                                                            <br>
                                                            <span style="font-family: 'Prompt', sans-serif;">ไม่มีข้อมูลกลุ่มเรียน</span>
                                                        </th>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <div class="row mt-4">
                        <div class="col-md-7">
                            <div class="card box-shadow mb-2">
                                <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">
                                    <span class="fs-18">สถานที่สำหรับเช็คชื่อ</span>
                                    <button class="btn btn-default btn-add ml-2" id="myBtn-location">+ เพิ่ม</button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-xl">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="table-head" style="width: 350px!important;">ชื่อสถานที่</th>
                                                <th class="table-head">ละติจูด</th>
                                                <th class="table-head">ลองจิจูด</th>
                                                <th class="table-head"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($locations)>0)
                                                @foreach($locations as $location)
                                                    <?php
                                                    $useLocation = \Illuminate\Support\Facades\DB::table('section_checks')
                                                        ->where('section_checks.location_id','=',$location->id)
                                                        ->count();
                                                    ?>
                                                    <tr>
                                                        <td>{{ $location->name }}</td>
                                                        <td>{{ $location->latitude }}</td>
                                                        <td>{{ $location->longitude }}</td>
                                                        <td>
                                                            <a href="/teacher/manage/location/{{ $location->id }}/edit" data-toggle="tooltip" data-placement="bottom" title="แก้ไข" style="float: left; padding-top: 18px;">
                                                                <i class="fas fa-pencil-alt" style="font-size: 20px; color: #FF8574;"></i>
                                                            </a>
                                                            @if($useLocation > 0)
                                                                <button class="btn" disabled onclick="return confirm('Are you sure to delete?')" style="background-color: transparent;">
                                                                    <i class="fas fa-trash-alt mt-2" data-toggle="tooltip" data-placement="bottom" title="ไม่สามารถลบได้" style="font-size: 20px; color: #818182; opacity: .5;"></i>
                                                                </button>
                                                            @else
                                                                <form method="POST" action="/teacher/manage/location/{{ $location->id }}/delete">
                                                                    @csrf
                                                                    <input name="_method" type="hidden" value="DELETE">
                                                                    <button class="btn" onclick="return confirm('Are you sure to delete?')" style="background-color: transparent;"> <i class="fas fa-trash-alt mt-2" data-toggle="tooltip" data-placement="bottom" title="ลบ" style="font-size: 20px; color: #818182;"></i></button>
                                                                </form>
                                                            @endif
                                                            {{--<a href="#" class="ml-3" data-toggle="tooltip" data-placement="bottom" title="ลบ">--}}
                                                                {{--<i class="fas fa-trash-alt mt-2" style="font-size: 20px;"></i>--}}
                                                            {{--</a>--}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th colspan="6" class="text-center" style="color: lightgray;">
                                                        <img src="/uploads/icons/icon-no-information.png" alt="" style="width: 50px; opacity: .5;">
                                                        <br>
                                                        <span style="font-family: 'Prompt', sans-serif;">ไม่มีข้อมูลสถานที่</span>
                                                    </th>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card box-shadow mb-2">
                                <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">
                                    <span class="fs-18">รายชื่ออาจารย์</span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-xl">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="table-head">ชื่อ-นามสกุล</th>
                                                <th class="table-head">อีเมล</th>
                                                {{--<th class="table-head">แก้ไข</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($teachers)>0)
                                                @foreach($teachers as $teacher)
                                                    <tr>
                                                        <td>{{ $teacher->firstname.' '.$teacher->lastname }}</td>
                                                        <td>{{ $teacher->email }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th colspan="6" class="text-center" style="color: lightgray;">
                                                        <img src="/uploads/icons/icon-no-information.png" alt="" style="width: 50px; opacity: .5;">
                                                        <br>
                                                        <span style="font-family: 'Prompt', sans-serif;">ไม่มีข้อมูลผรายชื่อู้สอน</span>
                                                    </th>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>
                </div>

                <!-- The Modal Year-->
                <div id="modelYear" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content modal-content-year">
                        <span class="close">&times;</span>
                        <div class="container" style="padding: 30px;">
                            <h3 style="float: left;">ปีการศึกษา</h3> <button class="btn btn-default btn-add add_button_year ml-3">+ เพิ่ม</button>
                            <hr>
                            <form method="POST" action="/teacher/manage/year-term/store" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mt-2">
                                    {{--<label for="title" class="control-label mb-3 mr-2"style="color: black">ปีการศึกษา</label>--}}

                                    <div class="input_year_wrap">
                                        <div class="row">
                                            <label for="inputYear" class="col-1 col-form-label">ปี</label>
                                            <div class="col-md-3">
                                                <input class="form-control f-input" name="years[]" type="text">
                                            </div>
                                            <div class="col-1 pt-1">
                                                <h3>/</h3>
                                            </div>
                                            <label for="inputTerm" class="col-3 col-form-label">ภาคการศึกษา</label>
                                            <div class="col-md-3">
                                                <input class="form-control f-input" name="terms[]" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 item-center mt-4 mb-3">
                                    <input class="btn btn-dark btn-submit" type="submit" value="เพิ่มปีการศึกษา" style="background: #3956A3 !important; border: none; width: 100%">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- The Modal Section-->
                <div id="modelSection" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content modal-content-year">
                        <span class="close-section">&times;</span>
                        <div class="container" style="padding: 30px;">
                            <h3 style="float: left;">กลุ่มเรียน</h3> <button class="btn btn-default btn-add add_button_section ml-3">+ เพิ่ม</button>
                            <hr>
                            <form method="POST" action="/teacher/manage/section/store" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mt-2">
                                    {{--<label for="title" class="control-label mb-3 mr-2"style="color: black">กลุ่มเรียน</label>--}}

                                    <div class="row input_section_wrap">
                                        <div class="col-md-4">
                                            <input class="form-control f-input"  name="sections[]" type="text" style="width: 100px; height: 35px; margin-bottom: 10px">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 item-center mt-4 mb-3">
                                    <input class="btn btn-dark btn-submit" type="submit" value="เพิ่มปีการศึกษา" style="background: #3956A3 !important; border: none; width: 100%">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- The Modal Location-->
                <div id="modelLocation" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close-location">&times;</span>
                        <div class="container" style="padding: 30px;">
                            <h3 style="float: left;">สถานที่สำหรับเช็คชื่อ</h3> <button class="btn btn-default btn-add add_button_location ml-3">+ เพิ่ม</button>
                            <hr>
                            <form method="POST" action="/teacher/manage/location/store" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mt-2">
                                    {{--<label for="title" class="control-label mb-3 mr-2"style="color: black">กลุ่มเรียน</label>--}}

                                    <div class="input_location_wrap">
                                        <div class="card p-4">

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="location_name" class="pt-1">ชื่อสถานที่</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control f-input"  name="location_name[]" type="text" style="width: 100%; height: 35px; margin-bottom: 10px">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="location_latitude" class="pt-1">ละติจูด</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control f-input"  name="location_latitude[]" type="text" style="width: 100%; height: 35px; margin-bottom: 10px">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="location_longtitude" class="pt-1">ลองจิจูด</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control f-input"  name="location_longitude[]" type="text" style="width: 100%; height: 35px; margin-bottom: 10px">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-5 item-center mt-4 mb-3">
                                    <input class="btn btn-dark btn-submit" type="submit" value="เพิ่มสถานที่" style="background: #3956A3 !important; border: none; width: 100%">
                                </div>
                            </form>
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
    // Get the modal
    var modalYear = document.getElementById("modelYear");
    var modalSection = document.getElementById("modelSection");
    var modalLocation = document.getElementById("modelLocation");

    // Get the button that opens the modal
    var btnYear = document.getElementById("myBtn-year");
    var btnSection = document.getElementById("myBtn-section");
    var btnLocation = document.getElementById("myBtn-location");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var spanSection = document.getElementsByClassName("close-section")[0];
    var spanLocation = document.getElementsByClassName("close-location")[0];

    // When the user clicks on the button, open the modal
    btnYear.onclick = function() {
        modalYear.style.display = "block";
    }
    btnSection.onclick = function() {
        modalSection.style.display = "block";
    }
    btnLocation.onclick = function() {
        modalLocation.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modalYear.style.display = "none";
    }
    spanSection.onclick = function() {
        modalSection.style.display = "none";
    }
    spanLocation.onclick = function() {
        modalLocation.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modalYear) {
            modalYear.style.display = "none";
        }
        if (event.target == modalSection) {
            modalSection.style.display = "none";
        }
        if (event.target == modalLocation) {
            modalLocation.style.display = "none";
        }
    }
</script>

<script>
    $(document).ready(function() {
        var max_fields      = 6; //maximum input boxes allowed
        var wrapper_section   		= $(".input_section_wrap"); //Fields wrapper
        var add_button_section      = $(".add_button_section"); //Add button Class
        var wrapper_year   		= $(".input_year_wrap"); //Fields wrapper
        var add_button_year      = $(".add_button_year"); //Add button Class
        var wrapper_location   		= $(".input_location_wrap"); //Fields wrapper
        var add_button_location      = $(".add_button_location"); //Add button Class

        var section = 1; //initlal text box count
        var year = 1;
        var location = 1;

        if ($(add_button_section).click) {
            $(add_button_section).click(function(e){ //on add input button click
                e.preventDefault();
                if(section < max_fields){ //max input box allowed
                    section++; //text box increment
                    $(wrapper_section).append('<div class="col-md-4"><input class="form-control f-input"  name="sections[]" type="text" style="width: 100px;height: 35px;float: left; margin-bottom: 10px"><a href="#" class="remove_section ml-1 pt-1" style="float: left">X</a></div> '); //add input box
                }
            });

            $(wrapper_section).on("click",".remove_section", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        }
        if ($(add_button_year).click){
            $(add_button_year).click(function(e){ //on add input button click
                e.preventDefault();
                if(year < max_fields){ //max input box allowed
                    year++; //text box increment
                    $(wrapper_year).append('<div class="row">\n' +
                        ' <label for="inputYear" class="col-1 col-form-label">ปี</label>\n' +
                        ' <div class="col-md-3">\n' +
                        '   <input class="form-control f-input" name="years[]" type="text">\n' +
                        ' </div>\n' +
                        ' <div class="col-1 pt-1">\n' +
                        ' <h3>/</h3>\n' +
                        ' </div>\n' +
                        ' <label for="inputTerm" class="col-3 col-form-label">ภาคการศึกษา</label>\n' +
                        ' <div class="col-md-3">\n' +
                        ' <input class="form-control f-input" name="terms[]" type="text" id="title">\n' +
                        ' </div>\n' +
                        '<a href="#" class="remove_year ml-1 pt-1" style="float: left">X</a>\n' +
                        ' </div>'); //add input box
                }
            });



            $(wrapper_year).on("click",".remove_year", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); year--;
            })
        }
        if ($(add_button_location).click){
            $(add_button_location).click(function(e){ //on add input button click
                e.preventDefault();
                if(location < max_fields){ //max input box allowed
                    location++; //text box increment
                    $(wrapper_location).append('<div class="card p-4" id="card-location">'+
                        '<div class="row">'+
                        '<div class="col-md-2">'+
                        '<label for="location_name" class="pt-1">ชื่อสถานที่</label>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                        '<input class="form-control f-input"  name="location_name[]" type="text" style="width: 100%; height: 35px; margin-bottom: 10px">'+
                        '</div>'+
                        '</div>'+
                        '<div class="row">'+
                        '<div class="col-md-2">'+
                        '<label for="location_latitude" class="pt-1">ละติจูด</label>'+
                        '</div>'+
                        '<div class="col-md-4">'+
                        '<input class="form-control f-input"  name="location_latitude[]" type="text" style="width: 100%; height: 35px; margin-bottom: 10px">'+
                        '</div>'+
                        '<div class="col-md-2">'+
                        '<label for="location_longitudee" class="pt-1">ลองจิจูด</label>'+
                        '</div>'+
                        '<div class="col-md-4">'+
                        '<input class="form-control f-input"  name="location_longitude[]" type="text" style="width: 100%; height: 35px; margin-bottom: 10px">'+
                        '</div>'+
                        '</div> <hr>'+
                        '<div class="col-md-12 text-center"> <a href="#" class="remove_location ml-1 pt-1"><i class="fas fa-trash-alt mt-2" style="font-size: 18px;"></i></a>' +
                        '</div>'+
                        '</div>') //add input box
                }
            });



            $(wrapper_location).on("click",".remove_location", function(e){ //user click on remove text
                e.preventDefault(); $('#card-location').remove(); location--;
                console.log(location.val);
            })
        }


    });
</script>

</body>

</html>



{{--old ver--}}
{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<div class="container-fluid banner">--}}
    {{--</div>--}}

    {{--<div class="container-fluid">--}}
        {{--<div class="container mt-4">--}}
            {{--<h4>Your Section</h4>--}}
            {{--<a href="/teacher/section/create" class="btn btn-primary btn-submit" style="width: 150px;">--}}
                {{--Create Section--}}
            {{--</a>--}}
            {{--<a href="/teacher/assignment/create" class="btn btn-primary btn-submit" style="width: 200px;">--}}
                {{--Create Assignment--}}
            {{--</a>--}}

            {{--<hr>--}}

            {{--<h4>Assignment</h4>--}}
            {{--<div class="row">--}}
                {{--@if(count($assignments)>0)--}}
                    {{--@foreach($assignments as $assignment)--}}
                        {{--<a href="/teacher/assignment/{{ $assignment->id }}" class="cardLink col-md-3">--}}
                            {{--<div class="card card-shadow mt-3 mb-2">--}}
                                {{--<div class="card-header bg-gradient" style="border-radius: 20px 20px 0px 0px;">--}}
                                    {{--<span>Sect.</span>--}}
                                {{--</div>--}}

                                {{--<div class="card-body">--}}
                                    {{--<h5 class="card-title font-weight-bold fs-18">{{ $assignment->title }}</h5>--}}
                                    {{--<p class="card-text fs-12">Due. {{ $assignment->dueDate }} {{substr($assignment->dueTime, 0,-3)}} </p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--@endforeach--}}
                {{--@else--}}
                    {{--<div>--}}
                        {{--<p>No Assignment</p>--}}
                    {{--</div>--}}
                {{--@endif--}}

            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}
