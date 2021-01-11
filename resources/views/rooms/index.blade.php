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
  <table class="table table-bordered table-hover table-sm table-striped">
  <thead class="thead-light">
      <tr>
        <th> ID </th>
        <th> Name </th>
        <th> Room No </th>
        <th> Floor No </th>
        <th> Action </th>
      </tr>
      </thead>
      <tbody>
    @foreach ($rooms as $room)
      <tr>
      <td>{{$room->id}}</td>
      <td>{{$room->name}}</td>
        <td>{{$room->room_no}}</td>
        <td>{{$room->floor_no}}</td>
        <td>      
        <a href="{{url('/rooms/edit/'.$room->id)}}"><button class="btn btn-primary">Edit</button></a>
        <a class="delete" href="javascript:void(0);" data-id="<?php echo $room->id; ?>"><button class="btn btn-danger">Delete</button></a>
        </td>
        </tr>
    @endforeach
    </tbody>
    </table>
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