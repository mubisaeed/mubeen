@extends('layouts.app')

@section('content')
@if (Session::has('message'))
  <div class="alert alert-info">
    {{ Session::get('message') }}
  </div>
@endif 
<form method="POST" action="/schoolstore" enctype="multipart/form-data">
  @csrf
    <div class="card2 card border-0 px-4 py-5">
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        <div class="login_text">
          <h3>Create School</h3>
        </div>
        <br><br>
        <div class="row px-3"> 
            <label class="mb-1">
                <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">School name</h6>
            </label> 
            <input type="text" value="{{ old('name')}}" name="name" class="mb-4" required="" minlength="3" maxlength ="50">
            @error('sname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <br><br>
        <label style="color: black" for="email">Enter Email:</label>
        <input type="email" name="email" value="{{old('email')}}" required maxlength="255">
        @error('email')
        <div>
          {{$message}}
        </div>
        @enderror
        <br><br>
          <label for="password">{{ __('Password') }}</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          <label for="password-confirm">{{ __('Confirm Password') }}</label>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          <br><br>
          <br><br>  
               <div class="row px-3"> 
                  <label class="mb-1">
                      <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">School Image</h6>
                  </label> 
                  <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" required="">
              </div>
              <br><br>
        <div class="row px-3"> 
            <label class="mb-1">
                <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Role</h6>
            </label> 
            <select required="required" class="form-control" name="role">
                <option value="3">School</option>
                <option value="4">Instructor</option>
                <option value="5">Student</option>
            </select>
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
        
        <div class="row px-3 mb-4">
            <div class="custom-control custom-checkbox custom-control-inline">   </div>
        </div>
        <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Create</button> </div>
    </div>
</form>
<script type="text/javascript">
  setTimeout(function() {
    $('#message').fadeOut('fast');
}, 2000);
</script>   
@endsection