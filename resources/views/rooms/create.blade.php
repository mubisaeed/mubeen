@extends('layouts.app')
@section('content')

  <div>
    <h3>Add new Room</h3>
    <hr>
    <form method="POST" action="/rooms/create" enctype="multipart/form-data">
      @csrf
      <label style="color: black" for="name">Enter Name:</label>
      <input type="text" name="name" value="{{old('name')}}" required minlength="3" maxlength="255">
      @error('name')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label style="color: black" for="room_no">Enter Room No. :</label>
      <input type="text" name="room_no" value="{{old('room_no')}}" required minlength="1" maxlength="25">
      @error('room_no')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label style="color: black" for="floor_no">Enter Floor No. :</label>
      <input type="text" name="floor_no" value="{{old('floor_no')}}" required minlength="1" maxlength="25">
      @error('floor_no')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <input type="submit" value="Submit">
      <button><a href="/rooms">Cancel</a></button>
    </form>
  </div>

@endsection