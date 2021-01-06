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
             <form class="form-horizontal" method="POST" action="{{ url('/instructors/edit/'. $instructor->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="card2 card border-0 px-4 py-5">
                            <div class="login_text">
                                <h3>Edit Instructor</h3>
                            </div>
                            <br><br>

                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Instructor name</h6>
                                </label> 
                                <input type="text" name="name" value="{{$instructor->name }}" class="mb-4" placeholder="Enter student name" required="" minlength="3" maxlength ="50">
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
                                <input type="email" name="email" value="{{$instructor->email }}" class="mb-4" placeholder="Enter email" required="">
                                @error('sname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                             <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Instructor Image</h6>
                                </label> 
                                <input type="file" name="image" value="{{$instructor->image }}"  class="mb-4"  accept="image/x-png,image/gif,image/jpeg">
                                <img src="{{asset('/img/instructors/'.$instructor->image)}}" width ="100" >

                            </div>
                            <br><br>
                           
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Phone</h6>
                                </label> 
                                <input type="tel" name="phno" value="{{$instructor->phone }}"  class="mb-4" placeholder="xxxx-xxxxxxx" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" required="" minlength="12" maxlength = "12" >
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
                                <input type="text" name="cnic" value="{{ $instructor->cnic}}" class="mb-4" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"  required="" maxlength="15">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Address</h6>
                                </label> 
                                <input type="text" name="add" value="{{$instructor->address }}"  class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength ="200">
                            </div>
                            <br><br>
                            
                           
                            <div class="card-footer pull-right">

                        <a class="btn btn-default" href="{{url('/instructors')}}">Cancel</a>

                    <button type="submit" class="btn btn-fill btn-primary">Update</button>
                </div>
             </form>
                <script>
                    $(":input").inputmask();

               </script>
                <script type="text/javascript">
                  setTimeout(function() {
                    $('#message').fadeOut('fast');
                }, 30000);
                </script>
@endsection