@extends('layouts.app')

<link href="{{url('/assets/css/calendar.css')}}" rel="stylesheet" />
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>





@section('content')



  <div id="message">

    @if (Session::has('message'))

      <div class="alert alert-info">

        {{ Session::get('message') }}

      </div>

    @endif

  </div>
@if(Auth::user()->role_id == '1')
  <div class="row z_minus">

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-header card-header-warning card-header-icon">

          <div class="card-icon">

            <i class="graduation_cap"><img src="{{asset('/assets/img/latest/cap.png')}}" alt=""></i>

          </div>
          <?php
            // dd($students);
          ?>

          <p class="card-category">Sub Admins</p>

          <h3 class="card-title">
            6
          </h3>

        </div>

        <div class="card-footer">

          <div class="stats">

            <a href="javascript:;">90% completed</a>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-header card-header-success card-header-icon">

          <div class="card-icon">

            <i class="daily_usr"><img src="{{asset('/assets/img/latest/checking-attendance.png')}}" alt=""></i>

          </div>

          <p class="card-category">Schools</p>

          <h3 class="card-title">10</h3>

        </div>

        <div class="card-footer">

          <div class="stats">

            <a href="#">20% Absent</a>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-header card-header-success card-header-icon">

          <div class="card-icon">

            <i class="daily_usr"><img src="{{asset('/assets/img/latest/checking-attendance.png')}}" alt=""></i>

          </div>

          <p class="card-category">Schools</p>

          <h3 class="card-title">10</h3>

        </div>

        <div class="card-footer">

          <div class="stats">

            <a href="#">20% Absent</a>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-header card-header-success card-header-icon">

          <div class="card-icon">

            <i class="daily_usr"><img src="{{asset('/assets/img/latest/checking-attendance.png')}}" alt=""></i>

          </div>

          <p class="card-category">Schools</p>

          <h3 class="card-title">10</h3>

        </div>

        <div class="card-footer">

          <div class="stats">

            <a href="#">20% Absent</a>

          </div>

        </div>

      </div>

    </div>

  </div>
@else

  <div class="row z_minus">

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-header card-header-warning card-header-icon">

          <div class="card-icon">

            <i class="graduation_cap"><img src="{{asset('/assets/img/latest/cap.png')}}" alt=""></i>

          </div>
          <?php
            $no_courses = DB::table('course_instructor')->where('i_u_id', $user->id)->get()->pluck('course_id');
            $classes = DB::table('courses')->whereIn('id', $no_courses)->get()->pluck('clas_id');
            $student_classes = DB::table('classes_students')->whereIn('class_id', $classes)->get()->pluck('s_u_id');
             $students = DB::table('users')->join('students','students.s_u_id','=','users.id')->whereIn('users.id',$student_classes)->get();
            $std_classes = DB::table('classes_students')->where('s_u_id', $user->id)->get()->pluck('class_id');
            $std_courses = DB::table('courses')->whereIn('clas_id', $std_classes)->count();
            $all_courses = DB::table('courses')->count();
            // dd($students);
          ?>

          <p class="card-category">Courses</p>

          <h3 class="card-title">
            @if($user->role_id == '4')
              {{count($no_courses)}}
            @elseif($user->role_id == '5') 
              {{$std_courses}}
            @elseif($user->role_id == '3') 
              {{$all_courses}}
            @else
            6
            @endif
          </h3>

        </div>

        <div class="card-footer">

          <div class="stats">

            <a href="javascript:;">90% completed</a>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-header card-header-success card-header-icon">

          <div class="card-icon">

            <i class="daily_usr"><img src="{{asset('/assets/img/latest/checking-attendance.png')}}" alt=""></i>

          </div>

          <p class="card-category">Attendance</p>

          <h3 class="card-title">80%</h3>

        </div>

        <div class="card-footer">

          <div class="stats">

            <a href="#">20% Absent</a>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-header card-header-danger card-header-icon">

          <div class="card-icon">

            <i class="carbon_report"><img src="{{asset('/assets/img/latest/carbon_report.png')}}" alt=""></i>

          </div>

          <p class="card-category">Assignments</p>

          <h3 class="card-title">75%</h3>

        </div>

        <div class="card-footer">

          <div class="stats">

            <a href="#">25% Remaining</a>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-header card-header-info card-header-icon">

          <div class="card-icon">

            <i class="quiz"><img src="{{asset('/assets/img/latest/quiz.png')}}" alt=""></i>

          </div>

          <p class="card-category">Quizzes/Tests</p>

          <h3 class="card-title">80%</h3>

        </div>

        <div class="card-footer">

          <div class="stats">

            <a href="#">80% completed</a>

          </div>

        </div>

      </div>

    </div>

  </div>

@endif

  <div class="row">

    <div class="col-md-7">

      <div class="percent_chart percent_chart card-header card-header-warning card-header-icon">

        <div class="card-icon">

          <h2>Attendance</h2>

          <p>Students Attendance Trend Statistics</p>

        </div>

        <div id="chartContainer" style="height: 300px; width: 100%;overflow: hidden;"></div>

      </div>

      <div class="percent_chart line_chart percent_chart card-header card-header-warning card-header-icon">

        <div class="card-icon">

          <h2>Assignment Reporting</h2>

        </div>

        <div class="card">

          <div class="card-body">

            <canvas id="chBar" height="100"></canvas>

          </div>

        </div>

      </div>

      <div class="percent_chart progress_lines percent_chart card-header card-header-warning card-header-icon">

        <div class="card-icon">

          <h2>Course Statistics</h2>

        </div>

        <div class="progres_lines">

          <div class="progress_text">

            <h4>Macro Economics I</h4>

            <h3>73%</h3>

          </div>

          <div class="progress">

            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

          </div>

        </div>

        <div class="progres_lines">

          <div class="progress_text">

            <h4>Macro Economics II</h4>

            <h3>8%</h3>

          </div>

          <div class="progress">

            <div class="progress-bar yellow_bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

          </div>

        </div>

        <div class="progres_lines">

          <div class="progress_text">

            <h4>Statistics</h4>

            <h3>19%</h3>

          </div>

          <div class="progress">

            <div class="progress-bar green_bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

          </div>

        </div>

        <div class="progres_lines">

          <div class="progress_text">

            <h4>Finance</h4>

            <h3>27%</h3>

          </div>

          <div class="progress">

            <div class="progress-bar blue_bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

          </div>

        </div>

      </div>

    </div>


    <div class="col-md-5">

    @if(Auth::user()->role_id == 4)
        <div class="student_roaster card-header card-header-warning card-header-icon">

          <div class="card-icon">

            <h2>Student Roster</h2>

          </div>

          <div class="current_date">

            <input type="date" name="" value="" placeholder="Oct - Nov 2019" >

          </div>

          @foreach($students as $std)
            <div class="stu_list">
                <div class="stu_img">

                  <img src="{{asset('/assets/img/upload/'.$std->image)}}" alt="" width="50" height="50">

                  <div class="stu_text">

                    <h4>{{$std->name}}</h4>

                    <p>{{$std->rollno}}</p>

                  </div>

                </div>

              <div class="stu_sub">

                <p>Mathematics</p>

                <p>#{{$std->rollno}}</p>

              </div>

            </div>
          @endforeach

          <!-- <div class="stu_list border-0">

            <div class="stu_img">

              <img src="{{asset('/assets/img/latest/Oval4.png')}}" alt="">

              <div class="stu_text">

                <h4>Cloi claver</h4>

                <p>73%</p>

              </div>

            </div>

            <div class="stu_sub">

              <p>Mathematics</p>

              <p>#1342</p>

            </div>

          </div> -->

          <div class="all_result text-center">

            <a href="#">See all Students</a>

          </div>

        </div>
    @endif

      @if(Auth::user()->role_id == 4 || Auth::user()->role_id == 5)

        <div class="inbox card-header card-header-warning card-header-icon">

          <div class="card-icon">

            <h2>Inbox</h2>

          </div>

          <select class="form-control" >

            <option>Recent</option>

            <option>Latest</option>

          </select>

          <div class="listing_ib">

            <?php

                $id = Auth::user()->role_id;

                $instructors = DB::table('instructor_student')->where('s_u_id', Auth::user()->id)->get()->all();

                $students = DB::table('instructor_student')->where('created_by_id', Auth::user()->id)->get()->all();

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

                        $messages = DB::table('messages_instructor_student')->where('std_id' , $student)->where('ins_id' , $instructor)->pluck('content');

                        $message = $messages->values()->last();

                        $times = DB::table('messages_instructor_student')->where('std_id' , $student)->where('ins_id' , $instructor)->pluck('created_at');

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

                      <div class="ib_img">

                        @if($st->image == null)

                          <img src="{{asset('/assets/img/man.png')}}" width="50" alt="">

                        @else

                          <img src="{{asset('/assets/img/upload/'.$st->image)}}" width="50" alt="">

                        @endif

                        <a href="{{url('/chatbox/'.$st->id)}}">

                          <div class="ib_text">

                            <h4>{{$st->name}}</h4>

                            <p class="ib_short_text m-0">{{$message}}</p>

                            <p class="time m-0">{{$diff}}</p>

                          </div>

                        </a>

                      </div>

                    @endif

                  @endforeach

                @endif

                @if($id == 5)

                  @foreach($instructors as $instrctr)

                    <?php

                      $ins  = DB::table('users')->where('id', $instrctr->created_by_id)->get()->first();

                      $user = Auth::user();

                      if(Auth::user()->role_id==5)

                        {

                        $instructor = $ins->id;

                        $student = Auth::user()->id;

                        $messages = DB::table('messages_instructor_student')->where('std_id' , $student)->where('ins_id' , $instructor)->pluck('content');

                        $message = $messages->values()->last();

                        $times = DB::table('messages_instructor_student')->where('std_id' , $student)->where('ins_id' , $instructor)->pluck('created_at');

                        $time = $times->values()->last();

                        // echo \Carbon\Carbon::now();

                          // echo \Carbon\Carbon::now()."   " . \Carbon\Carbon::parse($time);

                          $diff = \Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::parse($time));

                      }

                    ?>

                    @if(count($messages) > 0)

                      <div class="ib_img">

                        <img src="{{asset('/assets/img/upload/'.$ins->image)}}" width="50" alt="">

                        <a href="{{url('/chatbox/'.$ins->id)}}">

                          <div class="ib_text">

                            <h4>{{$ins->name}}</h4>

                            <p class="ib_short_text m-0">{{$message}}</p>

                            <p class="time m-0">{{$diff}}</p>

                          </div>

                        </a>

                      </div>

                    @endif

                  @endforeach

                @endif

              </div>

        </div>

      @endif

    </div>

    <!-- <div class="col-md-4">

      <div class="card card-chart">

        <div class="card-header card-header-success">

          <div class="ct-chart" id="dailySalesChart"></div>

        </div>

        <div class="card-body">

          <h4 class="card-title">Daily Sales</h4>

          <p class="card-category">

            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>

          </div>

          <div class="card-footer">

            <div class="stats">

              <i class="material-icons">access_time</i> updated 4 minutes ago

            </div>

          </div>

        </div>

      </div>

      <div class="col-md-4">

        <div class="card card-chart">

          <div class="card-header card-header-warning">

            <div class="ct-chart" id="websiteViewsChart"></div>

          </div>

          <div class="card-body">

            <h4 class="card-title">Email Subscriptions</h4>

            <p class="card-category">Last Campaign Performance</p>

          </div>

          <div class="card-footer">

            <div class="stats">

              <i class="material-icons">access_time</i> campaign sent 2 days ago

            </div>

          </div>

        </div>

      </div>

      <div class="col-md-4">

        <div class="card card-chart">

          <div class="card-header card-header-danger">

            <div class="ct-chart" id="completedTasksChart"></div>

          </div>

          <div class="card-body">

            <h4 class="card-title">Completed Tasks</h4>

            <p class="card-category">Last Campaign Performance</p>

          </div>

          <div class="card-footer">

            <div class="stats">

              <i class="material-icons">access_time</i> campaign sent 2 days ago

            </div>

          </div>

        </div>

      </div> -->

    </div>

    <div class="calender_main">

      <div class="calender card-header card-header-warning card-header-icon">

        <div class="card-icon">

          <h2>Calendar</h2>

        </div>

        <div class="calendar_main">

          <div class="row">

            <div class="col-md-3">

              <div class="clndr_event_list">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#calendar_add_even">Add Calendar Data</button>

                <div class="radio_event_list">

                  <label class="container_radio" onclick="window.location.href = '/dashboard/School Calendar' ">School Calendar

                    <input type="radio"  checked  value="School Calendar" name="type" class="type">

                    <span class="checkmark"></span>

                  </label>

                  <label class="container_radio" onclick="window.location.href = '/dashboard/Live Instructor Schedule' ">Live Instructor Schedule

                    <input type="radio" @if(isset($type) && $type == 'Live Instructor Schedule') checked @endif name="type" value="Live Instructor Schedule" class="type">

                    <span class="checkmark"></span>

                  </label>

                  <label class="container_radio" onclick="window.location.href = '/dashboard/US Holidays' ">US Holidays

                    <input type="radio"  @if(isset($type) && $type == 'US Holidays') checked @endif  name="type" value="US Holidays" class="type">

                    <span class="checkmark"></span>

                  </label>

                  <label class="container_radio" onclick="window.location.href = '/dashboard/Events' ">Events

                    <input type="radio"  @if(isset($type) && $type == 'Events') checked @endif  name="type" value="Events" class="type">

                    <span class="checkmark"></span>

                  </label>


                </div>

              </div>

            </div>

            <div class="col-md-9">

              <div class="top_clndr">

                <div class="">

                  <div class="card-body p-0">

                    <div>
                      {!! $calendar->calendar() !!}
                      {!! $calendar->script() !!}
                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

          

        </div>

      </div>

<!--   <div class="mt-5">
     {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
  </div> -->
    </div>


















    <div class="course_table">

      <div class="course card-header card-header-warning card-header-icon">

        <div class="card-icon">

          <h2>Latest Courses</h2>

        </div>

       

        <table class="table table-hover" id="table-id">

          <thead>

            <tr>

              <th scope="col">Sr.</th>

              <th scope="col">Courses</th>

              <th scope="col">Date</th>

              {{-- <th scope="col">Department</th> --}}

              <th scope="col">Room No.</th>

              <th scope="col">Action</th>

            </tr>

          </thead>

          <tbody id="mybody">


              <?php

                $courses = DB::table('courses')->orderBy('id', 'desc')->get();
                $count = 1;

              ?>

              @foreach($courses as $index =>$course)
              <tr>

                <th scope="row">#{{$count}}</th>
                  <?php $count++; ?>

                <td class="first_row">

                  <div class="course_td">

                      <img src="{{asset('/assets/img/upload/'.$course->image)}}" width="50" alt="" class="img-fluid">

                    <p>{{$course->course_name}}</p>

                  </div>

                </td>

                <td class="first_row">{{date('d-m-Y', strtotime($course->start_date))}} - {{date('d-m-Y', strtotime($course->end_date))}}</td>

                {{-- <td class="first_row">{{$course->department}}</td> --}}

                <td class="first_row">{{$course->room_number}}</td>

                <td class="align_ellipse first_row">

                  <li class="nav-item dropdown">

                    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                      <span class="material-icons">

                        more_horiz

                      </span>

                      <div class="ripple-container"></div>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                      <a class="dropdown-item" href="{{url('/course/'.$course->slug)}}" target="_blank"> <i class="fa fa-eye"></i>View</a>

                      <a class="dropdown-item" href="{{url('course/edit/' . $course->id)}}"><i class="fa fa-cogs"></i>Edit</a>

                      <a href="javascript:void(0);" data-id="<?php echo $course->id; ?>" class="dropdown-item delete"><i class="fa fa-trash"></i>Delete</a>

                    </div>

                  </li>

                </td>

              </tr>

              @endforeach

          </tbody>

        </table>
          <div class="table_footer">
            <div class="table_pegination">
              <nav>
                <ul class="pager pagination">
                  <li data-page="prev" class="pager__item pager__item--prev"><span class="pager__link fa fa-angle-left">
                  <span class="sr-only">(current)</span></span></li>
                  <li data-page="next" id="prev" class="pager__item pager__item--prev"><span class="pager__link fa fa-angle-right">
                  <span class="sr-only">(current)</span></span></li>
                </ul>
              </nav>
            </div>
            <div class="table_rows">
              <div class="rows_main">
                <p>Rows per page</p>
                <select name="state" id="maxRows">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                </select>
              </div>
            </div>
          </div>

    </div>

  </div>

  <!-- calendar modal -->

  <div id="modal-view-event" class="modal modal-top fade calendar-modal">

    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <div class="modal-body">

          <h4 class="modal-title"><span class="event-icon"></span><span class="event-title"></span></h4>

          <div class="event-body"></div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

        </div>

      </div>

    </div>

  </div>

  <div id="modal-view-event-add" class="modal modal-top fade calendar-modal">

    <div class="modal-dialog modal-dialog-centered" role="document">

  <div class="modal-content">

    <div class="cross_modal">

      <div class="modal_title">

        <h3>Add Event</h3>

      </div>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true" class="cross_btn">×</span>

      </button>

    </div>

    <div class="modal-body">

      <form method="POST" action="/add_event_from_calendar">

        @csrf

        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

        <div class="custom_input_main mobile_field">

          <input type="text" class="form-control" name="event_name">



          <label>Event Name <span class="grey">*</span></label>

        </div>

        <div class="custom_input_main mobile_field">

          <input type="date" class="form-control" name="event_date">



          <label>Event Date <span class="red">*</span></label>

        </div>

        <div class="custom_input_main mobile_field">

          <textarea class="form-control" name="event_description"></textarea>



          <label>Event Description <span class="red">*</span></label>

        </div>

        <div class="s_form_button">

          <a href="/dashboard"><button type="button" class="btn cncl_btn">Cancel</button></a>

          <button type="submit" class="btn save_btn">Save</button>

        </div>

      </form>

    </div>

  </div>

</div>

  </div>





<!-- Modal -->
<div class="modal fade" id="calendar_add_even" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Calendar Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/add_event_from_calendar">
          @csrf
           <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
           <input type="hidden" name="event_type" @if(isset($type)) value="{{$type}}" @else value="School Calendar" @endif id="form_type">

        <div class="custom_input_main mobile_field">

          <input type="text" class="form-control" name="event_name" required>



          <label>Event Name <span class="grey">*</span></label>

        </div>

        <div class="custom_input_main mobile_field">

          <input type="date" class="form-control" name="event_start" required>



          <label>Event Start Date <span class="red">*</span></label>

        </div>

        <div class="custom_input_main mobile_field">

          <input type="date" class="form-control" name="event_end" required>



          <label>Event End Date <span class="red">*</span></label>

        </div>

        <div class="custom_input_main mobile_field">

          <textarea class="form-control" name="event_description" required></textarea>



          <label>Event Description <span class="red">*</span></label>

        </div>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
       </form>
    </div>
  </div>
</div>


<script type="text/javascript">

  $(".type").change(function(){ // bind a function to the change event
        if( $(this).is(":checked") ){ // check if the radio is checked
            var val = $(this).val(); // retrieve the value
            $("#form_type").val(val);
        }
    });

  setTimeout(function() {

    $('#message').fadeOut('fast');

}, 3000);

</script>

<script type="text/javascript">

        $( "body" ).on( "click", ".delete", function () {

            var task_id = $( this ).attr( "data-id" );

            var form_data = {

                id: task_id

            };

            swal({

                title: "Do you want to delete this Course",

                //text: "@lang('category.delete_category_msg')",

                type: 'info',

                showCancelButton: true,

                confirmButtonColor: '#F79426',

                cancelButtonColor: '#d33',

                confirmButtonText: 'Yes',

                showLoaderOnConfirm: true

            }).then( ( result ) => {

                if ( result.value == true ) {

                    $.ajax( {

                        type: 'POST',

                        headers: {

                            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )

                        },

                        url: '<?php echo url("course/delete"); ?>',

                        data: form_data,

                        success: function ( msg ) {

                            swal( "@lang('Course Deleted Successfully')", '', 'success' )

                            setTimeout( function () {

                                location.reload();

                            }, 900 );

                        }

                    } );

                }

            } );

        } );

</script>

<script>
    getPagination('#table-id');
  
    function getPagination(table) {
      var lastPage = 1;

      $('#maxRows')
        .on('change', function(evt) {
          //$('.paginationprev').html('');            // reset pagination

        lastPage = 1;
          $('.pagination')
            .find('li')
            .slice(1, -1)
            .remove();
          var trnum = 0; // reset tr counter
          var maxRows = parseInt($(this).val()); // get Max Rows from select option

          if (maxRows == 5000) {
            $('.pagination').hide();
          } else {
            $('.pagination').show();
          }

          var totalRows = $(table + ' tbody tr').length; // numbers of rows
          $(table + ' tr:gt(0)').each(function() {
            // each TR in  table and not the header
            trnum++; // Start Counter
            if (trnum > maxRows) {
              // if tr number gt maxRows

              $(this).hide(); // fade it out
            }
            if (trnum <= maxRows) {
              $(this).show();
            } // else fade in Important in case if it ..
          }); //  was fade out to fade it in
          if (totalRows > maxRows) {
            // if tr total rows gt max rows option
            var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
            //  numbers of pages
            for (var i = 1; i <= pagenum; ) {
              // for each page append pagination li
              $('.pagination #prev')
                .before(
                  '<li data-page="' +
                    i +
                    '" class="pager__item">\
                      <span class="pager__link">' +
                    i++ +
                    '<span class="sr-only">(current)</span></span>\
                    </li>'
                )
                .show();
            } // end for i
          } // end if row count > max rows
          $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
          $('.pagination li').on('click', function(evt) {
            // on click each page
            evt.stopImmediatePropagation();
            evt.preventDefault();
            var pageNum = $(this).attr('data-page'); // get it's number

            var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

            if (pageNum == 'prev') {
              if (lastPage == 1) {
                return;
              }
              pageNum = --lastPage;
            }
            if (pageNum == 'next') {
              if (lastPage == $('.pagination li').length - 2) {
                return;
              }
              pageNum = ++lastPage;
            }

            lastPage = pageNum;
            var trIndex = 0; // reset tr counter
            $('.pagination li').removeClass('active'); // remove active class from all li
            $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
            // $(this).addClass('active');          // add active class to the clicked
          limitPagging();
            $(table + ' tr:gt(0)').each(function() {
              // each tr in table not the header
              trIndex++; // tr index counter
              // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
              if (
                trIndex > maxRows * pageNum ||
                trIndex <= maxRows * pageNum - maxRows
              ) {
                $(this).hide();
              } else {
                $(this).show();
              } //else fade in
            }); // end of for each tr in table
          }); // end of on click pagination list
        limitPagging();
        })
        .val(5)
        .change();

      // end of on select change

      // END OF PAGINATION
    }

    function limitPagging(){
      // alert($('.pagination li').length)

      if($('.pagination li').length > 7 ){
          if( $('.pagination li.active').attr('data-page') <= 3 ){
          $('.pagination li:gt(5)').hide();
          $('.pagination li:lt(5)').show();
          $('.pagination [data-page="next"]').show();
        }if ($('.pagination li.active').attr('data-page') > 3){
          $('.pagination li:gt(0)').hide();
          $('.pagination [data-page="next"]').show();
          for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
            $('.pagination [data-page="'+i+'"]').show();

          }

        }
      }
      if($('.pagination li').length == 2){
        document.getElementsByClassName('pagination').hide();
      }
    }
    
  </script>

@endsection