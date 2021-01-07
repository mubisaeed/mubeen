@extends('layouts.app')
@section('content')
           
  <div id="message">
    @if (Session::has('message'))
      <div class="alert alert-info">
        {{ Session::get('message') }}
      </div>
    @endif
  </div>
              
  @if(count($icons)>0)
    <table id="customers" class="table table-bordered table-hover table-sm table-striped">
    <thead class="thead-dark">
      <tr>
        <th> Title </th>
        <th> Icons </th>
        <th> Action </th>
      </tr>
      </thead>
      <tbody>
      @foreach ($icons as $icon )
      <tr>
        <td>{{$icon->title}}</td>
        <td><img src="{{asset('img/icons/'.$icon->image)}}" class="img-fluid" height="50" width="75"></td>
        <td><a href="{{url('editicon/'. $icon->id)}}"><button class="btn btn-info">Edit</button></a>
        <a class="delete" href="javascript:void(0);" data-id="<?php echo $icon->id; ?>"><button class="btn btn-danger">Delete</button></a></td>
      </tr>
      @endforeach
      </tbody>
    </table>
  @else
    <h2>There is no icon<h2>
  @endif

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
title: "Do you want to delete this Icon?",

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

url: '<?php echo url("/deleteicon/{id}"); ?>',
data: form_data,
success: function ( msg ) {
swal( "@lang('Icon Deleted')", '', 'success' )
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