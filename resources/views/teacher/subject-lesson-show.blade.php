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
                            <h5><strong>เนื้อหา</strong> - กลุ่มเรียน {{ $sections->section}}</h5>
                            <span>{{ $sections->code.' '.$sections->name  }}</span>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="javascript:history.back()" class="btn btn-submit mt-3" style="background: white; border: 2px solid #3956A3; color: #3956A3;  width: 150px;">ย้อนกลับ</a>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="color: black">{{ $lesson->topic }}</h2>
                            <span style="font-size: 12px; color: #818182;">รายละเอียด</span><br>
                            <span style="font-size: 16px; color: black;">{{ $lesson-> description }}</span>
                        </div>

                            @if(($lesson->file) != null)

                                <div class="row container mt-3">
                                    @foreach($files as $file)
                                    <figure class="col-md-2 col-sm-6">
                                        <a href="/teacher/subject/section/{{ $sections->sis_id }}/lesson={{ $lesson->id }}/{{ $file }}" data-toggle="lesson_file" data-gallery="gallery" data-size="1600x1067">
                                            <input type="hidden" name="name[]" value="{{ $file }}">
                                            <div class="card img-fluid" style="margin-bottom: 0; width: 150px; overflow: hidden;" >
                                                <div class="img-square-wrapper" style="width: 100%; height: 80px; opacity: .5;">
                                                    <?php
                                                    $filename = $file;
                                                    $ext =  substr($filename, strrpos($filename, '.' )+1);
                                                    //                                                    dd($ext);
                                                    ?>
                                                    @if(($ext == 'pdf') || ($ext == 'mp4'))
                                                        <iframe src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $file }}" scrolling="no" style="width: 100%; height: 100%; border: none;">
                                                            <p>Your browser does not support iframes.</p>
                                                        </iframe>
                                                    @else
                                                        <img class="" src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $file }}"  alt="Card image cap" style="width: 100%; height: 100%; border: none;">
                                                    @endif
                                                </div>
                                                <div class="card-body" style="padding: 5px;">
                                                    <h6 class="card-title" style="margin-bottom: 0; font-size: 12px; color: #818182;">{{ $file }}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </figure>
                                    @endforeach
                                </div>
                            @else

                            @endif
                        @if($lesson->user_id == \Illuminate\Support\Facades\Auth::id())
                        <div class="row item-center mt-3">
                            <div class="col-md-6 text-right">
                                <a href="/teacher/subject/section/{{ $sections->sis_id }}/lesson/{{ $lesson->id }}/edit" class="btn btn-primary btn-dark" style="width: 200px; border-radius: 20px;">
                                    แก้ไข
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="/teacher/subject/section/{{ $sections->sis_id }}/lesson/{{ $lesson->id }}/delete">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-primary btn-danger" onclick="return confirm('Are you sure to delete?')" style="width: 200px; border-radius: 20px;"> <i class="fas fa-trash"></i> ลบ</button>
                                </form>
                                {{--<a href="#" class="btn btn-primary btn-danger" style="width: 200px;">--}}
                                {{--delete--}}
                                {{--</a>--}}
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- The Modal Section-->
            <div id="modelImg" class="modal" style="padding-top: 90px;">

                <!-- Modal content -->
                <div class="modal-content modal-content-img" style="height: 90%">
                    <span class="close">&times;</span>
                    <input type="hidden" class="filename" value="">
                    {{--<div class="container" style="padding: 30px;">--}}
                    @if(($ext == 'pdf') || ($ext == 'mp4'))
                        <iframe src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $file }}" scrolling="no" style="height: 100%; border: none;">
                            <p>Your browser does not support iframes.</p>
                        </iframe>
                    @else
                        <img class="item-center" src="/uploads/LessonFiles/{{$lesson->sis_id}}/{{ $file }}"  alt="Card image cap" style="height: 100%; border: none; align-items: center;">
                    @endif
                    {{--</div>--}}
                </div>
            </div>


        </div>
    </div>



@endsection