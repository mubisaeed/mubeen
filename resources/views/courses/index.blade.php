@extends('layouts.app')
@section('content')
<div class="breadcrumb_main">
  <ol class="breadcrumb">
    <li><a href = "#">Home</a></li>
    <li class = "active">Add New Course</li>
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
    
    <div class="course_table mt-0">
      <div class="course card-header card-header-warning card-header-icon">
        
        <h3>Course Schedules</h3>
        <div class="table_filters">
          <div class="table_search">
            <input type="text" name="search" id="search" value="" placeholder="Search...">
            <a href="#"> <i class="fa fa-search"></i> </a>
          </div>
          <div class="table_select">
            <select class="selectpicker">
              <option>All Courses</option>
              <option>Today </option>
              <option>Macro Economics I</option>
              <option>Macro Economics II</option>
            </select>
          </div>
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
            @foreach($courses as $index =>$course)
            <tr>
              <th scope="row">#{{$index+1}}</th>
              <td class="first_row">
                <div class="course_td">
                  <!-- <img src="{{asset('img/latest/Simple03.png')}}" alt="" class="img-fluid"> -->
                  <p>{{$course->course_name}}</p>
                </div>
              </td>
              <td class="first_row">{{date('d-m-Y', strtotime($course->start_date))}} - {{date('d-m-Y', strtotime($course->end_date))}}</td>
              <td class="first_row">{{$course->department}}</td>
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
                    <a class="dropdown-item" href="{{url('resource/download/'.$course->id)}}" target="_blank"> <i class="fa fa-eye"></i>Link</a>
                    <a class="dropdown-item" href="{{url('/courseresourse/'. $course->id)}}" target="_blank"> <i class="fa fa-file" aria-hidden="true"></i>Resourses</a>
                    <a class="dropdown-item" href="{{url('course/replicate/' . $course->id)}}"> <i class="fa fa-copy"></i>Duplicate</a>
                    <a class="dropdown-item" href="{{url('course/edit/' . $course->id)}}"><i class="fa fa-cogs"></i>Edit</a>
                    <a href="javascript:void(0);" data-id="<?php echo $course->id; ?>" class="dropdown-item delete"><i class="fa fa-trash"></i>Delete</a>
                  </div>
                </li>
              </td>
            </tr>
            @endforeach
            <!-- <tr>
            <th scope="row">#13</th>
              <td>
                <div class="course_td">
                  <img src="../assets/img/latest/Simple04.png" alt="" class="img-fluid">
                  <p>Literature</p>
                </div>
              </td>
              <td>Jun 1, 2020 - Jun 30, 2020</td>
              <td>Neuro Sciences</td>
              <td>23</td>
              <td class="align_ellipse"><li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="material-icons">
                    more_horiz
                  </span>
                  <div class="ripple-container"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#"> <i class="fa fa-eye"></i>View</a>
                  <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>Edit</a>
                </div>
              </li></td>
            </tr>
            <tr>
              <th scope="row">#14</th>
              <td>
                <div class="course_td">
                  <img src="../assets/img/latest/Simple05.png" alt="" class="img-fluid">
                  <p>Psychology</p>
                </div>
              </td>
              <td>Jun 1, 2020 - Jun 30, 2020</td>
              <td>Neuro Sciences</td>
              <td>32</td>
              <td class="align_ellipse"><li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="material-icons">
                    more_horiz
                  </span>
                  <div class="ripple-container"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#"> <i class="fa fa-eye"></i>View</a>
                  <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>Edit</a>
                </div>
              </li></td>
            </tr>
            <tr>
              <th scope="row">#15</th>
              <td>
                <div class="course_td">
                  <img src="../assets/img/latest/Simple06.png" alt="" class="img-fluid">
                  <p>English</p>
                </div>
              </td>
              <td>Jun 1, 2020 - Jun 30, 2020</td>
              <td>Neuro Sciences</td>
              <td>2</td>
              <td class="align_ellipse"><li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="material-icons">
                    more_horiz
                  </span>
                  <div class="ripple-container"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#"> <i class="fa fa-eye"></i>View</a>
                  <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>Edit</a>
                </div>
              </li></td>
            </tr>
            <tr>
              <th scope="row">#16</th>
              <td>
                <div class="course_td">
                  <img src="../assets/img/latest/Simple07.png" alt="" class="img-fluid">
                  <p>Biology</p>
                </div>
              </td>
              <td>Jun 1, 2020 - Jun 30, 2020</td>
              <td>Neuro Sciences</td>
              <td>23</td>
              <td class="align_ellipse"><li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="material-icons">
                    more_horiz
                  </span>
                  <div class="ripple-container"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#"> <i class="fa fa-eye"></i>View</a>
                  <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>Edit</a>
                </div>
              </li></td>
            </tr>
            <tr>
              <th scope="row">#17</th>
              <td>
                <div class="course_td">
                  <img src="../assets/img/latest/Simple08.png" alt="" class="img-fluid">
                  <p>Mathematics</p>
                </div>
              </td>
              <td>Jun 1, 2020 - Jun 30, 2020</td>
              <td>Neuro Sciences</td>
              <td>4</td>
              <td class="align_ellipse"><li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="material-icons">
                    more_horiz
                  </span>
                  <div class="ripple-container"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#"> <i class="fa fa-eye"></i>View</a>
                  <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>Edit</a>
                </div>
              </li></td>
            </tr> -->
          </tbody>
        </table>
        <div class="table_footer">
          <div class="table_pegination">
            <nav>
              <ul class="pager">
                <li class="pager__item pager__item--prev"><a class="pager__link" href="#">
                <i class="fa fa-angle-left"></i></a></li>
                <li class="pager__item"><a class="pager__link active" href="#">1</a></li>
                <li class="pager__item"><a class="align_hash" href="#">/</a></li>
                <li class="pager__item"><a class="pager__link no_border" href="#">16</a></li>
                <li class="pager__item pager__item--prev"><a class="pager__link" href="#">
                <i class="fa fa-angle-right"></i></a></li>
              </ul>
            </nav>
          </div>
          <div class="table_rows">
            <div class="rows_main">
              <p>Rows per page</p>
              <select>
                <option>6</option>
                <option>7</option>
                <option>8</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#search').on('keyup',function(){
    $value=$(this).val();
    $.ajax({
      type : 'get',
      url : 'search',
      data:{'search':$value},
      success:function(data){
        $('tbody').html(data);
      }
    });
  })
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
@endsection