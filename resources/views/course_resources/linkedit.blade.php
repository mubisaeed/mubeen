@extends('layouts.app')
@section('content')


<div id="message">
  @if (Session::has('message'))
    <div class="alert alert-info">
      {{ Session::get('message') }}
    </div>
  @endif
</div>
  {{-- <form action="{{url('/linkupdate')}}" method="post" enctype="multipart/form-data">
    
    {{@csrf_field()}}

      <i class="fas fa-pencil-alt"></i> 

    <h2>Course Resources</h2>
<input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="main" value="{{$main}}">

    <div class="info">

    <label for="title">Titile:</label><br>
    <input type="text" name="title" value="{{old('title', $courselinks->title)}}" minlength="3" maxlength ="50" autofocus=""><br><br>

      @error('title')
      <div>
        {{$message}}
      </div>
      @enderror

      <label for="short_des">Short Description:</label><br>
    <input type="text" name="short_des" value="{{old('short_des', $courselinks->short_description)}}" minlength="10" maxlength ="1000"><br><br>

      @error('short_des')
      <div>
        {{$message}}
      </div>
      @enderror

    
      <label for="link">Link:</label><br>
      <input class="form-control" type="url" name="link" value={{old('link', $courselinks->link)}} minlength="10" maxlength ="100"><br><br>
      
      @error('link')
        <div>
          {{ $message }}
        </div>
      @enderror

    <button type="submit">Submit</button>
  </form> --}}



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
                  <form action="{{url('/linkupdate')}}" method="post" enctype="multipart/form-data">
                      {{@csrf_field()}}
                      @foreach ($errors->all() as $error)
                      <div class="alert alert-danger">{{ $error }}</div>
                      @endforeach
                      {{-- <input type="hidden" name="course_id" value="{{$id}}"> --}}
                      <input type="hidden" name="id" value="{{$id}}">
                      <input type="hidden" name="main" value="{{$main}}"> 
                    <div class="col-md-6 p_left">
                      <div class="custom_input_main">
                        {{-- <input type="text" name="title" value="{{old('title', $courselinks->title)}}" minlength="3" maxlength ="50" autofocus=""> --}}
                        <input type="text" class="form-control" value="{{old('title', $courselinks->title)}}" name="title" required="" minlength="3" maxlength ="50" autofocus="">
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
                        <textarea class="form-control" name="short_des" rows="4" cols="50" value="{{old('short_des')}}" minlength="10" maxlength ="1000" style="height: 100px !important;"></textarea>
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
                      <div class="custom_input_main">
                        <input class="form-control" type="url" name="link" value={{old('link', $courselinks->link)}} minlength="10" maxlength ="100">
                        {{-- <input type="url" name="link" value="{{old('link')}}" size="max:10240"> --}}
                        <label>Link <span class="red">*</span></label>
                      </div>
                          @error('link')
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

 @endsection




