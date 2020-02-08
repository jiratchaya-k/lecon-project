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
                            <a class="nav-link" href="/teacher/subject"><i class="fa fa-fw fa-angle-right"></i></i>วิชาทั้งหมด<span class="badge badge-success">6</span></a>
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
                            <h2 class="pageheader-title">งามที่มอบหมาย</h2>
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
                    <style>
                    .card-shadow:hover {
                    box-shadow: 0 5px 19px 0 rgba(0,0,0,0.1),0 10px 20px 0 rgba(0,0,0,0.1);
                    }
                    </style>

                    <div class="container-fluid">
                    <div class="container">
                    <div class="card card-shadow col-md-12 item-center mb-3">
                    <div class="card-body container">
                    <div class="row">
                    <div class="col-md-8">
                    <h5>Assignment Sect. {{ $sections->section}}</h5>
                    <span>{{ $sections->code.' '.$sections->name  }}</span>
                    </div>
                    <div class="col-md-4 text-right">
                    <h5 class="text-green">Due. {{ $assignment->dueDate }} {{substr($assignment->dueTime, 0,-3)}}</h5>
                    </div>
                    </div>

                    <hr>
                    <h3>{{ $assignment->title }}</h3>
                    <span>{{ $assignment-> description }}</span>

                    <h5>Work Required</h5>
                    <p>File Type :
                    @if(empty($assignment->fileType))
                    None
                    @else
                    @foreach($fileType as $type)
                    {{ $type.' ' }}
                    @endforeach
                    @endif
                    <br>
                    Dimentions :
                    @if( $assignment->dimensions == '')
                    None
                    @else
                    {{ $assignment->dimensions }} {{ $assignment->dimensionsType }}
                    @endif

                    </p>

                    <div class="row">
                    <div class="col-md-6 text-right">
                    <a href="#" class="btn btn-primary btn-dark" style="width: 200px;">
                    edit
                    </a>
                    </div>
                    <div class="col-md-6">
                    <a href="#" class="btn btn-primary btn-danger" style="width: 200px;">
                    delete
                    </a>
                    </div>
                    </div>

                    <hr>


                    </div>
                    </div>

                        <div class="card card-shadow col-md-12 item-center mb-5">
                            <div class="card-body container">

                        <div class="table-responsive-xl">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="table-head" style="width: 100px!important;">รหัสนักศึกษา</th>
                                    <th class="table-head">ชื่อ-นามสกุล</th>
                                    <th class="table-head">ไฟล์งาน</th>
                                    <th class="table-head">เกรด</th>
                                    <th class="table-head">แก้ไข</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($allWorks)>0)
                                    @foreach($allWorks as $work)
                                        <tr class="click-row" data-href="/teacher/assignment/{{$assignment->title}}/work={{ $work->id }}">

                                            <td>{{$work->student_id}}</td>
                                            <td>{{$work->firstname.' '.$work->lastname}}</td>

                                         <?php
                                                $files = \Illuminate\Support\Facades\DB::table('files')->where('work_id','=',$work->id)
                                                    ->get();



                                           ?>
                                            <td>
                                                @foreach($files as $file)

                                                    {{ $file->file }}
                                                @endforeach
                                            </td>

                                            <td>
                                                @if($work->grade != null)
                                                    {{$work->grade}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/teacher/assignment/{{$assignment->title}}/work={{ $work->id }}" class="btn btn-primary btn-dark bg-gradient box-shadow" style="border: none">
                                                    ให้เกรด
                                                </a>
                                                <a href="#" class="ml-3">
                                                    <i class="fas fa-trash-alt mt-2" style="font-size: 20px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>ยังไม่มีงานที่ส่ง</td>
                                        <td></td>
                                        <td></td>
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
                    {{--<div class="row">--}}
                    {{--@if(count($assignments)>0)--}}
                    {{--@foreach($assignments as $assignment)--}}
                    {{--<a href="/assignment/{{ $assignment->id }}" class="cardLink col-md-3">--}}
                    {{--<div class="card card-shadow  mt-3 mb-2">--}}
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
    jQuery(document).ready(function($) {
        $(".click-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
</body>

</html>



{{--@extends('layouts.app-teacher')--}}

{{--@section('content')--}}
    {{--<style>--}}
        {{--.card-shadow:hover {--}}
            {{--box-shadow: 0 5px 19px 0 rgba(0,0,0,0.1),0 10px 20px 0 rgba(0,0,0,0.1);--}}
        {{--}--}}
    {{--</style>--}}
    {{--<div class="container-fluid banner">--}}
    {{--</div>--}}

    {{--<div class="container-fluid">--}}
        {{--<div class="container mt-4">--}}
            {{--<div class="card card-overlap card-shadow col-md-12 item-center mb-5">--}}
                {{--<div class="card-body container">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-8">--}}
                            {{--<h5>Assignment Sect. {{ $sections[0]->section}}</h5>--}}
                            {{--<span>{{ $sections[0]->code.' '.$sections[0]->name  }}</span>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 text-right">--}}
                            {{--<h5 class="text-green">Due. {{ $assignment->dueDate }} {{substr($assignment->dueTime, 0,-3)}}</h5>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<hr>--}}
                    {{--<h3>{{ $assignment->title }}</h3>--}}
                    {{--<span>{{ $assignment-> description }}</span>--}}

                    {{--<h5>Work Required</h5>--}}
                    {{--<p>File Type :--}}
                        {{--@if(empty($assignment->fileType))--}}
                            {{--None--}}
                        {{--@else--}}
                            {{--@foreach($fileType as $type)--}}
                                {{--{{ $type.' ' }}--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                        {{--<br>--}}
                        {{--Dimentions :--}}
                        {{--@if( $assignment->dimensionsType == '')--}}
                            {{--None--}}
                        {{--@else--}}
                            {{--{{ $assignment->dimensions }} {{ $assignment->dimensionsType }}--}}
                        {{--@endif--}}

                    {{--</p>--}}

                    {{--<div class="row">--}}
                        {{--<div class="col-md-6 text-right">--}}
                            {{--<a href="#" class="btn btn-primary btn-dark" style="width: 200px;">--}}
                                {{--edit--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<a href="#" class="btn btn-primary btn-danger" style="width: 200px;">--}}
                                {{--delete--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<hr>--}}
                    {{--<div class="table-responsive-xl">--}}
                        {{--<table class="table">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th class="table-head">รหัสนักศึกษา</th>--}}
                                {{--<th class="table-head">ชื่อ-นามสกุล</th>--}}
                                {{--<th class="table-head">ไฟล์งาน</th>--}}
                                {{--<th class="table-head">เกรด</th>--}}
                                {{--<th class="table-head">แก้ไข</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@if(count($allWorks)>0)--}}
                                {{--@foreach($allWorks as $work)--}}
                                    {{--<tr class="click-row" data-href="/teacher/assignment/work/{{$work->id}}">--}}
                                        {{--<td>{{$work->student_id}}</td>--}}
                                        {{--<td>{{$work->firstname.' '.$work->lastname}}</td>--}}
                                        {{--<td>{{$work->file}}</td>--}}
                                        {{--<td>{{$work->grade}}</td>--}}
                                        {{--<td>--}}
                                            {{--<a href="" class="btn btn-primary btn-dark btn-table">--}}
                                                {{--edit--}}
                                            {{--</a>--}}
                                            {{--<a href="#" class="ml-3">--}}
                                                {{--<i class="fas fa-trash-alt mt-2" style="font-size: 20px;"></i>--}}
                                            {{--</a>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{--<tr>--}}
                                    {{--<td>ยังไม่มีงานที่ส่ง</td>--}}
                                    {{--<td></td>--}}
                                    {{--<td></td>--}}
                                    {{--<td></td>--}}
                                    {{--<td></td>--}}
                                {{--</tr>--}}
                            {{--@endif--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}


                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}

{{--@endsection--}}
