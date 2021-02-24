@extends('layouts.app')

@section('content')


<style type="text/css">
  
  .box{
    padding:60px 0px;
}

.box-part{
    background:#eef2fb;
    border-radius:0;
    padding:60px 10px;
    margin:30px 0px;
}
.text{
    margin:20px 0px;
}

.fa{
     color:#4183D7;
}
</style>

<div class="breadcrumb_main">

  <ol class="breadcrumb">

    <li><a href = "{{url('/dashboard')}}">Home</a></li>

    <li>Terms/Sessions</li>

    <li>Course</li>

    <li class = "active">All Weekly Details</li>

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

    <div class="all_courses_main">

      

      <div class="course_table no_before_table mt-0">

        <div class="course card-header card-header-warning card-header-icon">

          

          <h3>{{$course->course_name}} Weekly Details</h3>

          @if($weeks > 0)

            <div class="table_filters">

            <!--   <div class="table_search">

                <input type="text" name="search" id="search" value="" placeholder="Search...">

                <a href="#"> <i class="fa fa-search"></i> </a>

              </div> -->

             <!--  <div class="table_select">

                <select class="selectpicker">

                  <option>All Classes</option>

                  <option>Today </option>

                  <option>Macro Economics I</option>

                  <option>Macro Economics II</option>

                </select>

              </div> -->

            </div>

              <div class="box">
                <div class="container">
                  <div class="row">
                    @for($i = 1; $i <= $weeks; $i++)


                      <?php
                        $quizzes = DB::table('quizzes')->where([
                              ['instructor_id', '=', $instructor_id],
                              ['course_id', '=', $course->id],
                              ['week', '=', $i],
                          ])->count();
                        $lectures = DB::table('lectures')->where([
                              ['instructor_id', '=', $instructor_id],
                              ['course_id', '=', $course->id],
                              ['week', '=', $i],
                          ])->count();
                        $links = DB::table('courselink')->where([
                              ['instructor_id', '=', $instructor_id],
                              ['course_id', '=', $course->id],
                              ['week', '=', $i],
                          ])->count();
                        $videos = DB::table('resources')->where([
                              ['instructor_id', '=', $instructor_id],
                              ['course_id', '=', $course->id],
                              ['week', '=', $i],
                          ])->count();
                        $downloadables = DB::table('resources')->where([
                              ['instructor_id', '=', $instructor_id],
                              ['course_id', '=', $course->id],
                              ['week', '=', $i],
                          ])->count();
                      ?>
                    <div class="col-md-4">
                      <a href="{{url('/course/show_week_details/'. $instructor_id .'/'. $course->id .'/'. $i)}}">
                        <div class="member aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                            <div class="pic">
                                <img src="{{asset('/assets/img/upload/'.$course->image)}}" width="50" alt="" class="img-fluid">
                            </div>
                            <div class="member-info">
                                <h4>Week {{$i}}</h4>
                                <span>{{$links}} Links</span>
                                <span>{{$videos}} Videos</span>
                                <span>{{$quizzes}} Quizzes</span>
                                <span>{{$lectures}} Lectures</span>
                                <span>{{$downloadables}} Downloadables</span>
                                <div class="img_buttons">
                                    <a class="btn btn-primary" href="{{url('/course/show_week_details/'. $instructor_id .'/'. $course->id .'/'. $i)}}">View Resources</a>
                                </div>
                            </div>
                        </div>
                      </a>
                    </div>
                    @endfor
                  </div>    
                </div>
              </div>


           @else

            <p>There is nothing related course</p>

          @endif

        </div>

      </div>

    </div>

  </div>



<script>

    $(document).ready(function(){

      $("#search").on("keyup", function() {

        var value = $(this).val().toLowerCase();

        // alert(value);

        $("#mybody tr").filter(function() {

          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

        });

      });

    });

  </script>

<script type="text/javascript">

  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>

<script type="text/javascript">

  setTimeout(function() {

    $('#message').fadeOut('fast');

}, 2000);

</script>

          <!-- <script src="{{url('backend/sweetalerts/sweetalert2.all.js')}}"></script> -->


@endsection