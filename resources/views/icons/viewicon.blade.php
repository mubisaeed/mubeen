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
    <table id="customers">
      <tr>
        <th> Title </th>
        <th> Image </th>
        <th> Action </th>
      </tr>
      @foreach ($icons as $icon )
      <tr>
        <td>{{$icon->title}}</td>
        <td><img src="{{asset('img/icons/'.$icon->image)}}" height="50" width="50"></td>
        <td><a href="{{url('editicon/'. $icon->id)}}"><button>Edit</button></a>
        <a class="delete" href="javascript:void(0);" data-id="<?php echo $icon->id; ?>">Delete</a></td>
      </tr>
      @endforeach
    </table>
  @else
    <h2>There is no icon<h2>
  @endif

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