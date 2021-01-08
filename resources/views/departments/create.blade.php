@extends('layouts.app')
@section('content')

  <div>
    <h3>Add a new Department</h3>
    <hr>
    <form method="POST" action="/departments/create" enctype="multipart/form-data">
      @csrf
      <label style="color: black" for="name">Enter name:</label>
      <input class="form-control" type="text" name="name" value="{{old('name')}}" required minlength="3" maxlength="255">
      @error('name')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <div class="footer pull-right">
      <input class="btn btn-primary" type="submit" value="Submit">
      <a href="/departments" class="btn btn-default">Cancel</a>
      </div>
    </form>
  </div>

@endsection