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

    <input type="text" name="title" value="{{old('title')}}" placeholder="Enter Titile here!" required>

      @if ($errors->has('title'))
      <span class="text-danger">
      <small>{{ $errors->first('title') }}</small>
      </span>
      @endif

    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" placeholder="Image" required>

      @if ($errors->has('image'))
      <span class="text-danger">
      <small>{{ $errors->first('image') }}</small>
      </span>
      @endif


    <button type="submit">Create</button>
  </form>
</div>

 @endsection