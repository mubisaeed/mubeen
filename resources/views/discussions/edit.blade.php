@extends('layouts.app')
@section('content')   

  <div>
    <h3>Edit Discussion</h3>
    <hr>
    <form method="POST" action="/discussions/edit/{{$discussion->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label for="title">Enter Title:</label>
      <input type="text" name="title" value="{{old('title', $discussion->title)}}" required minlength="3" maxlength="255">
      @error('title')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label for="image">Upload an image:</label>
      <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
      <img height="150px" width="200px" src="{{asset('img/discussions/'.$discussion->image)}}">
      @error('image')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label for="description">Enter Description:</label>
      <input type="text" name="description" value="{{old('title', $discussion->description)}}" required minlength="10" maxlength="3000">
      @error('description')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br><br>
      <input type="submit" value="Update">
      <button><a href="/discussions">Cancel</a></button>
    </form>
  </div>

@endsection