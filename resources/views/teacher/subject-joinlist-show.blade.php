@extends('layouts.app-teacher')
@section('content')
    <style>
        .nav-item > .home-active{
            color: white !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
    <style>
        .card-shadow:hover {
            box-shadow: 0 5px 19px 0 rgba(0,0,0,0.1),0 10px 20px 0 rgba(0,0,0,0.1);
        }
        .entry:not(:first-of-type)
        {
            margin-top: 10px;
        }

        .glyphicon
        {
            font-size: 18px;
        }
    </style>
    <div class="container-fluid banner">
    </div>

    <div class="container-fluid">
        <div class="container mt-4">
            <div class="card card-overlap card-shadow col-md-12 item-center mb-5">
                <div class="card-body container">
                    <div class="row">
                        <div class="col-md-8">
                            <h5><strong>รายชื่อผู้เข้าร่วม</strong> - กลุ่มเรียน {{ $sections->section}}</h5>
                            <span>{{ $sections->code.' '.$sections->name  }}</span>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="javascript:history.back()" class="btn btn-submit mt-3" style="background: white; border: 2px solid #3956A3; color: #3956A3;  width: 150px;">ย้อนกลับ</a>
                        </div>
                    </div>

                    <hr>

                    <h6 style="font-weight: bold; color: #3956A3; margin: 10px 0; float: left;">รายชื่อผู้สอน</h6><button class="btn btn-default btn-add mt-2 ml-2" id="myBtn-teacher" style="color: #222222;">+ เพิ่ม</button>
                    <div class="row mt-3" style="clear: both;">
                        @foreach($teachers as $teacher)
                        <div class="col-md-4">
                            <div class="card" style="width: 100%; border: 2px solid #454cad; border-radius: 20px; background-color: white;">
                                <div class="card-body" style="padding-bottom: 0px;">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="/uploads/profileImage/{{ $teacher->profile_img }}" alt="Avatar" style="width: 50px;border-radius: 50%;">
                                        </div>
                                        <div class="col-md-9">
                                            <h6 class="card-title" style="font-weight: bolder;">
                                                {{ $teacher->firstname.' '.$teacher->lastname }}
                                            </h6>
                                            <p class="card-text" style="font-size: 14px; color: #5e5d5d; margin-top: -10px;">{{ $teacher->email }}</p>
                                        </div>
                                    </div>
                                    <hr style="margin-bottom: 0px;">
                                    <div class="text-center">
                                        <form method="POST" action="/teacher/subject/section/{{ $sections->id }}/join-list/user_id={{ $teacher->id }}/delete">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn" onclick="return confirm('Are you sure to delete?')" style="background-color: transparent; padding-left: 0; padding-right: 0;"> <i class="fas fa-trash-alt mt-2" data-toggle="tooltip" data-placement="bottom" title="ลบ" style="font-size: 18px; color: #818182;"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr>
                    <h6 style="font-weight: bold; color: #FF8574; margin: 10px 0; float: left;">รายชื่อนักศึกษา</h6><button class="btn btn-default btn-add mt-2 ml-2" id="myBtn-student" style="color: #222222;">+ เพิ่ม</button>
                    <div class="row mt-3" style="clear: both;">
                        @foreach($students as $student)
                            <div class="col-md-4">
                                <div class="card" style="width: 100%; border: 2px solid #FF8574; border-radius: 20px; background-color: white;">
                                    <div class="card-body" style="padding-bottom: 0px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="/uploads/profileImage/{{ $student->profile_img }}" alt="Avatar" style="width: 50px;border-radius: 50%;">
                                            </div>
                                            <div class="col-md-9">
                                                <span class="card-title" style="font-size: 13px; font-weight: bold; color: #5e5d5d;">
                                                    {{ $student->student_id }}
                                                </span>
                                                <h6 class="card-title" style="font-weight: bolder;">
                                                    {{ $student->firstname.' '.$student->lastname }}
                                                </h6>
                                                <p class="card-text" style="font-size: 14px; color: #5e5d5d; margin-top: -10px;">{{ $student->email }}</p>
                                            </div>
                                        </div>
                                        <hr style="margin-bottom: 0px;">
                                        <div class="text-center">
                                            <form method="POST" action="/teacher/subject/section/{{ $sections->id }}/join-list/user_id={{ $student->id }}/delete">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn" onclick="return confirm('Are you sure to delete?')" style="background-color: transparent; padding-left: 0; padding-right: 0;"> <i class="fas fa-trash-alt mt-2" data-toggle="tooltip" data-placement="bottom" title="ลบ" style="font-size: 18px; color: #818182;"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>

            <!-- The Modal Section-->
            <div id="modelTeacher" class="modal">
                <!-- Modal content -->
                <div class="modal-content modal-content-teacher">
                    <span class="close">&times;</span>
                    <div class="container" style="padding: 30px;">
                        <h3 style="float: left;">เพิ่มรายชื่ออาจารย์</h3> <button class="btn btn-default btn-add ml-2 add_button_teacher">+ เพิ่ม</button>
                        <hr>
                        <form method="POST" action="/teacher/subject/section/{{ $sections->id }}/join-list/add" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <div class="row input_teacher_wrap">
                                <input class="form-control f-input"  name="subject_createby" type="hidden" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                    <div class="col-md-6">
                                        <input class="form-control f-input"  name="subject_teacher[]" type="text" list="teachers" style="float: left; width: 90%; height: 35px; margin-bottom: 10px" value="">
                                    </div>
                            </div>
                            <datalist id="teachers">
                                @if(count($allTeachers)>0)
                                    @foreach($allTeachers as $allTeacher)
                                        <option value="{{ $allTeacher->firstname.' '.$allTeacher->lastname.' ('.$allTeacher->email.')' }}" ></option>
                                    @endforeach
                                @endif
                            </datalist>
                        </div>
                            <div class="col-md-5 item-center mt-4 mb-3">
                                <input class="btn btn-dark btn-submit" type="submit" value="เพิ่ม" style="background: #3956A3 !important; border: none; width: 100%">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- The Modal Student-->
            <div id="modelStudent" class="modal">
                <!-- Modal content -->
                <div class="modal-content modal-content-student">
                    <span class="close close-student">&times;</span>
                    <div class="container" style="padding: 30px;">
                        <h3 style="float: left;">เพิ่มรายชื่อนักศึกษา</h3> <button class="btn btn-default btn-add ml-2 add_button_student">+ เพิ่ม</button>
                        <hr>
                        <form method="POST" action="/teacher/subject/section/{{ $sections->id }}/join-list/add" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <div class="row input_student_wrap">
                                <div class="col-md-6">
                                    <input class="form-control f-input"  name="subject_student[]" type="text" list="teachers" style="float: left; width: 90%; height: 35px; margin-bottom: 10px" value="">
                                </div>
                            </div>
                            <datalist id="teachers">
                                @if(count($allStudents)>0)
                                    @foreach($allStudents as $allStudent)
                                        <option value="{{ $allStudent->firstname.' '.$allStudent->lastname.' ('.$allStudent->email.')' }}" ></option>
                                    @endforeach
                                @endif
                            </datalist>
                        </div>
                            <div class="col-md-5 item-center mt-4 mb-3">
                                <input class="btn btn-dark btn-submit" type="submit" value="เพิ่ม" style="background: #3956A3 !important; border: none; width: 100%">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Get the modal
        var modalTeacher = document.getElementById("modelTeacher");
        var modalStudent = document.getElementById("modelStudent");
        // var modalLocation = document.getElementById("modelLocation");

        // Get the button that opens the modal
        var btnTeacher = document.getElementById("myBtn-teacher");
        var btnStudent = document.getElementById("myBtn-student");
        // var btnLocation = document.getElementById("myBtn-location");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var spanStudent = document.getElementsByClassName("close-student")[0];
        // var spanLocation = document.getElementsByClassName("close-location")[0];

        // When the user clicks on the button, open the modal
        btnTeacher.onclick = function() {
            modalTeacher.style.display = "block";
        }
        btnStudent.onclick = function() {
            modalStudent.style.display = "block";
        }
        // btnLocation.onclick = function() {
        //     modalLocation.style.display = "block";
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modalTeacher.style.display = "none";
        }
        spanStudent.onclick = function() {
            modalStudent.style.display = "none";
        }
        // spanLocation.onclick = function() {
        //     modalLocation.style.display = "none";
        // }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalTeacher) {
                modalTeacher.style.display = "none";
            }
            if (event.target == modalStudent) {
                modalStudent.style.display = "none";
            }
            // if (event.target == modalLocation) {
            //     modalLocation.style.display = "none";
            // }
        }
    </script>


@endsection