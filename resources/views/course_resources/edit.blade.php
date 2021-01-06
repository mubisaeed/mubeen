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
          <option value="{{$course->id}}">{{$course->class_name}}</option>
        @endforeach
        </select><br><br>

    <label for="title">Titile:</label><br>
    <input type="text" name="title" value="{{$cress->title}}" placeholder="Enter Titile here!"><br><br>

       @error('title')
      <div>
        {{$message}}
      </div>
      @enderror

      <label for="short_des">Short Description:</label><br>
    <input type="text" name="short_des" value="{{$cress->short_description}}"><br><br>

       @error('short_des')
      <div>
        {{$message}}
      </div>
      @enderror

    <label for="file">File:</label><br>
    <input id="file" type="file" name="file" value="{{$cress->file}}"><br><br>

    <button type="submit">Update</button>
  </form>
</div>
  
</div>
</div>
</div>

<script>

var uploadField = document.getElementById("file");

uploadField.onchange = function() {
    if(this.files[0].size > 100 * 1024 * 1024){
       alert("File is too big!");
       this.value = "";
    };
};

</script>

 @endsection