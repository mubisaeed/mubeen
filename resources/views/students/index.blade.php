@extends('layouts.app')
@section('content')

<div class="breadcrumb_main">
  <ol class="breadcrumb">
    <li><a href = "{{url('/dashboard')}}">Home</a></li>
    <li class = "active">All Students</li>
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
          
          <h3>Student Schedules</h3>
          @if(count($students)>0)
            <div class="table_filters">
              <div class="table_search">
                <input type="text" name="search" id="search" value="" placeholder="Search...">
                <a href="#"> <i class="fa fa-search"></i> </a>
              </div>
              <div class="table_select">
                <select class="selectpicker">
                  <option>All Students</option>
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
                  <th scope="col">Students</th>
                  <th scope="col">Email</th>
                  <th scope="col">Mobile</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Admission Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="mybody">
                @foreach($students as $index =>$std)
                <tr>
                  <?php
                    $st = DB::table('users')->where('id', $std->s_u_id)->get()->first();
                    $stdd = DB::table('students')->where('s_u_id', $std->s_u_id)->get()->first();
                  ?>
                  <th scope="row">#{{$index+1}}</th>
                  <td class="first_row">
                    <div class="course_td">
                      <img src="{{asset('assets/img/upload/'.$st->image)}}" width="50" alt="" class="img-fluid">
                      <p>{{$st->name}}</p>
                    </div>
                  </td>
                  <td class="first_row">{{$st->email}}</td>
                  <td class="first_row">{{$st->contact}}</td>
                  <td class="first_row">{{$stdd->gender}}</td>
                  <td class="first_row">{{date('d-m-Y', strtotime($stdd->admission_date))}}</td>
                  <td class="align_ellipse first_row">
                    <li class="nav-item dropdown">
                      <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="material-icons">
                          more_horiz
                        </span>
                        <div class="ripple-container"></div>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{url('student/show/' . $st->id)}}"> <i class="fa fa-eye"></i>View</a>
                        <a class="dropdown-item" href="{{url('student/edit/' . $st->id)}}"><i class="fa fa-cogs"></i>Edit</a>
                        <a href="javascript:void(0);" data-id="<?php echo $st->id; ?>" class="dropdown-item delete"><i class="fa fa-trash"></i>Delete</a>
                      </div>
                    </li>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>   
            {{ $students->links() }}
  <!--           <div class="table_footer">
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
            </div> -->
           @else
            <p>There is no Student</p>
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
<script type="text/javascript">
  $( "body" ).on( "click", ".delete", function () {
    var task_id = $( this ).attr( "data-id" );
    var form_data = {
        id: task_id
    };
    swal({
        title: "Do you want to delete this Student",
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
                url: '<?php echo url("/student/delete"); ?>',
                data: form_data,
                success: function ( msg ) {
                    swal( "@lang('Student Deleted Successfully')", '', 'success' )
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
