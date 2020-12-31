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
    <button><a href="/safetytips/create">Add Safety Tip</a></button>
  </div>
  <br><br>
  <div>
    @if(count($safetytips)>0)
      <h3>All Safety Tips</h3>
    @else
      <h3>No Safety Tips Available</h3>
    @endif
  </div>
  <hr>
  <div>
    @foreach ($safetytips as $safetytip)
      <h4>ID: {{$safetytip->id}}</h4>
      <div>
        <h5>Title: {{$safetytip->title}}</h5>
        <div>
          <img height="250px" width="300px" src="img/safetytips/{{$safetytip->image}}">
        </div><br>
        <p>Description: {{$safetytip->description}}</p>
        <button><a href="/safetytips/edit/{{$safetytip->id}}">Edit</a></button>
        <form action="/safetytips/{{$safetytip->id}}" method="POST">
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