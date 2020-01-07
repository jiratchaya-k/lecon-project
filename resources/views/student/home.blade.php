@extends('layouts.app')
@section('content')
    <div class="container-fluid banner">
    </div>

    <div class="container-fluid">
        <div class="container mt-4">
            {{--<h4>Your Section</h4>--}}

            {{--<hr>--}}

            <h4>Assignment</h4>
            <div class="row">
                @if(count($assignments)>0)
                    @foreach($assignments as $assignment)
                        <a href="/assignment/{{ $assignment->id }}" class="cardLink col-md-3">
                            <div class="card card-shadow  mt-3 mb-2">
                                <div class="card-header bg-gradient" style="border-radius: 20px 20px 0px 0px;">
                                    <span>Sect. {{ $assignment->section }}</span>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold fs-18">{{ $assignment->title }}</h5>
                                    <p class="card-text fs-12">Due. {{ $assignment->dueDate }} {{substr($assignment->dueTime, 0,-3)}} </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div>
                        <p>No Assignment</p>
                    </div>
                @endif
        </div>
    </div>
@endsection
{{--<center><h1>Lecon Project</h1></center>--}}
{{--<a href="/qrcode" class="btn btn-primary">gen qrcode</a>--}}
{{--<a href="/reader" class="btn btn-primary">scan qrcode</a>--}}