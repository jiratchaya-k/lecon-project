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
                            <a class="nav-link" href="/teacher/subject"><i class="fa fa-fw fa-angle-right"></i></i>วิชาทั้งหมด<span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="/teacher/student-check"><i class="fa fa-fw fa-angle-right"></i>เช็คชื่อนักศึกษา<span class="badge badge-success">6</span></a>
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
                            <h2 class="pageheader-title">เช็คชื่อเข้าเรียน</h2>

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
                    @if(count($subjects)>0)
                        @foreach($subjects as $subject)
                            <div class="col-md-12">
                                <div class="card box-shadow mb-2">
                                    <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">
                                <span class="fs-18">
                                    {{ $subject->code }}
                                    {{ $subject->name }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-xl">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="table-head">กลุ่มเรียน</th>
                                                    <th class="table-head">วัน</th>
                                                    <th class="table-head">เวลา</th>
                                                    <th class="table-head">วันที่เช็คชื่อ</th>
                                                    <th class="table-head"> </th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                $sections = \Illuminate\Support\Facades\DB::table('subjects')
                                                    ->where('name',$subject->name)
                                                    ->join('sections_in_subjects as sis','sis.subject_id', '=','subjects.id')
                                                    ->join('sections','sis.section_id', '=','sections.id')
                                                    ->join('attend_sections','attend_sections.sis_id','=','sis.id')
                                                    ->join('users','attend_sections.user_id','=','users.id')
                                                    ->where('attend_sections.user_id','=',\Illuminate\Support\Facades\Auth::id())
                                                    ->select('sections.section','sis.date','sis.startTime','sis.endTime')->get();

//                                                dd($sections);


                                                ?>

                                                @if(count($sections)>0)
                                                    @foreach($sections as $section)
                                                        <form method="POST" action="/teacher/student-check/get-qrcode" enctype="multipart/form-data">
                                                            @csrf
                                                        <tr>
                                                            <td>{{ $section->section }}</td>

                                                            @switch( $section->date )
                                                                @case('Sunday')
                                                                    <td>อาทิยต์</td>
                                                                @break
                                                                @case('Monday')
                                                                    <td>จันทร์</td>
                                                                @break
                                                                @case('Tuesday')
                                                                    <td>อังคาร</td>
                                                                @break
                                                                @case('Wednesday')
                                                                    <td>พุธ</td>
                                                                @break
                                                                @case('Thursday')
                                                                    <td>พฤหัสบดี</td>
                                                                @break
                                                                @case('Friday')
                                                                    <td>ศุกร์</td>
                                                                @break
                                                                @case('Saturday')
                                                                    <td>เสาร์</td>
                                                                @break
                                                            @endswitch


                                                            {{--<td>{{ $section->date }}</td>--}}
                                                            <td>{{substr($section->startTime,0,-3) .' - '.substr($section->endTime,0,-3) }}</td>
                                                            <td>
                                                                <div class="form-group mt-2">
                                                                    <input class="form-control f-input" name="check_date" type="date" id="date">
                                                                    <input class="form-control f-input" name="check_name" type="hidden" value="{{$subject->name}}">
                                                                    <input class="form-control f-input" name="check_code" type="hidden" value="{{$subject->code}}">
                                                                    <input class="form-control f-input" name="check_section" type="hidden" value="{{$section->section}}">
                                                                    <input class="form-control f-input" name="check_time" type="hidden" value="{{substr($section->startTime,0,-3) .' - '.substr($section->endTime,0,-3) }}">
                                                                    <input class="form-control f-input" name="check_dedate" type="hidden" value="{{$section->date}}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input class="btn btn-primary btn-submit" style="width: 100%" type="submit" value="บันทึก">
                                                                {{--<a href="/teacher/student-check/get-qrcode" class="btn btn-primary btn-submit" style="width: 100%">--}}
                                                                    {{--สร้าง QR CODE--}}
                                                                {{--</a>--}}
                                                            </td>
                                                        </tr>
                                                        </form>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
