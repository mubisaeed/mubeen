@extends('layouts.app')
@section('content')
<div class="breadcrumb_main">
  <ol class="breadcrumb">
    <li><a href = "#">Home</a></li>
    <li class = "active">Profile</li>
  </ol>
</div>  
<div id="message">
  @if (Session::has('message'))
    <div class="alert alert-info">
      {{ Session::get('message') }}
    </div>
  @endif
</div>
<div class="content_main">
  <div class="profile_main">
     @foreach ($errors->all() as $error)
              <div class="alert alert-danger">{{ $error }}</div>
          @endforeach
    <div class="profile mt-0">
      <div class="course card-header card-header-warning card-header-icon">
        
        <h3 class="main_title_ot">Profile</h3>
        
        <div class="profile_tabs">
          <div class="row">
            <div class="col-md-12">
              <div class="tabbable-panel">
                <div class="tabbable-line">
                  <ul class="nav nav-tabs ">
                    <li class="profile_tabs_child">
                      <a href="{{url('/showprofile')}}" >
                      Profile </a>
                    </li>
                    <li class="profile_tabs_child">
                      <a href="{{url('/messages')}}">
                      Messages </a>
                    </li>
                    <li class="active profile_tabs_child">
                      <a href="{{url('/editprofile')}}">
                      Settings </a>
                    </li>
                  </ul>

                  <div class="tab-content">
                  <form method="POST" action="{{url('updateprofile',Auth::user()->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-pane active" id="tab_default_3">
                      <div class="s_profile">
                        <div class="s_profile_img text-center">
                          <div class="child_image">
                            <img src="../assets/img/latest/admin.png" alt="">
                            <div class="s_edit_pic">
                              <a href="#"> <i class="fa fa-pencil"></i> </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="s_profile_fields">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="custom_input_main">
                              <input type="text" class="form-control" autofocus="">
                              <label>Name <span class="red">*</span></label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="custom_input_main">
                              <input type="text" class="form-control" placeholder="info@myadmin.com">
                              <label>Email <span class="grey">*</span></label>
                              <span class="red">Email can't be changed *</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="custom_input_main mobile_field">
                              <input type="text" class="form-control" placeholder="(132) 11425 4521">
                              <label>Mobile <span class="grey">*</span></label>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="custom_input_main">
                              <textarea class="form-control" style="height: 115px !important;"> </textarea>
                              <label>Bio <span class="grey">*</span></label>
                            </div>
                          </div>
                        </div>
                        <div class="security_setting">
                          <h3>Security Settings</h3>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="custom_input_main">
                                <input type="text" class="form-control" placeholder="***************" autocomplete="new-password">
                                <label>Old Password<span class="grey">*</span></label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="custom_input_main">
                                <input type="password" class="form-control" autocomplete="new-password">
                                <label>New Password</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="custom_input_main">
                                <input type="password" class="form-control" >
                                <label>Confirm New Password</label>
                              </div>
                            </div>
                          </div>
                          <div class="s_form_button text-center">
                            <button type="button" class="btn cncl_btn">Cancel</button>
                            <button type="button" class="btn save_btn">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


 
<script type="text/javascript">
  setTimeout(function() {
    $('#message').fadeOut('fast');
}, 2000);
</script>
<script type="text/javascript">
  $('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });
</script>

@endsection