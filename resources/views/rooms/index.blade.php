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
    @if(count($rooms)>0)
      <h3>All Rooms</h3>
    @else
      <h3>No Rooms Available</h3>
    @endif
  </div>
  <hr>
  <div>
    @foreach ($rooms as $room)
      <h4>ID: {{$room->id}}</h4>
      <div>
        <h5>Name: {{$room->name}}</h5>
        <span>Room No. : {{$room->room_no}}</span> <br>
        <span>Floor No. : {{$room->floor_no}}<span>
        <br><br>
        <button><a href="/rooms/edit/{{$room->id}}">Edit</a></button>
        <button><a class="delete" href="javascript:void(0);" data-id="<?php echo $room->id; ?>">Delete</a></button>
      </div><br>
      <hr>
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
    title: "Do you want to delete this Room?",
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
    url: '<?php echo url("/rooms/delete"); ?>',
    data: form_data,
    success: function ( msg ) {
    swal( "@lang('Room Deleted')", '', 'success' )
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