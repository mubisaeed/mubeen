@extends('layouts.app')
@section('content')   

  <div>
    <h3>Edit Department</h3>
    <hr>
    <form method="POST" action="/departments/edit/{{$department->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label for="name">Enter name:</label>
      <input type="text" name="name" value="{{old('name', $department->name)}}" required minlength="3" maxlength="255">
      @error('name')
      <div>
        {{$message}}
      </div>
      @enderror
      <br><br>
      <input type="submit" value="Update">
      <button><a href="/departments">Cancel</a></button>
    </form>
  </div>

</div>
</div>
</div>
@endsection