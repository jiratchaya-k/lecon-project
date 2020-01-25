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
                            <a class="nav-link active" href="/teacher/assignment"><i class="fa fa-fw fa-angle-right"></i>งามที่มอบหมาย<span class="badge badge-success">6</span></a>
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
                            <h2 class="pageheader-title" style=" float: left">งามที่มอบหมาย</h2>
                            <div class="text-right mb-2">
                                <a id="myBtn" class="btn btn-primary btn-submit" style="width: 20%; color: white">
                                    เปรียบเทียบงาน
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
                    <?php
                    use Symfony\Component\Console\Input\Input;$file = json_decode($works->file);
                    $countfile = count(json_decode($works->file));
                    ?>
                    {{--<div class="container-fluid mt-10">--}}

                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close text-right">&times;</span>
                            <div class="container">
                                <h3>เปรียบเทียบงาน</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px solid gray;">
                                        @for($i = 0; $i < $countfile; $i++)
                                            <div class="card mr-3" style="width: 18rem; box-shadow: none;">
                                                <img class="card-img-top" src="/uploads/workFiles/{{ $file[$i] }}" alt="Card image cap">
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="col-md-6">

                                        <h5 style="float: left; margin-top: 5px">เปรียบเทียบกับเกรด</h5>
                                        <select class="f-input ml-2" name="grade" style="width: 100px; height: 32px; padding-left: 10px;">
                                            <option value="">เลือกเกรด</option>
                                            <option value="A">A</option>
                                            <option value="B+">B+</option>
                                            <option value="B">B</option>
                                            <option value="C+">C+</option>
                                            <option value="C">C</option>
                                            <option value="D+">D+</option>
                                            <option value="D">D</option>
                                            <option value="DELETE">DELETE</option>
                                        </select>

                                        <div id="workGrade">

                                        </div>

                                    </div>




                                </div>
                            </div>

                        </div>

                    </div>

                    <style>
                    .card-shadow:hover {
                    box-shadow: 0 5px 19px 0 rgba(0,0,0,0.1),0 10px 20px 0 rgba(0,0,0,0.1);
                    }
                    </style>

                    <div class="container-fluid">
                        <div class="container">
                            <div class="card card-shadow col-md-12 item-center mb-3">
                                <div class="card-body container">
                                    <form method="POST" action="/teacher/assignment/work={{$works->id}}/graded" enctype="multipart/form-data">
                                        @csrf
                                    <div class="table-responsive-xl">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="table-head" style="width: 100px!important;">รหัสนักศึกษา</th>
                                                <th class="table-head">ชื่อ-นามสกุล</th>
                                                <th class="table-head">ไฟล์งาน</th>
                                                <th class="table-head">เกรด</th>
                                                <th class="table-head">ให้เกรด</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>{{ $works->student_id }}</td>
                                                    <td>{{ $works->firstname.' '.$works->lastname }}</td>

                                                    <td>
                                                        @for($i = 0; $i < $countfile; $i++)
                                                            {{ $file[$i] }} <br>
                                                        @endfor
                                                    </td>

                                                    <td>{{ $works->grade }}</td>
                                                    <td>
                                                        <select class="f-input ml-2 mt-2" name="grade" style="width: 100px; height: 32px; padding-left: 10px;">
                                                            <option value="A">A</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B">B</option>
                                                            <option value="C+">C+</option>
                                                            <option value="C">C</option>
                                                            <option value="D+">D+</option>
                                                            <option value="D">D</option>
                                                            <option value="DELETE">DELETE</option>
                                                        </select>

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="container row mt-3">
                                        @for($i = 0; $i < $countfile; $i++)
                                            <div class="card mr-3" style="width: 18rem; box-shadow: none;">
                                                <img class="card-img-top" src="/uploads/workFiles/{{ $file[$i] }}" alt="Card image cap">
                                            </div>
                                        @endfor
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6 text-right">
                                                <input class="btn btn-primary btn-submit" type="submit" value="บันทึก">
                                            </div>
                                            <div class="col-md-6">
                                                <a href="/teacher/assignment/{{$works->assignment_id}}" class="btn btn-primary btn-submit" style="background: darkgray!important;">
                                                    ย้อนกลับ
                                                </a>
                                            </div>
                                        </div>
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

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script type="text/javascript">
    jQuery(document).ready(function ()
    {
        jQuery('select[name="grade"]').on('change',function(){
            var grade = jQuery(this).val();
            if(grade)
            {
                jQuery.ajax({
                    url : '/get-works/' +grade,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        console.log(data, data.length);
                        jQuery('select[name="work"]').empty();
                        $('.work_img').remove();
                        $('.work_txt').remove();
                        $('.img_box').remove();

                        if (data.length != 0){
                            $.map( data , function ( value , key) {

                                for ( var i=0; i< key.length; i++){
                                    console.log(value,key);
                                    $('#workGrade').append('<div class="card mr-2 mt-3 img_box" style="width: 15rem; box-shadow: none;">'+
                                        '<img class="card-img-top work_img"  src="/uploads/workFiles/'+ value +'" alt="Card image cap">'+'</div>');
                                }

                            });
                        } else {
                            $('#workGrade').append('<h5 class="work_txt mt-3">No Work.</h5>');
                        }

                    }
                });
            }
            else
            {
                $('select[name="work"]').empty();
            }
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
