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
    <button><a href="/safetytips/create">Add Safety Tip</a></button>
  </div>
  <br><br>
  <div>
    @if(count($safetytips)>0)
      <h3>All Safety Tips</h3>
    @else
      <h3>No Safety Tips Available</h3>
    @endif
  </div>
  <hr>
  <div>
    @foreach ($safetytips as $safetytip)
      <h4>ID: {{$safetytip->id}}</h4>
      <div>
        <h5>Title: {{$safetytip->title}}</h5>
        <div>
          <img height="250px" width="300px" src="img/safetytips/{{$safetytip->image}}">
        </div><br>
        <p>Description: {{$safetytip->description}}</p>
        <button><a href="/safetytips/edit/{{$safetytip->id}}">Edit</a></button>
<<<<<<< HEAD
        <form action="/safetytips/delete{{$safetytip->id}}" method="POST">
          @csrf
          @method('DELETE')
          <button onclick="return confirm('Are you sure?')" type="submit" value="submit">Delete</button>
        </form>
=======
        <button><a class="delete" href="javascript:void(0);" data-id="<?php echo $safetytip->id; ?>">Delete</a></button>
>>>>>>> 765fb557d1cf36874b7d18749e37f1b19ce38536
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
  title: "Do you want to delete this Safety Tip?",
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
  url: '<?php echo url("/safetytips/delete"); ?>',
  data: form_data,
  success: function ( msg ) {
  swal( "@lang('Safety Tip Deleted')", '', 'success' )
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