@extends('layouts.app')

@section('content')

            <div id="message">
              @if (Session::has('message'))
                <div class="alert alert-info">
                  {{ Session::get('message') }}
                </div>
              @endif
          </div>
             <form class="form-horizontal" method="POST" action="{{ url('/school/update/'. $school->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="card2 card border-0 px-4 py-5">
                            <div class="login_text">
                                <h3>Edit School</h3>
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">School name</h6>
                                </label> 
                                <input type="text" name="sname" value="{{$school->name }}" class="mb-4" placeholder="Enter class name" required="" minlength ="3" maxlength ="50">
                                @error('sname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Logo</h6>
                                </label> 
                                <input type="file" name="image" value="{{$school->logo }}"  class="mb-4" accept="image/x-png,image/gif,image/jpeg">

                                <img src="{{asset('/img/upload/'.$school->logo)}}" width ="100" >
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Address</h6>
                                </label> 
                                <input type="text" name="add" value="{{$school->address }}"  class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength="200">
                                @error('add')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Owner Name</h6>
                                </label> 
                                <input type="text" name="oname" value="{{$school->owner_name }}"  class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength ="50">
                                @error('oname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Owner Address</h6>
                                </label> 
                                <input type="text" name="oadd" value="{{$school->owner_address }}"  class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength ="50">
                                @error('oadd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                           
                            
                           
                            <div class="card-footer pull-right">

                        <a class="btn btn-default success" href="{{url('/schools')}}">Cancel</a>

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