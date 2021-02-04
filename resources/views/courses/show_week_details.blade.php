@extends('layouts.app')

@section('content')



  <div id="message">

    @if (Session::has('message'))

      <div class="alert alert-info">

        {{ Session::get('message') }}

      </div>

    @endif

  </div>

  <div class="breadcrumb_main">

    <ol class="breadcrumb">

      <li><a href = "{{url('/dashboard')}}">Home</a></li>

      <li class = "active">Course Weekly Details</li>

    </ol>

  </div>

  <div class="content_main">

    <div class="card-header sftp_main">

      <div class="align_dftp">


          <h3 class="mb-0">Weekly details</h3>


      </div>


      <div class="panel-group" id="accordion">



        <div class="panel panel-default" data-toggle="collapse" data-target="#table">

          <div class="panel-heading">

            <h4 class="panel-title">

            <a data-toggle="collapse" class="active_stp stmp_accordion">Quizzes</a>

            </h4>

          </div>


          <div id="table" class="collapse">

              <div class="panel-body">


                <div class="table_filters">

                  <div>
                    <a href="{{url('/quiz/create/'. $insid .'/'. $cid .'/'. $week)}}" class="btn btn-primary">Add Quiz</a>
                  </div>

                </div>
                @if(count($quizzes) > 0)

                  <div class="table_filters">

                    <div class="table_search">

                      <input type="text" name="search" id="search" value="" placeholder="Search...">

                      <a href="#"> <i class="fa fa-search"></i> </a>
                      
                    </div>

                  </div>

                  <table class="table table-hover" id="table-id">

                    <thead>

                      <tr>

                        <th scope="col">ID</th>

                        <th scope="col">Name</th>

                        <th scope="col">Add Questions</th>

                        <th scope="col">Show Quiz</th>

                        <th scope="col">Action</th>

                      </tr>

                    </thead>

                    <tbody id="mybody">

                      @foreach($quizzes as $index =>$quiz)

                      <tr>

                        <th scope="row">#{{$index+1}}</th>

                        <td class="first_row">

                          <div class="course_td">

                            <p>{{$quiz->name}}</p>

                          </div>

                        </td>

                        <td class="first_row">
                          <a href="{{url('/quiz/addquestion/toquiz/'.$quiz->id)}}" class="btn btn-success"> Add questions</a>
                        </td>

                        <td class="first_row">
                          <a href="{{url('/quiz/showquiz/'.$quiz->id)}}" class="btn btn-success">Show Quiz</a>
                        </td>

                        <td class="align_ellipse first_row">

                          <li class="nav-item dropdown">

                            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                              <span class="material-icons">

                                more_horiz

                              </span>

                              <div class="ripple-container"></div>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                              <a class="dropdown-item" href="{{url('/quiz/edit/'.$quiz->id)}}"><i class="fa fa-cogs"></i>Edit</a>

                              <a href="javascript:void(0);" data-id="<?php echo $quiz->id; ?>" class="dropdown-item deletequiz"><i class="fa fa-trash"></i>Delete</a>

                            </div>

                          </li>

                        </td>

                      </tr>

                      @endforeach

                    </tbody>

                  </table>  

               @else

                <p>There is no Quiz</p>

              @endif

              </div>

          </div>

        </div>




        <div class="panel panel-default" data-toggle="collapse" data-target="#tablelecture">

          <div class="panel-heading">

            <h4 class="panel-title">

            <a data-toggle="collapse" class="active_stp stmp_accordion">Lectures</a>

            </h4>

          </div>


          <div id="tablelecture" class="collapse">

              <div class="panel-body">

                 <div class="table_filters">

                  <div>
                    <a href="{{url('/lecture/create/'. $insid .'/'. $cid .'/'. $week)}}" class="btn btn-primary">Create New Lecture</a>
                  </div>

                </div>

                @if(count($lectures) > 0)

                  <div class="table_filters">

                    <div class="table_search">

                      <input type="text" name="search" id="search" value="" placeholder="Search...">

                      <a href="#"> <i class="fa fa-search"></i> </a>
                      
                    </div>

                  <!--   <div>
                      <a href="{{url('/lecture/create/'. $insid .'/'. $cid .'/'. $week)}}" class="btn btn-primary">Create New Lecture</a>
                    </div> -->

                  </div>

                  <table class="table table-hover" id="table-id">

                    <thead>

                      <tr>

                        <th scope="col">ID</th>

                        <th scope="col">Topic</th>

                        <th scope="col">Action</th>

                      </tr>

                    </thead>

                    <tbody id="mybody">

                      @foreach($lectures as $index =>$lec)

                      <tr>

                        <th scope="row">#{{$index+1}}</th>

                        <td class="first_row">

                          <div class="course_td">


                            <p>{{$lec->topic}}</p>

                          </div>

                        </td>

                        <td class="align_ellipse first_row">
                              <a href="{{url('/instructor/launchmeeting/' . $lec->id)}}">
                                <button class="btn btn-sm btn-info">
                                  <i class="fa fa-rocket" aria-hidden="true"></i>Launch Meeting    
                                </button>
                              </a>
                              <a href="#">
                                <button class="btn btn-sm btn-success">
                                  <i class="fa fa-cogs" aria-hidden="true"></i>Edit    
                                </button>
                              </a>
                              <a href="javascript:void(0);" data-id="<?php echo $lec->id; ?>" class=" deletelec">
                                <button class="btn btn-sm btn-danger">
                                  <i class="fa fa-trash" aria-hidden="true"></i>Delete    
                                </button>
                              </a>
                        </td>

                      </tr>

                      @endforeach

                    </tbody>

                  </table>  

                @else

                  <p>There is no Lecture</p>

                @endif

              </div>

          </div>

        </div>







        <div class="panel panel-default" data-toggle="collapse" data-target="#linkstable">

          <div class="panel-heading">

            <h4 class="panel-title">

            <a data-toggle="collapse" class="active_stp stmp_accordion">Links</a>

            </h4>

          </div>


          <div id="linkstable" class="collapse">

              <div class="panel-body">


                <div class="table_filters">

                  <div>
                    <a href="{{url('/courselink/'. $insid .'/'. $cid .'/'. $week)}}" class="btn btn-primary">Add New Link</a>
                  </div>

                </div>
                @if(count($links)>0)

                  <div class="table_filters">

                    <div class="table_search">

                      <input type="text" name="search" id="search" value="" placeholder="Search...">

                      <a href="#"> <i class="fa fa-search"></i> </a>
                      
                    </div>

                  </div>

                  <table class="table table-hover" id="table-id">

                    <thead>

                      <tr>

                        <th scope="col">ID</th>

                        <th scope="col">Title</th>

                        <th scope="col">Link Description</th>

                        <th scope="col">Links</th>

                        <th scope="col">Action</th>

                      </tr>

                    </thead>

                    <tbody id="mybody">

                      @foreach($links as $index =>$cl)

                      <tr>

                        <th scope="row">#{{$index+1}}</th>

                        <td class="first_row">

                          <div class="course_td">

                            <p>{{$cl->title}}</p>

                          </div>

                        </td>

                        <td class="first_row"><div class="limit_description">{{$cl->short_description}}</div></td>

                        <td class="first_row"><a href="{{$cl->link}}">{{$cl->link}}</a></td>

                        <td class="align_ellipse first_row">

                          <li class="nav-item dropdown">

                            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                              <span class="material-icons">

                                more_horiz

                              </span>

                              <div class="ripple-container"></div>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                              <a class="dropdown-item" href="{{url('/linkedit/' . $cl->id.'/'.$cid)}}"><i class="fa fa-cogs"></i>Edit</a>

                              <a href="javascript:void(0);" data-id="<?php echo $cl->id; ?>" class="dropdown-item deletelink"><i class="fa fa-trash"></i>Delete</a>

                            </div>

                          </li>

                        </td>

                      </tr>

                      @endforeach

                    </tbody>

                  </table>  

               @else

                <p>There is no Link</p>

              @endif

              </div>

          </div>

        </div>













        <div class="panel panel-default" data-toggle="collapse" data-target="#videostable">

          <div class="panel-heading">

            <h4 class="panel-title">

            <a data-toggle="collapse" class="active_stp stmp_accordion">Videos</a>

            </h4>

          </div>


          <div id="videostable" class="collapse">

              <div class="panel-body">


                <div class="table_filters">


                  <div>
                    <a href="{{url('/courseresoursevideo/'. $insid .'/'. $cid .'/'. $week)}}" class="btn btn-primary">Add New Video</a>
                  </div>

                </div>
                @if(count($videos)>0)

                <div class="table_filters">

                  <div class="table_search">

                    <input type="text" name="search" id="search" value="" placeholder="Search...">

                    <a href="#"> <i class="fa fa-search"></i> </a>
                    
                  </div>
                </div>

                <table class="table table-hover" id="table-id">

                  <thead>

                    <tr>

                      <th scope="col">ID</th>

                      <th scope="col">Title</th>

                      <th scope="col">Video Description</th>

                      <th scope="col">Resource</th>                
                      
                      <th scope="col">Action</th>

                    </tr>

                  </thead>

                  <tbody id="mybody">

                    @foreach($videos as $index =>$cr)

                    <tr>

                <th scope="row">#{{$index+1}}</th>

                <td class="first_row">

                  <div class="course_td">

                    

                    <p>{{$cr->title}}</p>

                  </div>

                </td>

                <td class="first_row"><div class="limit_description">{{$cr->short_description}}</div></td>

                @if($cr->type =='mp4')

                  <td class="first_row"><iframe src="{{asset('storage/'.$cr->file)}}" height="60" width="85">{{($cr->file)}}</iframe><br>
                  <a class ="btn btn-primary" href="{{route('/download', $cr->id)}}">{{$cr->type}}</a></td>
                @else
                  <td class="first_row"><a href="{{$cr->link}}">{{$cr->link}}</a></td>

                @endif

                <td class="align_ellipse first_row">

                  <li class="nav-item dropdown">

                    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                      <span class="material-icons">

                        more_horiz

                      </span>

                      <div class="ripple-container"></div>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                      <a class="dropdown-item" href="{{url('/resource/editvid/' . $cr->id.'/'. $cid)}}"><i class="fa fa-cogs"></i>Edit</a>

                      <a href="javascript:void(0);" data-id="<?php echo $cr->id; ?>" class="dropdown-item deletevideo"><i class="fa fa-trash"></i>Delete</a>

                    </div>

                  </li>

                </td>

              </tr>

                    @endforeach

                  </tbody>

                </table>  

               @else

                <p>There is no Video</p>

              @endif

              </div>

          </div>

        </div>







      </div>

    </div>

  </div>



<script type="text/javascript">

  $("body").on( "click", ".deletevideo", function () {

  var task_id = $( this ).attr( "data-id" );

  console.log(task_id);

  var form_data = {

  id: task_id

  };

  swal({

  title: "Do you want to delete this video",



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



  url: '<?php echo url("/deletevid/{id}"); ?>',

  data: form_data,

  success: function ( msg ) {

  swal( "@lang('Video Deleted')", '', 'success' )

  setTimeout( function () {

  location.reload();

  }, 1000 );

  }

  } );

  }

  } );

  } );

  </script>

<script type="text/javascript">

    $("body").on( "click", ".deletequiz", function () {

    var task_id = $( this ).attr( "data-id" );

    console.log(task_id);

    var form_data = {

    id: task_id

    };

    swal({

    title: "Do you want to delete this Quiz?",

    type: 'info',

    showCancelButton: true,

    confirmButtonColor: '#F79426',

    cancelButtonColor: '#d33',

    confirmButtonText: 'Yes',

    showLoaderOnConfirm: true

    }).then( ( result ) => {

    if ( result.value == true ) {

    $.ajax( {

    type: 'POST',
    headers: {

                    'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )

                },

    url: '<?php echo url("/quiz/delete"); ?>',

    data: form_data,

    success: function ( msg ) {

    swal( "@lang('Quiz Deleted')", '', 'success' )

    setTimeout( function () {

    location.reload();

    }, 1000 );

    }

    } );

    }

    } );

    } );

  </script>


  <script type="text/javascript">

    setTimeout(function() {

      $('#message').fadeOut('fast');

    }, 2000);

  </script>


  <script>

    $(document).ready(function(){

      $("#search").on("keyup", function() {

        var value = $(this).val().toLowerCase();

        // alert(value);

        $("#mybody tr").filter(function() {

          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

        });

      });

    });

  </script>


  <script type="text/javascript">

    $("body").on( "click", ".deletelink", function () {

    var task_id = $( this ).attr( "data-id" );

    console.log(task_id);

    var form_data = {

    id: task_id

    };

    swal({

    title: "Do you want to delete this link",



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



    url: '<?php echo url("/linkdelete/{id}"); ?>',

    data: form_data,

    success: function ( msg ) {

    swal( "@lang('Link Deleted')", '', 'success' )

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