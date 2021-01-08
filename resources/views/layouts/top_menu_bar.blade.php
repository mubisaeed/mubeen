<div class="header_2">
  <div class="main_heding">
    <div class="hed_img">
      <img src="{{asset('img/latest/DouglasElem_63471360.png')}}" alt="" class="img-fluid">
      <h3>{{$user->name}} Dashboard</h3>
    </div>
    <div class="live_button">
      <button type="button"><img src="{{asset('img/latest/man-talking.png')}}" alt="" class="img-fluid">Live Instructor</button>
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
          <a href="{{url('/course')}}">Cources</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="top_menu_link @if(Request::segment(1) == 'calendar')  active_link arrow_box @endif">
          <a href="{{url('/calendar')}}">Calendar & Events</a>
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
                <span class="notification">5</span>
                <p class="d-lg-none d-md-block">
                  Some Actions
                </p>
                <div class="ripple-container"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Mike John responded to your email</a>
                <a class="dropdown-item" href="#">You have 5 new tasks</a>
                <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                <a class="dropdown-item" href="#">Another Notification</a>
                <a class="dropdown-item" href="#">Another One</a>
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