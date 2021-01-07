@extends('layouts.app')
@section('content')

  <div id="message">
    @if (Session::has('message'))
      <div class="alert alert-info">
        {{ Session::get('message') }}
      </div>
    @endif
  </div>
  <form class="form-horizontal" method="POST" action="{{ url('/updatecontact/'. $contact->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="card2 card border-0 px-4 py-5">
      <div class="login_text">
        <h3>Contact Us</h3>
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Title</h6></label> 
        <input type="text" name="title" value="{{old('title', $contact->title)}}" class="mb-4" required minlength="3" maxlength="50">
        @error('title')
          <div>
            {{$message}}
          </div>
        @enderror
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Image</h6></label> 
        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
        @error('image')
          <div>
            {{$message}}
          </div>
        @enderror
        <img src="{{asset('/img/upload/'.$contact->image)}}" width ="100" >
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Email</h6></label> 
        <input type="email" name="email" value="{{old('email', $contact->email)}}" required>
        @error('email')
          <div>
            {{$message}}
          </div>
        @enderror
      </div>
      <div class="row px-3"> 
        <label for="phno" class="mb-1"><h6 class="mb-0 text-sm">Phone</h6></label> 
        <input type="tel" name="phno" value="{{old('phno', $contact->phone)}}"  class="mb-4" required maxlength="12" minlength="12" placeholder="03xx-xxxxxxx" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}">
        @error('phno')
          <div>
            {{$message}}
          </div>
        @enderror
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Address</h6></label> 
        <input type="text" name="add" value="{{old('add', $contact->address)}}"  class="mb-4" required minlength="3" maxlength="200">
        @error('add')
          <div>
            {{$message}}
          </div>
        @enderror
      </div>
      <div class="card-footer pull-right">
        <a class="btn btn-default" href="{{url('/contactpage')}}">Cancel</a>
        <button type="submit" class="btn btn-fill btn-primary">Update</button>
      </div>
    </div>
  </form>
  
  <script>
    $(":input").inputmask();
  </script>
  <script type="text/javascript">
    setTimeout(function() {
      $('#message').fadeOut('fast');
    }, 2000);
  </script>
@endsection