@extends('layouts.app')
@section('content')
  {{-- <div>
    <h3>Add a new Safety Tip</h3>
    <hr>
    <form method="POST" action="/safetytips/create" enctype="multipart/form-data">
      @csrf
      <label style="color: black" for="title">Enter title:</label>
      <input type="text" name="title" value="{{old('title')}}" required minlength="3" maxlength="255">
      @error('title')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label style="color: black" for="image">Upload an image:</label>
      <input type="file" name="image" required accept="image/x-png,image/gif,image/jpeg">
      @error('image')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label style="color: black" for="description">Enter Description:</label>
      <input type="text" name="description" value="{{old('description')}}" required minlength="10" maxlength="3000">
      @error('description')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <input type="submit" value="Submit">
      <button><a href="/safetytips">Cancel</a></button>
    </form>
  </div> --}}

  <div class="breadcrumb_main">
    <ol class="breadcrumb">
      <li><a href = "#">Home</a></li>
      <li class = "active">Add a new Safety Tip</li>
    </ol>
  </div>  
  <div class="content_main">
    <div class="profile_main">

      <div class="profile mt-0">
        <div class="course card-header card-header-warning card-header-icon">
          
          <h3 class="main_title_ot">Add a new Safety Tip</h3>
                    <div class="tab-content">
                    <form method="POST" action="/safetytips/create" enctype="multipart/form-data">
                      @csrf
                      <div class="tab-pane active" id="tab_default_3">
                        <div class="s_profile_fields">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="custom_input_main mobile_field">
                                <input type="text" class="form-control" name="name" autofocus="">
                                <label>Enter title<span class="red">*</span></label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="custom_input_main mobile_field">
                                <textarea class="form-control" name="bio" style="height: 115px !important;"></textarea>
                                <label>Enter Description <span class="red">*</span></label>
                              </div>
                            </div>
                          </div>
                            <div class="s_form_button text-center">
                              <button type="button" class="btn cncl_btn">Cancel</button>
                              <button type="submit" class="btn save_btn">Save</button>
                            </div>
                      </div>
                      </div>
                    </form>
                  </div>
                
      </div>
    </div>
  </div>
  </div>
  



@endsection