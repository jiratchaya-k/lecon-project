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
    </style>
    <div class="container-fluid banner">
    </div>

    <div class="container-fluid">
        <div class="container mt-4">
            <div class="card card-overlap card-shadow col-md-12 item-center">
                <div class="card-body container">
                    <div class="row">
                        <div class="col-md-8">
                            <span style="font-size: 14px; color: #5e5d5d;">{{ $sections->code }} <br> {{ $sections->name }}</span>
                            <br>
                            <h6 class="mt-2">
                            อาจารย์ผู้สอน
                            @for( $i=0; $i<count($allTeacher); $i++)
                                อาจารย์ {{ $allTeacher[$i]->firstname.' '.$allTeacher[$i]->lastname }}
                                @if($i != count($allTeacher)-1)
                                    ,
                                @endif
                            @endfor
                            </h6>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0 mt-2 mb-2" style="color: #3956A3;">กลุ่มเรียน {{ $sections->section }}</h5>
                            <h6>วัน{{ $date }} <br>เวลา {{substr($sections->startTime,0,-3) .' - '.substr($sections->endTime,0,-3) }}</h6>
                            <h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="card mb-3" style="border: 3px solid #FF8574; border-radius: 20px; background-color: white;">
                                <div class="card-body container">
                                    <h5 class="card-title" style="font-weight: bolder">โพสต์</h5>
                                    <hr>
                                    @if(count($posts)>0)
                                        @foreach($posts as $post)
                                            <div class="card mb-2" style="border: 2px solid #fafafa; border-radius: 20px; background-color: #d7d7df;">
                                                <div class="card-body">
                                                    <h5 style="font-size: 16px; font-weight: bolder; margin-bottom: 5px;">{{ $post->topic }}</h5>
                                                    <h6 style="font-size: 14px; color: #818182; font-weight: normal; margin: 0;">{{ $post->description }}</h6>
                                                </div>
                                            </div>
                                        @endforeach

                                    @else
                                        ไม่มีโพสต์
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <div class="card mb-3" style="border: 3px solid #3956A3; border-radius: 20px; background-color: white;">
                                <div class="card-body container">
                                    <h5 class="card-title" style="font-weight: bolder">เนื้อหา</h5>
                                    <hr>
                                    @if(count($lessons)>0)
                                        @foreach($lessons as $lesson)
                                            <a href="/subject/section/{{$sections->sis_id}}/lesson={{ $lesson->id }}" class="lesson-box">
                                                <div class="card lesson-card mb-2" style="border: 2px solid #fafafa; border-radius: 20px; background-color: #d7d7df;">
                                                    <div class="card-body">

                                                        <h4 style="font-size: 16px; font-weight: bolder; margin-bottom: 5px;">{{ $lesson->topic }}</h4>
                                                        <h6 style="font-size: 14px; color: #818182; font-weight: normal; margin: 0;">{{ $lesson->description }}</h6>
                                                    </div>
                                                </div>
                                            </a>
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
                </div>
            </div>

        </div>
    </div>



@endsection