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

    <input type="text" name="title" value="value="{{old('title', $data->title)}}" placeholder="Enter Titile here!" required>

    @if ($errors->has('title'))
    <span class="text-danger">
    <small>{{ $errors->first('title') }}</small>
    </span>
    @endif

    <input type="file" accept="image/x-png,image/gif,image/jpeg" name="image"><img src="{{asset('img/icons/'.$data->image)}}" height="50" width="50">

    @if ($errors->has('image'))
    <span class="text-danger">
    <small>{{ $errors->first('image') }}</small>
    </span>
    @endif

    <button type="submit">Update</button>

  </form>

</div>

@endsection