@extends('layouts.app')
@section('content')

<div>
  <form action="{{route('updateicon',[$data->id])}}" method="POST" enctype="multipart/form-data">
    {{@csrf_field()}}

    <div class="title">
    <i class="fas fa-pencil-alt"></i>
    <h2>Icons</h2>
    </div>
    <div class="info">
    <div class="form-group">
    <input type="text" class="form-control" name="title" value="{{old('title', $data->title)}}" placeholder="Enter Titile here!" required>
    
    @if ($errors->has('title'))
    <span class="text-danger">
    <small>{{ $errors->first('title') }}</small>
    </span>
    @endif
    </div>
    <div class="text-left">
    <input type="file" class="img-fluid" accept="image/x-png,image/gif,image/jpeg" name="image">
    <img src="{{asset('img/icons/'.$data->image)}}" height="100" width="100">

    @if ($errors->has('image'))
    <span class="text-danger">
    <small>{{ $errors->first('image') }}</small>
    </span>
    @endif
    </div>
    <div class="footer pull-right">
    <a class="btn btn-default" href="{{url('/viewicon')}}">Cancel</a>
    <button type="submit" class="btn btn-success">Update</button>
    </div>

  </form>

</div>

@endsection