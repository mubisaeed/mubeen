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
    <li class = "active">Edit Student</li>
  </ol>
</div>
<div class="content_main">
  <div class="profile_main">
    <div class="profile mt-0">
      <div class="course card-header card-header-warning card-header-icon">
        
        <h3 class="main_title_ot">Edit Student</h3>
        <div class="tab-content">
            <form class="form-horizontal" method="POST" action="{{ url('/student/update/'. $student->id) }}" enctype="multipart/form-data">
              @csrf
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
              <div class="tab-pane active" id="tab_default_3">
              <div class="s_profile_fields">
                <div class="row">
                  <div class="col-md-6 p_left">
                    <div class="custom_input_main mobile_field">
                      <input type="text" class="form-control" value="{{old('sname',$student->name)}}"  name="sname" required="" minlength="3" maxlength ="50" autofocus="">
                      <label>Student name<span class="red">*</span></label>
                    </div>
                    @error('sname')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-6 p_right">
                    <div class="custom_input_main mobile_field">
                      <input type="email" class="form-control" name="email"value="{{old('email',$student->email)}}"  required maxlength="255"autofocus="">
                      <label>Email<span class="red">*</span></label>
                    </div>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-6 p_left">
                    <div class="custom_input_main mobile_field">
                      <input type="file" name="image" value="{{old('image',$student->image)}}"  class="mb-4" accept="image/x-png,image/gif,image/jpeg" autofocus="">
                      <label>Image<span class="red">*</span></label>
                    </div>
                  </div>
                   <div class="col-md-6 p_left">
                      <div class="custom_input_main mobile_field">
                        <input type="date" class="form-control" name="adate" value="{{old('adate',$student->admission_date)}}"  onchange="invoicedue(event);" class="mb-4" required="" autofocus="">
                        <label>Admission Date
                          <span class="red">*</span></label>
                        </div>
                      </div>
                      <div class="row px-3"> 
                        <label class="mb-1">
                          <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Gender</h6>
                        </label> 
                        <label class="mb-1">
                            <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Male</h6>
                        <input type="radio"  name="gender" value="male" {{ (isset($student->gender) && $student->gender == 'male') ? 'checked' : '' }}>
                        </label> 
                        <label class="mb-1">
                            <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Female</h6>
                        <input type="radio" name="gender" value="no" {{ (isset($student->gender) && $student->gender == 'female') ? 'checked' : '' }}>
                        </label> 
                        
                  </div>
                  <div class="col-md-6 p_right">
                    <div class="custom_input_main mobile_field">
                      <select required="required" class="form-control" name="role">
                          <option value="5">Student</option>
                      </select>
                      <label>Role<span class="red">*</span></label>
                    </div>
                  </div>
                <div class="col-md-6 p_left">
                    <div class="custom_input_main mobile_field">
                      <input type="text" class="form-control" value="{{old('fname',$student->father_name)}}" name="fname" class="mb-4" required="" minlength="3" maxlength ="50" autofocus="">
                      <label>Father name<span class="red">*</span></label>
                    </div>
                    @error('fname')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="col-md-6 p_right">
                    <div class="custom_input_main mobile_field">
                      <input type="tell" class="form-control" name="phno" value="{{old('phno',$student->phone)}}" placeholder="xxxx-xxxxxxx" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" required="" minlength="12" maxlength = "12" autofocus="">
                      <label>Phone No<span class="red">*</span></label>
                    </div>
                    @error('phno')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-6 p_left">
                    <div class="custom_input_main mobile_field">
                      <input type="text" class="form-control" value="{{old('cnic',$student->cnic)}}" name="cnic"class="mb-4" minlength="13" maxlength="15"  placeholder="XXXXX-XXXXXXX-X"  required="" autofocus="">
                      <label>CNIC<span class="red">*</span></label>
                    </div>
                    @error('cnic')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-6 p_right">
                    <div class="custom_input_main mobile_field">
                      <input type="text" class="form-control" value="{{old('add',$student->address)}}"  name="add" class="mb-4" required="" minlength="3" maxlength ="200" autofocus="">
                      <label>Address<span class="red">*</span></label>
                    </div>
                    @error('address')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message}}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-6 p_right">
                    <div class="custom_input_main mobile_field">
                      <input type="text" class="form-control" name="class" value="{{old('class',$student->class)}}" required="" minlength="3" maxlength ="200" autofocus="">
                      <label>Class<span class="red">*</span></label>
                    </div>
                    @error('class')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-6 p_right">
                    <div class="custom_input_main mobile_field">
                      <input type="text" class="form-control"  name="rno" value="{{old('rno',$student->rollno)}}" required="" minlength="1" maxlength ="200" autofocus="">
                      <label>Roll No<span class="red">*</span></label>
                    </div>
                    @error('rno')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <!-- <div class="col-md-12">
                      <div class="custom_input_main select_plugin mobile_field">
                        <select class="selectpicker" name="blood">
                          <option  {{ ( $student->blood_group) == 'A+' ? 'selected' : '' }} value="A+">A+</option>
                          <option {{ ( $student->blood_group) == 'B+' ? 'selected' : '' }} value="B+">B+</option>
                          <option {{ ( $student->blood_group) == 'AB+' ? 'selected' : '' }} value="AB+">AB+</option>
                          <option {{ ( $student->blood_group) == 'O+' ? 'selected' : '' }} value="O+">O+</option>
                          <option {{ ( $student->blood_group) == 'O-' ? 'selected' : '' }} value="O-">O-</option>
                        </select>
                        <label class="select_lable">Blood Group</label>
                      </div>
                  </div> -->
                  <div class="row px-3"> 
                    <label class="mb-1">
                      <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Diabetes</h6>
                    </label> 
                    <label class="mb-1">
                        <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Yes</h6>
                    <input type="radio"  name="diabetes" value="yes" {{ (isset($student->diabetes) && $student->diabetes == 'yes') ? 'checked' : '' }}>
                    </label> 
                    <label class="mb-1">
                        <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">No</h6>
                    <input type="radio" name="diabetes" value="no" {{ (isset($student->diabetes) && $student->diabetes == 'no') ? 'checked' : '' }}>
                    </label> 
                        
                  </div>
                  <br><br>
                  <div class="row px-3"> 
                    <label class="mb-1">
                        <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Alergy</h6>
                    </label> 
                    <label class="mb-1">
                        <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Yes</h6>
                    <input type="radio" value="yes" name="alergy" class="mb-4" {{ (isset($student->alergy) && $student->alergy == 'yes') ? 'checked' : '' }}>
                    </label> 
                    <label class="mb-1">
                        <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">No</h6>
                    <input type="radio" value="no" name="alergy" class="mb-4" {{ (isset($student->alergy) && $student->alergy == 'no') ? 'checked' : '' }}>
                    </label> 
                  </div>

                  <div class="s_form_button text-center">
                      <a  href="{{url('/students')}}"><button type="button" class="btn cncl_btn">Cancel</button></a>
                      <button type="submit" class="btn save_btn">Update</button>
                    </div>
                  </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
<script>
  $(":input").inputmask();
</script>
<script type="text/javascript">
  setTimeout(function() {
    $('#message').fadeOut('fast');
  }, 30000);
</script>
@endsection	     