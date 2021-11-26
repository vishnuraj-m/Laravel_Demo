@extends('admin.admin_master')

@section('admin')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="py-12">

    <div class="container">
        <div class="row">




            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Slider</div>
                    <div class="card-body">


                        <form action="{{ url('slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $sliders->image }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Update Slider Title</label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $sliders->title }}">

                                @error('title')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Update Slider Description</label>
                                <textarea type="text" name="description" class="form-control" id="description" aria-describedby="emailHelp" value="{{ $sliders->description }}"></textarea>
                                <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" value="{{ $sliders->description }}"></textarea> -->

                                @error('description')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"> Update Slider Image</label>
                                <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                @error('image')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                            </div>


                            <div class="form-group">
                                <img src="{{ asset($sliders->image) }}" style="width: 400px; height: 200px;">

                            </div>

                            <button type="submit" class="btn btn-primary">Update Slider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection