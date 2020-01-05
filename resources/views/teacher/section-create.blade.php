@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-10">
        <div class="container">
            <h3 class="text-center mb-3">Create Section</h3>
            <div class="card mt-2 col-md-10 item-center">
                <div class="card-body">
                    <form method="POST" action="/section/store" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group col-md-4">
                            <label for="code" class="control-label">Assignment Title</label>
                            <input class="form-control" name="section_code" type="text" id="code">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description" class="control-label">Assignment Description</label>
                            <textarea class="form-control" name="album_description" cols="50" rows="5" id="description"></textarea>
                        </div>

                        <div class="row container">
                            <div class="form-group col-md-4">
                                <label for="description" class="control-label">Date</label>
                                <input class="form-control" name="section_code" type="text" id="code">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="description" class="control-label">Start Time</label>
                                <input class="form-control" name="section_code" type="text" id="code">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="description" class="control-label">End Time</label>
                                <input class="form-control" name="section_code" type="text" id="code">
                            </div>
                        </div>


                        <div class="col-md-5 item-center mt-4 mb-3">
                            <input class="btn col-12" type="submit" value="Submit" style="background-color: #66CDAA; border: none;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
