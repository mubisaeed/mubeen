@extends('layouts.app')
@section('content')

  <div class="content">
        <div class="row">
            <div id="message">
            @if (Session::has('message'))
              <div class="alert alert-info">
                {{ Session::get('message') }}
              </div>
            @endif
            </div>
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">All Instructors</h4>
                            </div>

                        </div>
                    
                    </div>
                    <div class="card-body">
                        <div class="">
                                  @if(count($instructors) > 0)
                            <table id="myTable" class="text-primary display table tablesorter">
                                <thead class="text-primary">

                                    <tr>
                                        <th>Instructor name</th>
                                        <th>Email</th>
                                        <th class="text-center">Actions</th>
                                    </tr></thead>
                                <tbody>
                                    <tr class="custom_color" >
                                        @foreach($instructors as $ins)
                                        
                                    <tr>
                                        <td>{{$ins->name}}</td>
                                        <td>{{$ins->email}}</td>
                                        <td class="text-right">
                                          <a class="btn btn-sm btn-success" href="{{url('/instructors/show/' . $ins->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                          <a class="btn btn-sm btn-info" href="{{url('instructors/edit/' . $ins->id)}}"><i class="fa fa-pencil"></i></a>
                                          <a href="javascript:void(0);" data-id="<?php echo $ins->id; ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                                  @else
                                    <h3>There is no Instructor</h3>
                                  @endif
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
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