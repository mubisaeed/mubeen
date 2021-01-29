@extends('layouts.app')
@section('content')
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
                <a href="{{url('/viewicon')}}" class="btn cncl_btn">Cancel</a>
                <button type="submit" class="btn save_btn">Save<div class="ripple-container"></div></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
 @endsection