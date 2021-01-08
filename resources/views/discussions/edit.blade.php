@extends('layouts.app')
@section('content')   

  <div>
    <h3>Edit Discussion</h3>
    <hr>
    <form method="POST" action="/discussions/edit/{{$discussion->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label for="title">Enter Title:</label>
      <input class="form-control" type="text" name="title" value="{{old('title', $discussion->title)}}" required minlength="3" maxlength="255">
      @error('title')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <div class="text-left">
      <label for="image">Upload an image:</label>
      <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
      <img height="100px" width="100px" src="{{asset('img/discussions/'.$discussion->image)}}">
      @error('image')
      <div>
        {{$message}}
      </div>
      @enderror
      </div><br>
      <label for="description">Enter Description:</label>
      <input class="form-control" type="text" name="description" value="{{old('title', $discussion->description)}}" required minlength="10" maxlength="3000">
      @error('description')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br><br>
      <div class="footer pull-right">
      <input class="btn btn-primary" type="submit" value="Update">
      <a class="btn btn-default" href="/discussions">Cancel</a>
      </div>
    </form>
  </div>

@endsection