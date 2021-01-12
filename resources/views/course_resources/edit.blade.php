@extends('layouts.app')
@section('content')

{{-- <div>
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
</div> --}}

<div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href = "#">Home</a></li>
                <li class = "active">Add New Course</li>
              </ol>
            </div>
            <div class="assignment">
              <div class="card-header main_ac">
                <h3>Course Resources</h3>
                <div class="ac_add_form">
                  <div class="row">
                   <form action="{{route('resource/update',[$cress->id])}}" method="post" enctype="multipart/form-data">
                      {{@csrf_field()}}
                        <input type="hidden" name="id" value="{{$id}}">
                        <input type="hidden" name="main" value="{{$main}}"> 
                          @foreach ($errors->all() as $error)
                          <div class="alert alert-danger">{{ $error }}</div>
                          @endforeach
                    <div class="col-md-6 p_left">
                      <div class="custom_input_main">
                        <input type="text" class="form-control" value="{{old('title', $cress->title)}}" name="title" required="" minlength="3" maxlength ="50" autofocus="">
                        <label>Title <span class="red">*</span></label>
                      </div>
                          @error('title')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                    <div class="col-md-12">
                      <div class="custom_input_main">
                        <textarea class="form-control" name="short_des" rows="4" cols="50" value="{{old('short_des', $cress->short_description)}}" minlength="10" maxlength ="1000" style="height: 100px !important;"></textarea>
                        <label>Course description...</label>
                      </div>
                          @error('short_des')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="file_spacing">
                        <input id="file" class="choose" type="file" name="file" accept="application/pdf,application/vnd.ms-excel/application/vnd.ms-doc" required="" autofocus="" size="max:10240">
                      </div>
                          @error('file')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="s_form_button text-center">
                        <a  href="{{url('/course')}}"><button type="button" class="btn cncl_btn">Cancel</button></a>
                        <button type="submit" class="btn save_btn">Save<div class="ripple-container"></div></button>
                      </div>
                    </div>
                    </form>
                  </div>
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

{{-- 

 <div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href = "#">Home</a></li>
                <li class = "active">Add New Course</li>
              </ol>
            </div>
            <div class="assignment">
              <div class="card-header main_ac">
                <h3>Course Resources</h3>
                <div class="ac_add_form">
                  <div class="row">
                   <form action="{{route('resource/update',[$cress->id])}}" method="post" enctype="multipart/form-data">
                      {{@csrf_field()}}
                        <input type="hidden" name="course_id" value="{{$id}}"> 
                          @foreach ($errors->all() as $error)
                          <div class="alert alert-danger">{{ $error }}</div>
                          @endforeach
                    <div class="col-md-6 p_left">
                      <div class="custom_input_main">
                        <input type="text" class="form-control" value="{{old('title', $cress->title)}}" name="title" required="" minlength="3" maxlength ="50" autofocus="">
                        <label>Title <span class="red">*</span></label>
                      </div>
                          @error('title')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                    <div class="col-md-12">
                      <div class="custom_input_main">
                        <textarea class="form-control" name="short_des" rows="4" cols="50" value="{{old('short_des', $cress->short_description)}}" minlength="10" maxlength ="1000" style="height: 100px !important;"></textarea>
                        <label>Course description...</label>
                      </div>
                          @error('short_des')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="file_spacing">
                        <input id="file" class="choose" type="file" name="file" accept="application/pdf,application/vnd.ms-excel/application/vnd.ms-doc" required="" autofocus="" size="max:10240">
                      </div>
                          @error('file')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="s_form_button text-center">
                        <a  href="{{url('/course')}}"><button type="button" class="btn cncl_btn">Cancel</button></a>
                        <button type="submit" class="btn save_btn">Save<div class="ripple-container"></div></button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}