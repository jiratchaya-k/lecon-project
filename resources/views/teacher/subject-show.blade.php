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
                            <?php $user = \Illuminate\Support\Facades\DB::table('users')->where('id','=',\Illuminate\Support\Facades\Auth::id())->first();
                            ?>
                            {{ $user->firstname.' '.$user->lastname }}
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="/teacher/subject"><i class="fa fa-fw fa-angle-right"></i></i>วิชาทั้งหมด<span class="badge badge-success">6</span></a>
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
                                <span>{{ $sections->code }} <br> {{ $sections->name }}</span>
                                <h5 class="mb-0 mt-2">กลุ่มเรียน {{ $sections->section }}
                                    วัน{{ $date }}
                                    เวลา {{substr($sections->startTime,0,-3) .' - '.substr($sections->endTime,0,-3) }}</h5>
                                <h5>
                                    @for( $i=0; $i<count($allTeacher); $i++)
                                        อาจารย์ {{ $allTeacher[$i]->firstname.' '.$allTeacher[$i]->lastname }}
                                        @if($i != count($allTeacher)-1)
                                            ,
                                        @endif
                                    @endfor
                                </h5>
                            </div>
                            <div class="col-md-4">
                                {{--<a href="/teacher/assignment/create" class="btn btn-primary btn-submit" style="width: 100%;">--}}
                                    {{--สร้าง--}}
                                {{--</a>--}}

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="card mb-3">
                                    <div class="card-body container">
                                        <div class="row">
                                            <div class="col-9">
                                                <h5 class="card-title" style="float: left">โพสต์</h5>
                                            </div>
                                            <div class="col">
                                                <button class="text-right" id="myBtn-post" style="width: 100%; background: none; border: none">
                                                    <i class="fas fa-edit" style="font-size: 16px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                        @if(count($posts)>0)
                                            @foreach($posts as $post)
                                        <h5>{{ $post->topic }}</h5>
                                            <span>{{ $post->description }}</span>
                                            <hr>
                                            @endforeach

                                        @else
                                            ไม่มีโพสต์
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-6">
                                <div class="card mb-3">
                                    <div class="card-body container">
                                        <div class="row">
                                            <div class="col-10">
                                                <h5 class="card-title" style="float: left">เนื้อหา</h5>
                                            </div>
                                            <div class="col">
                                                <button class="text-right" id="myBtn-lesson" style="width: 100%; background: none; border: none">
                                                    <i class="fas fa-edit" style="font-size: 16px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                        @if(count($lessons)>0)
                                            @foreach($lessons as $lesson)
                                                <h5>{{ $lesson->topic }}</h5>
                                                <span>{{ $lesson->description }}</span>
                                                <hr>
                                            @endforeach

                                        @else
                                            ไม่มีโพสต์
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- The Modal Post-->
                        <div id="modelPost" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content modal-content-post">
                                <span class="close">&times;</span>
                                <div class="container" style="padding: 30px;">
                                    <h3>สร้างโพสต์</h3>
                                    <hr>
                                    <form method="POST" action="/teacher/subject/section/{{$sections->sis_id}}/post/store" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group mt-3">
                                                <div class="row mb-3">
                                                    <label for="inputYear" class="col-3 col-form-label">หัวข้อ</label>
                                                    <div class="col-md">
                                                        <input class="form-control f-input" name="post_topic" type="text">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputYear" class="col-3 col-form-label">รายละเอียด</label>
                                                    <div class="col-md">
                                                        <textarea class="form-control f-input" name="post_description" id="post_description" cols="30" style="border-radius: 20px;" rows="5"></textarea>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="col-md-5 item-center mt-5 mb-3">
                                            <input class="btn btn-dark btn-submit" type="submit" value="สร้างโพสต์" style="background: #3956A3 !important; border: none; width: 100%">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>


                        <!-- The Modal Lesson -->
                        <div id="modelLesson" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content modal-content-lesson">
                                <span class="close-lesson">&times;</span>
                                <div class="container" style="padding: 20px 30px 30px 30px;">
                                    <h3>สร้างเนื้อหา</h3>
                                    <hr>
                                    <form method="POST" action="/teacher/subject/section/{{$sections->sis_id}}/lesson/store" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group mt-3">
                                            <div class="row mb-3">
                                                <label for="inputYear" class="col-3 col-form-label">หัวข้อ</label>
                                                <div class="col-md">
                                                    <input class="form-control f-input" name="lesson_topic" type="text">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputYear" class="col-3 col-form-label">รายละเอียด</label>
                                                <div class="col-md">
                                                    <textarea class="form-control f-input" name="lesson_description" cols="30" style="border-radius: 20px;" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="file" class="control-label col-3 pt-4">Upload your work</label>


                                            <div class="controls col-md">
                                                <div class="form-group item-center mt-3 ">
                                                    <div class="entry input-group item-center">
                                                        <input class="form-control f-input mb-3" name="lesson_file[]" type="file" style="float: left; border-radius: 20px">
                                                        <span class="input-group-btn ml-2" style="float: left;" >
                                <button class="btn btn-success btn-addfile">
                                  <span class="glyphicon glyphicon-plus">+</span>
                                </button>
                                </span>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>

                                        </div>

                                        <div class="col-md-5 item-center mt-5 mb-3">
                                            <input class="btn btn-dark btn-submit" type="submit" value="สร้างโพสต์" style="background: #3956A3 !important; border: none; width: 100%">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>


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
    var modalPost = document.getElementById("modelPost");
    var modalLesson = document.getElementById("modelLesson");

    // Get the button that opens the modal
    var btnPost = document.getElementById("myBtn-post");
    var btnLesson = document.getElementById("myBtn-lesson");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var spanLesson = document.getElementsByClassName("close-lesson")[0];

    // When the user clicks on the button, open the modal
    btnPost.onclick = function() {
        modalPost.style.display = "block";
    }
    btnLesson.onclick = function() {
        modalLesson.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modalPost.style.display = "none";
    }
    spanLesson.onclick = function() {
        modalLesson.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modalPost) {
            modalPost.style.display = "none";
        }
        if (event.target == modalLesson) {
            modalLesson.style.display = "none";
        }
    }
</script>

<script>

    $(function()
    {
        $(document).on('click', '.btn-addfile', function(e)
        {
            e.preventDefault();

            var controlForm = $('.controls:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-addfile')
                .removeClass('btn-addfile').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus">-</span>');
        }).on('click', '.btn-remove', function(e)
        {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
</script>
</body>

</html>
