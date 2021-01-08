@extends('layouts.app')
@section('content')

<div>
  <form action="{{route('resource/update',[$cress->id])}}" method="post" enctype="multipart/form-data">
    
    {{@csrf_field()}}
    <input type="hidden" name="course_id" value="{{$id}}">    


    <div class="title">

      <i class="fas fa-pencil-alt"></i> 

    <h2>Course Resources</h2>

    </div>

    <div class="info">

    <label for="title">Title:</label><br>
    <input type="text" name="title" value="{{old('title', $cress->title)}}" placeholder="Enter Titile here!" required><br><br>

       @error('title')
      <div>
        {{$message}}
      </div>
      @enderror

      <label for="short_des">Short Description:</label><br>
    <input type="text" name="short_des" value="{{old('short_des', $cress->short_description)}}" required><br><br>

       @error('short_des')
      <div>
        {{$message}}
      </div>
      @enderror

    <label for="file">File:</label><br>
    <input id="file" type="file" name="file"><br><br>

    <button type="submit">Update</button>
  </form>
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