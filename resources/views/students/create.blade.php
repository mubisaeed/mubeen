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
                    <form method="POST" action="/studentstore" enctype="multipart/form-data">
                    @csrf
                        <div class="card2 card border-0 px-4 py-5">
                            @foreach ($errors->all() as $error)

                            <div class="alert alert-danger">{{ $error }}</div>

                            @endforeach
                            <div class="login_text">
                                <h3>Create Student</h3>
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Student name</h6>
                                </label> 
                                <input type="text" value="{{ old('sname')}}" name="sname" class="mb-4" placeholder="Enter class name" required="" minlength="3" maxlength ="20">
                                @error('sname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                            <label><h6 style="color:black; margin-right: 10px">email</h6></label>
                            <input type="email" name="email" placeholder="Enter email address" value="{{old('email')}}">
                              @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Role</h6>
                                </label> 
                                <select required="required" class="form-control" name="role">
                                    <option value="5">Student</option>
                                </select>
                            </div>
                            <br><br>
                             <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Student Image</h6>
                                </label> 
                                <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Father name</h6>
                                </label> 
                                <input type="text" value="{{ old('fname')}}" name="fname" class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength ="50">
                                @error('fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Phone Number</h6>
                                </label> 
                                <input type="tel" name="phno" value="{{ old('phno')}}" placeholder="xxxx-xxxxxxx" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" required="" minlength="12" maxlength = "12">
                                @error('phno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black"style="color:black; margin-right: 10px">CNIC</h6>
                                </label> 
                                <input type="text" value="{{ old('cnic')}}" name="cnic"class="mb-4" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"  required="">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Address</h6>
                                </label> 
                                <input type="text"value="{{ old('add')}}" name="add" class="mb-4" placeholder="Enter room number" required="" minlength="3" maxlength ="200">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Class</h6>
                                </label> 
                                <input type="text" value="{{ old('class')}}" name="class" class="mb-4" placeholder="Enter room number" required="" min="3" max="50">
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
                                <input type="text" value="{{ old('rno')}}" name="rno" class="mb-4" placeholder="Enter room number" required="">
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
                                    <option value="A+">A+</option>
                                    <option value="B+">B+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            <div class="row px-3"> 
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
                                
                            </div>
                            <br><br>
                           <div class="row px-3"> 
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
                                
                            </div>
                            <br><br>
                                
                            <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Create</button> </div>
                        </div>
                    </form>
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
@endsection
       