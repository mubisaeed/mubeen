@extends('layouts.app')
@section('content')
  <div id="message">
    @if (Session::has('message'))
      <div class="alert alert-info">
        {{ Session::get('message') }}
      </div>
    @endif
  </div>

{{-- <div class="tab-content">
  <form action="{{url('/resource/create')}}" method="POST" enctype="multipart/form-data">

    {{@csrf_field()}}

    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
      @endforeach

      <input type="hidden" name="course_id" value="{{$id}}">    

        <div class="title">
          <i class="fas fa-pencil-alt"></i> 
          <h3 class="main_title_ot">Course Resources</h3>
        </div>

        <div class="col-md-6 p_left">
          <div class="custom_input_main mobile_field">
            <input type="text" class="form-control" value="{{ old('title')}}" name="title" required="" minlength="3" maxlength ="50" autofocus="">
            <label>Title<span class="red">*</span></label>
          </div>
            @error('title')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-6 p_left">
          <div class="custom_input_main mobile_field">
            <textarea name="short_des" rows="4" cols="50" value="{{old('short_des')}}" minlength="10" maxlength ="1000"></textarea><br><br>
            <label>short_description<span class="red">*</span></label>
          </div>
            @error('short_des')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-6 p_left">
          <div class="custom_input_main mobile_field">
            <input id="file" type="file" name="file" accept="application/pdf,application/vnd.ms-excel/application/vnd.ms-doc" required="" autofocus="" size="max:10240">
            <label>File<span class="red">*</span></label>
          </div>
            @error('file')
            <div>
            {{$message}}
            </div>
            @enderror
        </div>


        <div class="s_form_button text-left">
          <button type="submit" class="btn save_btn">Submit</button>
        </div>
      </div>
  </form>
</div> --}}



<div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href = "#">Home</a></li>
                <li class = "active">Add New Course</li>
              </ol>
            </div>
            <div class="assignment">
              <div class="card-header main_ac">
                <h3>Course Resources</h3>
                <div class="ac_add_form">
                  <div class="row">
                   <form action="{{url('/resource/create')}}" method="POST" enctype="multipart/form-data">
                      {{@csrf_field()}}
                      @foreach ($errors->all() as $error)
                      <div class="alert alert-danger">{{ $error }}</div>
                      @endforeach
                      <input type="hidden" name="course_id" value="{{$id}}">
                    <div class="col-md-6 p_left">
                      <div class="custom_input_main">
                        <input type="text" class="form-control" value="{{ old('title')}}" name="title" required="" minlength="3" maxlength ="50" autofocus="">
                        <label>Title <span class="red">*</span></label>
                      </div>
                          @error('title')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                    <div class="col-md-12">
                      <div class="custom_input_main">
                        <textarea class="form-control" name="short_des" rows="4" cols="50" value="{{old('short_des')}}" minlength="10" maxlength ="1000" style="height: 100px !important;"></textarea>
                        <label>Course description...</label>
                      </div>
                          @error('short_des')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="file_spacing">
                        <input id="file" class="choose" type="file" name="file" accept="application/pdf,application/vnd.ms-excel/application/vnd.ms-doc" required="" autofocus="" size="max:10240">
                      </div>
                          @error('file')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="s_form_button text-center">
                        <a  href="{{url('/course')}}"><button type="button" class="btn cncl_btn">Cancel</button></a>
                        <button type="submit" class="btn save_btn">Save<div class="ripple-container"></div></button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>











<script>
  var uploadField = document.getElementById("file");
  uploadField.onchange = function() {
      if(this.files[0].size > 100 * 1024 * 1024){
        alert("File is too big!");
        this.value = "";
      };
  };

</script>



  <div class="content_main">
  <div class="all_courses_main">
    
    <div class="course_table mt-0">
      <div class="course card-header card-header-warning card-header-icon">
        
        <h3>Course Resources</h3>
        @if(count($cresources)>0)
          <div class="table_filters">
            <div class="table_search">
              <input type="text" name="search" id="search" value="" placeholder="Search...">
              <a href="#"> <i class="fa fa-search"></i> </a>
            </div>
            <div class="table_select">
              <select class="selectpicker">
                <option>All Resources</option>
                <option>Today </option>
                <option>Macro Economics I</option>
                <option>Macro Economics II</option>
              </select>
            </div>
          </div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Short Description</th>
                <th scope="col">File</th>
                <th scope="col">Download</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cresources as $index =>$cr)
              <tr>
                <th scope="row">#{{$index+1}}</th>
                <td class="first_row">
                  <div class="course_td">
                    <!-- <img src="{{asset('img/latest/Simple03.png')}}" alt="" class="img-fluid"> -->
                    <p>{{$cr->title}}</p>
                  </div>
                </td>
                <td class="first_row">{{$cr->short_description}}</td>
                @if ($cr->type=='pdf')
                  <td class="first_row"><embed src="{{asset('storage/'.$cr->file)}}" type="application/pdf"  
                  height="80" width="80" download></td>
                @endif
                <td class="first_row"><a href="{{route('/download', $cr->id)}}">{{$cr->type}}</a></td>
                <td class="align_ellipse first_row">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="material-icons">
                        more_horiz
                      </span>
                      <div class="ripple-container"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                      <a class="dropdown-item" href="{{url('/resource/edit/' . $cr->id.'/'.$id)}}"><i class="fa fa-cogs"></i>Edit</a>
                      <a href="javascript:void(0);" data-id="<?php echo $cr->id; ?>" class="dropdown-item delete"><i class="fa fa-trash"></i>Delete</a>
                    </div>
                  </li>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="table_footer">
            <div class="table_pegination">
              <nav>
                <ul class="pager">
                  <li class="pager__item pager__item--prev"><a class="pager__link" href="#">
                  <i class="fa fa-angle-left"></i></a></li>
                  <li class="pager__item"><a class="pager__link active" href="#">1</a></li>
                  <li class="pager__item"><a class="align_hash" href="#">/</a></li>
                  <li class="pager__item"><a class="pager__link no_border" href="#">16</a></li>
                  <li class="pager__item pager__item--prev"><a class="pager__link" href="#">
                  <i class="fa fa-angle-right"></i></a></li>
                </ul>
              </nav>
            </div>
            <div class="table_rows">
              <div class="rows_main">
                <p>Rows per page</p>
                <select>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                </select>
              </div>
            </div>
          </div>
        @else
          <p>There is no resource</p>
        @endif
      </div>
    </div>
  </div>
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








          {{-- <div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href = "#">Home</a></li>
                <li class = "active">Add New Course</li>
              </ol>
            </div>
            <div class="assignment">
              <div class="card-header main_ac">
                <h3>Course Resources</h3>
                <div class="ac_add_form">
                  <div class="row">
                   <form action="{{url('/resource/create')}}" method="POST" enctype="multipart/form-data">
                      {{@csrf_field()}}
                      @foreach ($errors->all() as $error)
                      <div class="alert alert-danger">{{ $error }}</div>
                      @endforeach
                      <input type="hidden" name="course_id" value="{{$id}}">
                    <div class="col-md-6 p_left">
                      <div class="custom_input_main">
                        <input type="text" class="form-control" value="{{ old('title')}}" name="title" required="" minlength="3" maxlength ="50" autofocus="">
                        <label>Title <span class="red">*</span></label>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="custom_input_main">
                        <textarea class="form-control" name="short_des" rows="4" cols="50" value="{{old('short_des')}}" minlength="10" maxlength ="1000" style="height: 100px !important;"></textarea>
                        <label>Course description...</label>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="file_spacing">
                        <input id="file" class="choose" type="file" name="file" accept="application/pdf,application/vnd.ms-excel/application/vnd.ms-doc" required="" autofocus="" size="max:10240">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="s_form_button text-center">
                        <button type="button" class="btn cncl_btn">Cancel</button>
                        <button type="button" class="btn save_btn">Save<div class="ripple-container"></div></button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}