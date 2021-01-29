@extends('layouts.app')

@section('content')



<div class="breadcrumb_main">

              <ol class="breadcrumb">

                <li><a href = "{{url('/dashboard')}}">Home</a></li>

                <li class = "active">Edit Video</li>

              </ol>

            </div>

            <div class="assignment">

              <div class="card-header main_ac">

                <h3>Edit</h3>

                <div class="ac_add_form">

                @foreach ($errors->all() as $error)

                            <div class="alert alert-danger">{{ $error }}</div>

                          @endforeach

                  <form action="{{route('resourcevid/update')}}" method="post" enctype="multipart/form-data" class="w-100">


                  <div class="row">

                   

                      {{@csrf_field()}}

                        <input type="hidden" name="id" value="{{$id}}">

                        <input type="hidden" name="main" value="{{$main}}"> 


                      </div>

                          @error('title')

                          <span class="invalid-feedback" role="alert">

                          <strong>{{ $message }}</strong>

                          </span>

                          @enderror

                      </div>

                       @if($cress->type == 'mp4')

                    <div class="col-md-6 p_left">

                      <div class="file_spacing">

                        <input id="file" class="choose" type="file" name="video" accept="video/mp4,video/x-m4v,video/x-wmv,video/*" size="max:10240" required="">

                      </div>

                          @error('video')

                          <span class="invalid-feedback" role="alert">

                          <strong>{{ $message }}</strong>

                          </span>

                          @enderror

                    </div>

                    @else

                    <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="url" class="form-control" name="link" value="{{old('link', $cress->link)}}" required minlength="3" maxlength="120" autofocus="">

                      <label>Youtube Video Link<span class="red">*</span></label>

                    </div>

                    @error('link')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>

                  @endif

                    {{-- <div class="col-md-6 p_left">

                      <div class="custom_input_main">

                        <textarea class="form-control" name="short_des" rows="4" cols="50" value="{!!old('short_des', $cress->short_description)!!}" minlength="10" maxlength ="1000" style="height: 100px !important;" required="">
                        
                        {{old('short_des', $cress->short_description)}}
                        
                        </textarea>

                        <label>Video description...</label>

                      </div>

                          @error('short_des')

                          <span class="invalid-feedback" role="alert">

                          <strong>{{ $message }}</strong>

                          </span>

                          @enderror

                      </div> --}}


                      <div class="col-md-12 p_left">

                      <div class="custom_input_main">

                        <textarea class="form-control" name="short_des" rows="4" cols="50" value="{!!old('short_des', $cress->short_description)!!}" minlength="10" maxlength ="1000" style="height: 100px !important;"required=""></textarea>

                        <label>Video description<span class="red">*</span></label>

                      </div>

                          @error('short_des')

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

        </div>

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