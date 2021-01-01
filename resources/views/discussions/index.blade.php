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
    @if(count($discussions)>0)
      <h3>All Discussions</h3>
    @else
      <h3>No Discussions Available</h3>
    @endif
  </div>
  <hr>
  <div>
    @foreach ($discussions as $discussion)
      <h4>ID: {{$discussion->id}}</h4>
      <div>
        <h5>Title: {{$discussion->title}}</h5>
        <div>
          <img height="250px" width="300px" src="img/discussions/{{$discussion->image}}">
        </div><br>
        <p>Description: {{$discussion->description}}</p>
        <button><a href="/discussions/edit/{{$discussion->id}}">Edit</a></button>
        <button><a class="delete" href="javascript:void(0);" data-id="<?php echo $discussion->id; ?>">Delete</a></button>
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
    title: "Do you want to delete this Discussion?",
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
    url: '<?php echo url("/discussions/delete"); ?>',
    data: form_data,
    success: function ( msg ) {
    swal( "@lang('Discussion Deleted')", '', 'success' )
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