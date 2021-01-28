<?php
  $user = Auth::user();
?>

<?php

$special= DB::table('special_educations')->get();

?>
<div class="header_2">

  <div class="main_heding">

    <div class="hed_img">

      <img src="{{asset('/assets/img/upload/'.$user->image)}}" alt="" class="img-fluid" width="50" height="50">

      <h3>{{$user->name}} Dashboard</h3>

    </div>

    <div class="live_button">

      <button type="button"><img src="{{asset('/assets/img/latest/man-talking.png')}}" alt="" class="img-fluid">Live</button>

    </div>

  </div>

  <div class="top_menu_bar">

    <div class="row">

      <div class="col-md-2">

        <div class="top_menu_link  @if(Request::segment(1) == 'dashboard')  active_link arrow_box @endif ">

          <a href="{{url('/dashboard')}}">Dashboard</a>

        </div>

      </div>

      <div class="col-md-2">

        <div class="top_menu_link @if(Request::segment(1) == 'course')  active_link arrow_box @endif ">

          <a href="{{url('/course')}}">Courses</a>

        </div>

      </div>

      <div class="col-md-3">

        <div class="top_menu_link @if(Request::segment(1) == 'safetytips')  active_link arrow_box @endif">

          <a href="{{url('/safetytips')}}">Greecon Safety Tips</a>

        </div>

      </div>

      <div class="col-md-2">

        <div class="top_menu_link @if(Request::segment(1) == '#')  active_link arrow_box @endif">

          <a href="#">Schedule</a>

        </div>

      </div>

      <div class="col-md-3">

        <div class="top_menu_notification">

          <ul class="navbar-nav">

            <li class="nav-item">

              <a class="nav-link" href="javascript:;">

                <i class="fa fa-question-circle"></i>

                <p class="d-lg-none d-md-block">

                  Stats

                </p>

                <div class="ripple-container"></div>

              </a>

            </li>

            <li class="nav-item">

              <a class="nav-link" href="javascript:;">

                <i class="fa fa-envelope"></i>

                <p class="d-lg-none d-md-block">

                  Stats

                </p>

                <div class="ripple-container"></div>

              </a>

            </li>

            <li class="nav-item dropdown">

              <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <i class="fa fa-bell"></i>

                <span class="notification">
                @if(auth()->user()->role_id == '3')
                <?php

                $special = DB::table('special_educations')->where('is_seen', 0)->get()->count();
                ?>
                @elseif(auth()->user()->role_id == '5')
                 <?php

                $special = DB::table('special_educations')->where('is_rejected', 1)->where('student_id', auth()->user()->id)->get()->count();
                ?>

              {{$special}}

                @endif


                <span >5</span> 
                
                
                </span>

                <p class="d-lg-none d-md-block">

                  Some Actions

                </p>

                <div class="ripple-container"></div>

              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

              <?php

                $speciall = DB::table('special_educations')->where('is_rejected', 0)->get();

              ?>
              @foreach($speciall as $sp)
              
              <a class="dropdown-item" href="{{url('special_education/index')}}">{{DB::table('users')->where('id' , $sp->student_id)->pluck('name')->first()}}  responded to your email</a>
              
              @endforeach

                {{-- <a class="dropdown-item" href="#">Mike John responded to your email</a>

                <a class="dropdown-item" href="#">You have 5 new tasks</a>

                <a class="dropdown-item" href="#">You're now friend with Andrew</a>

                <a class="dropdown-item" href="#">Another Notification</a>

                <a class="dropdown-item" href="#">Another One</a> --}}

              </div>

            </li>

            {{-- <li class="nav-item dropdown">

              <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <i class="fa fa-user"></i>

                <p class="d-lg-none d-md-block">

                  Account

                </p>

                <div class="ripple-container"></div>

              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                <a class="dropdown-item" href="{{url('/showprofile')}}">Profile</a>

                <a class="dropdown-item" href="#">Settings</a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{url('/logout')}}">Log out</a>

              </div>

            </li> --}}

          </ul>

        </div>

      </div>

    </div>

  </div>

</div>
{{-- 

<script>

$(document).ready(function(){

// updating the view with notifications using ajax

function load_unseen_notification(view = '')

{

 $.ajax({

  url:"/special_education/notification",
  method:"get",
  data:{view:view},
  dataType:"json",
  success:function(data)

  {

   $('.dropdown-menu').html(data.notification);

   if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification);
   }

  }

 });

}

load_unseen_notification();

// submit form and get new records

$('#comment_form').on('submit', function(event){
 event.preventDefault();

 if($('#subject').val() != '' && $('#comment').val() != '')

 {

  var form_data = $(this).serialize();

  $.ajax({

   url:"/special_education/notification",
   method:"get",
   data:form_data,
   success:function(data)

   {

    $('#comment_form')[0].reset();
    load_unseen_notification();

   }

  });

 }

 else

 {
  alert("Both Fields are Required");
 }

});

// load new notifications

$(document).on('click', '.dropdown-toggle', function(){

 $('.count').html('');

 load_unseen_notification('yes');

});

setInterval(function(){

 load_unseen_notification();;

}, 5000);

});

</script> --}}