@extends('layouts.app')
@section('content')

  <div id="message">
  @if (Session::has('message'))
    <div class="alert alert-info">
      {{ Session::get('message') }}
    </div>
  @endif
  </div>

  <form class="form-horizontal" method="POST" action="{{ url('/updateabout/'. $about->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="card2 card border-0 px-4 py-5">
      <div class="login_text">
        <h3>About</h3>
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Title</h6></label> 
        <input type="text" name="title" value="{{$about->title }}" class="mb-4" placeholder="Enter student name" required="" min="3" max="50">
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Image</h6></label> 
        <input type="file" name="image" value="{{$about->image }}"  class="mb-4"  accept="image/x-png,image/gif,image/jpeg">
        <img src="{{asset('/img/upload/'.$about->image)}}" width ="100" >
      </div>
      <div class="row px-3"> 
        <label class="mb-1"><h6 class="mb-0 text-sm">Content</h6></label> 
        <textarea name="content" cols="16" id="txtEditor" style="height: 35px;width: 100%;" required = "">
          {{$about->content }}
        </textarea>
      </div>                 
      <div class="card-footer pull-right">
        <button type="submit" class="btn btn-fill btn-primary">Update</button>
      </div>
    </div>
  </form>
  
  </div>
  </div>
  </div>
    
  <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'txtEditor' );
  </script>
  <script>
    $(":input").inputmask();
  </script>
  <script type="text/javascript">
    setTimeout(function() {
      $('#message').fadeOut('fast');
    }, 2000);
  </script>

@endsection