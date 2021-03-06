@extends('layouts.app')
@section('content')



<div class="content">
          <div class="container-fluid">
           
            <div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Messages</li>
              </ol>
            </div>
            <div class="content_main">
              <div class="profile_main">
                
                <div class="profile mt-0">
                  <div class="course card-header card-header-warning card-header-icon">
                    
                    <h3 class="main_title_ot">Messages</h3>
                    
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
                                <li class="active profile_tabs_child">
                                  <a href="{{url('/messages')}}">
                                    Messages 
                                  </a>
                                </li>
                                <li class="profile_tabs_child">
                                  <a href="{{url('/editprofile')}}">
                                    Settings 
                                  </a>
                                </li>
                              </ul>
                              <div class="tab-content">
                                <!-- <div class="tab-pane active" id="tab_default_1">
                                  <div class="profile_row">
                                    <div class="row">
                                      <div class="col-md-3">
                                        <div class="p_img">
                                          <div class="p_img_edit">
                                            <img src="../assets/img/latest/admin.png" alt="" class="img-fluid">
                                            <div class="edit_pic">
                                              <a href="#"> <i class="fa fa-pencil"></i> </a>
                                            </div>
                                          </div>
                                          <h3>Lily Cristopher</h3>
                                          <p>M.Phil Statistics</p>
                                          
                                        </div>
                                      </div>
                                      <div class="col-md-3 d-flex align-items-center">
                                        <div class="p_mob">
                                          <div class="mobile_head">
                                            <h4>Mobile</h4>
                                            <p>(132) 11425 4521</p>
                                          </div>
                                          <div class="edit_mob">
                                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-pencil"></i></a>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3 d-flex align-items-center">
                                        <div class="p_email">
                                          <h4>Email</h4>
                                          <p>info@myadmin.com</p>
                                        </div>
                                      </div>
                                      <div class="col-md-3 d-flex align-items-center">
                                        <div class="p_id">
                                          <h4>ID</h4>
                                          <p>#1232</p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="p_text">
                                    <div class="edit_detail_p">
                                      <a href="#"><i class="fa fa-pencil"></i></a>
                                    </div>
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atcorrupti quos dolores et
                                      quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est
                                      laborum et dolorum fuga. <br> <br>
                                      On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoraliz the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble thena bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. <br> <br>
                                      Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                  </div>
                                </div> -->
                                <div class="tab-pane active" id="tab_default_2">
                                  <div class="row">
                                    <div class="col-md-7 chat-area">
                                      <div class="chatbox-holder">
                                        <div class="chatbox">
                                          <p>Welcome to messages area. Click to any perso to start chat :-)</p>

                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-5 devided_border">
                                      <div class="msg_list_head">
                                        <select>
                                          <option>Recent</option>
                                          <option>Old</option>
                                          <option>New</option>
                                        </select>
                                        <div class="filter_plus">
                                          <i class="fa fa-plus"></i>
                                        </div>
                                      </div>
                                      @if(Auth::user()->role_id == '4')
                                        @foreach($instructor_students as $ins_std)
                                            <div class="msg_listing" id="{{$ins_std->id}}">
                                              <div class="msg_styling">
                                                <div class="msg_img">
                                                  <div class="msg_list_img">
                                                    <img src="../assets/img/latest/msg_img.png" alt="">
                                                  </div>
                                                  <div class="msg_name">
                                                    <h5>{{$ins_std->name}}</h5>
                                                    <p>M.Phil Biology</p>
                                                  </div>
                                                </div>
                                                <div class="msg_time">
                                                  <p>2:12 PM</p>
                                                </div>
                                              </div>
                                              <p class="s_msg">Donec vitae enim eleifend, pulvinar lacus id, faucibus...  </p>
                                            </div>
                                        @endforeach

                                      @elseif(Auth::user()->role_id == '5')
                                        @foreach($instructors as $ins)
                                            <div class="msg_listing" id="{{$ins->id}}">
                                              <div class="msg_styling">
                                                <div class="msg_img">
                                                  <div class="msg_list_img">
                                                    <img src="../assets/img/latest/msg_img.png" alt="">
                                                  </div>
                                                  <div class="msg_name">
                                                    <h5>{{$ins->name}}</h5>
                                                    <p>M.Phil Biology</p>
                                                  </div>
                                                </div>
                                                <div class="msg_time">
                                                  <p>2:12 PM</p>
                                                </div>
                                              </div>
                                              <p class="s_msg">Donec vitae enim eleifend, pulvinar lacus id, faucibus...  </p>
                                            </div>
                                        @endforeach
                                      @endif
                                      

                                      <!-- <div class="msg_listing">
                                        <div class="msg_styling">
                                          <div class="msg_img">
                                            <div class="msg_list_img">
                                              <img src="../assets/img/latest/msg_img3.png" alt="">
                                            </div>
                                            <div class="msg_name">
                                              <h5>Cloie Dacker</h5>
                                              <p>M.Phil Biology</p>
                                            </div>
                                          </div>
                                          <div class="msg_time">
                                            <p>2:12 PM</p>
                                          </div>
                                        </div>
                                        <p class="s_msg">Donec vitae enim eleifend, pulvinar lacus id, faucibus...  </p>
                                      </div>
                                      <div class="msg_listing">
                                        <div class="msg_styling">
                                          <div class="msg_img">
                                            <div class="msg_list_img">
                                              <img src="../assets/img/latest/msg_img2.png" alt="">
                                            </div>
                                            <div class="msg_name">
                                              <h5>Cloie Dacker</h5>
                                              <p>M.Phil Biology</p>
                                            </div>
                                          </div>
                                          <div class="msg_time">
                                            <p>2:12 PM</p>
                                          </div>
                                        </div>
                                        <p class="s_msg">Donec vitae enim eleifend, pulvinar lacus id, faucibus...  </p>
                                      </div>
                                      <div class="msg_listing">
                                        <div class="msg_styling">
                                          <div class="msg_img">
                                            <div class="msg_list_img">
                                              <img src="../assets/img/latest/msg_img3.png" alt="">
                                            </div>
                                            <div class="msg_name">
                                              <h5>Cloie Dacker</h5>
                                              <p>M.Phil Biology</p>
                                            </div>
                                          </div>
                                          <div class="msg_time">
                                            <p>2:12 PM</p>
                                          </div>
                                        </div>
                                        <p class="s_msg">Donec vitae enim eleifend, pulvinar lacus id, faucibus...  </p>
                                      </div>
                                      <div class="msg_listing">
                                        <div class="msg_styling">
                                          <div class="msg_img">
                                            <div class="msg_list_img">
                                              <img src="../assets/img/latest/msg_img4.png" alt="">
                                            </div>
                                            <div class="msg_name">
                                              <h5>Cloie Dacker</h5>
                                              <p>M.Phil Biology</p>
                                            </div>
                                          </div>
                                          <div class="msg_time">
                                            <p>2:12 PM</p>
                                          </div>
                                        </div>
                                        <p class="s_msg">Donec vitae enim eleifend, pulvinar lacus id, faucibus...  </p>
                                      </div>
                                      <div class="msg_listing">
                                        <div class="msg_styling">
                                          <div class="msg_img">
                                            <div class="msg_list_img">
                                              <img src="../assets/img/latest/msg_img5.png" alt="">
                                            </div>
                                            <div class="msg_name">
                                              <h5>Cloie Dacker</h5>
                                              <p>M.Phil Biology</p>
                                            </div>
                                          </div>
                                          <div class="msg_time">
                                            <p>2:12 PM</p>
                                          </div>
                                        </div>
                                        <p class="s_msg">Donec vitae enim eleifend, pulvinar lacus id, faucibus...  </p>
                                      </div>
                                      <div class="msg_listing">
                                        <div class="msg_styling">
                                          <div class="msg_img">
                                            <div class="msg_list_img">
                                              <img src="../assets/img/latest/msg_img.png" alt="">
                                            </div>
                                            <div class="msg_name">
                                              <h5>Cloie Dacker</h5>
                                              <p>M.Phil Biology</p>
                                            </div>
                                          </div>
                                          <div class="msg_time">
                                            <p>2:12 PM</p>
                                          </div>
                                        </div>
                                        <p class="s_msg">Donec vitae enim eleifend, pulvinar lacus id, faucibus...  </p>
                                      </div> -->
                                    </div>
                                  </div>
                                </div>
                             <!--  <div class="tab-pane" id="tab_default_3">
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
                                          <input type="text" class="form-control" placeholder="***************">
                                          <label>Old Password<span class="grey">*</span></label>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="custom_input_main">
                                          <input type="password" class="form-control">
                                          <label>New Password</label>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="custom_input_main">
                                          <input type="password" class="form-control">
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
                              </div> -->
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
        </div>

        <!-- // Modal /// -->

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="cross_modal">
              <div class="modal_title">
                <h3>Edit Mobile No.</h3>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="cross_btn">??</span>
              </button>
            </div>
            <div class="modal-body">
             <div class="custom_input_main">
                <input type="text" class="form-control" placeholder="(132) 11425 4521">
                <label>Mobile <span class="grey">*</span></label>
              </div>
              <div class="s_form_button">
                <button type="button" class="btn cncl_btn">Cancel</button>
                <button type="button" class="btn save_btn">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      
    </div>
@endsection