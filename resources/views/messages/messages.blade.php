@extends('layouts.app')
@section('content')
<div class="breadcrumb_main">
  <ol class="breadcrumb">
    <li><a href = "#">Home</a></li>
    <li class = "active">Profile</li>
  </ol>
</div>  
<div class="content_main">
  <div class="profile_main">
    
    <div class="profile mt-0">
      <div class="course card-header card-header-warning card-header-icon">
        
        <h3 class="main_title_ot">Profile</h3>
        
        <div class="profile_tabs">
          <div class="row">
            <div class="col-md-12">
              <div class="tabbable-panel">
                <div class="tabbable-line">
                  <ul class="nav nav-tabs ">
                    <li class=" profile_tabs_child">
                      <a href="{{url('/showprofile')}}">
                      Profile </a>
                    </li>
                    <li class="active profile_tabs_child">
                      <a href="{{url('/messages')}}">
                      Messages </a>
                    </li>
                    <li class="profile_tabs_child">
                      <a href="{{url('/editprofile')}}">
                      Settings </a>
                    </li>
                  </ul>

                  <div class="tab-content">
                  
                    <div class="tab-pane active" id="tab_default_2">
                                  <div class="row">
                                    <div class="col-md-7">
                                      <div class="chatbox-holder">
                                        <div class="chatbox">
                                          <div class="ticket_chat">
                                            <div class="msg_img">
                                              <img src="{{asset('/img/upload/'.$suser->image)}}" alt="">
                                              <div class="msg_name">
                                                <h5>{{$suser->name}}</h5>
                                                <p>{{$suser->bio}}</p>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="chat-messages">
                                            @if(Auth::user()->role_id == 4)
                                              @foreach($messages as $msg)
                                               @if($msg->sent_by == 5)
                                            <div class="message-box-holder">
                                              <div class="message-box message-partner">
                                               {{$msg->content}}
                                              </div>
                                            </div>
                                            @endif
                                            @if($msg->sent_by == 4)
                                            <!-- <div class="message-box-holder">
                                              <div class="message-box message-partner">
                                                Can I send you files?
                                              </div>
                                              <p class="admin_days_ago">4 days ago</p>
                                            </div> -->
                                            <div class="message-box-holder">
                                              <div class="add_check">
                                                <div class="message-box">
                                                  {{$msg->content}}
                                                </div>
                                                <span><img src="../assets/img/latest/all-done.svg" alt=""></span>
                                              </div>
                                              <p class="user_days_ago">4 days ago</p>
                                            </div>
                                            @endif
                                          @endforeach
                                        @endif
                                        @if(Auth::user()->role_id == 5)
                                          @foreach($messages as $msg)
                                           @if($msg->sent_by == 4)
                                           <div class="message-box-holder">
                                              <div class="message-box message-partner">
                                                {{$msg->content}}
                                              </div>
                                            </div>
                                            @endif
                                            @if($msg->sent_by == 5)
                                            <!-- <div class="message-box-holder">
                                              <div class="message-box message-partner">
                                                Can I send you files?
                                              </div>
                                              <p class="admin_days_ago">4 days ago</p>
                                            </div> -->
                                            <div class="message-box-holder">
                                              <div class="add_check">
                                                <div class="message-box">
                                                  {{$msg->content}}
                                                </div>
                                                <span><img src="../assets/img/latest/all-done.svg" alt=""></span>
                                              </div>
                                              <p class="user_days_ago">4 days ago</p>
                                            </div>
                                            @endif
                                          @endforeach
                                        @endif
                                            <!-- <div class="message-box-holder">
                                              <div class="message-box message-partner">
                                                <div class="attachment_send">
                                                  <i class="fa fa-file-o"></i>
                                                  <div class="attachmet_size">
                                                    <h6>Style.zip</h6>
                                                    <p>41.36 Mb</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div> -->
                                            <div class="combine_date">
                                              <p>3 days ago</p>
                                            </div>
                                           <!--  <div class="message-box-holder">
                                              <div class="add_check">
                                                <div class="message-box">
                                                  Hello! I tweaked everything you asked. I am sending the finished file.
                                                </div>
                                                <span><img src="../assets/img/latest/checkmark.svg" alt=""></span>
                                              </div>
                                              <p class="user_days_ago">3 days ago</p>
                                            </div> -->
                                          </div>
                                          <div class="chat-input-holder">
                                            <div class="main_send">
                                              <div class="plus_icon">
                                                <a href="#"><i class="fa fa-plus"></i></a>
                                                <div class="option_list" style="display: none;">
                                                  <ul>
                                                    <li> <a href="#"> <i class="fa fa-file"> </i> File </a> </li>
                                                  </ul>
                                                </div>
                                              </div>
                                              <textarea class="chat-input" placeholder="Type a message here"></textarea>
                                            </div>
                                            <div class="send_icon">
                                              <a href="#"><i class="fa fa-paper-plane"></i></a>
                                            </div>
                                          </div>
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


                                      <?php
                $id = Auth::user()->role_id;
                $instructors = DB::table('instructor_student')->where('s_u_id', Auth::user()->id)->get()->all();
                $students = DB::table('instructor_student')->where('i_u_id', Auth::user()->id)->get()->all();
              ?>
              @if($id == 4)
                @foreach($students as $stdnt)
                <?php
                      $st = DB::table('users')->where('id', $stdnt->s_u_id)->get()->first();
                      $user = Auth::user();
                      if(Auth::user()->role_id==4)
                        {
                        $student = $st->id;
                        $instructor = Auth::user()->id;
                        $messages = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->pluck('content');
                        $message = $messages->values()->last();
                        $times = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->pluck('created_at');
                        $time = $times->values()->last();
                        // $t = $time->setTimezone('America/Vancouver');
                        // echo $time;
                        // echo \Carbon\Carbon::now();
                          // echo \Carbon\Carbon::now()."   " . \Carbon\Carbon::parse($time);
                          // $diff = \Carbon\Carbon::now()->diffInMinutes(\Carbon\Carbon::parse($time));
                          $diff = \Carbon\Carbon::parse($time)->diffForHumans();
                      }
                    ?>
                    @if(count($messages) > 0)
                    <a href="{{url('/chatbox/'. $st->id) }}">
                      <div class="msg_listing">
                        <div class="msg_styling">
                          <div class="msg_img">
                            <div class="msg_list_img">
                              <img src="../assets/img/latest/msg_img.png" alt="">
                            </div>
                            <div class="msg_name">
                              <h5>{{$st->name}}</h5>
                              <p>{{$st->bio}}</p>
                            </div>
                          </div>
                          <div class="msg_time">
                            <p>{{$diff}}</p>
                          </div>
                        </div>
                        <p class="s_msg">{{$message}}</p>
                      </div>
                      </a>
                    @endif
                  @endforeach
                @endif
                @if($id == 5)
                  @foreach($instructors as $instrctr)
                    <?php
                      $ins  = DB::table('users')->where('id', $instrctr->i_u_id)->get()->first();
                      $user = Auth::user();
                      if(Auth::user()->role_id==5)
                        {
                        $instructor = $ins->id;
                        $student = Auth::user()->id;
                        $messages = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->pluck('content');
                        $message = $messages->values()->last();
                        $times = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->pluck('created_at');
                        $time = $times->values()->last();
                        // echo \Carbon\Carbon::now();
                          // echo \Carbon\Carbon::now()."   " . \Carbon\Carbon::parse($time);
                          $diff = \Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::parse($time));
                      }
                    ?>
                    @if(count($messages) > 0)
                        <div class="msg_listing">
                        <div class="msg_styling">
                          <div class="msg_img">
                            <div class="msg_list_img">
                              <img src="../assets/img/latest/msg_img.png" alt="">
                            </div>
                            <div class="msg_name">
                              <h5>{{$ins->name}}</h5>
                              <p>{{$ins->bio}}</p>
                            </div>
                          </div>
                          <div class="msg_time">
                            <p>{{$diff}}</p>
                          </div>
                        </div>
                        <p class="s_msg">{{$message}}</p>
                      </div>
                    @endif
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
        <span aria-hidden="true" class="cross_btn">&times;</span>
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
@endsection