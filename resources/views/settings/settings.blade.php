@extends('layouts.app')
@section('content')

<div>
    <form action="{{url('update/')}}" method="POST" enctype="multipart/form-data">
      {{@csrf_field()}} 
      <h2>Settings</h2>
    
      <label for="fb">Facebook Link:</label>
      <input type="url" name="fb" value="{{$setting->facebook_url}}" placeholder="Facebook Link"><br><br>

      <label for="twitter">Twitter Link:</label>
      <input type="url" name="twitter" value="{{$setting->twitter_url}}" placeholder="Twitter Link"><br><br>

      <label for="youtube">Youtube Link:</label>
      <input type="url" name="youtube" value="{{$setting->youtube_url}}" placeholder="Youtube Link"><br><br>

      <label for="contact">Contact Us:</label>
      <input type="email" name="contact" value="{{$setting->contact_email}}" placeholder="Contact Us"><br><br>

      <label for="Noti">Notification Email:</label>
      <input type="email" name="Noti" value="{{$setting->notification_email}}" placeholder="Notification"><br><br>

      <label for="phone">Phone Number:</label>
      <input type="number" name="phone" value="{{$setting->phone_number}}" placeholder="Phone Number" class="mb-4" required="" data-inputmask="'mask': '0399-99999999'" maxlength="12"><br><br>

      <button type="submit">update</button>

    </form>
  </div>

</div>
</div>
</div>


@endsection