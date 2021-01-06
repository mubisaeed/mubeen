@extends('layouts.app')
@section('content')

<div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href = "#">Home</a></li>
                <li><a href="#"> All Courses </a> </li>
                <li class = "active">View</li>
              </ol>
            </div>
            
            <div class="content_main">
              <div class="card-header course_view_main">
                <div class="cv_head">
                  <div class="cv_title">
                    <h3 class="mb-0">{{$cat->course_name}}</h3>
                    <p> <i class="fa fa-clock-o"></i> {{date('d-m-Y', strtotime($cat->start_date))}} - {{date('d-m-Y', strtotime($cat->end_date))}} </p>
                  </div>
                  <div class="cv_cogs">
                    <a href="#"> <i class="fa fa-cogs"></i> </a>
                  </div>
                </div>
                <div class="cv_img_detail">
                  <div class="cv_img">
                    <img src="{{asset('img/latest/course_view.png')}}" alt="" class="img-fluid main_image_cv">
                    <div class="cv_detail">
                    <div class="cv_box">
                      <h4>Details</h4>
                      <div class="cv_box_detail">
                        <div class="cv_box_img">
                          <img src="{{asset('img/latest/pill1.png')}}" alt="" class="img-fluid">
                          <h5>Course ID</h5>
                        </div>
                        <div class="cv_box_rank">
                          <p>{{$cat->id}}</p>
                        </div>
                      </div>
                      <div class="cv_box_detail">
                        <div class="cv_box_img">
                          <img src="{{asset('img/latest/department1.png')}}" alt="" class="img-fluid">
                          <h5>Department</h5>
                        </div>
                        <div class="cv_box_rank">
                          <p>{{$cat->department}}</p>
                        </div>
                      </div>
                      <div class="cv_box_detail">
                        <div class="cv_box_img">
                          <img src="{{asset('img/latest/classroom1.png')}}" alt="" class="img-fluid">
                          <h5>Course Color</h5>
                        </div>
                        <div class="cv_box_rank">
                          <p>substr({{$cat->course_color}})</p>
                        </div>
                      </div>
                      <div class="cv_box_detail">
                        <div class="cv_box_img">
                          <img src="{{asset('img/latest/whiteboard1.png')}}" alt="" class="img-fluid">
                          <h5>Room No.</h5>
                        </div>
                        <div class="cv_box_rank">
                          <p>{{$cat->room_number}}</p>
                        </div>
                      </div>
                      <div class="cv_box_detail">
                        <div class="cv_box_img">
                          <img src="{{asset('img/latest/calendar1.png')}}" alt="" class="img-fluid">
                          <h5>Start Date </h5>
                        </div>
                        <div class="cv_box_rank">
                          <p>{{date('d-m-Y', strtotime($cat->start_date))}}</p>
                        </div>
                      </div>
                      <div class="cv_box_detail">
                        <div class="cv_box_img">
                          <img src="{{asset('img/latest/calendar1.png')}}" alt="" class="img-fluid">
                          <h5>End Date</h5>
                        </div>
                        <div class="cv_box_rank">
                          <p>{{date('d-m-Y', strtotime($cat->end_date))}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  
                  <div class="cv_tabs">
                    <div id="exTab2">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <ul class="nav nav-tabs">
                              <li class="active">
                                <a href="#1" data-toggle="tab">Description</a>
                              </li>
                              <li><a href="#2" data-toggle="tab" class="second_tab">Requirements</a>
                            </li>
                            <li><a href="#3" data-toggle="tab" class="third_tab">Course Roster</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    
                    <div class="panel-body">
                      <div class="tab-content ">
                        <div class="tab-pane active" id="1">
                          <p>
                            {!! $cat->course_description !!}
                            <!-- At vero eos et ac cusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atcorrupti quos dolores et 
                          quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est 
                          laborum et dolorum fuga. <br> <br>
                          On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoraliz the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble thena bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. <br> <br>
                           Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. --> 
                           </p>
                        </div>
                        <div class="tab-pane" id="2">
                          <p> <strong>Requirements</strong> At vero eos et ac cusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atcorrupti quos dolores et 
                          quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est 
                          laborum et dolorum fuga. <br> <br>
                          On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoraliz the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble thena bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. <br> <br>
                           Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                           </p>
                        </div>
                        <div class="tab-pane" id="3">
                          <p> <strong>Course Roster</strong> At vero eos et ac cusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atcorrupti quos dolores et 
                          quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est 
                          laborum et dolorum fuga. <br> <br>
                          On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoraliz the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble thena bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. <br> <br>
                           Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                           </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection