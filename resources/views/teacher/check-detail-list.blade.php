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
                            <?php use Illuminate\Support\Facades\DB;$user = \Illuminate\Support\Facades\DB::table('users')->where('id','=',\Illuminate\Support\Facades\Auth::id())->first();
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
                            <h2 class="pageheader-title">เช็คชื่อเข้าเรียน -> {{ $subject->code.' '.$subject->name }}</h2>

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

                            <div class="col-md-12">
                                <div class="card box-shadow mb-2">
                                    <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color: #3956A3; color: white;">

                                <span class="fs-18">
                                    กลุ่มเรียน {{ $subject->section }} ,
                                    @switch( $subject->date )
                                        @case('Sunday')
                                        วันอาทิยต์
                                        @break
                                        @case('Monday')
                                        วันจันทร์
                                        @break
                                        @case('Tuesday')
                                        วันอังคาร
                                        @break
                                        @case('Wednesday')
                                        วันพุธ
                                        @break
                                        @case('Thursday')
                                        วันพฤหัสบดี
                                        @break
                                        @case('Friday')
                                        วันศุกร์
                                        @break
                                        @case('Saturday')
                                        วันเสาร์
                                        @break
                                    @endswitch

                                    {{ ' - '.$check_date }}
                                </span>

                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-xl">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="table-head" style="width: 100px!important;">รหัสนักศึกษา</th>
                                                    <th class="table-head">ชื่อ-นามสกุล</th>
                                                    <th class="table-head">วันที่เช็ค</th>
                                                    <th class="table-head">เวลาที่เช็ค</th>
                                                    <th class="table-head">สถานะ</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($lists)>0)
                                                    @foreach($lists as $list)
                                                        <?php
                                                                $check_date = date('Y-m-d',strtotime($check_date));

//                                                                dd($list->id);
                                                                $std = DB::table('student_checks')->where('user_id',$list->user_id)
                                                                    ->join('section_checks','section_checks.id','=','student_checks.sectionCheck_id')
                                                                    ->where('section_checks.check_date',$check_date)
                                                                    ->first();

//                                                                dd($std);

                                                                if ($std != null){
                                                                    $check = DB::table('section_checks')->where('section_checks.check_date',$check_date)
                                                                        ->join('student_checks','student_checks.sectionCheck_id','=','section_checks.id')
                                                                        ->join('users','users.id','=','student_checks.user_id')->where('users.id',$list->user_id)
                                                                        ->select('student_checks.status as status','student_checks.created_at as std_check')
                                                                        ->first();


                                                                    $status = $check->status;
                                                                    $std_check_date = date('d M Y', strtotime($check->std_check));
                                                                    $std_check_time = date('H:i', strtotime($check->std_check));

//                                                                    dd($status,$std_check_date,$std_check_time);
                                                                }else {

                                                                    if (strtotime($check_date) < time()){
                                                                        $status = 'missed';
                                                                        $std_check_date = '-';
                                                                        $std_check_time = '-';
                                                                    }else {
                                                                        $status = '-';
                                                                        $std_check_date = '-';
                                                                        $std_check_time = '-';
                                                                    }


//                                                                    dd($status,$std_check_date,$std_check_time);
                                                                }

//                                                            dd($check);
                                                        ?>
                                                    <tr>
                                                        <td>{{ $list->student_id }}</td>
                                                        <td>{{ $list->firstname.' '.$list->lastname }}</td>
                                                        <td>{{ $std_check_date }}</td>
                                                        <td>{{ $std_check_time }}</td>
                                                        <td>
                                                            @if( $status == 'checked')
                                                                <i class="fas fa-check-circle" style="color: #00ab6c; font-size: 18px;"></i>
                                                            @elseif ( $status == 'missed')
                                                                <i class="fas fa-times-circle" style="color: firebrick; font-size: 18px;"></i>
                                                            @elseif ( $status == 'checked late')
                                                                <i class="fas fa-check-circle" style="color: sandybrown; font-size: 18px;"></i>
                                                            @elseif ( $status == 'leave')
                                                                <i class="fas fa-exclamation-circle" style="color: #f3b600; font-size: 18px;"></i>
                                                            @elseif ( $status == '-')
                                                                <i class="fas fa-minus-circle" style="color: grey; font-size: 18px;"></i>
                                                            @endif
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
