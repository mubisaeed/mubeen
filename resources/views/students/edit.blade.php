@extends('layouts.app')

@section('content')
               <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
              <div id="message">
              @if (Session::has('message'))
                <div class="alert alert-info">
                  {{ Session::get('message') }}
                </div>
              @endif
            </div>
             <form class="form-horizontal" method="POST" action="{{ url('/student/update/'. $student->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="card2 card border-0 px-4 py-5">
                            <div class="login_text">
                                <h3>Edit Student</h3>
                            </div>
                            <br><br>

                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Student name</h6>
                                </label> 
                                <input type="text" name="sname" value="{{$student->name }}" class="mb-4" placeholder="Enter student name" required="" minlength="3" maxlength ="50">
                                @error('sname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Email</h6>
                                </label> 
                                <input type="email" name="email" value="{{$student->email }}" class="mb-4" placeholder="Enter email" required="">
                                @error('sname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Student Image</h6>
                                </label> 
                                <input type="file" name="image" value="{{$student->image }}"  class="mb-4"  accept="image/x-png,image/gif,image/jpeg">
                                <img src="{{asset('/img/upload/'.$student->image)}}" width ="100" >

                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Father Name</h6>
                                </label> 
                                <input type="text" name="fname" value="{{$student->father_name }}"  class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength ="50">
                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Phone</h6>
                                </label> 
                                <input type="tel" name="phno" value="{{$student->phone }}"  class="mb-4" placeholder="xxxx-xxxxxxx" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" required="" minlength="12" maxlength = "12" >
                                @error('phno')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">CNIC</h6>
                                </label>
                                <input type="text" name="cnic" value="{{ $student->cnic}}" class="mb-4" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"  required="" maxlength="15">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Address</h6>
                                </label> 
                                <input type="text" name="add" value="{{$student->address }}"  class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength ="200">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">class</h6>
                                </label> 
                                <input type="text" name="class" value="{{$student->class }}"  class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength ="200">
                                @error('class')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Roll Number</h6>
                                </label> 
                                <input type="text" name="rno" value="{{$student->rollno }}" class="mb-4" placeholder="Enter room number" required="">
                                @error('rno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Blood Group</h6>
                                </label> 
                                <select required="required" class="form-control" name="blood">
                                    <option  {{ ( $student->blood_group) == 'A+' ? 'selected' : '' }} value="A+">A+</option>
                                    <option {{ ( $student->blood_group) == 'B+' ? 'selected' : '' }} value="B+">B+</option>
                                    <option {{ ( $student->blood_group) == 'AB+' ? 'selected' : '' }} value="AB+">AB+</option>
                                    <option {{ ( $student->blood_group) == 'O+' ? 'selected' : '' }} value="O+">O+</option>
                                    <option {{ ( $student->blood_group) == 'O-' ? 'selected' : '' }} value="O-">O-</option>
                                </select>
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Diabetes</h6>
                                </label> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Yes</h6>
                                <input type="radio" value="yes" name="diabetes" {{ (isset($student->diabetes) && $student->diabetes == 'yes') ? 'checked' : '' }} class="mb-4" >
                                </label> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">No</h6>
                                <input type="radio" value="no" {{ (isset($student->diabetes) && $student->diabetes == 'no') ? 'checked' : '' }} name="diabetes" class="mb-4">
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
                           
                            <div class="card-footer pull-right">

                        <a class="btn btn-default" href="{{url('/students')}}">Cancel</a>

                    <button type="submit" class="btn btn-fill btn-primary">Update</button>
                </div>
             </form>
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