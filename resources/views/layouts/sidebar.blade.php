@if(Auth::user()->role_id == 1)
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('/assets/img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('/assets/img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('/assets/img/upload/'.$user->image)}}" alt="" class="admin_pic img-fluid">
          <h3>{{$user->name}}</h3>
          <li class="arrow_dropdown dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('/assets/img/latest/arrow_down.png')}}" alt="">
              <p class="d-lg-none d-md-block">
                Account
              </p>
              <div class="ripple-container"></div>
            </a>
            <div class="dropdown-menu admin_dd dropdown-menu-right" aria-labelledby="navbarDropdownProfile" x-placement="bottom-end" style="position: absolute; top: 42px; left: -129px; will-change: top, left;">
              <a class="dropdown-item" href="{{url('/showprofile')}}"> <i class="fa fa-user"></i> Profile</a>
              <a class="dropdown-item" href="{{url('/messages')}}"><i class="fa fa-inbox"></i> Inbox</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/editprofile')}}"><i class="fa fa-cog"></i> Account Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/logout')}}"> <i class="fa fa-sign-out"></i> Log out</a>
            </div>
          </li>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/calendar')}}">
            <i class="fa fa-calendar"></i>
            <p>Calendar</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <i class="fa fa-graduation-cap"></i>
            <span>Schools</span>
          </a>
          <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/schools')}}">All Schools</a>
              <a class="collapse-item" href="{{url('/schoolcreate')}}">Add New School</a>
            </div>
          </div>
        </li>
      <!--   <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-book"></i>
            <span>Courses</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/course')}}">All Courses</a>
              <a class="collapse-item" href="{{url('/courses')}}">Add New Course</a>
            </div>
          </div>
        </li> -->
<!--         <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            <i class="fa fa-user-plus"></i>
            <span>Instructors</span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/instructors')}}">All Instructors</a>
              <a class="collapse-item" href="{{url('/instructors/create')}}">Add Instructor</a>
            </div>
          </div>
        </li> -->
      <!--   <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fa fa-user"></i>
            <span>Students</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/students')}}">All Students</a>
              <a class="collapse-item" href="{{url('/studentcreate')}}">Add new student</a>
            </div>
          </div>
        </li> -->
       <!--  <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
            <i class="fa fa-pencil"></i>
            <span>Quizzes</span>
          </a>
          <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/mcq/create')}}">Add New Quiz</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
            <i class="fa fa-file-text-o"></i>
            <span>Assignments</span>
          </a>
          <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/assignments/create')}}">Add New Assignment</a>
            </div>
          </div>
        </li> -->
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/safetytips')}}">
            <i class="fa fa-lightbulb-o"></i>
            <p>Grecon Safety Tips</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/userguide')}}">
            <i class="fa fa-address-book-o"></i>
            <p>User Guide</p>
          </a>
        </li>
        <!-- {{-- <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
            <i class="fa fa-graduation-cap"></i>
            <span>Classes</span>
          </a>
          <div id="collapseEleven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/classes')}}">All Classes</a>
              <a class="collapse-item" href="{{url('/classcreate')}}">Add New Class</a>
            </div>
          </div>
        </li> --}}
        {{-- <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
            <i class="fa fa-graduation-cap"></i>
            <span>Rooms</span>
          </a>
          <div id="collapseNine" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/rooms')}}">All Rooms</a>
              <a class="collapse-item" href="{{url('/rooms/create')}}">Add Room</a>
            </div>
          </div>
        </li> --}} -->
   <!--      {{-- <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
            <i class="fa fa-calendar-o"></i>
            <span>Discussions</span>
          </a>
          <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/discussions')}}">All Discussions</a>
              <a class="collapse-item" href="{{url('/discussions/create')}}">Add Discussion</a>
            </div>
          </div>
        </li> --}}
        {{-- <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
            <i class="fa fa-calendar-o"></i>
            <span>Icons</span>
          </a>
          <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/viewicon')}}">Icons List</a>
              <a class="collapse-item" href="{{url('/create')}}">Add new icon</a>
            </div>
          </div>
        </li> --}} -->
   <!--      {{-- <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
            <i class="fa fa-graduation-cap"></i>
            <span>Pages</span>
          </a>
          <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/aboutpage')}}">About Page</a>
              <a class="collapse-item" href="{{url('/contactpage')}}">Contact Us</a>
            </div>
          </div>
        </li> --}}
        {{-- <li class="nav-item active ">
          <a class="nav-link" href="{{url('/setting')}}">
            <i class="fa fa-home"></i>
            <p>Settings</p>
          </a>
        </li> --}} -->
      </ul>
    </div>
  </div>

@elseif(Auth::user()->role_id == 2)
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('/assets/img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('/assets/img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('/assets/img/upload/'.$user->image)}}" alt="" class="admin_pic img-fluid">
          <h3>{{$user->name}}</h3>
          <li class="arrow_dropdown dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('/assets/img/latest/arrow_down.png')}}" alt="">
              <p class="d-lg-none d-md-block">
                Account
              </p>
              <div class="ripple-container"></div>
            </a>
            <div class="dropdown-menu admin_dd dropdown-menu-right" aria-labelledby="navbarDropdownProfile" x-placement="bottom-end" style="position: absolute; top: 42px; left: -129px; will-change: top, left;">
              <a class="dropdown-item" href="{{url('/showprofile')}}"> <i class="fa fa-user"></i> Profile</a>
              <a class="dropdown-item" href="{{url('/messages')}}"><i class="fa fa-inbox"></i> Inbox</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/editprofile')}}"><i class="fa fa-cog"></i> Account Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/logout')}}"> <i class="fa fa-sign-out"></i> Log out</a>
            </div>
          </li>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/calendar')}}">
            <i class="fa fa-calendar"></i>
            <p>Calendar</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <i class="fa fa-graduation-cap"></i>
            <span>Schools</span>
          </a>
          <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/schools')}}">All Schools</a>
              <a class="collapse-item" href="{{url('/schoolcreate')}}">Add New School</a>
            </div>
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/safetytips')}}">
            <i class="fa fa-lightbulb-o"></i>
            <p>Grecon Safety Tips</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/userguide')}}">
            <i class="fa fa-address-book-o"></i>
            <p>User Guide</p>
          </a>
        </li>
      </ul>
    </div>
  </div>

@elseif(Auth::user()->role_id == 3)
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('/assets/img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('/assets/img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('/assets/img/upload/'.$user->image)}}" alt="" class="admin_pic img-fluid">
          <h3>{{$user->name}}</h3>
          <li class="arrow_dropdown dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('/assets/img/latest/arrow_down.png')}}" alt="">
              <p class="d-lg-none d-md-block">
                Account
              </p>
              <div class="ripple-container"></div>
            </a>
            <div class="dropdown-menu admin_dd dropdown-menu-right" aria-labelledby="navbarDropdownProfile" x-placement="bottom-end" style="position: absolute; top: 42px; left: -129px; will-change: top, left;">
              <a class="dropdown-item" href="{{url('/showprofile')}}"> <i class="fa fa-user"></i> Profile</a>
              <a class="dropdown-item" href="{{url('/messages')}}"><i class="fa fa-inbox"></i> Inbox</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/editprofile')}}"><i class="fa fa-cog"></i> Account Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/logout')}}"> <i class="fa fa-sign-out"></i> Log out</a>
            </div>
          </li>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/calendar')}}">
            <i class="fa fa-home"></i>
            <p>Calendar</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-book"></i>
            <span>Courses</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/course')}}">All Courses</a>
              <a class="collapse-item" href="{{url('/courses')}}">Add New Course</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            <i class="fa fa-user-plus"></i>
            <span>Instructors</span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/instructors')}}">All Instructors</a>
              <a class="collapse-item" href="{{url('/instructors/create')}}">Add Instructor</a>
            </div>
          </div>
        </li>
        <!-- <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fa fa-user"></i>
            <span>Students</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/students')}}">All Students</a>
              <a class="collapse-item" href="{{url('/studentcreate')}}">Add new student</a>
            </div>
          </div>
        </li> -->
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <i class="fa fa-graduation-cap"></i>
            <span>Departments</span>
          </a>
          <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/departments')}}">All Departments</a>
              <a class="collapse-item" href="{{url('/departments/create')}}">Add Department</a>
            </div>
          </div>
        </li>
 <!--        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
            <i class="fa fa-pencil"></i>
            <span>Quizzes</span>
          </a>
          <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/mcq/create')}}">Add New Quiz</a>
            </div>
          </div>
        </li>
 -->      <!--   <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
            <i class="fa fa-file-text-o"></i>
            <span>Assignments</span>
          </a>
          <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/assignments/create')}}">Add New Assignment</a>
            </div>
          </div>
        </li> -->
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/safetytips')}}">
            <i class="fa fa-lightbulb-o"></i>
            <p>Grecon Safety Tips</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/userguide')}}">
            <i class="fa fa-address-book-o"></i>
            <p>User Guide</p>
          </a>
        </li>
      </ul>
    </div>
  </div>

@elseif(Auth::user()->role_id == 4)
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('/assets/img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('/assets/img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('/assets/img/upload/'.$user->image)}}" alt="" class="admin_pic img-fluid">
          <h3>{{$user->name}}</h3>
          <li class="arrow_dropdown dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('/assets/img/latest/arrow_down.png')}}" alt="">
              <p class="d-lg-none d-md-block">
                Account
              </p>
              <div class="ripple-container"></div>
            </a>
            <div class="dropdown-menu admin_dd dropdown-menu-right" aria-labelledby="navbarDropdownProfile" x-placement="bottom-end" style="position: absolute; top: 42px; left: -129px; will-change: top, left;">
              <a class="dropdown-item" href="{{url('/showprofile')}}"> <i class="fa fa-user"></i> Profile</a>
              <a class="dropdown-item" href="{{url('/messages')}}"><i class="fa fa-inbox"></i> Inbox</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/editprofile')}}"><i class="fa fa-cog"></i> Account Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/logout')}}"> <i class="fa fa-sign-out"></i> Log out</a>
            </div>
          </li>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/calendar')}}">
            <i class="fa fa-home"></i>
            <p>Calendar</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-book"></i>
            <span>Courses</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/course')}}">All Courses</a>
              <a class="collapse-item" href="{{url('/courses')}}">Add New Course</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fa fa-user"></i>
            <span>Students</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/students')}}">All Students</a>
              <a class="collapse-item" href="{{url('/studentcreate')}}">Add new student</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
            <i class="fa fa-pencil"></i>
            <span>Quizzes</span>
          </a>
          <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/mcq/create')}}">Add New Quiz</a>
            </div>
          </div>
        </li>
<!--         <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
            <i class="fa fa-file-text-o"></i>
            <span>Assignments</span>
          </a>
          <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/assignments/create')}}">Add New Assignment</a>
            </div>
          </div>
        </li> -->
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/safetytips')}}">
            <i class="fa fa-lightbulb-o"></i>
            <p>Grecon Safety Tips</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/userguide')}}">
            <i class="fa fa-address-book-o"></i>
            <p>User Guide</p>
          </a>
        </li>
      </ul>
    </div>
  </div>

@elseif(Auth::user()->role_id == 5)
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('/assets/img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('/assets/img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('/assets/img/upload/'.$user->image)}}" alt="" class="admin_pic img-fluid">
          <h3>{{$user->name}}</h3>
          <li class="arrow_dropdown dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('/assets/img/latest/arrow_down.png')}}" alt="">
              <p class="d-lg-none d-md-block">
                Account
              </p>
              <div class="ripple-container"></div>
            </a>
            <div class="dropdown-menu admin_dd dropdown-menu-right" aria-labelledby="navbarDropdownProfile" x-placement="bottom-end" style="position: absolute; top: 42px; left: -129px; will-change: top, left;">
              <a class="dropdown-item" href="{{url('/showprofile')}}"> <i class="fa fa-user"></i> Profile</a>
              <a class="dropdown-item" href="{{url('/messages')}}"><i class="fa fa-inbox"></i> Inbox</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/editprofile')}}"><i class="fa fa-cog"></i> Account Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/logout')}}"> <i class="fa fa-sign-out"></i> Log out</a>
            </div>
          </li>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/calendar')}}">
            <i class="fa fa-home"></i>
            <p>Calendar</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/safetytips')}}">
            <i class="fa fa-lightbulb-o"></i>
            <p>Grecon Safety Tips</p>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/userguide')}}">
            <i class="fa fa-address-book-o"></i>
            <p>User Guide</p>
          </a>
        </li>
      </ul>
    </div>
  </div>

@else

@endif