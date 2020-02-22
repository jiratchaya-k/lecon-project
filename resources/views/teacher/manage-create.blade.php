<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="/css/style-teacher.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <!-- <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css"> -->
    <!-- <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css"> -->
    <!-- <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css"> -->
    <!-- <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css"> -->
    <!-- <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css"> -->
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
                                    <div class="card-body">
                                        <div class="container">
                                        <form method="POST" action="/teacher/manage/year-term/store" enctype="multipart/form-data">
                                            @csrf

                                                    <div class="form-group mt-2">
                                                        <label for="title" class="control-label mb-3 mr-2"style="color: black">ปีการศึกษา</label>
                                                        <button class="btn btn-default btn-add add_button_year">+ เพิ่ม</button>
                                                        <div class="input_year_wrap">
                                                            <div class="row">
                                                                <label for="inputYear" class="col-1 col-form-label">ปี</label>
                                                                <div class="col-md-3">
                                                                    <input class="form-control f-input" name="years[]" type="text">
                                                                </div>
                                                                <div class="col-1 pt-1">
                                                                    <h3>/</h3>
                                                                </div>
                                                                <label for="inputTerm" class="col-4 col-form-label">ภาคการศึกษา</label>
                                                                <div class="col-md-2">
                                                                    <input class="form-control f-input" name="terms[]" type="text">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                            <div class="col-md-5 item-center mt-5 mb-3">
                                                <input class="btn btn-dark btn-submit" type="submit" value="บันทึก" style="background: #3956A3 !important; border: none; width: 100%">
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card box-shadow mb-2">
                                    <div class="card-body">
                                        <div class="container">
                                            <form method="POST" action="/teacher/manage/section/store" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group mt-2">
                                                    <label for="title" class="control-label mb-3 mr-2"style="color: black">กลุ่มเรียน</label>
                                                    <button class="btn btn-default btn-add add_button_section">+ เพิ่ม</button>
                                                    <div class="row input_section_wrap">
                                                        <div class="col-md-4">
                                                            <input class="form-control f-input"  name="sections[]" type="text" style="width: 100px; height: 35px; margin-bottom: 10px">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5 item-center mt-5 mb-3">
                                                    <input class="btn btn-dark btn-submit" type="submit" value="บันทึก" style="background: #3956A3 !important; border: none; width: 100%">
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function() {
        var max_fields      = 6; //maximum input boxes allowed
        var wrapper_section   		= $(".input_section_wrap"); //Fields wrapper
        var add_button_section      = $(".add_button_section"); //Add button Class
        var wrapper_year   		= $(".input_year_wrap"); //Fields wrapper
        var add_button_year      = $(".add_button_year"); //Add button Class

        var section = 1; //initlal text box count
        var year = 1;

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
                        ' <div class="col-md-4">\n' +
                        '   <input class="form-control f-input" name="years[]" type="text">\n' +
                        ' </div>\n' +
                        ' <div class="col-1 pt-1">\n' +
                        ' <h3>/</h3>\n' +
                        ' </div>\n' +
                        ' <label for="inputTerm" class="col-2 col-form-label">เทอม</label>\n' +
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
