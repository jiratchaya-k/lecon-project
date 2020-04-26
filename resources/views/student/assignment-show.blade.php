@extends('layouts.app')

@section('content')
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
        .mobile-box{
            display: none;
        }
        @media (min-width: 320px) and (max-width: 480px)
        {
            .banner {
                height: 180px;
                margin-top: 30px;
            }
            .card-overlap {
                top: 130px;
            }
            .due-box {
                margin-top: 5px;
                text-align: left!important;
            }
            .mobile-box{
                display: block;
            }
            .status-box{
                margin-top: 5px;
                text-align: center!important;
            }
        }
        @media (min-width: 481px) and (max-width: 767px)
        {
            .banner {
                height: 180px;
                margin-top: 30px;
            }
            .card-overlap {
                top: 130px;
            }
            .due-box {
                margin-top: 5px;
                text-align: left!important;
            }
            .status-box{
                margin-top: 5px;
                text-align: center!important;
            }
            .mobile-box{
                display: block;
            }
        }
    </style>
    <div class="container-fluid banner">
    </div>

    <div class="container-fluid">
        <div class="container mt-4">
            <div class="card card-overlap card-shadow col-md-12 item-center mb-5">
                <div class="card-body container">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <h5><strong>งานที่มอบหมาย</strong> - <br class="mobile-box"> กลุ่มเรียน {{ $sections->section}}</h5>
                            <span>{{ $sections->code.' '.$sections->name  }}</span>
                        </div>

                        <?php

                        $strYear = date("Y",strtotime($assignment->dueDate))+543;
                        $strMonth= date("n",strtotime($assignment->dueDate));
                        $strDay= date("j",strtotime($assignment->dueDate));
                        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                        $strMonthThai=$strMonthCut[$strMonth];

                        $dueDate = "$strDay $strMonthThai $strYear";

                        ?>

                        <div class="col-md-6 col-xs-12 text-right due-box">
                            <h5 style="color: #FF8574;"><span style="color: #5e5d5d; font-size: 16px;">ส่งภายใน</span> {{ $dueDate }} <br>
                                เวลา {{substr($assignment->dueTime, 0,-3)}}</h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <h3 style="color: #3956A3;">{{ $assignment->title }}</h3>
                            <span style="font-size: 12px; color: #818182;">รายละเอียด</span><br>
                            <span style="font-size: 16px; color: black;">
                                @if(!empty($assignment-> description))
                                    {{ $assignment-> description }}
                                @else
                                    -
                                @endif
                            </span>
                            <br><br>
                            @if(!empty($assignment->file))


                                <div class="row">
                                    <div class="tz-gallery">
                                    <div class="col-md-3 mt-2 mb-2">
                                        <a href="/assignment/{{$assignment->id}}/assignmentFiles={{ $assignment->file }}" class="btn lightbox" style="background-color: transparent; padding: 0;" data-toggle="tooltip" data-placement="bottom" title="คลิกเพื่อดูรูป">

                                            <div class="card img-fluid" style="margin-bottom: 0; width: 150px; overflow: hidden;" >
                                                <div class="img-square-wrapper" style="width: 100%; height: 80px; opacity: .5; overflow: hidden;">
                                                    <?php
                                                    $filename = $assignment->file;
                                                    $ext =  substr($filename, strrpos($filename, '.' )+1);
                                                    //                                                    dd($ext);
                                                    ?>
                                                    @if($ext == 'pdf')
                                                        <iframe src="/uploads/assignmentFiles/{{ $assignment->file }}" scrolling="no" style="width: 100%; border: none;">
                                                            <p>Your browser does not support iframes.</p>
                                                        </iframe>
                                                    @else
                                                        <img class="" src="/uploads/assignmentFiles/{{ $assignment->file }}"  alt="Card image cap" style="width: 100%; border: none;">
                                                    @endif
                                                </div>
                                                <div class="card-body" style="padding: 5px;">
                                                    <h6 class="card-title" style="margin-bottom: 0; font-size: 12px; color: #5e5d5d;">{{ $assignment->file }}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    </div>
                                </div>


                            @else

                            @endif
                            <h6 class="mt-4 font-weight-bold" style="color: #3956A3;">เงื่อนไขของงาน</h6>
                                <div>
                                    <span style="font-size: 12px; color: #818182;">ชื่อไฟล์</span><br>
                                    @if(empty($assignment->filename))
                                        ไม่กำหนด
                                    @else
                                        @foreach($filenames as $i=>$filename)
                                            {{ $filename }}
                                            @if($i != count($filenames)-1)
                                                <br>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <div class="mt-2">
                                    <span style="font-size: 12px; color: #818182; margin-top: 10px;">นามสกุลไฟล์</span><br>
                                    @if(empty($assignment->fileType))
                                        ไม่กำหนด
                                    @else
                                        @foreach($fileType as $type)
                                            {{ $type.' ' }}
                                        @endforeach
                                    @endif
                                </div>

                                <div class="mt-2">
                                    <span style="font-size: 12px; color: #818182; margin-top: 10px;">ขนาดของรูป (กว้าง x ยาว)</span><br>
                                    @if( $assignment->dimensionsType == '')
                                        ไม่กำหนด
                                    @else
                                        {{ $assignment->dimensions }} {{ $assignment->dimensionsType }}
                                    @endif
                                </div>


                        </div>
                        <div class="col-md-6 col-xs-12">

                            <div class="card mt-3" style="border: 3px solid #FF8574; border-radius: 20px; background-color: white;">
                                <div class="card-body">
                                    @if(!empty($assignmentWork))
                                    <div class="row">
                                        <div class="col-md-8 col-xs-12">
                                            เกรดที่ได้

                                            @if($grade != '')
                                                <span style="margin-left: 5px; color: #3956A3; font-size: 30px; font-weight: bold;">
                                                    {{ $grade }}
                                                </span>
                                            @else
                                                 <span style="font-size: 15px; color: #5e5d5d;">(ยังไม่มีเกรด)</span>
                                            @endif

                                            <br>
                                            <p style="font-size: 12px; color: #5e5d5d;">
                                                @if($assignmentWork->remark != '')
                                                    {{ ' ('.$assignmentWork->remark.')'  }}
                                                @endif
                                            </p>

                                        </div>
                                        <div class="col-md-4 col-xs-12 text-right status-box">
                                            <h6 class="btn" style="background-color: #3956A3; color: white; cursor: text;">
                                                {{ $status }}
                                            </h6>
                                        </div>
                                    </div>
                                        <p id="workStatus"></p>
                                        <div class="row">
                                            @foreach($works as $work)
                                                <div class="col-md-6">
                                                    <div class="card mb-4 box-shadow">
                                                        <a href="/assignment/{{$assignment->id}}/workFiles={{$work}}" data-toggle="tooltip" data-placement="bottom" title="คลิกเพื่อดูรูป">
                                                            <img src="/uploads/workFiles/{{$work}}" class="card-img-top" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <?php
                                        $dueDate = strtotime($assignment->dueDate);
                                        $dueTime = strtotime($assignment->dueTime);
                                        $date = strtotime(date("Y-m-d"));
                                        $time = strtotime(date("H:i:s"));
                                        ?>
                                        @if($date <= $dueDate && $time <= $dueTime)
                                            <div class="col-md-6 item-center">
                                                <button class="btn btn-primary btn-submit" id="myBtn-newwork" style="background:#FF8574; width: 100%;">
                                                    ส่งงานใหม่
                                                </button>
                                            </div>

                                        @endif
                                    @else
                                            <div class="col-md-12 text-right">
                                                <h6 class="btn" style="background-color: #3956A3; color: white;">
                                                    ยังไม่ได้ส่ง
                                                </h6>
                                            </div>

                                        <div class="text-center">
                                            <img src="/uploads/icons/icon-no-assignment.png" alt="" style="width: 100px; opacity: .5;">
                                            <br>
                                            <span>ไม่มีงานที่ส่ง</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(empty($works))
                    <form method="POST" action="/assignment/{{ $assignment->id }}/send" enctype="multipart/form-data" class="sendAssignment card mt-3">
                    @csrf

                        <div class="form-group col-md-8 item-center mt-4 text-center">
                            <label for="file" class="control-label">อับโหลดไฟล์งาน</label>
                            <input class="form-control" name="assignment_id" value="{{ $assignment->id }}" type="hidden">
                        </div>

                        <div class="controls">
                            <div class="form-group item-center mt-2 mb-3">
                                <div class="entry input-group col-md-8 item-center">
                                    <input class="form-control f-input col-md-12" name="work_file[]" type="file" style="float: left">
                                    <span class="input-group-btn ml-2" style="float: left;" >
                                <button class="btn btn-success btn-addfile">
                                  <span class="glyphicon glyphicon-plus">+</span>
                                </button>
                                </span>
                                </div>
                            </div>

                        </div>



                            <div class="col-md-3 item-center mt-2 mb-3">
                                <input class="btn btn-dark btn-submit" type="submit" value="ส่งงาน" style="background: #3956A3 !important; border: none; width: 100%">
                            </div>
                    </form>

                        @else
                        <br class="mt-5 mb-5">
                    @endif
                    <div class="text-center mb-3">
                        <a href="javascript:history.back()" class="btn btn-submit mt-4" style="background: white; border: 2px solid #3956A3; color: #3956A3; width: 150px;">ย้อนกลับ</a>
                    </div>

                </div>
            </div>

            <!-- The Modal Section-->
            <div id="modelNewWork" class="modal">
                <!-- Modal content -->
                <div class="modal-content modal-content-newwork">
                    <span class="close">&times;</span>
                    <div class="container" style="padding: 30px;">
                        <h3>ส่งงานใหม่</h3>
                        <hr>
                        <form method="POST" action="/assignment/{{ $assignment->id }}/work=update" enctype="multipart/form-data" class="sendAssignment card">
                            @csrf

                            <div class="form-group col-md-8 item-center mt-4 text-center">
                                <label for="file" class="control-label">อับโหลดไฟล์งาน</label>
                                <input class="form-control" name="assignment_id" value="{{ $assignment->id }}" type="hidden">
                            </div>

                            <div class="controls">
                                <div class="form-group item-center mt-2 mb-3">
                                    <div class="entry input-group col-md-8 item-center">
                                        <input class="form-control f-input col-md-12" name="work_file[]" type="file" style="float: left">
                                        <span class="input-group-btn ml-2" style="float: left;" >
                                <button class="btn btn-success btn-addfile">
                                  <span class="glyphicon glyphicon-plus">+</span>
                                </button>
                                </span>
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-3 item-center mt-2 mb-3">
                                <input class="btn btn-dark btn-submit" type="submit" value="ส่งงาน" style="background: #3956A3 !important; border: none; width: 100%">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        // Get the modal
        var modalNewWork = document.getElementById("modelNewWork");
        // var modalStudent = document.getElementById("modelStudent");
        // var modalLocation = document.getElementById("modelLocation");

        // Get the button that opens the modal
        var btnNewWork = document.getElementById("myBtn-newwork");
        // var btnStudent = document.getElementById("myBtn-student");
        // var btnLocation = document.getElementById("myBtn-location");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // var spanStudent = document.getElementsByClassName("close-student")[0];
        // var spanLocation = document.getElementsByClassName("close-location")[0];

        // When the user clicks on the button, open the modal
        btnNewWork.onclick = function() {
            modalNewWork.style.display = "block";
        }
        // btnStudent.onclick = function() {
        //     modalStudent.style.display = "block";
        // }
        // btnLocation.onclick = function() {
        //     modalLocation.style.display = "block";
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modalNewWork.style.display = "none";
        }
        // spanStudent.onclick = function() {
        //     modalStudent.style.display = "none";
        // }
        // spanLocation.onclick = function() {
        //     modalLocation.style.display = "none";
        // }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalNewWork) {
                modalNewWork.style.display = "none";
            }
            // if (event.target == modalStudent) {
            //     modalStudent.style.display = "none";
            // }
            // if (event.target == modalLocation) {
            //     modalLocation.style.display = "none";
            // }
        }
    </script>

    
@endsection
