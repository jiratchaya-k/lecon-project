<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/style-teacher.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">

    <link rel="shortcut icon" href="/uploads/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/uploads/favicon.ico" type="image/x-icon">

    <title>LECON - Teacher</title>

    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">--}}
</head>

<body>

<style>
    .file-field.medium .file-path-wrapper {
        height: 3rem; }
    .file-field.medium .file-path-wrapper .file-path {
        height: 2.8rem; }

    .file-field.big-2 .file-path-wrapper {
        height: 3.7rem; }
    .file-field.big-2 .file-path-wrapper .file-path {
        height: 3.5rem; }
</style>
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
                            <a class="nav-link active" href="/teacher/subject"><i class="fa fa-fw fa-angle-right"></i>วิชาทั้งหมด<span class="badge badge-success">6</span></a>
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
                            <h2 class="pageheader-title">แก้ไขวิชาเรียน</h2>
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
                        <div class="card box-shadow mb-2">
                            <div class="card-body">
                                <form method="POST" action="/teacher/subject/section/{{ $section->sis_id }}/update" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="sis_id" value="{{ $section->sis_id }}">
                                    <div class="container row">
                                        <input type="hidden" name="subject_id" value="{{ $section->subject_id }}">
                                        <div class="form-group col-md-4">
                                            <label for="title" class="control-label">รหัสวิชา</label>
                                            <input class="form-control f-input" name="subject_code" type="text" value="{{ $section->code }}">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="title" class="control-label">ชื่อวิชา</label>
                                            <input class="form-control f-input" name="subject_name" type="text" value="{{ $section->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="control-label">ปีการศึกษา/เทอม</label>
                                        <input type="hidden" id="year_id" value="{{ $section->year_id }}">
                                        <select class="f-input ml-2 mt-2" name="subject_year" style="width: 100px; height: 32px; padding-left: 10px;">
                                            @if(count($years)>0)
                                                @foreach($years as $year)
                                                    <option name="year_opt[]" value="{{ $year->id }}">{{ $year->year }}/{{ $year->term }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="container">
                                        <label class="control-label mb-3 mr-2">กลุ่มเรียน</label>
                                        <div class="card box-shadow mb-2">
                                            <div class="card-body">
                                                <div class="form-group col-md-8">
                                                    <label class="control-label">กลุ่มเรียน</label>
                                                    <input type="hidden" id="section_id" value="{{ $section->section_id }}">
                                                    <select class="f-input ml-2 mt-2" name="subject_section" style="width: 100px; height: 32px; padding-left: 10px;">
                                                        @if(count($sections)>0)
                                                            @foreach($sections as $sect)
                                                                <option name="sect_opt[]" value="{{ $sect->id }}">{{ $sect->section }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="container row">
                                                    <div class="form-group col-md-5">
                                                        <label for="title" class="control-label">วัน</label><br>
                                                        <input type="hidden" id="date" value="{{ $section->date }}">
                                                        <select class="f-input" name="subject_date" style="width: 180px; height: 32px; padding-left: 10px;">
                                                            <option name="date_opt[]" value="Monday">จันทร์</option>
                                                            <option name="date_opt[]" value="Tuesday">อังคาร</option>
                                                            <option name="date_opt[]" value="Wednesday">พุธ</option>
                                                            <option name="date_opt[]" value="Thursday">พฤหัสบดี</option>
                                                            <option name="date_opt[]" value="Friday">ศุกร์</option>
                                                            <option name="date_opt[]" value="Saturday">เสาร์</option>
                                                            <option name="date_opt[]" value="Sunday">อาทิตย์</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-7">
                                                        <label for="title" class="control-label">เวลา</label> <br>
                                                        <input type="hidden" id="startTime" value="{{ substr($section->startTime,0,-3) }}">
                                                        <select class="f-input" name="subject_startTime" style="width: 180px; height: 32px; padding-left: 10px; float: left;">
                                                            <option name="start_opt[]" value="08:30">08:30</option>
                                                            <option name="start_opt[]" value="09:25">09:25</option>
                                                            <option name="start_opt[]" value="10:20">10:20</option>
                                                            <option name="start_opt[]" value="11:15">11:15</option>
                                                            <option name="start_opt[]" value="12:10">12:10</option>
                                                            <option name="start_opt[]" value="13:00">13:00</option>
                                                            <option name="start_opt[]" value="13:55">13:55</option>
                                                            <option name="start_opt[]" value="14:50">14:50</option>
                                                            <option name="start_opt[]" value="15:45">15:45</option>
                                                            <option name="start_opt[]" value="16:40">16:40</option>
                                                            <option name="start_opt[]" value="17:35">17:35</option>
                                                            <option name="start_opt[]" value="18:30">18:30</option>
                                                            <option name="start_opt[]" value="19:25">19:25</option>
                                                            <option name="start_opt[]" value="20:20">20:20</option>
                                                            <option name="start_opt[]" value="21:15">21:15</option>
                                                        </select>
                                                        {{--<input class="form-control f-input col-4" name="subject_startTime" type="time" style="float: left">--}}
                                                        <h4 style="float: left; margin: 0 20px; padding-top: 3px;">-</h4>
                                                        <input type="hidden" id="endTime" value="{{ substr($section->endTime,0,-3) }}">
                                                        <select class="f-input" name="subject_endTime" style="width: 180px; height: 32px; padding-left: 10px;">
                                                            <option name="end_opt[]" value="09:20">09:20</option>
                                                            <option name="end_opt[]" value="10:15">10:15</option>
                                                            <option name="end_opt[]" value="11:10">11:10</option>
                                                            <option name="end_opt[]" value="12:05">12:05</option>
                                                            <option name="end_opt[]" value="13:00">13:00</option>
                                                            <option name="end_opt[]" value="13:50">13:50</option>
                                                            <option name="end_opt[]" value="14:45">14:45</option>
                                                            <option name="end_opt[]" value="15:40">15:40</option>
                                                            <option name="end_opt[]" value="16:35">16:35</option>
                                                            <option name="end_opt[]" value="17:30">17:30</option>
                                                            <option name="end_opt[]" value="18:25">18:25</option>
                                                            <option name="end_opt[]" value="19:20">19:20</option>
                                                            <option name="end_opt[]" value="20:15">20:15</option>
                                                            <option name="end_opt[]" value="21:10">21:10</option>
                                                            <option name="end_opt[]" value="22:05">22:05</option>
                                                        </select>
                                                        {{--<input class="form-control f-input col-4" name="subject_endTime" type="time">--}}
                                                    </div>
                                                </div>

                                                <?php $user_id = \Illuminate\Support\Facades\Auth::id() ?>

                                                <div class="form-group container">
                                                    <label for="title" class="control-label">รายชื่ออาจารย์</label><button class="btn btn-default btn-add ml-2 add_button_teacher">+ เพิ่ม</button>
                                                    <div class="row input_teacher_wrap">
                                                        <input class="form-control f-input"  name="subject_createby" type="hidden" value="{{ \Illuminate\Support\Facades\Auth::id() }}">

                                                        @foreach($teachers as $teacher)
                                                        <div class="col-md-4">
                                                            <input class="form-control f-input"  name="subject_teacher[]" type="text" list="teachers" style="float: left; width: 90%; height: 35px; margin-bottom: 10px" value="{{ $teacher->firstname.' '.$teacher->lastname.' ('.$teacher->email.')' }}">
                                                            <input type="hidden" id="teacher_id" value="{{ $teacher->id }}">
                                                            <a href="#" onclick="inactive()" class="remove_teacher ml-1 pt-1" style="float: left">X</a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <datalist id="teachers">
                                                        @if(count($allTeachers)>0)
                                                            @foreach($allTeachers as $allTeacher)
                                                                <option value="{{ $allTeacher->firstname.' '.$allTeacher->lastname.' ('.$allTeacher->email.')' }}" ></option>
                                                            @endforeach
                                                        @endif
                                                    </datalist>
                                                </div>
                                                <div class="form-group container">
                                                    <label for="title" class="control-label">รายชื่อนักศึกษา</label>
                                                    <button class="btn btn-default btn-add mb-2 add_button_student">+ เพิ่ม</button>
                                                    <div class="row input_student_wrap">
                                                        @foreach( $students as $student)
                                                        <div class="col-md-4">
                                                            <input class="form-control f-input"  id="addStd" name="subject_student[]" type="text" list="students" style="float: left; width: 90%; height: 35px; margin-bottom: 10px" value="{{ $student->firstname.' '.$student->lastname.' ('.$student->email.')' }}">
                                                            <input type="hidden" id="user_id" value="{{ $student->id }}">
                                                            <a href="#" onclick="inactive()" class="remove_student ml-1 pt-1" style="float: left">X</a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <datalist id="students">

                                                        @if(count($allStudents)>0)
                                                            @foreach($allStudents as $allStudent)
                                                                <option value="{{ $allStudent->firstname.' '.$allStudent->lastname.' ('.$allStudent->email.')' }}"></option>
                                                            @endforeach
                                                        @endif
                                                    </datalist>

                                                    {{--<nav class="mt-2">--}}
                                                        {{--<div class="nav nav-tabs" id="nav-tab" role="tablist">--}}
                                                            {{--<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">แบบไฟล์</a>--}}
                                                            {{--<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">แบบรายคน</a>--}}
                                                        {{--</div>--}}
                                                    {{--</nav>--}}
                                                    {{--<div class="tab-content pt-3" id="nav-tabContent">--}}
                                                        {{--<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">--}}
                                                            {{--<input class="form-control f-input col-md-6" id="addList" type="file" name="file" accept=".csv">--}}

                                                            {{--<input type="file" name="file" accept=".csv">--}}
                                                        {{--</div>--}}
                                                        {{--<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">--}}
                                                            {{--<button class="btn btn-default btn-add mb-2 add_button_student">+ เพิ่ม</button>--}}
                                                            {{--<div class="row input_student_wrap">--}}
                                                                {{--<div class="col-md-4">--}}
                                                                    {{--<input class="form-control f-input"  id="addStd" name="subject_student[]" type="text" list="students" style="width: 90%; height: 35px; margin-bottom: 10px">--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<datalist id="students">--}}

                                                                {{--@if(count($students)>0)--}}
                                                                    {{--@foreach($students as $student)--}}
                                                                        {{--<option value="{{ $student->firstname.' '.$student->lastname.' ('.$student->email.')' }}"></option>--}}
                                                                    {{--@endforeach--}}
                                                                {{--@endif--}}
                                                            {{--</datalist>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-5 item-center mt-5 mb-3">
                                        <input class="btn btn-dark btn-submit" type="submit" value="สร้างวิชา" style="background: #3956A3 !important; border: none; width: 100%">
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

    var year_id = document.getElementById("year_id");
    var year_opt = document.getElementsByName("year_opt[]");

    for (var i = 0; i < year_opt.length; i++) {
        if (year_id.value == year_opt[i].value){
            year_opt[i].selected = true;
        }
    }
</script>
<script>
    var section_id = document.getElementById("section_id");
    var sect_opt = document.getElementsByName("sect_opt[]");

    for (var i = 0; i < sect_opt.length; i++) {
        if (section_id.value == sect_opt[i].value){
            sect_opt[i].selected = true;
        }
    }
</script>
<script>
    var date = document.getElementById("date");
    var date_opt = document.getElementsByName("date_opt[]");

    for (var i = 0; i < date_opt.length; i++) {
        if (date.value == date_opt[i].value){
            date_opt[i].selected = true;
        }
    }
</script>
<script>
    var startTime = document.getElementById("startTime");
    var start_opt = document.getElementsByName("start_opt[]");

    // console.log(start_opt[0]);

    for (var i = 0; i < start_opt.length; i++) {
        if (startTime.value == start_opt[i].value){
            start_opt[i].selected = true;
        }
    }
</script>
<script>
    var endTime = document.getElementById("endTime");
    var end_opt = document.getElementsByName("end_opt[]");

    // console.log(start_opt[0]);

    for (var i = 0; i < end_opt.length; i++) {
        if (endTime.value == end_opt[i].value){
            end_opt[i].selected = true;
        }
    }
</script>

<script>

    function inactive() {
        var user_id = document.getElementById("user_id");
        var sis_id = document.getElementById("sis_id");
        // console.log(sis_id.value);
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : '/teacher/subject/section/'+sis_id.value+/delete_user/+user_id.value,
            type : "POST",
            dataType : "json",
            success: function (data) {

            },
        })
    }

    // $('#main-menu a').click(function(event) {
    //     event.preventDefault();



</script>


<script>
    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
        });
        $('.nav-tabs a').on('shown.bs.tab', function(event){
            var active_tab = $(event.target).text();         // active tab
            var previous_tab = $(event.relatedTarget).text();  // previous tab
            //
            // console.log(y);

            var addStd = document.getElementById("addStd");
            var addList = document.getElementById("addList");

            if (active_tab == 'แบบรายคน'){
                addList.value = "";

            }else if (active_tab == 'แบบไฟล์'){
                addStd.value = null;
            }

        });
    });
</script>

<script>
    $(document).ready(function() {
        var max_fields_teacher      = 10; //maximum input boxes allowed
        var max_fields_student      = 50; //maximum input boxes allowed
        var wrapper_teacher   		= $(".input_teacher_wrap"); //Fields wrapper
        var add_button_teacher      = $(".add_button_teacher"); //Add button Class
        var wrapper_student   		= $(".input_student_wrap"); //Fields wrapper
        var add_button_student      = $(".add_button_student"); //Add button Class

        var teacher = 1; //initlal text box count
        var student = 1;

        if ($(add_button_teacher).click) {
            $(add_button_teacher).click(function(e){ //on add input button click
                e.preventDefault();
                if(teacher < max_fields_teacher){ //max input box allowed
                    teacher++; //text box increment
                    $(wrapper_teacher).append('' +
                        '<div class="col-md-4">' +
                        '<input class="form-control f-input"  name="subject_teacher[]" type="text" list="teachers" ' +
                        'style="width: 90%; height: 35px; margin-bottom: 10px; float: left">' +
                        '<a href="#" class="remove_teacher ml-1 pt-1" style="float: left">X</a></div> '); //add input box
                }
            });

            $(wrapper_teacher).on("click",".remove_teacher", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); teacher--;
            })
        }
        if ($(add_button_student).click){
            $(add_button_student).click(function(e){ //on add input button click
                e.preventDefault();
                if(student < max_fields_student){ //max input box allowed
                    student++; //text box increment
                    $(wrapper_student).append('' +
                        '<div class="col-md-4">' +
                        '<input class="form-control f-input" name="subject_student[]" type="text" list="students" ' +
                        'style="width: 90%; height: 35px; margin-bottom: 10px; float: left">' +
                        '<a href="#" class="remove_student ml-1 pt-1" style="float: left">X</a></div> '); //add input box
                }
            });



            $(wrapper_student).on("click",".remove_student", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); student--;
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
