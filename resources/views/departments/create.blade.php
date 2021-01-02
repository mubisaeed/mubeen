@extends('layouts.app')
@section('content')

  <div>
    <h3>Add a new Department</h3>
    <hr>
    <form method="POST" action="/departments/create" enctype="multipart/form-data">
      @csrf
      <label style="color: black" for="name">Enter name:</label>
      <input type="text" name="name" value="{{old('name')}}" required minlength="3" maxlength="255">
      @error('name')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <input type="submit" value="Submit">
      <button><a href="/departments">Cancel</a></button>
    </form>
  </div>

</div>
</div>
</div>
@endsection