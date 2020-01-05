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
            <div class="card card-overlap card-shadow col-md-12 item-center">
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


                </div>
            </div>

        </div>
    </div>
@endsection
