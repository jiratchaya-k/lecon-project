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
                            <h2 class="pageheader-title" style="float: left;">งามที่มอบหมาย</h2>
                            <div class="text-right mb-2">
                                <a href="javascript:history.back()" class="btn btn-submit" style="background: white; border: 2px solid #3956A3; color: #3956A3;  width: 150px;">ย้อนกลับ</a>
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
                    <h5 style="line-height: 2px; padding-top: 10px;">Assignment Sect. {{ $sections->section}}</h5>
                    <span>{{ $sections->code.' '.$sections->name  }}</span>
                    </div>
                    <div class="col-md-4 text-right">
                    <h4 style="color: #3956A3; padding-top: 10px;">ส่งภายใน {{ $assignment->dueDate }} {{substr($assignment->dueTime, 0,-3)}}</h4>
                    </div>
                    </div>

                    <hr>
                        <div class="row">
                            <div class="col-md-8">
                                <h2 style="color: black">{{ $assignment->title }}</h2>
                                <span style="font-size: 12px; color: #818182;">รายละเอียด</span><br>
                                <span style="font-size: 16px; color: black;">{{ $assignment-> description }}</span>

                                <?php
                                $filename = $assignment->file;
                                $ext =  substr($filename, strrpos($filename, '.' )+1);
                                //                                                    dd($ext);
                                ?>

                                @if(($assignment->file) != null)

                                    <div class="row mt-3">
                                        <figure class="col-md-4">
                                            <a href="/uploads/assignmentFiles/{{ $assignment->file }}" data-toggle="lightbox" data-gallery="gallery" data-size="1600x1067">
                                                <div class="card img-fluid" style="margin-bottom: 0; width: 150px; overflow: hidden;" >
                                                    <div class="img-square-wrapper" style="width: 100%; height: 80px; opacity: .5;" data-toggle="tooltip" data-placement="bottom" title="คลิกเพื่อดูรูป">
                                                        <?php
                                                        $filename = $assignment->file;
                                                        $ext =  substr($filename, strrpos($filename, '.' )+1);
                                                        //                                                    dd($ext);
                                                        ?>
                                                        @if($ext == 'pdf')
                                                            <iframe src="/uploads/assignmentFiles/20191204001158_artworkA1.pdf" scrolling="no" style="width: 100%; height: 100%; border: none;">
                                                                <p>Your browser does not support iframes.</p>
                                                            </iframe>
                                                        @else
                                                            <img class="" src="/uploads/assignmentFiles/{{ $assignment->file }}"  alt="Card image cap" style="width: 100%; height: 100%; border: none;">
                                                        @endif
                                                    </div>
                                                    <div class="card-body" style="padding: 5px;">
                                                        <h6 class="card-title" style="margin-bottom: 0;">{{ $assignment->file }}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </figure>
                                    </div>
                                @else

                                @endif

                                <h5 class="mt-4">Work Required</h5>
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
                            </div>
                            <div class="col-md-4">
                                <div class="card mt-3" style="border: 3px solid #FF8574; border-radius: 20px; background-color: white;">
                                    <div class="card-body text-center">
                                        <span style="font-size: 12px; color: #818182;">การแสดงเกรด</span>
                                        <h2 style="color: #3956A3; margin: 10px 0 15px 0;">{{ $showGrade }}</h2>
                                        <hr>
                                        <form method="POST" action="/teacher/assignment/{{ $assignment->id }}/update-showgrade" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row text-center">
                                                <div class="container">
                                                    <input type="hidden" id="showGrade_status" value="{{ $assignment->showGrade }}">
                                                    <select class="f-input" name="showGrade" style="width: 120px; height: 32px; padding-left: 10px; margin-right: 5px;">
                                                        <option name="show_opt[]" value="show">แสดงเกรด</option>
                                                        <option name="show_opt[]" value="hidden">ไม่แสดงเกรด</option>
                                                    </select>
                                                    <input class="btn btn-submit" type="submit" value="บันทึก" style="width: 80px;background: #3956A3; border: none; color: white">

                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if(count($allWorks) <= 0)
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <a href="/teacher/assignment/{{ $assignment->id }}/edit" class="btn btn-primary btn-dark" style="width: 200px; border-radius: 20px;">
                                        แก้ไข
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <form method="POST" action="/teacher/assignment/{{ $assignment->id }}/delete">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-primary btn-danger" onclick="return confirm('Are you sure to delete?')" style="width: 200px; border-radius: 20px;"> <i class="fas fa-trash"></i> ลบ</button>
                                    </form>
                                    {{--<a href="#" class="btn btn-primary btn-danger" style="width: 200px;">--}}
                                        {{--delete--}}
                                    {{--</a>--}}
                                </div>
                            </div>
                            {{--<hr>--}}
                        @else

                        @endif




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
                                    <th class="table-head"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($allWorks)>0)
                                    @foreach($allWorks as $work)
                                        <?php
                                        $arrayIndex = array_search($work->id, $arr_workId);
                                        ?>
                                        <tr class="click-row" data-href="/teacher/assignment/{{$assignment->title}}/index={{$arrayIndex}}/work={{ $work->id }}">

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
                                                <a href="/teacher/assignment/{{$assignment->title}}/index={{$arrayIndex}}/work={{ $work->id }}" class="btn btn-primary btn-dark bg-gradient box-shadow" style="border: none">
                                                    ให้เกรด
                                                </a>
                                                {{--<a href="#" class="ml-3">--}}
                                                    {{--<i class="fas fa-trash-alt mt-2" style="font-size: 20px;"></i>--}}
                                                {{--</a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="6" class="text-center" style="color: lightgray;">
                                            <img src="/uploads/icons/icon-no-assignment.png" alt="" style="width: 100px; opacity: .5;">
                                            <br>
                                            <span style="font-family: 'Prompt', sans-serif;">ไม่มีงานที่นักศึกษาส่ง</span>
                                        </th>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                            </div>
                        </div>

                        <!-- The Modal Section-->
                        <div id="modelImg" class="modal" style="padding-top: 90px;">

                            <!-- Modal content -->
                            <div class="modal-content modal-content-img" style="height: 90%">
                                <span class="close">&times;</span>
                                {{--<div class="container" style="padding: 30px;">--}}
                                    @if($ext == 'pdf')
                                        <iframe src="/uploads/assignmentFiles/20191204001158_artworkA1.pdf" scrolling="no" style="height: 100%; border: none;">
                                            <p>Your browser does not support iframes.</p>
                                        </iframe>
                                    @else
                                        <img class="item-center" src="/uploads/assignmentFiles/{{ $assignment->file }}"  alt="Card image cap" style="height: 100%; border: none; align-items: center;">
                                    @endif
                                {{--</div>--}}
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
    jQuery(document).ready(function($) {
        $(".click-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

<script>
    // Get the modal
    var modalImg = document.getElementById("modelImg");

    // Get the button that opens the modal
    // var btnYear = document.getElementById("myBtn-year");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];


    // When the user clicks on the button, open the modal
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        modalImg.style.display = "block";
    });
    // btnImg.onclick = function() {
    //
    // }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modalImg.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modalImg) {
            modalImg.style.display = "none";
        }
    }
</script>
<script>

    var showGrade = document.getElementById("showGrade_status");
    var show_opt = document.getElementsByName("show_opt[]");

    for (var i = 0; i < show_opt.length; i++) {
        if (showGrade.value == show_opt[i].value){
            show_opt[i].selected = true;
        }
    }

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
