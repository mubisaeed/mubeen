@extends('layouts.app')
@section('content')

  <div id="message">
    @if (Session::has('message'))
      <div class="alert alert-info">
        {{ Session::get('message') }}
      </div>
    @endif
  </div>
  <div>
    @if(count($departments)>0)
      <h3>All Departments</h3>
    @else
      <h3>No Departments Available</h3>
    @endif
  </div>
  <hr>
  <div>
    @foreach ($departments as $department)
      <h4>ID: {{$department->id}}</h4>
      <h5>name: {{$department->name}}</h5>
      <button><a href="/departments/edit/{{$department->id}}">Edit</a></button>
      <button><a class="delete" href="javascript:void(0);" data-id="<?php echo $department->id; ?>">Delete</a></button>
      <br><hr>
    @endforeach
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