@extends('layouts.app')
@section('content')

<div>
  <form action="{{url('/resource/create')}}" method="post" enctype="multipart/form-data">
    
    {{@csrf_field()}}

    <div class="title">

      <i class="fas fa-pencil-alt"></i> 

    <h2>Course Resources</h2>

    </div>

    <div class="info">

    <label for="course">Course id:</label>

        <select name="course" id="">
        @foreach ($courses as $course)
          <option value="{{$course->id}}">{{$course->course_name}}</option>
        @endforeach
        </select><br><br>

    <label for="title">Titile:</label><br>
    <input type="text" name="title" value="{{old('title')}}" placeholder="Enter Titile here!"><br><br>

      @error('title')
      <div>
        {{$message}}
      </div>
      @enderror

      <label for="short_des">Short Description:</label><br>
    <input type="text" name="short_des" value="{{old('short_des')}}"><br><br>

      @error('short_des')
      <div>
        {{$message}}
      </div>
      @enderror

    <label for="file">File:</label><br>
    <input type="file" name="file" value="{{old('file')}}"><br><br>

   @error('file')
      <div>
        {{$message}}
      </div>
      @enderror

    <button type="submit">Submit</button>
  </form>
</div>

 @endsection