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
        <div class="menu-list" style="position: relative;">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav" >
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

                {{--<a href="/logout" class="btn btn-submit " style=" width:100%; background: #5e5d5d; color: white; height:40px; position: absolute; bottom: 60px; border-radius: 0;">ออกจากระบบ</a>--}}

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
                            <h2 class="pageheader-title">วิชาทั้งหมด</h2>
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
                        <div class="card box-shadow mb-4">
                            <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">
                                <span class="fs-18">
                                    {{--@foreach($code as $sub_code)--}}
                                        {{--{{ $sub_code->code }}--}}
                                    {{--@endforeach--}}
                                        {{ $subject->code }}
                                        {{ $subject->name }}</span>

                                <?php
                                    $subject_id = \Illuminate\Support\Facades\DB::table('subjects')->where('code','=',$subject->code)
                                    ->select('id')->first();
//                                    dd($subject_id);
                                 ?>
                                <a href="/teacher/subject/{{$subject_id->id}}/add-section" class="btn btn-default btn-add ml-2">+ เพิ่มกลุ่มเรียน</a>
                            </div>
                            <div class="card-body">
                                    <div class="table-responsive-xl">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="table-head">กลุ่มเรียน</th>
                                            <th class="table-head">ปีการศึกษา</th>
                                            <th class="table-head">เทอม</th>
                                            <th class="table-head" style="width: 100px!important;">ดูรายละเอียด</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php

                                        $sections = \Illuminate\Support\Facades\DB::table('subjects')
                                            ->where('name',$subject->name)
                                            ->join('sections_in_subjects as sis','sis.subject_id', '=','subjects.id')
                                            ->where('sis.status','=','active')
                                            ->join('sections','sis.section_id', '=','sections.id')
                                            ->join('years','sis.year_id', '=','years.id')
                                            ->join('attend_sections','attend_sections.sis_id','=','sis.id')
                                            ->join('users','attend_sections.user_id','=','users.id')
                                            ->where('attend_sections.user_id','=',\Illuminate\Support\Facades\Auth::id())
                                            ->where('attend_sections.status','=','active')
                                            ->orderBy('years.year','ASC')
                                            ->orderBy('years.term','ASC')
                                            ->orderBy('sections.section','ASC')
                                            ->select('sections.section', 'sis.id as sis_id','years.year','years.term')
                                            ->distinct()->get();


//                                        dd($years, $sections);

                                        ?>

                                        @if(count($sections)>0)
                                            @foreach($sections as $section)
                                                <tr>
                                                    <td>{{ $section -> section }}</td>
                                                    <td>{{ $section -> year }}</td>
                                                    <td>{{ $section -> term }}</td>
                                                    <td>
                                                        <a href="/teacher/subject/section/{{$section->sis_id}}" class="btn btn-primary btn-submit" style="background:#FF8574; width: 100%;">
                                                            ดูรายละเอียด
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                        @else
                        <div class="text-center">
                            <img src="/uploads/icons/icon-no-information.png" alt="" style="width: 100px; opacity: .5;">
                            <br>
                            <span>ไม่มีวิชาที่สร้าง</span>
                        </div>
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
</body>

</html>
