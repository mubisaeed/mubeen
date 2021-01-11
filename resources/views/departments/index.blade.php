@extends('layouts.app')
@section('content')
  <div id="message">
    @if (Session::has('message'))
      <div class="alert alert-info">
        {{ Session::get('message') }}
      </div>
    @endif
  </div>
  <div class="breadcrumb_main">
    <ol class="breadcrumb">
      <li><a href = "{{url('/dashboard')}}">Home</a></li>
      <li class = "active">All Departments</li>
    </ol>
  </div>
  <div class="content_main">
    <div class="all_courses_main">
      <div class="course_table mt-0">
        <div class="course card-header card-header-warning card-header-icon">
          @if(count($departments)>0)
            <h3>All Departments</h3>
          @else
            <h3>No Departments Available</h3>
          @endif
          <div class="table_filters">
            <div class="table_search">
              <input type="text" name="" value="" placeholder="Search...">
              <a href="#"> <i class="fa fa-search"></i> </a>
            </div>
            <div class="table_select">
              <select class="selectpicker">
                <option>All Departments</option>
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
                <th scope="col">Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($departments as $department)
                <tr>
                  <th scope="row">{{$department->id}}</th>
                  <td class="first_row">{{$department->name}}</td>
                  <td class="align_ellipse first_row">
                    <li class="nav-item dropdown">
                      <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="material-icons">
                          more_horiz
                        </span>
                        <div class="ripple-container"></div>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{url('/departments/edit/'.$department->id)}}"><i class="fa fa-cogs"></i>Edit</a>
                        <a class="dropdown-item delete" href="javascript:void(0);" data-id="<?php echo $department->id; ?>"> <i class="fa fa-trash"></i>Delete</a>
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
    setTimeout(function() {
      $('#message').fadeOut('fast');
    }, 2000);
  </script>
  <script type="text/javascript">
    $("body").on( "click", ".delete", function () {
    var task_id = $( this ).attr( "data-id" );
    console.log(task_id);
    var form_data = {
    id: task_id
    };
    swal({
    title: "Do you want to delete this department?",
    type: 'info',
    showCancelButton: true,
    confirmButtonColor: '#F79426',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
    showLoaderOnConfirm: true
    }).then( ( result ) => {
    if ( result.value == true ) {
    $.ajax( {
    type: 'get',
    url: '<?php echo url("/departments/delete"); ?>',
    data: form_data,
    success: function ( msg ) {
    swal( "@lang('Department Deleted')", '', 'success' )
    setTimeout( function () {
    location.reload();
    }, 1000 );
    }
    } );
    }
    } );
    } );
  </script>
@endsection