@extends('layouts.app')
@section('content')

<div>
  <form action="{{route('resource/update',[$cress->id])}}" method="post" enctype="multipart/form-data">
    
    {{@csrf_field()}}

    <div class="title">

      <i class="fas fa-pencil-alt"></i> 

    <h2>Course Resources</h2>

    </div>

    <div class="info">

    <label for="course">Course id:</label>

        <select name="course" id="">
        @foreach ($courses as $course)
          <option value="{{$course->id}}">{{{{old('title', $cress->class_name)}}}}</option>
        @endforeach
        </select><br><br>

    <label for="title">Titile:</label><br>
    <input type="text" name="title" value="{{old('title', $cress->title)}}" placeholder="Enter Titile here!" required><br><br>

       @error('title')
      <div>
        {{$message}}
      </div>
      @enderror

      <label for="short_des">Short Description:</label><br>
    <input type="text" name="short_des" value="{{old('title', $cress->short_description)}}" required><br><br>

       @error('short_des')
      <div>
        {{$message}}
      </div>
      @enderror

    <label for="file">File:</label><br>
    <input type="file" name="file" value="{{old('title', $cress->file)}}"><br><br>

    <button type="submit">Update</button>
  </form>
</div>
  
 @endsection