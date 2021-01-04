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
      <input type="url" name="fb" value={{old('title', $setting->facebook_url)}} required><br><br>

      <label for="twitter">Twitter Link:</label>
      <input type="url" name="twitter" value={{old('title', $setting->twitter_url)}} required><br><br>

      <label for="youtube">Youtube Link:</label>
      <input type="url" name="youtube" value={{old('title', $setting->youtube_url)}} required><br><br>

      <label for="contact">Contact Us:</label>
      <input type="email" name="contact" value={{old('title', $setting->contact_email)}} required><br><br>

      <label for="Noti">Notification Email:</label>
      <input type="email" name="Noti" value={{old('title', $setting->notification_email)}} required><br><br>

      <label for="phone">Phone Number:</label>
      <input type="number" name="phone" value={{old('title', $setting->phone_number)}}  class="mb-4" data-inputmask="'mask':'0399-99999999'" maxlength="12" minlength="12" required><br><br>

      <a class="btn btn-default" href="{{url('/setting')}}">Cancel</a>
      <button type="submit">Update</button>

    </form>
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