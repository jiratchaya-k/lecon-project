@extends('layouts.app-teacher')

@section('content')
    <style>
        .card-shadow:hover {
            box-shadow: 0 5px 19px 0 rgba(0,0,0,0.1),0 10px 20px 0 rgba(0,0,0,0.1);
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
                            <h5>Assignment Sect. {{ $sections[0]->section}}</h5>
                            <span>{{ $sections[0]->code.' '.$sections[0]->name  }}</span>
                        </div>
                        <div class="col-md-4 text-right">
                            <h5 class="text-green">Due. {{ $assignment->dueDate }} {{substr($assignment->dueTime, 0,-3)}}</h5>
                        </div>
                    </div>

                    <hr>
                    <h3>{{ $assignment->title }}</h3>
                    <span>{{ $assignment-> description }}</span>

                    <h5>Work Required</h5>
                    <p>File Type :
                        @if(empty($assignment->fileType))
                            None
                        @else
                            @foreach($fileType as $type)
                                {{ $type.' ' }}
                            @endforeach
                        @endif
                        <br>
                        Dimentions :
                        @if( $assignment->dimensionsType == '')
                            None
                        @else
                            {{ $assignment->dimensions }} {{ $assignment->dimensionsType }}
                        @endif

                    </p>

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
                    <div class="table-responsive-xl">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="table-head">รหัสนักศึกษา</th>
                                <th class="table-head">ชื่อ-นามสกุล</th>
                                <th class="table-head">ไฟล์งาน</th>
                                <th class="table-head">เกรด</th>
                                <th class="table-head">แก้ไข</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($allWorks)>0)
                                @foreach($allWorks as $work)
                                    <tr class="click-row" data-href="/teacher/assignment/work/{{$work->id}}">
                                        <td>{{$work->student_id}}</td>
                                        <td>{{$work->firstname.' '.$work->lastname}}</td>
                                        <td>{{$work->file}}</td>
                                        <td>{{$work->grade}}</td>
                                        <td>
                                            <a href="" class="btn btn-primary btn-dark btn-table">
                                                edit
                                            </a>
                                            <a href="#" class="ml-3">
                                                <i class="fas fa-trash-alt mt-2" style="font-size: 20px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>ยังไม่มีงานที่ส่ง</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>

@endsection
