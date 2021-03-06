<?php
  $user = Auth::user();
?>

  <div class="wrapper">

    <div class="sidebar"  data-color="purple" data-background-color="white" data-image="{{asset('/assets/img/sidebar-1.jpg')}}">

      <div class="logo">
        <a href="{{url('/dashboard')}}" class="simple-text logo-normal">

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

          <li class="nav-item  {{ Request::is('dashboard') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('/dashboard')}}">

              <i class="fa fa-home"></i>

              <p>Dashboard</p>

            </a>

          </li>

        @if($user->role_id == '1')
         <!--greetings-->
          <li class="nav-item dropdown_item  

          {{(Request::is('greetings/create') || Request::is('greetings/index'))? 'active' : '' }}

          ">

            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">

              <i class="fa fa-graduation-cap"></i>

              <span>Greetings</span>

            </a>

            <div id="collapseFive" class="collapse {{(Request::is('greetings/create') || Request::is('greetings/index'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">

                <a class="collapse-item {{ Request::is('greetings/index') ? 'active_multidropdown' : '' }}" href="{{url('/greetings/index')}}">All Greetings</a>

                <a class="collapse-item {{ Request::is('greetings/create') ? 'active_multidropdown' : '' }}" href="{{url('/greetings/create')}}">Add New Greeting</a>

              </div>

            </div>

          </li>

          @endif

          
        @if($user->role_id == '1' ||  $user->role_id == '2')
         <!--schools-->
          <li class="nav-item dropdown_item    
          {{(Request::is('schools') || Request::is('schoolcreate'))? 'active' : '' }}
          ">

            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">

              <i class="fa fa-graduation-cap"></i>

              <span>Schools</span>

            </a>

            <div id="collapseFour" class="collapse {{(Request::is('schools') || Request::is('schoolcreate'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">

                <a class="collapse-item {{ Request::is('schools') ? 'active_multidropdown' : '' }}" href="{{url('/schools')}}">All Schools</a>

                <a class="collapse-item {{ Request::is('schoolcreate') ? 'active_multidropdown' : '' }}" href="{{url('/schoolcreate')}}">Add New School</a>

              </div>

            </div>

          </li>
          
         

          <li class="nav-item dropdown_item  

          {{(Request::is('subadmin/show') || Request::is('Sub_admin/create'))? 'active' : '' }}
          ">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">

              <i class="fa fa-graduation-cap"></i>

              <span>Sub Admin</span>

            </a>

            <div id="collapseTen" class="collapse {{(Request::is('subadmin/show') || Request::is('Sub_admin/create'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">

                <a class="collapse-item {{ Request::is('subadmin/show') ? 'active_multidropdown' : '' }}" href="{{url('/subadmin/show')}}">All Sub Admin</a>

                @if($user->role_id == '1')

                  <a class="collapse-item {{ Request::is('Sub_admin/create') ? 'active_multidropdown' : '' }}" href="{{url('/Sub_admin/create')}}">Add New Sub Admin</a>

                @endif

              </div>

            </div>

          </li>

         <!--settings-->
          <li class="nav-item   {{ Request::is('setting') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('/setting')}}">

              <i class="fa fa-home"></i>

              <p>Settings</p>

            </a>

          </li>
           <!--pages-->
         <li class="nav-item dropdown_item   
         {{(Request::is('aboutpage') || Request::is('contactpage'))? 'active' : '' }}
         ">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">

              <i class="fa fa-graduation-cap"></i>

              <span>Pages</span>

            </a>

            <div id="collapseEight" class="collapse {{(Request::is('aboutpage') || Request::is('contactpage'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">

                <a class="collapse-item {{ Request::is('aboutpage') ? 'active_multidropdown' : '' }}" href="{{url('/aboutpage')}}">About Page</a>

                <a class="collapse-item {{ Request::is('contactpage') ? 'active_multidropdown' : '' }}" href="{{url('/contactpage')}}">Contact Us</a>

              </div>

            </div>

          </li> 

          <!-- greetig message -->

          
        @endif   
       
       
       
        @if( $user->role_id == '3' )

          <li class="nav-item  {{ Request::is('calendar') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('/calendar')}}">

              <i class="fa fa-calendar"></i>

              <p>Calendar</p>

            </a>

          </li>

          <li class="nav-item {{ Request::is('add_student_sample') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('/add_student_sample')}}">

              <i class="fa fa-calendar"></i>

              <p>Add student sample</p>

            </a>

          </li>

          <li class="nav-item {{ Request::is('show_attendance_to_school') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('/show_attendance_to_school')}}">

              <i class="fa fa-lightbulb-o"></i>

              <p>Attendance</p>

            </a>

          </li>

          @if(  in_array('All Departments', $data) || in_array('Add Department', $data) ) 
            <li class="nav-item dropdown_item  
              {{(Request::is('departments') || Request::is('departments/create'))? 'active' : '' }}
            ">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">

              <i class="fa fa-graduation-cap"></i>

              <span>Departments</span>

            </a>

            <div id="collapseOne" class="collapse {{(Request::is('departments') || Request::is('departments/create'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
              @if(  in_array('All Departments', $data) )
                <a class="collapse-item {{ Request::is('departments') ? 'active_multidropdown' : '' }}" href="{{url('/departments')}}">All Departments</a>
                @endif
              @if(  in_array('Add Department', $data) )
                <a class="collapse-item {{ Request::is('departments/create') ? 'active_multidropdown' : '' }}" href="{{url('/departments/create')}}">Add Department</a>
              @endif
              </div>

            </div>

          </li>
          <li class="nav-item {{ Request::is('setgrades') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('/setgrades')}}">

              <i class="fa fa-calendar"></i>

              <p>Set Grades</p>

            </a>

          </li>
        @endif

           @if(  in_array('All Classes', $data) || in_array('Add New Class', $data) ) 
            <!--classes-->
              <li class="nav-item dropdown_item  
                {{(Request::is('classes') || Request::is('classcreate'))? 'active' : '' }}
              ">
      
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
      
                  <i class="fa fa-graduation-cap"></i>
      
                  <span>Terms/Sessions</span>
      
                </a>
      
                <div id="collapseEleven" class="collapse {{(Request::is('classes') || Request::is('classcreate'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
      
                  <div class="py-2 collapse-inner rounded">
                   @if(  in_array('All Classes', $data)  )
                    <a class="collapse-item {{ Request::is('classes') ? 'active_multidropdown' : '' }}" href="{{url('/classes')}}">All Terms</a>
                    @endif
                       @if(  in_array('Add New Class', $data) )
                    <a class="collapse-item {{ Request::is('classcreate') ? 'active_multidropdown' : '' }}" href="{{url('/classcreate')}}">Add New Term</a>
                    @endif
      
                  </div>
      
                </div>
      
              </li>
              @endif
              
          @if(  in_array('All Courses', $data) || in_array('Add New Course', $data) )    
        <!--courses-->
        <li class="nav-item dropdown_item  
          {{(Request::is('course') || Request::is('courses'))? 'active' : '' }}
        ">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

              <i class="fa fa-book"></i>

              <span>Courses</span>

            </a>

            <div id="collapseTwo" class="collapse {{(Request::is('course') || Request::is('courses'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
                 @if(  in_array('All Courses', $data) ) 
                <a class="collapse-item {{ Request::is('course') ? 'active_multidropdown' : '' }}" href="{{url('/course')}}">All Courses</a>
                 @endif
                 @if( in_array('Add New Course', $data) ) 
                <a class="collapse-item {{ Request::is('courses') ? 'active_multidropdown' : '' }}" href="{{url('/courses')}}">Add New Course</a>
                 @endif
              </div>

            </div>

          </li> 
          @endif    

          <!-- students -->


          @if(  in_array('All Students', $data) || in_array('Add New Student', $data) )    
        <!--courses-->
          <li class="nav-item dropdown_item  
            {{(Request::is('students') || Request::is('studentcreate'))? 'active' : '' }}
          ">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">

              <i class="fa fa-user"></i>

              <span>Students</span>

            </a>

            <div id="collapseThree" class="collapse {{(Request::is('students') || Request::is('studentcreate'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
                   @if(  in_array('All Students', $data) )
                <a class="collapse-item {{ Request::is('students') ? 'active_multidropdown' : '' }}" href="{{url('/students')}}">All Students</a>
                   @endif
                   @if(  in_array('Add New Student', $data) )
                <a class="collapse-item {{ Request::is('studentcreate') ? 'active_multidropdown' : '' }}" href="{{url('/studentcreate')}}">Add New Student</a>
                   @endif

              </div>

            </div>

          </li> 
          @endif    

        <!-- ins-->
        @if(  in_array('All Instructors', $data) || in_array('Add Instructor', $data) ) 
        <li class="nav-item dropdown_item  
          {{(Request::is('instructors') || Request::is('instructors/create'))? 'active' : '' }}
        ">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">

              <i class="fa fa-user-plus"></i>

              <span>Instructors</span>

            </a>

            <div id="collapseFive" class="collapse {{(Request::is('instructors') || Request::is('instructors/create'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
            @if(  in_array('All Instructors', $data)  ) 
                <a class="collapse-item {{ Request::is('instructors') ? 'active_multidropdown' : '' }}" href="{{url('/instructors')}}">All Instructors</a>
            @endif
            @if(   in_array('Add Instructor', $data) ) 
                <a class="collapse-item {{ Request::is('instructors/create') ? 'active_multidropdown' : '' }}" href="{{url('/instructors/create')}}">Add Instructor</a>
            @endif
              </div>

            </div>

          </li>
          @endif
          
          @if(  in_array('All Rooms', $data) || in_array('Add Room', $data) ) 
        <!--rooms-->
        <li class="nav-item dropdown_item  
          {{(Request::is('rooms') || Request::is('rooms/create'))? 'active' : '' }}
        ">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">

              <i class="fa fa-graduation-cap"></i>

              <span>Rooms</span>

            </a>

            <div id="collapseNine" class="collapse {{(Request::is('rooms') || Request::is('rooms/create'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
                @if(  in_array('All Rooms', $data)  ) 
                <a class="collapse-item {{ Request::is('rooms') ? 'active_multidropdown' : '' }}" href="{{url('/rooms')}}">All Rooms</a>
                @endif
                @if(   in_array('Add Room', $data) ) 
                <a class="collapse-item {{ Request::is('rooms/create') ? 'active_multidropdown' : '' }}" href="{{url('/rooms/create')}}">Add Room</a>
                @endif

              </div>

            </div>

          </li> 
          @endif
          
           <!-- @if(  in_array('All Discussions', $data) || in_array('Add Discussion', $data) )  -->
          <!--discussions-->
         <!-- <li class="nav-item dropdown_item  {{ Request::is('discussions') ? 'active' : '' }}">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">

              <i class="fa fa-calendar-o"></i>

              <span>Discussions</span>

            </a>

            <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
               @if(  in_array('All Discussions', $data)  ) 
                <a class="collapse-item" href="{{url('/discussions')}}">All Discussions</a>
              @endif
              @if(  in_array('Add Discussion', $data)  )
                <a class="collapse-item" href="{{url('/discussions/create')}}">Add Discussion</a>
              @endif  

              </div>

            </div>

          </li> -->
          <!-- @endif -->
          @if(  in_array('Icons List', $data) || in_array('Add New Icon', $data) ) 
           <!--icons-->
          <li class="nav-item dropdown_item  
            {{(Request::is('viewicon') || Request::is('create/icon'))? 'active' : '' }}
          ">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">

              <i class="fa fa-calendar-o"></i>

              <span>Icons</span>

            </a>

            <div id="collapseSix" class="collapse {{(Request::is('viewicon') || Request::is('create/icon'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
                 @if(  in_array('Icons List', $data) )
                <a class="collapse-item {{ Request::is('viewicon') ? 'active_multidropdown' : '' }}" href="{{url('/viewicon')}}">Icons List</a>
                 @endif
               @if(  in_array('Add New Icon', $data) )
                <a class="collapse-item {{ Request::is('create/icon') ? 'active_multidropdown' : '' }}" href="{{url('/create/icon')}}">Add new icon</a>
                @endif

              </div>

            </div>

          </li>
          @endif
          
          <!--department-->
          
    
        @endif 

        @if($user->role_id == '4')
          <li class="nav-item  {{ Request::is('calendar') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('/calendar')}}">

              <i class="fa fa-calendar"></i>

              <p>Calendar</p>

            </a>

          </li>
          @if(  in_array('All Classes', $data))
          <li class="{{ Request::is('/classes') ? 'active' : '' }} nav-item dropdown_item">
          
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
          
                      <i class="fa fa-graduation-cap"></i>
          
                      <span>Terms/Sessions</span>
          
                    </a>
    
              <div id="collapseEleven" class="collapse {{ Request::is('classes') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
    
                <div class="py-2 collapse-inner rounded">
                  <a class="collapse-item {{ Request::is('classes') ? 'active_multidropdown' : '' }}" href="{{url('/classes')}}">All Terms</a>
                 
    
                </div>
    
              </div>
    
            </li>
          @endif

          @if(  in_array('All Courses', $data)|| in_array('Add New Course', $data))

          <li class="nav-item dropdown_item  {{(Request::is('course') || Request::is('courses'))? 'active' : '' }}">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

              <i class="fa fa-book"></i>

              <span>Courses</span>

            </a>

            <div id="collapseTwo" class="collapse {{(Request::is('course') || Request::is('courses'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
                 @if(  in_array('All Courses', $data) )
                <a class="collapse-item {{ Request::is('course') ? 'active_multidropdown' : '' }}" href="{{url('/course')}}">All Courses</a>
                @endif
                @if(  in_array('Add New Course', $data) )
                <a class="collapse-item {{ Request::is('courses') ? 'active_multidropdown' : '' }}" href="{{url('/courses')}}">Add New Course</a>
                   @endif
              </div>

            </div>

          </li> 
          @endif

          @if(  in_array('All Students', $data) || in_array('Add New Student', $data) ) 
         <!--student-->
         <!-- <li class="nav-item dropdown_item  {{ Request::is('students') ? 'active' : '' }}">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">

              <i class="fa fa-user"></i>

              <span>Students</span>

            </a>

            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded"> -->
                  <!--  @if(  in_array('All Students', $data) )
                <a class="collapse-item" href="{{url('/students')}}">All Students</a>
                   @endif -->
                   <!-- @if(  in_array('Add New Student', $data) ) -->
                <!-- <a class="collapse-item" href="{{url('/studentcreate')}}">Add New Student</a> -->
                   <!-- @endif -->

              <!-- </div>

            </div>

          </li> -->
          @endif
     
      
       
        @if(  in_array('Add Questions', $data) )
         <!--quiz-->
<!--          <li class="nav-item dropdown_item">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">

              <i class="fa fa-pencil"></i>

              <span>Questions</span>

            </a>

            <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
                
                <a class="collapse-item" href="{{url('/mcq/create')}}">Add Questions</a>

              </div>

            </div>

          </li> -->
        @endif   
      
        @if(  in_array('Add New Assignment', $data) )
        <!--assignment-->
         <!--  <li class="nav-item dropdown_item">

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
        @endif  

                  @if(  in_array('All Discussions', $data) || in_array('Add Discussion', $data) ) 
          <!--discussions-->
           <li class="nav-item dropdown_item  {{(Request::is('discussions') || Request::is('discussions/create'))? 'active' : '' }}">

              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">

                <i class="fa fa-calendar-o"></i>

                <span>Discussions</span>

              </a>

              <div id="collapseSeven" class="collapse {{(Request::is('discussions') || Request::is('discussions/create'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

                <div class="py-2 collapse-inner rounded">
                 @if(  in_array('All Discussions', $data)  ) 
                  <a class="collapse-item {{ Request::is('discussions') ? 'active_multidropdown' : '' }}" href="{{url('/discussions')}}">All Discussions</a>
                @endif
                @if(  in_array('Add Discussion', $data)  )
                  <a class="collapse-item {{ Request::is('discussions/create') ? 'active_multidropdown' : '' }}" href="{{url('/discussions/create')}}">Add Discussion</a>
                @endif  

                </div>

              </div>

            </li>
          @endif  

        @endif
        
        
        
        @if(auth()->user()->role_id == '5')
      
      
        <li class="nav-item  {{ Request::is('calendar') ? 'active' : '' }}">

              <a class="nav-link" href="{{url('/calendar')}}">

                <i class="fa fa-calendar"></i>

                <p>Calendar</p>

              </a>

            </li>
      
       
   
         <li class="nav-item dropdown_item {{ Request::is('classes') ? 'active' : '' }}">
            
                      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
            
                        <i class="fa fa-graduation-cap"></i>
            
                        <span>Terms/Sessions</span>
            
                      </a>
      
                <div id="collapseEleven" class="collapse {{ Request::is('classes') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
      
                  <div class="py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::is('classes') ? 'active_multidropdown' : '' }}" href="{{url('/classes')}}">All Terms/Sessions</a>
                   
      
                  </div>
      
                </div>
      
              </li>


<!--             <li class="nav-item dropdown_item  {{Request::is('course') ? 'active' : '' }}">

              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                <i class="fa fa-book"></i>

                <span>Courses</span>

              </a>

              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

                <div class="py-2 collapse-inner rounded">
                  <a class="collapse-item" href="{{url('/course')}}">All Courses</a>
                
                </div>

              </div>
            </li> -->

          

          
            

             <li class="nav-item dropdown_item {{(Request::is('special_education/index') || Request::is('special_education/create'))? 'active' : '' }}">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">

              <i class="fa fa-user"></i>

              <span>Special Education</span>

            </a>

            <div id="collapseThree" class="collapse {{(Request::is('special_education/index') || Request::is('special_education/create'))? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">

              @if(auth()->user()->role_id == '3')
              
                <a class="collapse-item {{ Request::is('special_education/index') ? 'active_multidropdown' : '' }}" href="{{url('/special_education/index')}}">Special Education</a>

                @endif
                  
                
                <a class="collapse-item {{ Request::is('special_education/create') ? 'active_multidropdown' : '' }}" href="{{url('/special_education/create')}}">Add Special Education</a>
                  

              </div>

            </div>

          </li>


          <li class="nav-item dropdown_item  {{ Request::is('discussions') ? 'active' : '' }}">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">

              <i class="fa fa-calendar-o"></i>

              <span>Discussions</span>

            </a>

            <div id="collapseSeven" class="collapse {{ Request::is('discussions') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">

              <div class="py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('discussions') ? 'active_multidropdown' : '' }}" href="{{url('/discussions')}}">All Discussions</a>
              

              </div>

            </div>

          </li>


  
    
        @endif 
        <!--safty -->
          <li class="nav-item  {{ Request::is('safetytips') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('/safetytips')}}">

              <i class="fa fa-lightbulb-o"></i>

              <p>Grecon Safety Tips</p>

            </a>

          </li>
        <!--user guide-->
        @if(auth()->user()->role_id == '1' || auth()->user()->role_id == '3')
          <li class="nav-item  {{ Request::is('userguide') ? 'active' : '' }}">

            <a class="nav-link" href="{{url('userguide')}}">

              <i class="fa fa-address-book-o"></i>

              <p>User Guide</p>

            </a>

          </li>

        @endif
         
     

        </ul>

      </div>

  </div>
