@extends('layouts.app')
@section('content')

  <div>
    <h3>Edit Room</h3>
    <hr>
    <form method="POST" action="/rooms/edit/{{$room->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label for="name">Enter Name:</label>
      <input type="text" name="name" value="{{old('name', $room->name)}}" required minlength="3" maxlength="255">
      @error('name')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label for="room_no">Enter Room No. :</label>
      <input type="text" name="room_no" value="{{old('room_no', $room->room_no)}}" required minlength="1" maxlength="25">
      @error('room_no')
      <div>
        {{$message}}
      </div>
      @enderror
      <br>
      <label for="floor_no">Enter floor No. :</label>
      <input type="text" name="floor_no" value="{{old('floor_no', $room->floor_no)}}" required minlength="1" maxlength="25">
      @error('floor_no')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <input type="submit" value="Update">
      <button><a href="/rooms">Cancel</a></button>
    </form>
  </div>

</div>
</div>
</div>
@endsection