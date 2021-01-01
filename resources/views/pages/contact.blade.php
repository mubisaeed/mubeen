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
        <input type="text" name="title" value="{{$contact->title}}" class="mb-4" placeholder="Enter title" required="" min="3" max="50">
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Image</h6></label> 
        <input type="file" name="image" value="{{$contact->image }}"  class="mb-4"  accept="image/x-png,image/gif,image/jpeg">
        <img src="{{asset('/img/upload/'.$contact->image)}}" width ="100" >
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Email</h6></label> 
        <input type="email" name="email" value="{{$contact->email}}">
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Phone</h6></label> 
        <input type="text" name="phno" value="{{$contact->phone }}"  class="mb-4" placeholder="Enter department" required="" data-inputmask="'mask': '0399-99999999'" maxlength="12">
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Address</h6></label> 
        <input type="text" name="add" value="{{$contact->address }}"  class="mb-4" placeholder="Enter department" required="" min="3" max="200">
      </div>
      <div class="card-footer pull-right">
        <a class="btn btn-default" href="{{url('/contactpage')}}">Cancel</a>
        <button type="submit" class="btn btn-fill btn-primary">Update</button>
      </div>
    </div>
  </form>

  </div>
  </div>
  </div>

  <script>
    $(":input").inputmask();
  </script>
  <script type="text/javascript">
    setTimeout(function() {
      $('#message').fadeOut('fast');
    }, 2000);
  </script>
@endsection