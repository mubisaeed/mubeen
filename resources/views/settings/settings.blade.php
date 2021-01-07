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
    <form action="{{url('update/')}}" method="POST" enctype="multipart/form-data">
      {{@csrf_field()}} 
      <h2>Settings</h2>
      <label for="fb">Facebook Link:</label>      
      <input class="form-control" type="url" name="fb" value={{old('fb', $setting->facebook_url)}} required><br><br>
      @error('fb')
        <div>
          {{ $message }}
        </div>
      @enderror
      
      <label for="twitter">Twitter Link:</label>
      <input class="form-control" type="url" name="twitter" value={{old('twitter', $setting->twitter_url)}} required><br><br>
      @error('twitter')
        <div>
          {{ $message }}
        </div>
      @enderror
      <label for="youtube">Youtube Link:</label>
      <input class="form-control" type="url" name="youtube" value={{old('youtube', $setting->youtube_url)}} required><br><br>
      @error('youtube')
        <div>
          {{ $message }}
        </div>
      @enderror
      <label for="contact">Contact Us:</label>
      <input class="form-control" type="email" name="contact" value={{old('contact', $setting->contact_email)}} required><br><br>
      @error('contact')
        <div>
          {{ $message }}
        </div>
      @enderror
      <label for="Noti">Notification Email:</label>
      <input class="form-control" type="email" name="Noti" value={{old('Noti', $setting->notification_email)}} required><br><br>
      @error('Noti')
        <div>
          {{ $message }}
        </div>
      @enderror
      <label for="phone">Phone Number:</label>
      <input class="form-control" type="tel" name="phone" value={{old('phone', $setting->phone_number)}}  class="mb-4" placeholder="03xx-xxxxxxx" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" required minlength="12" maxlength = "12"><br><br>
      @error('phone')
        <div>
          {{ $message }}
        </div>
      @enderror
      
      <button type="submit" class="btn btn-success">Update</button>
      <a class="btn btn-default" href="{{url('/setting')}}">Cancel</a>

    </form>
  </div>

<script type="text/javascript">
  setTimeout(function() {
    $('#message').fadeOut('fast');
  }, 2000);
</script>

@endsection