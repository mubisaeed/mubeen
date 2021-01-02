@extends('layouts.app')
@section('content')

  <div>
    <h3>Edit Instructor</h3>
    <hr>
    <form method="POST" action="/instructors/edit/{{$instructor->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label for="name">Enter Name:</label>
      <input type="text" name="name" value="{{old('name', $instructor->name)}}" required minlength="3" maxlength="255">
      @error('name')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label for="image">Upload an image:</label>
      <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
      <img height="150px" width="200px" src="{{asset('img/instructors/'.$instructor->image)}}">
      @error('image')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label for="bio">Enter Bio:</label>
      <input type="text" name="bio" value="{{old('bio', $instructor->bio)}} required minlength="10" maxlength="3000">
      @error('bio')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <label for="email">Enter Email:</label>
      <input type="email" name="email" value="{{old('email', $instructor->email)}}" required maxlength="255">
      @error('email')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <input type="submit" value="Update">
      <button><a href="/instructors">Cancel</a></button>
    </form>
  </div>

</div>
</div>
</div>
@endsection