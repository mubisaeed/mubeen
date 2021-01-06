@extends('layouts.app')
@section('content')
  <div>
    <h3>Add a new Safety Tip</h3>
    <hr>
    <form method="POST" action="/safetytips/create" enctype="multipart/form-data">
      @csrf
      <label style="color: black" for="title">Enter title:</label>
      <input type="text" name="title" value="{{old('title')}}" required minlength="3" maxlength="255">
      @error('title')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label style="color: black" for="image">Upload an image:</label>
      <input type="file" name="image" required accept="image/x-png,image/gif,image/jpeg">
      @error('image')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label style="color: black" for="description">Enter Description:</label>
      <input type="text" name="description" value="{{old('description')}}" required minlength="10" maxlength="3000">
      @error('description')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <input type="submit" value="Submit">
      <button><a href="/safetytips">Cancel</a></button>
    </form>
  </div>

@endsection