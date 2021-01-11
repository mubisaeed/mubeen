@extends('layouts.app')
@section('content')

<div>
  <div id="message">
  @if (Session::has('message'))
    <div class="alert alert-info">
      {{ Session::get('message') }}
    </div>
  @endif
</div>
  <form action="{{url('/linkupdate')}}" method="post" enctype="multipart/form-data">
    
    {{@csrf_field()}}

    {{-- <div class="title"> --}}

      <i class="fas fa-pencil-alt"></i> 

    <h2>Course Resources</h2>
<input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="main" value="{{$main}}">
    </div>

    <div class="info">

    <label for="title">Titile:</label><br>
    <input type="text" name="title" value="{{old('title', $courselinks->title)}}" minlength="3" maxlength ="50" autofocus=""><br><br>

      @error('title')
      <div>
        {{$message}}
      </div>
      @enderror

      <label for="short_des">Short Description:</label><br>
    <input type="text" name="short_des" value="{{old('short_des', $courselinks->short_description)}}" minlength="10" maxlength ="1000"><br><br>

      @error('short_des')
      <div>
        {{$message}}
      </div>
      @enderror

    
      <label for="link">Link:</label><br>
      <input class="form-control" type="url" name="link" value={{old('link', $courselinks->link)}} minlength="10" maxlength ="100"><br><br>
      
      @error('link')
        <div>
          {{ $message }}
        </div>
      @enderror

    <button type="submit">Submit</button>
  </form>
</div>

 @endsection