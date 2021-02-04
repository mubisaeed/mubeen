@extends('layouts.app')
@section('content')
<div id="message">
    @if (Session::has('message'))
        <div class="alert alert-info">
        {{ Session::get('message') }}
        </div>
    @endif  
</div>
  <div class="breadcrumb_main">
    <ol class="breadcrumb">
      <li><a href = "{{asset('/dashboard')}}">Home</a></li>
      <li class = "active">Add New Lecture</li>
    </ol>
  </div>
  <div class="assignment">
    <div class="card-header main_ac">
      <h3>Add Lecture</h3>
      <div class="ac_add_form">
        @foreach ($errors->all() as $error)
          <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        <form action="{{url('/lecture/create')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="course_id" value="{{$course->id}}">
          <input type="hidden" name="instructor_id" value="{{$instructor_id}}">
          <input type="hidden" name="week" value="{{$week}}">
          <div class="row">
            <div class="col-md-6 p_left">
                      <div class="custom_input_main">
                        <input type="text" class="form-control" value="{{ old('topic')}}" name="topic" required="" minlength="3" maxlength ="50" autofocus="">
                        <label>Topic <span class="red">*</span></label>
                      </div>
                          @error('topic')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div><br>
            <div class="col-md-12">
              <div class="s_form_button text-center">
                <a href="{{url('/course/show_week_details/'. $instructor_id .'/'. $course->id .'/'. $week)}}" class="btn cncl_btn">Cancel</a>
                <button type="submit" class="btn save_btn">Save<div class="ripple-container"></div></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript">
  setTimeout(function() {
    $('#message').fadeOut('fast');
}, 2000);
</script>
 @endsection