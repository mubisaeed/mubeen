@if(Auth::user()->role_id == 1)
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('img/latest/admin.png')}}" alt="" class="img-fluid">
          <h3>Lily Cristopher</h3>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- <li class="nav-item active">
          <a class="nav-link" href="{{url('edit', Auth::user()->id)}}">
            <i class="fa fa-home"></i>
            <p>Edit Profile</p>
          </a>
        </li> -->
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/showcalender')}}">
            <i class="fa fa-home"></i>
            <p>Calender</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
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
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-graduation-cap"></i>
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
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fa fa-calendar-o"></i>
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
            <li class="nav-item dropdown_item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <i class="fa fa-calendar-o"></i>
                <span>Discussions</span>
              </a>
              <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-2 collapse-inner rounded">
                  <a class="collapse-item" href="/discussions">All Discussions</a>
                  <a class="collapse-item" href="/discussions/create">Add Discussion</a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown_item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <i class="fa fa-calendar-o"></i>
                <span>Icons</span>
              </a>
              <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-2 collapse-inner rounded">
                  <a class="collapse-item" href="/viewicon">Icons List</a>
                  <a class="collapse-item" href="/create">Add new icon</a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown_item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                <i class="fa fa-calendar-o"></i>
                <span>Course Resources</span>
              </a>
              <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-2 collapse-inner rounded">
                  <a class="collapse-item" href="{{route('/courseresourse')}}">All Resources</a>
                  <a class="collapse-item" href="{{route('/resource')}}">Add Resources</a>
                </div>
              </div>
            </li>
         <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            <i class="fa fa-calendar-o"></i>
            <span>Instructors</span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/instructors">All Instructors</a>
              <a class="collapse-item" href="/instructors/create">Add Instructor</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
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
        </li>
         <li class="nav-item dropdown_item">
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
            </li>
            <li class="nav-item active ">
              <a class="nav-link" href="/setting">
                <i class="fa fa-home"></i>
                <p>Settings</p>
              </a>
            </li>
      </ul>
    </div>
  </div>
@elseif(Auth::user()->role_id == 2)
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('img/latest/admin.png')}}" alt="" class="img-fluid">
          <h3>Lily Cristopher</h3>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- <li class="nav-item active ">
          <a class="nav-link" href="{{url('edit', Auth::user()->id)}}">
            <i class="fa fa-home"></i>
            <p>Edit Profile</p>
          </a>
        </li> -->
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/showcalender')}}">
            <i class="fa fa-home"></i>
            <p>Calender</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-graduation-cap"></i>
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
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fa fa-calendar-o"></i>
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
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            <i class="fa fa-calendar-o"></i>
            <span>Instructors</span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/instructors">All Instructors</a>
              <a class="collapse-item" href="/instructors/create">Add Instructor</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
            <i class="fa fa-calendar-o"></i>
            <span>Discussions</span>
          </a>
          <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/discussions">All Discussions</a>
              <a class="collapse-item" href="/discussions/create">Add Discussion</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
            <i class="fa fa-calendar-o"></i>
            <span>Icons</span>
          </a>
          <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/viewicon">Icons List</a>
              <a class="collapse-item" href="/create">Add new icon</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
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
        </li>
      </ul>
    </div>
  </div>
@elseif(Auth::user()->role_id == 3)
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('img/latest/admin.png')}}" alt="" class="img-fluid">
          <h3>Lily Cristopher</h3>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- <li class="nav-item active ">
          <a class="nav-link" href="{{url('edit', Auth::user()->id)}}">
            <i class="fa fa-home"></i>
            <p>Edit Profile</p>
          </a>
        </li> -->
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/showcalender')}}">
            <i class="fa fa-home"></i>
            <p>Calender</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-graduation-cap"></i>
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
            <i class="fa fa-calendar-o"></i>
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
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            <i class="fa fa-calendar-o"></i>
            <span>Instructors</span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/instructors">All Instructors</a>
              <a class="collapse-item" href="/instructors/create">Add Instructor</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
            <i class="fa fa-calendar-o"></i>
            <span>Discussions</span>
          </a>
          <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/discussions">All Discussions</a>
              <a class="collapse-item" href="/discussions/create">Add Discussion</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
            <i class="fa fa-calendar-o"></i>
            <span>Icons</span>
          </a>
          <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/viewicon">Icons List</a>
              <a class="collapse-item" href="/create">Add new icon</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
@elseif(Auth::user()->role_id == 4)
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('img/latest/admin.png')}}" alt="" class="img-fluid">
          <h3>Lily Cristopher</h3>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- <li class="nav-item active ">
          <a class="nav-link" href="{{url('edit', Auth::user()->id)}}">
            <i class="fa fa-home"></i>
            <p>Edit Profile</p>
          </a>
        </li> -->
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/showcalender')}}">
            <i class="fa fa-home"></i>
            <p>Calender</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fa fa-calendar-o"></i>
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
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
            <i class="fa fa-calendar-o"></i>
            <span>Discussions</span>
          </a>
          <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/discussions">All Discussions</a>
              <a class="collapse-item" href="/discussions/create">Add Discussion</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
@elseif(Auth::user()->role_id == 5)
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('img/latest/admin.png')}}" alt="" class="img-fluid">
          <h3>Lily Cristopher</h3>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- <li class="nav-item active ">
          <a class="nav-link" href="{{url('edit', Auth::user()->id)}}">
            <i class="fa fa-home"></i>
            <p>Edit Profile</p>
          </a>
        </li> -->
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/showcalender')}}">
            <i class="fa fa-home"></i>
            <p>Calender</p>
          </a>
        </li>
        <li class="nav-item dropdown_item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
            <i class="fa fa-calendar-o"></i>
            <span>Discussions</span>
          </a>
          <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
              <a class="collapse-item" href="/discussions">All Discussions</a>
              <a class="collapse-item" href="/discussions/create">Add Discussion</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
@else
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('img/sidebar-1.jpg')}}">
      <div class="logo"><a href="{{url('/dashboard')}}" class="simple-text logo-normal">
        <img src="{{asset('img/latest/logo.png')}}" alt="" class="img-fluid">
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <div class="admin_image text-center">
          <img src="{{asset('img/latest/admin.png')}}" alt="" class="img-fluid">
          <h3>Lily Cristopher</h3>
        </div>
        <li class="nav-item active  ">
          <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fa fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
@endif