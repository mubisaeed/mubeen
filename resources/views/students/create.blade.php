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

    <li class = "active">Add New Student</li>

  </ol>

</div>

<div class="content_main">

  <div class="profile_main">

    <div class="profile mt-0">

      <div class="course card-header card-header-warning card-header-icon">

        

        <h3 class="main_title_ot">Add New Student</h3>




        <form method="POST" action="/import_file_students" enctype="multipart/form-data">
          @csrf
            <input type="file" name="select_file" accept=".xlsx" required="">
           
            <input type="submit" name="upload" class="btn btn-primary" value="Upload">

        </form>


                          <table class="table table-hover" id="table-id">

                    <thead>

                      <tr>

                        <th scope="col">ID</th>


                        <th scope="col">Downloadable</th>


                      </tr>

                    </thead>

                    <tbody id="mybody">

                      @foreach($samples as $index =>$sample)

                       
                        <tr>

                          <th scope="row">#{{$index+1}}</th>

                       
<!--                                 <td>
                                

                                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{asset('storage/'.$sample->file)}}" width='100' height='100px' frameborder='0'></iframe>


                                </td> -->

                    

                          <td class="first_row"><a href="{{asset('storage/'.$sample->file)}}"  class="btn btn-primary"download>Download</a></td>



                        </tr>


                      @endforeach

                    </tbody>

                  </table>

        <div class="tab-content">

           <form method="POST" action="/studentstore" enctype="multipart/form-data">

             @csrf

            @foreach ($errors->all() as $error)

              <div class="alert alert-danger">{{ $error }}</div>

            @endforeach

            <div class="tab-pane active" id="tab_default_3">

              <div class="s_profile_fields">

                <div class="row">

                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('sname')}}" name="sname" required="" minlength="3" maxlength ="50" autofocus="">

                      <label>First name<span class="red">*</span></label>

                    </div>

                    @error('sname')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>


                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('lname')}}" name="lname" required="" minlength="3" maxlength ="50" autofocus="">

                      <label>Last name<span class="red">*</span></label>

                    </div>

                    @error('lname')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>


                  <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" name="record_no" value="{{old('record_no')}}" required maxlength="255" autofocus="">

                      <label>Record no.<span class="red">*</span></label>

                    </div>

                    @error('record_no')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>

                  <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input type="email" class="form-control" name="email" value="{{old('email')}}" required maxlength="255" autofocus="">

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

                      <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" required="" autofocus="">

                      <label>Image<span class="red">*</span></label>

                    </div>

                  </div>

                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus="">

                      <label>Password<span class="red">*</span></label>

                      @error('password')

                      <span class="invalid-feedback" role="alert">

                          <strong>{{ $message }}</strong>

                      </span>

                      @enderror

                    </div>

                  </div>

                  <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" autofocus="">

                      <label>Confirm Password<span class="red">*</span></label>

                    </div>

                  </div>




                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('hadd')}}" name="hadd" required="" minlength="3" maxlength ="50" autofocus="">

                      <label>Home Address<span class="red">*</span></label>

                    </div>

                    @error('hadd')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>





                  <div class="col-md-12">

                      <div class="custom_input_main select_plugin mobile_field">

                        <select class="selectpicker" name="role">

                          <option value="5">Student</option>

                        </select>

                        <label class="select_lable">Role</label>

                      </div>

                  </div>

                  <!-- <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="date" class="form-control" name="adate" value="{{old('adate')}}" onchange="invoicedue(event);" class="mb-4" required="" autofocus="">

                      <label>Admission Date

                        <span class="red">*</span></label>

                      </div>

                    </div> -->

                    <div class="row px-3"> 

                      <label class="mb-1">

                        <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Gender</h6>

                      </label> 

                      <label class="mb-1">

                          <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Male</h6>

                      <input type="radio" value="male" name="gender" class="mb-4" checked="checked">

                      </label> 

                      <label class="mb-1">

                          <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Female</h6>

                      <input type="radio" value="female" name="gender" class="mb-4">

                      </label> 

                          

                    </div>


                  <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('gl')}}" name="gl" class="mb-4" required="" minlength="1" maxlength ="50" autofocus="">

                      <label>Grade Level<span class="red">*</span></label>

                    </div>

                    @error('gl')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>



                <div class="col-md-12 p_right" required = "">

                  <input type="checkbox" value="Dust Mites" name="alergy[]" />
                  <label>Dust Mites</label>

                   <input type="checkbox" value="Animal dander" name="alergy[]" />
                  <label>Animal dander</label>

                 <input type="checkbox" value="Food (shellfish, eggs and cows' milk)" name="alergy[]" />
                  <label>Food (shellfish, eggs and cows' milk)</label>

                 <input type="checkbox" value="Insect bites and stings" name="alergy[]" />
                  <label>Insect bites and stings</label>

                 <input type="checkbox" value="Medicines" name="alergy[]" />
                <label>Medicines</label>


                    <!-- <select required="" name="alergy">

                      <option value="1">Dust Mites</option>

                      <option value="2">Animal dander</option>

                      <option value="3">Food (shellfish, eggs and cows' milk)</option>

                      <option value="4">Insect bites and stings</option>

                      <option value="5">Medicines</option>

                    </select>

                    <label >Known Allergies</label> -->


                </div>


                <div class="col-md-12 p_right">

                    <div class="custom_input_main select_plugin mobile_field">

                    <select class="selectpicker" required="" name="iep">

                      <option value="1">1st Grade(Elementary)</option>

                      <option value="2">2nd Grade(Elementary)</option>

                      <option value="3">3rd Grade(Elementary)</option>

                      <option value="4">4th Grade(Elementary)</option>

                      <option value="5">5th Grade(Elementary)</option>

                      <option value="6">6th Grade(Elementary)</option>

                      <option value="7">7th Grade(Middle)</option>

                      <option value="8">8th Grade(Middle)</option>

                      <option value="9">9th Grade(Highschool)</option>

                      <option value="10">10th Grade(Highschool)</option>

                      <option value="11">11th Grade(Highschool)</option>

                      <option value="12">12th Grade(Highschool)</option>

                    </select>

                    <label class="select_lable">IEP/504</label>

                  </div>

                </div>


                <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('pfname')}}" name="pfname" class="mb-4" required="" minlength="1" maxlength ="50" autofocus="">

                      <label>Parent First Name<span class="red">*</span></label>

                    </div>

                    @error('pfname')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                </div>

                <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('plname')}}" name="plname" class="mb-4" required="" minlength="1" maxlength ="50" autofocus="">

                      <label>Parent Last Name<span class="red">*</span></label>

                    </div>

                    @error('plname')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                </div>



                <div class="col-md-6 p_left">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('reltion')}}" name="relation" class="mb-4" required="" minlength="1" maxlength ="50" autofocus="">

                      <label>Relation<span class="red">*</span></label>

                    </div>

                    @error('relation')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                </div>

                <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input type="tell" class="form-control" name="phno" value="{{ old('phno')}}" placeholder="xxxx-xxxxxxx" required="" autofocus="">

                      <label>Phone No<span class="red">*</span></label>

                    </div>

                    @error('phno')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>

                  
                <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input type="email" class="form-control" name="pemail" value="{{old('pemail')}}" required maxlength="255" autofocus="">

                      <label>Parent Email <span class ="red">*</span></label>

                    </div>

                    @error('pemail')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>

                  <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('add')}}" name="add" required="" minlength="3" maxlength ="200" autofocus="">

                      <label>Address<span class="red">*</span></label>

                    </div>

                    @error('add')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div>

                 <!--  <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('class')}}" name="class" required="" minlength="3" maxlength ="200" autofocus="">

                      <label>Class<span class="red">*</span></label>

                    </div>

                    @error('class')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div> -->

                  <!-- <div class="col-md-6 p_right">

                    <div class="custom_input_main mobile_field">

                      <input type="text" class="form-control" value="{{ old('rno')}}" name="rno" required="" minlength="1" maxlength ="200" autofocus="">

                      <label>Roll No<span class="red">*</span></label>

                    </div>

                    @error('rno')

                      <span class="invalid-feedback" role="alert">

                      <strong>{{ $message }}</strong>

                      </span>

                    @enderror

                  </div> -->

          <!-- <div class="row px-3"> 

            <label class="mb-1">

              <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Diabetes</h6>

            </label> 

            <label class="mb-1">

                <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Yes</h6>

            <input type="radio" value="yes" name="diabetes" class="mb-4" >

            </label> 

            <label class="mb-1">

                <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">No</h6>

            <input type="radio" value="no" name="diabetes" class="mb-4" checked="checked">

            </label> 

                

          </div> -->

          <br><br>

          <!-- <div class="row px-3"> 

            <label class="mb-1">

                <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Alergy</h6>

            </label> 

            <label class="mb-1">

                <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Yes</h6>

            <input type="radio" value="yes" name="alergy" class="mb-4" >

            </label> 

            <label class="mb-1">

                <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">No</h6>

            <input type="radio" value="no" name="alergy" class="mb-4" checked="checked">

            </label> 

          </div> -->

          <div class="s_form_button text-center">

              <a  href="{{url('/students')}}"><button type="button" class="btn cncl_btn">Cancel</button></a>

              <button type="submit" class="btn save_btn">Save</button>

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

  </div>

</div>

</div>

<script type="text/javascript">

  setTimeout(function() {

    $('#message').fadeOut('fast');

}, 2000);

</script> 

<script type="text/javascript">

  var password = document.getElementById("password");

  var confirm_password = document.getElementById("password_confirmation");



function validatePassword(){

  if(password.value != confirm_password.value) {

    confirm_password.setCustomValidity("Passwords Don't Match");

  } else {

    confirm_password.setCustomValidity('');

  }

}



password.onchange = validatePassword;

confirm_password.onkeyup = validatePassword;

</script>  

@endsection

       