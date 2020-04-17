@extends('layouts.app-teacher')
@section('content')
    <style>
        .nav-item > .section-active{
            color: #3956A3 !important;
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
                        <div class="col-md-12">
                            <h5><strong>งานที่มอบหมาย</strong> - กลุ่มเรียน {{ $sections->section}}</h5>
                            <span>{{ $sections->code.' '.$sections->name  }}</span>
                        </div>
                    </div>

                    <hr>
                        <div class="table-responsive-xl">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="table-head" style="width: 100px!important;">รหัสนักศึกษา</th>
                                    <th class="table-head">ชื่อ-นามสกุล</th>
                                    <th class="table-head">ไฟล์งาน</th>
                                    <th class="table-head">เกรดปัจจุบัน</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>{{ $works->student_id }}</td>
                                    <td>{{ $works->firstname.' '.$works->lastname }}</td>

                                    <td>
                                        @foreach($files as $file)
                                            {{ $file->file }} <br>
                                        @endforeach
                                    </td>

                                    <td>{{ $works->grade }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                    <div class="container mt-3 text-center col-md-8">

                        @if(($ext == 'pdf'))
                            <button class="btn-fullscreen btn btn-submit mb-3" style="width: 150px; background: #FF8574; color: white; float: right; margin-right: 120px;">ขยายเต็มจอ</button>
                            <br style="clear: both;">
                            <iframe src="/uploads/{{ $folder }}/{{ $filename }}" scrolling="no" style="width:100%; height: 600px; border: none; clear: both;">
                                <p>Your browser does not support iframes.</p>
                            </iframe>
                        @elseif(($ext == 'mp4'))
                            <video controls style="width: 100%; border: none;">
                                <source src="/uploads/{{ $folder }}/{{ $filename }}">
                            </video>
                        @else
                            <img class="item-center" src="/uploads/{{ $folder }}/{{ $filename }}"  alt="Card image cap" style="border: 2px solid #FF8574!important; width: 100%; border: none; align-items: center;">
                        @endif
                        <h6 style="color: #818182; margin: 5px;">{{ $filename }}</h6>
                        <a href="javascript:history.back()" class="btn btn-submit mt-3" style="background: white; border: 2px solid #3956A3; color: #3956A3;  width: 150px;">ย้อนกลับ</a>
                    </div>

                </div>
            </div>

        </div>
    </div>



@endsection