@extends('admin.admin_master')

@section('admin')
<div class="col-lg-12">
    <div class="card card-default">
        
        <div class="card-header card-header-border-bottom">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
            <h2>Create Home About</h2>
        </div>
        <div class="card-body">
            <form action="{{route('store.about')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Home Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Slider Title">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Short Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="short_dis"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Long Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="long_dis"></textarea>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection