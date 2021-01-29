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

                <li><a href = "{{url('/dashboard')}}">Home</a></li>

                <li class = "active">Add New File</li>

              </ol>

            </div>

            <div class="assignment">

              <div class="card-header main_ac">

                <h3>Add file</h3>

                <div class="ac_add_form">

                @foreach ($errors->all() as $error)

                      <div class="alert alert-danger">{{ $error }}</div>

                      @endforeach

                <form action="{{url('/special_education/store')}}" method="POST" enctype="multipart/form-data" class="w-100">

                  <div class="row">

                   

                      {{@csrf_field()}}

                      

                      <div class="col-md-12">

                      <div class="file_spacing">

                        <input id="file" class="choose" type="file" name="file" accept=".doc,.docx,.pptx,.xlsx,.txt,application/pdf,application/vnd.ms-excel/application/vnd.ms-docx/mp4,video/x-m4v,video/x-wmv,video/*" required="" autofocus="" size="max:10240">

                      </div>

                          @error('file')

                          <span class="invalid-feedback" role="alert">

                          <strong>{{ $message }}</strong>

                          </span>

                          @enderror

                      </div>

                    <div class="col-md-12">

                      <div class="custom_input_main">

                        <textarea class="form-control" name="comments" rows="4" cols="50" value="{{old('comments')}}" minlength="10" maxlength ="255" style="height: 100px !important;" required=""></textarea>

                        <label>Parent comments<span class="red">*</span></label>

                      </div>

                          @error('comments')

                          <span class="invalid-feedback" role="alert">

                          <strong>{{ $message }}</strong>

                          </span>

                          @enderror

                      </div>


                    <div class="col-md-12">

                      <div class="file_spacing">

                        <input id="file" class="choose" type="file" name="image" accept="image/*" required="" autofocus="" size="max:1024"> 

                      </div>

                          @error('image')

                          <span class="invalid-feedback" role="alert">

                          <strong>{{ $message }}</strong>

                          </span>

                          @enderror

                    </div>

                    <div class="col-md-12">

                      <div class="custom_input_main">

                        <textarea class="form-control" name="text" rows="4" cols="50" value="{{old('text')}}" minlength="10" maxlength ="255" style="height: 100px !important;" required=""></textarea>

                        <label>Text Information<span class="red">*</span></label>

                      </div>

                          @error('text')

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

                    {{-- <input type="hidden" name ="comment" value="defualt_value"> --}}

                    {{-- @if(auth()->user()->role_id == '3')

                    <div class="col-md-12">

                      <div class="custom_input_main">

                        <textarea value="defualt_value" class="form-control" name="comment" rows="4" cols="50" value="{{old('comment')}}" minlength="10" maxlength ="255" style="height: 100px !important;" required=""></textarea>

                        <label>Parent comments<span class="red">*</span></label>

                      </div> --}}

                          {{-- @error('comment')

                          <span class="invalid-feedback" role="alert">

                          <strong>{{ $message }}</strong>

                          </span>

                          @enderror --}}

                      </div>

                      {{-- @endif --}}

                </div>

                    </form>

                  

                </div>

              </div>

            </div>

          </div>


@endsection
