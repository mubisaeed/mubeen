<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script> -->

@extends('layouts.app')

@section('content')



<style>

  [type='color'] {

  -moz-appearance: none;

  -webkit-appearance: none;

  appearance: none;

  padding: 0;

  width: 15px;

  height: 15px;

  border: none;

}



[type='color']::-webkit-color-swatch-wrapper {

  padding: 0;

}



[type='color']::-webkit-color-swatch {

  border: none;

}



.color-picker {

  padding: 10px 15px;

  border-radius: 10px;

  border: 1px solid #ccc;

  background-color: #f8f9f9;

}

.select_plugin  .dropdown-toggle {
  margin-top: 0;
}

</style>





<div class="breadcrumb_main">

  <ol class="breadcrumb">

    <li><a href = "{{url('/dashboard')}}">Home</a></li>

    <li class = "active">Add New Course</li>

  </ol>

</div>

<div class="content_main">

  <div class="profile_main">

    <div class="profile mt-0">

      <div class="course card-header card-header-warning card-header-icon">

        

        <h3 class="main_title_ot">Add New Course</h3>

        <div class="tab-content">

          <form method="POST" action="/createcourse" enctype="multipart/form-data">

            @csrf

            @foreach ($errors->all() as $error)

              <div class="alert alert-danger">{{ $error }}</div>

            @endforeach

            <div class="tab-pane active" id="tab_default_3">

              <div class="s_profile_fields">

                <div class="row">

                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control"  value="{{ old('cname')}}" name="cname" required=""  minlength="3" maxlength ="50" autofocus="">

                      <label>Course name<span class="red">*</span></label>

                    </div>

                    @error('cname')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $cname }}</strong>

                      </span>

                    @enderror

                  </div>

                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" required="" autofocus="">

                      <label>Image<span class="red">*</span></label>

                    </div>

                  </div>

                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="date" class="form-control" name="sdate" value="{{old('sdate')}}" onchange="invoicedue(event);" class="mb-4" required="" autofocus="">

                      <label>Start Date

                        <span class="red">*</span></label>

                      </div>

                    </div>

                    <div class="col-md-6 p_right">

                      <div class="custom_input_main mobile_field">

                        <input type="date" class="form-control" value="{{ old('edate')}}" name="edate" onchange="invoicedue(event);" required="" autofocus="">

                        <label>End Date

                          <span class="red">*</span></label>

                        </div>

                      </div>

                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control"  value="{{ old('building')}}" name="building"  required="" minlength="1" maxlength ="50" autofocus="">

                      <label>Building Name

                        <span class="red">*</span></label>

                      </div>

                      @error('rno')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $building }}</strong>

                      </span>

                    @enderror

                    </div>


                    <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control"  value="{{ old('rno')}}" name="rno"  required="" minlength="1" maxlength ="50" autofocus="">

                      <label>Room No.

                        <span class="red">*</span></label>

                      </div>

                      @error('rno')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $rno }}</strong>

                      </span>

                    @enderror

                    </div>

                    <div class="col-md-6  colorpicker colorpicker-component p_left">

                      <div class="custom_input_main mobile_field">

                        <span class="color-picker">

                          <label for="colorPicker">

                            <input type="color"   value="#1DB8CE" id="colorPicker">

                            <input type="hidden"  name="ccolor" value="#1DB8CE" id="colorPickerr">

                          </label>

                        </span>

                        <label>Course Color

                          <span class="red">*</span></label>

                        </div>

                      </div>

                      <div class="col-md-6 p_right">

                        <div class="custom_input_main select_plugin mobile_field">

                        <select class="selectpicker" name="sessions">

                          <option value="1">One session  ( 9 weeks ) </option>

                          <option value="2">Two sessions-One semester ( 18 weeks )  </option>

                          <option value="3">Three session  ( 27 weeks )</option>

                          <option value="4">Four sessions-Two semesters ( 36 weeks )</option>

                        </select>

                        <label class="select_lable">Sessions</label>

                      </div>

                      </div>

                    </div>


                    <div class="row">

                      <div class="col-md-12">

                        <div class="custom_input_main mobile_field">

                          <textarea name="cdescription" cols="8" id="txtEditor" value="{!!old('cdescription')!!}" style="height: 35px;width: 100%;" required="">

                          </textarea>

                          <label>Enter Description <span class="red">*</span></label>

                        </div>

                      </div>

                    </div>

                    <div class="s_form_button text-center">

                      <a  href="{{url('/course')}}"><button type="button" class="btn cncl_btn">Cancel</button></a>

                      <button type="submit" class="btn save_btn">Save</button>

                    </div>

                  </div>

                </div>

              </form>

            </div>

            

          </div>

        </div>

      </div>

    </div>



<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>



  <script>

   document.querySelectorAll('input[type=color]').forEach(function(picker) {



  var targetLabel = document.querySelector('label[for="' + picker.id + '"]'),

    codeArea = document.createElement('span');



  codeArea.innerHTML = picker.value;

  targetLabel.appendChild(codeArea);



  picker.addEventListener('change', function() {

    codeArea.innerHTML = picker.value;

    // alert(picker.value);

    document.getElementById("colorPickerr").value() = picker.value ;

    targetLabel.appendChild(codeArea);

  });

});

  </script>





<script>

  CKEDITOR.replace( 'txtEditor' );

</script>

<!-- <script src="{{asset('js/bootstrap-colorpicker.min.js')}}"></script> -->

                <!-- <script src="//unpkg.com/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script> -->

                <!-- <script src="{{asset('dist/js/bootstrap-colorpicker.js')}}"></script> -->

                <!-- <script src="{{asset('assets/js/bootstrap.bundle.min')}}"></script> -->

<!--                 <script>

                    $(function () {

                      // Basic instantiation:

                      $('#demo-input').colorpicker();

                      

                      // Example using an event, to change the color of the #demo div background:

                      $('#demo-input').on('colorpickerChange', function(event) {

                        $('#demo').css('background-color', event.color.toString());

                      });

                    });

                </script> -->

                  <script type="text/javascript">

                    setTimeout(function() {

                      $('#message').fadeOut('fast');

                  }, 30000);

                  </script>

<!--                   <script type="text/javascript">

  $('.colorpicker').colorpicker({});

</script> -->





<!-- <script>

  $('.select_plugin .dropdown-toggle').click(function(){

    $('.dropdown-menu').addClass('show');

  });

</script> -->

    @endsection