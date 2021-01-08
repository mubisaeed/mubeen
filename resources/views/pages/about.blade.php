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
    <div class="container">
      <div class="login_text">
        <h3>About</h3>
      </div>
      <div class="row px-3"> 
        <label class="mb-2"><h6 class="mb-0 text-sm">Title</h6></label> <br>
        <input class="form-control" type="text" name="title" value="{{old('title', $about->title)}}" class="mb-4" required minlength="3" maxlength="50"><br><br>
        @error('title')
          <div>
            {{$message}}
          </div>
        @enderror
      </div>
      <div class="text-left">
        <label class="mb-1"><h6 class="mb-0 text-sm">Image</h6></label> <br>
        <input type="file" name="image"  class="mb-4"  accept="image/x-png,image/gif,image/jpeg">
        <img class="img-fluid" src="{{asset('/img/upload/'.$about->image)}}" width ="100" height="100">
        @error('image')
          <div>
            {{$message}}
          </div>
        @enderror
      </div>
      <div class="text-left">
        <label class="mb-1"><h6 class="mb-0 text-sm">Content</h6></label><br>
        <textarea name="content" cols="16" id="txtEditor" required>
          {{old('content', $about->content)}}
        </textarea>
        @error('content')
          <div>
            {{$message}}
          </div>
        @enderror
      </div>                 
      <div class="card-footer pull-right">
        <a class="btn btn-default" href="{{url('/aboutpage')}}">Cancel</a>
        <button type="submit" class="btn btn-fill btn-primary">Update</button>
      </div>
    </div>
  </form>
    
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