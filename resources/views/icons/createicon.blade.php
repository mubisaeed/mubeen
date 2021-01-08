@extends('layouts.app')
@section('content')

<div>
  <form action="{{url('/createicon')}}" method="post" enctype="multipart/form-data">
    
    {{@csrf_field()}}

    <div class="title">

      <i class="fas fa-pencil-alt"></i> 

    <h2>Icons</h2>

    </div>

    <div class="info">
    <div class="form-group">
    <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Enter Titile here!" required>

      @if ($errors->has('title'))
      <span class="text-danger">
      <small>{{ $errors->first('title') }}</small>
      </span>
      @endif
    </div>
    <div class="text-left">
    <input type="file" class="img-fluid" name="image" accept="image/x-png,image/gif,image/jpeg" required>

      @if ($errors->has('image'))
      <span class="text-danger">
      <small>{{ $errors->first('image') }}</small>
      </span>
      @endif
    </div>
    <div class="footer pull-right">
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="/viewicon" class="btn btn-default">Cancel</a>
    </div>
  </form>
</div>

 @endsection