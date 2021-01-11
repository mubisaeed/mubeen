@extends('layouts.app')
@section('content')

  <div id="message">
    @if (Session::has('message'))
      <div class="alert alert-info">
        {{ Session::get('message') }}
      </div>
    @endif
  </div>
    @if(count($discussions)>0)
      <h3>All Discussions</h3>
    @else
      <h3>No Discussions Available</h3>
    @endif
  </div>
  <table class="table table-bordered table-hover table-sm table-striped">
  <thead class="thead-light">
  <tr>
  <th>ID</th>
  <th>Title</th>
  <th>image</th>
  <th>Description</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
    @foreach ($discussions as $discussion)
    <tr>
    <td>{{$discussion->id}}</td>
    <td>{{$discussion->title}}</td>
    <td>
    <img height="50px" width="50px" src="{{asset('/assets/img/discussions/'.$discussion->image)}}">
    </td>
    <td>{{$discussion->description}}</td>
    <td><a href="{{url('/discussions/edit/'.$discussion->id)}}"><button class="btn btn-primary">Edit</button></a>
    <a class="delete" href="javascript:void(0);" data-id="<?php echo $discussion->id; ?>"><button class="btn btn-danger">Delete</button></a></td>
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