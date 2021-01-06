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
    @if(count($cress)>0)
      <table>
        <tr>
          <td>Course id</td>
          <td>Title</td>
          <td>Short Description</td>
          <td>File</td>
          <td>Download</td>
          <td>Action</td>
        </tr>
        @foreach ($cress as $cres)
          <tr>
            <td>{{$cres->course_id}}</td>
            <td>{{$cres->title}}</td>
            <td>{{$cres->short_description}}</td>
            @if ($cres->type=='pdf')
              <td><embed src="{{asset('storage/'.$cres->file)}}" type="application/pdf"  
              height="80" width="80" download></td>
            @elseif($cres->type=='mp4')
              <td><iframe src="{{asset('storage/'.$cres->file)}}"></iframe></td>
            @elseif($cres->type=='jpg' || 'png' || 'jpeg')
              <td><img src="{{asset('storage/'.$cres->file)}}" height="80" width="80"></td>
            @endif
            <td><a href="{{route('/download', $cres->id)}}">{{$cres->type}}</a></td>
            <td>
              <a href="/resource/edit/{{$cres->id}}" ><button>Edit</button></a>
              <a class="delete" href="javascript:void(0);" data-id="<?php echo $cres->id; ?>"><button>Delete</button></a>
            </td>
          </tr>
        @endforeach
      </table>
    @else
      <h2>There is no Resource<h2>
    @endif
  </div>

  <script src="{{url('backend/sweetalerts/sweetalert2.all.js')}}"></script>

  <script type="text/javascript">
    setTimeout(function() {
      $('#message').fadeOut('fast');
    }, 30000);
  </script>

  <script type="text/javascript">
  $("body").on( "click", ".delete", function () {
  var task_id = $( this ).attr( "data-id" );
  console.log(task_id);
  var form_data = {
  id: task_id
  };
  swal({
  title: "Do you want to delete this Resourse",

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

  url: '<?php echo url("/deleteres/{id}"); ?>',
  data: form_data,
  success: function ( msg ) {
  swal( "@lang('Resourse Deleted')", '', 'success' )
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