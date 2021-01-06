<link href="{{asset('css/bootstrap-colorpicker.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
@extends('layouts.app')
@section('content')
            <div id="message">
            @if (Session::has('message'))
              <div class="alert alert-info">
                {{ Session::get('message') }}
              </div>
            @endif
          </div>

             <form class="form-horizontal" method="POST" action="{{ url('/course/update/'. $course->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="card2 card border-0 px-4 py-5">
                            <div class="login_text">
                                <h3>Update Course</h3>
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Course name</h6>
                                </label> 
                                <input type="text" name="cname" value="{{$course->course_name }}" class="mb-4" placeholder="Enter class name" required=""  minlength="3" maxlength ="50">
                                @error('cname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Derpartment</h6>
                                </label> 
                                <input type="text" name="department" value="{{$course->department }}"  class="mb-4" placeholder="Enter department" required=""  minlength="3" maxlength ="200">
                                @error('department')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Room Number</h6>
                                </label> 
                                <input type="text" name="rno" value="{{$course->room_number }}" class="mb-4" placeholder="Enter room number" required="">
                                @error('rno')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Start Date</h6>
                                </label> 


                                <input type="date" name="sdate" value="{{$course->start_date}}"  class="mb-4" placeholder="Enter start date" required="">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">End Date</h6>
                                </label> 
                                <input type="date" name="edate"  value="{{$course->end_date}}"   class="mb-4" placeholder="Enter start date" required="">
                                
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black; margin-right: 10px">Sessions</h6>
                                </label> 
                                <select required="required" class="form-control" name="sessions">
                                    <option  {{ ( $course->sessions) == '1' ? 'selected' : '' }}  value="1" >1</option>
                                    <option {{ ( $course->sessions) == '2' ? 'selected' : '' }}  value="2">2</option>
                                    <option {{ ( $course->sessions) == '3' ? 'selected' : '' }}  value="3">3</option>
                                    <option {{ ( $course->sessions) == '4' ? 'selected' : '' }}  value="4">4</option>
                                    <option {{ ( $course->sessions) == '5' ? 'selected' : '' }}  value="5">5</option>
                                    <option {{ ( $course->sessions) == '6' ? 'selected' : '' }}  value="6">6</option>
                                    <option {{ ( $course->sessions) == '7' ? 'selected' : '' }}  value="7">7</option>
                                    <option {{ ( $course->sessions) == '8' ? 'selected' : '' }}  value="8">8</option>
                                    <option {{ ( $course->sessions) == '9' ? 'selected' : '' }}  value="9">9</option>
                                </select>
                            </div>
                            <br><br>
                            <div class="row px-3 demo "> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Course Color</h6>
                                </label> 
                                <div style="background-color:  {{$course->course_color}}; padding: 10px; border: 1px solid green;">
                                        		
                                        	</div>
                                <input type="text" id="demo-input" name="ccolor" value="{{$course->course_color}}" class="mb-4" placeholder="Enter class color" required="">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Course Description</h6>
                                </label> 
                                <textarea name="cdescription" cols="16" id="txtEditor" style="height: 35px;width: 100%;">
							                   {{$course->course_description}}
                                </textarea>
                                
                            </div>
                            <br><br>
                            <div class="card-footer pull-right">

                        <a class="btn btn-default" href="{{url('/course')}}">Cancel</a>

                    <button type="submit" class="btn btn-fill btn-primary">Update</button>
                </div>
                    </form>




                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
                </script>
                <script>
                    $('.colorpicker').colorpicker();
                </script>
                <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                <script>
                CKEDITOR.replace( 'txtEditor' );
                </script>

    <!-- <script src="//code.jquery.com/jquery-3.4.1.js"></script> -->
                <script src="{{asset('js/bootstrap-colorpicker.min.js')}}"></script>
                <script src="//unpkg.com/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
                <script src="{{asset('dist/js/bootstrap-colorpicker.js')}}"></script>
                <script>
                    $(function () {
                      // Basic instantiation:
                      $('#demo-input').colorpicker();
                      
                      // Example using an event, to change the color of the #demo div background:
                      $('#demo-input').on('colorpickerChange', function(event) {
                        $('#demo').css('background-color', event.color.toString());
                      });
                    });
                </script>
                  <script type="text/javascript">
                    setTimeout(function() {
                      $('#message').fadeOut('fast');
                  }, 30000);
                  </script>
@endsection
             