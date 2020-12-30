@extends('layouts.app')
@section('content')

  <div>
    @if(count($discussions)>0)
      <h3>All Discussions</h3>
    @else
      <h3>No Discussions Available</h3>
    @endif
  </div>
  <hr>
  <div>
    @foreach ($discussions as $discussion)
      <h4>ID: {{$discussion->id}}</h4>
      <div>
        <h5>Title: {{$discussion->title}}</h5>
        <div>
          <img height="250px" width="300px" src="img/discussions/{{$discussion->image}}">
        </div><br>
        <p>Description: {{$discussion->description}}</p>
        <button><a href="/discussions/edit/{{$discussion->id}}">Edit</a></button>
        <form action="/discussions/{{$discussion->id}}" method="POST">
          @csrf
          @method('DELETE')
          <button onclick="return confirm('Are you sure?')" type="submit" value="submit">Delete</button>
        </form>
      </div><br>
      <hr>
    @endforeach
  </div>

</div>
</div>
</div>
@endsection