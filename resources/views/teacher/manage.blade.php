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
                            พลเอก สังฆกุล
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
                            <h2 class="pageheader-title" style=" float: left">การจัดการ</h2>
                            <div class="text-right mb-2">
                                <a href="/teacher/manage/create" class="btn btn-primary btn-submit" style="width: 20%;">
                                    สร้างทั้งหมด
                                </a>
                            </div>

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
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-xl">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="table-head">ปีการศึกษา</th>
                                                    <th class="table-head">เทอม</th>
                                                    <th class="table-head">แก้ไข</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($years)>0)
                                                    @foreach($years as $year)
                                                        <tr>
                                                            <td>{{ $year->year }}</td>
                                                            <td>{{ $year->term }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-primary btn-dark btn-table" style="width: 80px;">
                                                                    edit
                                                                </a>
                                                                <a href="#" class="ml-3">
                                                                    <i class="fas fa-trash-alt mt-2" style="font-size: 20px;"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>ไม่มีข้อมูล</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-md-4">--}}
                                {{--<div class="card box-shadow mb-2">--}}
                                    {{--<div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">--}}
                                        {{--<span class="fs-18">ภาคการศึกษา</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-body">--}}
                                        {{--<div class="table-responsive-xl">--}}
                                            {{--<table class="table">--}}
                                                {{--<thead>--}}
                                                {{--<tr>--}}
                                                    {{--<th class="table-head">ภาคการศึกษา</th>--}}
                                                    {{--<th class="table-head">แก้ไข</th>--}}
                                                {{--</tr>--}}
                                                {{--</thead>--}}
                                                {{--<tbody>--}}
                                                {{--@if(count($terms)>0)--}}
                                                    {{--@foreach($terms as $term)--}}
                                                        {{--<tr>--}}
                                                            {{--<td>{{ $term->term }}</td>--}}
                                                            {{--<td>1</td>--}}
                                                            {{--<td>--}}
                                                                {{--<a href="#" class="btn btn-primary btn-danger ">--}}
                                                                    {{--delete--}}
                                                                {{--</a>--}}
                                                            {{--</td>--}}
                                                        {{--</tr>--}}
                                                    {{--@endforeach--}}
                                                {{--@endif--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-6">
                                <div class="card box-shadow mb-2">
                                    <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">
                                        <span class="fs-18">กลุ่มเรียน</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-xl">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="table-head">รหัสกลุ่มเรียน</th>
                                                    <th class="table-head">แก้ไข</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($sections)>0)
                                                    @foreach($sections as $section)
                                                <tr>
                                                    <td>{{ $section->section }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-primary btn-dark btn-table">
                                                            edit
                                                        </a>
                                                        <a href="#" class="ml-3">
                                                            <i class="fas fa-trash-alt mt-2" style="font-size: 20px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>ไม่มีข้อมูล</td>
                                                        <td></td>
                                                        <td></td>
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

                    <div class="col-md-12 mt-4">
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
