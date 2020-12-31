@extends('layouts.app')
@section('content')

  <div id="message">
  @if (Session::has('message'))
    <div class="alert alert-info">
      {{ Session::get('message') }}
    </div>
  @endif
  </div>
  <div>
    @if(count($instructors)>0)
      <h3>All Instructors</h3>
    @else
      <h3>No Instructors Available</h3>
    @endif
  </div>
  <hr>
  <div>
    @foreach ($instructors as $instructor)
      <h4>ID: {{$instructor->id}}</h4>
      <div>
        <h5>Name: {{$instructor->name}}</h5>
        <div>
          <img height="250px" width="300px" src="img/instructors/{{$instructor->image}}">
        </div><br>
        <p>Bio: {{$instructor->bio}}</p>
        <span>Email: {{$instructor->email}}<span><br><br>
        <button><a href="/instructors/edit/{{$instructor->id}}">Edit</a></button>
        <form action="/instructors/{{$instructor->id}}" method="POST">
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
  <script type="text/javascript">
    setTimeout(function() {
      $('#message').fadeOut('fast');
  }, 2000);
  </script>

@endsection