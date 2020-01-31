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
                        <div class="col-md-6">
                            <h5>Assignment Sect. {{ $sections->section}}</h5>
                            <span>{{ $sections->code.' '.$sections->name  }}</span>
                        </div>
                        <div class="col-md-6 text-right">
                            <h5 class="text-green">Due. {{ $assignment->dueDate }} {{substr($assignment->dueTime, 0,-3)}}</h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>{{ $assignment->title }}</h3>
                            <span>{{ $assignment-> description }}</span>
                            <br><br>
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
                        </div>
                        <div class="col-md-6">
                            <h6>Status :  {{ $status }}</h6>
                            @if(!empty($assignmentWork))

                                <p id="workStatus"></p>
                            <div class="row">
                                @foreach($works as $work)
                                    <div class="col-md-3">
                                        <div class="card mb-4 box-shadow">
                                            <a href="#">
                                                <img src="/uploads/workFiles/{{$work}}" class="card-img-top" alt="">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                                Grade : {{ $assignmentWork->grade }}
                                @if($assignmentWork->remark != '')
                                    {{ ' ('.$assignmentWork->remark.')'  }}
                                @endif
                            @else
                                Grade :
                                <h6>No Work.</h6>
                            @endif
                        </div>
                    </div>


                    <hr>

                    <form method="POST" action="/assignment/{{ $assignment->id }}/send" enctype="multipart/form-data" class="sendAssignment">
                    @csrf

                        <div class="form-group col-md-8 item-center mt-3 mb-3">
                            <label for="file" class="control-label">Upload your work</label>
                            {{--<input class="form-control" name="work_file[]" type="file">--}}
                            <input class="form-control" name="assignment_id" value="{{ $assignment->id }}" type="hidden">
                        </div>

                        <div class="controls">
                            <div class="form-group item-center mt-3 mb-3">
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



                            <div class="col-md-3 item-center mt-5 mb-3">
                                <input class="btn btn-dark btn-submit" type="submit" value="ส่งงาน" style="background: #3956A3 !important; border: none; width: 100%">
                            </div>
                    </form>

                </div>
            </div>

        </div>
    </div>


    
@endsection
