@extends('layouts.app')
@section('content')

  <div>
    <h3>Add new Instructor</h3>
    <hr>
    <form method="POST" action="/instructors/create" enctype="multipart/form-data">
      @csrf
      <label style="color: black" for="name">Enter Name:</label>
      <input type="text" name="name" value="{{old('name')}}" required minlength="3" maxlength="255">
      @error('name')
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
      <label style="color: black" for="bio">Enter Bio:</label>
      <input type="text" name="bio" value="{{old('bio')}}" required minlength="10" maxlength="3000">
      @error('bio')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label style="color: black" for="email">Enter Email:</label>
      <input type="email" name="email" value="{{old('email')}}" required maxlength="255">
      @error('email')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <input type="submit" value="Submit">
      <button><a href="/instructors">Cancel</a></button>
    </form>
  </div>

</div>
</div>
</div>
@endsection