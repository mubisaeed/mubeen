@extends('layouts.app')
@section('content')

  <div>
    <h3>Add a new Discussion</h3>
    <hr>
    <form method="POST" action="/discussions/create" enctype="multipart/form-data">
      @csrf
      <label style="color: black" for="title">Enter title:</label>
      <input class="form-control" type="text" name="title" value="{{old('title')}}" required minlength="3" maxlength="255">
      @error('title')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <div class="text-left">
      <label style="color: black" for="image">Upload an image:</label>
      <input class="img-fluid" type="file" name="image" required accept="image/x-png,image/gif,image/jpeg">
      @error('image')
      <div>
        {{$message}}
      </div>
      @enderror
      </div><br>
      <label style="color: black" for="description">Enter Description:</label>
      <input class="form-control" type="text" name="description" value="{{old('description')}}" required minlength="10" maxlength="3000">
      @error('description')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <div class="footer pull-right">
      <input class="btn btn-primary" type="submit" value="Submit">
      <a href="{{url('/discussions')}}" class="btn btn-default">Cancel</a>
      </div>
    </form>
  </div>

@endsection