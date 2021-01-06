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
  <div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href = "#">Home</a></li>
                <li class = "active">Grecon Safety Tips</li>
              </ol>
            </div>
            <div class="content_main">
              <div class="card-header sftp_main">
                <h3 class="mb-0">Grecon Safety Tips</h3>
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="active_stp stmp_accordion">
                      How to learn via live instructor</a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse in collapse show">
                      <div class="panel-body">
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself.</p>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="stmp_accordion">
                      Assignment reportings</a>
                      </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself.</p>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="stmp_accordion">
                      Where does it come from?</a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself.</p>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="stmp_accordion">
                      Where does it come from?</a>
                      </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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