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
    @if(count($instructors)>0)
      <h3>All Instructors</h3>
    @else
      <h3>No Instructors Available</h3>
    @endif
  </div>
  <hr>
  <div>
    @foreach ($instructors as $instructor)
      <h4>ID: {{$instructor->id}}</h4>
      <div>
        <h5>Name: {{$instructor->name}}</h5>
        <div>
          <img height="250px" width="300px" src="img/instructors/{{$instructor->image}}">
        </div><br>
        <p>Bio: {{$instructor->bio}}</p>
        <span>Email: {{$instructor->email}}<span><br><br>
        <button><a href="/instructors/edit/{{$instructor->id}}">Edit</a></button>
        <button><a class="delete" href="javascript:void(0);" data-id="<?php echo $instructor->id; ?>">Delete</a></button>
      </div><br>
      <hr>
    @endforeach
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
    title: "Do you want to delete this Instructor?",
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
    url: '<?php echo url("/instructors/delete"); ?>',
    data: form_data,
    success: function ( msg ) {
    swal( "@lang('Instructor Deleted')", '', 'success' )
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