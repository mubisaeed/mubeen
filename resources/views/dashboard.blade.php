@extends('layouts.app')
@section('content')

<div id="message">
            @if (Session::has('message'))
              <div class="alert alert-info">
                {{ Session::get('message') }}
              </div>
            @endif
          </div>
  <div class="row make_visible">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="graduation_cap"><img src="{{('img/latest/cap.png')}}" alt=""></i>
          </div>
          <p class="card-category">Courses</p>
          <h3 class="card-title">4
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
            <i class="daily_usr"><img src="{{('img/latest/checking-attendance.png')}}" alt=""></i>
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
            <i class="carbon_report"><img src="{{('img/latest/carbon_report.png')}}" alt=""></i>
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
            <i class="quiz"><img src="{{('img/latest/quiz.png')}}" alt=""></i>
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
      <div class="student_roaster card-header card-header-warning card-header-icon">
        <div class="card-icon">
          <h2>Student Roster</h2>
        </div>
        <div class="current_date">
          <input type="date" name="" value="" placeholder="Oct - Nov 2019" >
        </div>
        <div class="stu_list">
          <div class="stu_img">
            <img src="{{('img/latest/Oval.png')}}" alt="">
            <div class="stu_text">
              <h4>Mr Wick</h4>
              <p>60%</p>
            </div>
          </div>
          <div class="stu_sub">
            <p>Mathematics</p>
            <p>#1232</p>
          </div>
        </div>
        <div class="stu_list">
          <div class="stu_img">
            <img src="{{('img/latest/Oval2.png')}}" alt="">
            <div class="stu_text">
              <h4>Lily Joe</h4>
              <p>68%</p>
            </div>
          </div>
          <div class="stu_sub">
            <p>Mathematics</p>
            <p>#4355</p>
          </div>
        </div>
        <div class="stu_list">
          <div class="stu_img">
            <img src="{{('img/latest/Oval3.png')}}" alt="">
            <div class="stu_text">
              <h4>Jone dakker</h4>
              <p>70%</p>
            </div>
          </div>
          <div class="stu_sub">
            <p>Mathematics</p>
            <p>#1532</p>
          </div>
        </div>
        <div class="stu_list">
          <div class="stu_img">
            <img src="{{('img/latest/Oval4.png')}}" alt="">
            <div class="stu_text">
              <h4>Cloi claver</h4>
              <p>73%</p>
            </div>
          </div>
          <div class="stu_sub">
            <p>Mathematics</p>
            <p>#1342</p>
          </div>
        </div>
        <div class="stu_list">
          <div class="stu_img">
            <img src="{{('img/latest/Oval.png')}}" alt="">
            <div class="stu_text">
              <h4>Mr Wick</h4>
              <p>60%</p>
            </div>
          </div>
          <div class="stu_sub">
            <p>Mathematics</p>
            <p>#1232</p>
          </div>
        </div>
        <div class="stu_list">
          <div class="stu_img">
            <img src="{{('img/latest/Oval2.png')}}" alt="">
            <div class="stu_text">
              <h4>Lily Joe</h4>
              <p>68%</p>
            </div>
          </div>
          <div class="stu_sub">
            <p>Mathematics</p>
            <p>#4355</p>
          </div>
        </div>
        <div class="stu_list border-0">
          <div class="stu_img">
            <img src="{{('img/latest/Oval4.png')}}" alt="">
            <div class="stu_text">
              <h4>Cloi claver</h4>
              <p>73%</p>
            </div>
          </div>
          <div class="stu_sub">
            <p>Mathematics</p>
            <p>#1342</p>
          </div>
        </div>
        <div class="all_result text-center">
          <a href="#">See all results</a>
        </div>
      </div>
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
              $instructors = DB::table('users')->where('role_id', 4)->get();
              $students = DB::table('users')->where('role_id', 5)->get();
            ?>
            @if($id == 4)
              @foreach($students as $st)
              <?php
                    $user = Auth::user();
                    if(Auth::user()->role_id==4)
                      {
                      $student = $st->id;
                      $instructor = Auth::user()->id;
                      $messages = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->pluck('content');
                      $message = $messages->values()->last();
                      $times = DB::table('messages')->where('student' , $student)->where('instructor' , $instructor)->pluck('created_at');
                      $time = $times->values()->last();
                      // echo \Carbon\Carbon::now();
                        // echo \Carbon\Carbon::now()."   " . \Carbon\Carbon::parse($time);
                        $diff = \Carbon\Carbon::now()->diffInMinutes(\Carbon\Carbon::parse($time));
                    }
                  ?>
                    <div class="ib_img">
                      <img src="{{asset('/img/upload/'.$st->image)}}" width="50" alt="">
                      <a href="{{url('/chatbox/'.$st->id)}}">
                        <div class="ib_text">
                          <h4>{{$st->name}}</h4>
                          <p class="ib_short_text m-0">{{$message}}</p>
                          <p class="time m-0">{{$diff}} minutes ago</p>
                        </div>
                      </a>
                    </div>
                @endforeach
              @endif
              @if($id == 5)
                @foreach($instructors as $ins)
                  <?php
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
                  <div class="ib_img">
                    <img src="{{asset('/img/upload/'.$ins->image)}}" width="50" alt="">
                    <a href="{{url('/chatbox/'.$ins->id)}}">
                      <div class="ib_text">
                        <h4>{{$ins->name}}</h4>
                        <p class="ib_short_text m-0">{{$message}}</p>
                        <p class="time m-0">{{$diff}}</p>
                      </div>
                    </a>
                  </div>
                @endforeach
              @endif
<!--           <div class="ib_img">
            <img src="{{('img/latest/Oval8.png')}}" alt="">
            <div class="ib_text">
              <h4>Andrew Stack</h4>
              <p class="ib_short_text m-0">Bonbon macaroon jelly beans gummi bears</p>
              <p class="time m-0">25 mins ago</p>
            </div>
          </div>
          <div class="ib_img">
            <img src="{{('img/latest/Oval9.png')}}" alt="">
            <div class="ib_text">
              <h4>Andrew Stack</h4>
              <p class="ib_short_text m-0">Bonbon macaroon jelly beans gummi bears</p>
              <p class="time m-0">25 mins ago</p>
            </div>
          </div>
          <div class="ib_img">
            <img src="{{('img/latest/Oval10.png')}}" alt="">
            <div class="ib_text">
              <h4>Andrew Stack</h4>
              <p class="ib_short_text m-0">Bonbon macaroon jelly beans gummi bears</p>
              <p class="time m-0">25 mins ago</p>
            </div>
          </div>
          <div class="ib_img">
            <img src="{{('img/latest/Oval11.png')}}" alt="">
            <div class="ib_text">
              <h4>Andrew Stack</h4>
              <p class="ib_short_text m-0">Bonbon macaroon jelly beans gummi bears</p>
              <p class="time m-0">25 mins ago</p>
            </div>
          </div>
          <div class="ib_img">
            <img src="{{('img/latest/Oval10.png')}}" alt="">
            <div class="ib_text">
              <h4>Andrew Stack</h4>
              <p class="ib_short_text m-0">Bonbon macaroon jelly beans gummi bears</p>
              <p class="time m-0">25 mins ago</p>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <div class="calender_main">
    <div class="calender card-header card-header-warning card-header-icon">
      <div class="card-icon">
        <h2>Calendar</h2>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div id="calendarContainer"></div>
        </div>
        <div class="col-md-7">
          <div id="organizerContainer"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="course_table">
    <div class="course card-header card-header-warning card-header-icon">
      <div class="card-icon">
        <h2>Course Schedules</h2>
      </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Courses</th>
            <th scope="col">Date</th>
            <th scope="col">Department</th>
            <th scope="col">Room No.</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">#12</th>
            <td class="first_row">
              <div class="course_td">
                <img src="{{('img/latest/Simple03.png')}}" alt="" class="img-fluid">
                <p>Mathematics</p>
              </div>
            </td>
            <td class="first_row">Jun 1, 2020 - Jun 30, 2020</td>
            <td class="first_row">Neuro Sciences</td>
            <td class="first_row">12</td>
            <td class="align_ellipse first_row"><a href="#"><span class="material-icons">
              more_horiz
            </span></a></td>
          </tr>
          <tr>
            <th scope="row">#13</th>
            <td>
              <div class="course_td">
                <img src="{{('img/latest/Simple04.png')}}" alt="" class="img-fluid">
                <p>Literature</p>
              </div>
            </td>
            <td>Jun 1, 2020 - Jun 30, 2020</td>
            <td>Neuro Sciences</td>
            <td>23</td>
            <td class="align_ellipse"><a href="#"><span class="material-icons">
              more_horiz
            </span></a></td>
          </tr>
          <tr>
            <th scope="row">#14</th>
            <td>
              <div class="course_td">
                <img src="{{('img/latest/Simple05.png')}}" alt="" class="img-fluid">
                <p>Psychology</p>
              </div>
            </td>
            <td>Jun 1, 2020 - Jun 30, 2020</td>
            <td>Neuro Sciences</td>
            <td>32</td>
            <td class="align_ellipse"><a href="#"><span class="material-icons">
              more_horiz
            </span></a></td>
          </tr>
          <tr>
            <th scope="row">#15</th>
            <td>
              <div class="course_td">
                <img src="{{('img/latest/Simple06.png')}}" alt="" class="img-fluid">
                <p>English</p>
              </div>
            </td>
            <td>Jun 1, 2020 - Jun 30, 2020</td>
            <td>Neuro Sciences</td>
            <td>2</td>
            <td class="align_ellipse"><a href="#"><span class="material-icons">
              more_horiz
            </span></a></td>
          </tr>
          <tr>
            <th scope="row">#16</th>
            <td>
              <div class="course_td">
                <img src="{{('img/latest/Simple07.png')}}" alt="" class="img-fluid">
                <p>Biology</p>
              </div>
            </td>
            <td>Jun 1, 2020 - Jun 30, 2020</td>
            <td>Neuro Sciences</td>
            <td>23</td>
            <td class="align_ellipse"><a href="#"><span class="material-icons">
              more_horiz
            </span></a></td>
          </tr>
          <tr>
            <th scope="row">#17</th>
            <td>
              <div class="course_td">
                <img src="{{('img/latest/Simple08.png')}}" alt="" class="img-fluid">
                <p>Mathematics</p>
              </div>
            </td>
            <td>Jun 1, 2020 - Jun 30, 2020</td>
            <td>Neuro Sciences</td>
            <td>4</td>
            <td class="align_ellipse"><a href="#"><span class="material-icons">
              more_horiz
            </span></a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>
</div>
<script type="text/javascript">
  setTimeout(function() {
    $('#message').fadeOut('fast');
}, 3000);
</script>
@endsection