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
        .mobile-box{
            display: none;
        }
        .desk-box {
            display: block;
        }
        @media (min-width: 320px) and (max-width: 480px)
        {
            .banner {
                height: 180px;
                margin-top: 30px;
            }
            .mobile-box{
                display: block;
            }
            .desk-box {
                display: none;
            }
        }
        @media (min-width: 481px) and (max-width: 767px)
        {
            .banner {
                height: 180px;
                margin-top: 30px;
            }
            .mobile-box{
                display: block;
            }
            .desk-box {
                display: none;
            }
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
                            <h2 class="pageheader-title">แก้ไขโพสต์</h2>
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
        <div class="container">
            <div class="card box-shadow mb-2">
                <div class="card-body">
                    <div class="container desk-box" style="padding: 30px;">
                        <form method="POST" action="/teacher/subject/section/{{ $post->sis_id }}/post/{{ $post->id }}/update" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mt-3">
                                <div class="row mb-3">
                                    <label for="inputYear" class="col-md-3 col-xs-12 col-12 col-form-label">หัวข้อ</label>
                                    <div class="col-md">
                                        <input class="form-control f-input" name="post_topic" type="text" value="{{ $post->topic }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputYear" class="col-md-3 col-xs-12 col-12 col-form-label">รายละเอียด</label>
                                    <div class="col-md">
                                        <textarea class="form-control f-input" name="post_description" id="post_description" cols="30" style="border-radius: 20px; text-align: left;" rows="5">{{ $post->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 item-center mt-5 mb-3">
                                <input class="btn btn-dark btn-submit" type="submit" value="บันทึก" style="background: #3956A3 !important; border: none; width: 100%">
                            </div>
                        </form>
                    </div>

                    <div class="mobile-box">
                        <form method="POST" action="/teacher/subject/section/{{ $post->sis_id }}/post/{{ $post->id }}/update" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mt-3">
                                <div class="row mb-3">
                                    <label for="inputYear" class="col-md-3 col-xs-12 col-12 col-form-label">หัวข้อ</label>
                                    <div class="col-md">
                                        <input class="form-control f-input" name="post_topic" type="text" value="{{ $post->topic }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputYear" class="col-md-3 col-xs-12 col-12 col-form-label">รายละเอียด</label>
                                    <div class="col-md">
                                        <textarea class="form-control f-input" name="post_description" id="post_description" cols="30" style="border-radius: 20px; text-align: left;" rows="5">{{ $post->description }}</textarea>
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

    var types = document.getElementsByName("type[]");
    var auto_filetype = document.getElementById("auto-fileType");

    console.log(auto_filetype.value);

    for (var x =0; x < types.length;x++) {
        if ((types[x].value == null) || (types[x].value == "")) {
            $('#toggle-fileType').prop('checked', false);
            $('#fileType-box').hide();
        }
        else {
            $('#toggle-fileType').prop('checked', true);

            // console.log(types.length);

            for (var i = 0; i < types.length; i++) {
                // console.log(types[i].value);

                if (types[i].value == "jpg") {
                    $('#type_jpg').prop('checked', true)
                } else if (types[i].value == "png") {
                    $('#type_png').prop('checked', true)
                } else if (types[i].value == "gif") {
                    $('#type_gif').prop('checked', true)
                } else if (types[i].value == "pdf") {
                    $('#type_pdf').prop('checked', true)
                } else if (types[i].value == "mp4") {
                    $('#type_mp4').prop('checked', true)
                }

            }

            if (auto_filetype.value == 1) {
                $('#autoGrade-fileType').prop('checked', true)
            } else {
                $('#autoGrade-fileType').prop('checked', false)
            }

        }
    }

</script>

<script>

    var dimension = document.getElementById("dimensionsWidth");
    var auto_dimension = document.getElementById("auto-dimension");


    console.log(auto_dimension.value);

        if ((dimension.value == null) || (dimension.value == "")) {
            $('#toggle-dimensions').prop('checked', false);
            $('#dimensions-box').hide();
        }
        else {
            $('#toggle-dimensions').prop('checked', true);

            // console.log(types.length);


            if (auto_dimension.value == 1) {
                $('#autoGrade-dimensions').prop('checked', true)
            } else {
                $('#autoGrade-dimensions').prop('checked', false)
            }

        }

</script>

<script>

    var sis_id = document.getElementById("sis_id");
    var sect_opt = document.getElementsByName("sect_opt[]");

    for (var i = 0; i < sect_opt.length; i++) {
        if (sis_id.value == sect_opt[i].value){
            sect_opt[i].selected = true;
        }
    }

</script>



<script>
    $(function() {
        $('#toggle-event').change(function() {
            if ($(this).is(":checked")) {
                $('#wr-box').show();
            } else {
                $('#wr-box').hide();
                $('#toggle-fileType').prop('checked', false);
                $('#autoGrade-fileType').prop('checked', false);
                $('#autoGrade-dimensions').prop('checked', false);
                $('#fileType-box').hide();
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);

                $('#toggle-dimensions').prop('checked', false);
                $('#dimensions-box').hide();
                $('#dimensionsType').val('null');
                $('#dimensionsWidth').val(null);
                $('#dimensionsHeight').val(null);

            }

        })

        $('#toggle-fileType').change(function() {
            if ($(this).is(":checked")) {
                $('#fileType-box').show();
            } else {
                $('#fileType-box').hide();
                $('#autoGrade-fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);
                $('.fileType').prop('checked', false);

            }

        })

        $('#toggle-dimensions').change(function() {
            if ($(this).is(":checked")) {
                $('#dimensions-box').show();
            } else {
                $('#autoGrade-dimensions').prop('checked', false);
                $('#dimensions-box').hide();
                $('#dimensionsType').val('null');
                $('#dimensionsWidth').val(null);
                $('#dimensionsHeight').val(null);

            }

        })

    })
</script>
</body>

</html>
