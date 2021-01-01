      <link href="{{asset('css/bootstrap-colorpicker.min.css')}}" rel="stylesheet" />
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <link href="{{asset('css/bootstrap-colorpicker.css')}}" rel="stylesheet">                    <form method="POST" action="/createcourse">
                    @csrf
                        <div class="card2 card border-0 px-4 py-5">
                          @foreach ($errors->all() as $error)

                          <div class="alert alert-danger">{{ $error }}</div>

                        @endforeach
                            <div class="login_text">
                                <h3>create course</h3>
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Class name</h6>
                                </label> 
                                <input type="text" value="{{ old('clname')}}" name="clname" class="mb-4" placeholder="Enter class name" required=""  minlength="3" maxlength ="50">
                                @error('clname')
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
                                <input type="text" value="{{ old('department')}}" name="department" class="mb-4" placeholder="Enter department" required="" minlength="3" maxlength ="200">
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
                                <input type="text" value="{{ old('rno')}}" name="rno" class="mb-4" placeholder="Enter room number" required=""minlength="3" maxlength ="50">
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
                                <input type="date" name="sdate" value="{{old('sdate')}}" onchange="invoicedue(event);" class="mb-4" placeholder="Enter start date" required="">
                                
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0"  style="color:black; margin-right: 10px" >End Date</h6>
                                </label> 
                                <input type="date" value="{{ old('edate')}}" name="edate" onchange="invoicedue(event);" class="mb-4" placeholder="Enter end date" required="">
                            </div>
                            <br><br>
                            <div class="row px-3 demo "> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Class Color</h6>
                                </label> 
                                <input type="text" id="demo-input" name="ccolor" value="rgb(255, 128, 0)" class="mb-4" placeholder="Enter class color" required="">
                            </div>
                            <br><br>
                            <div class="row px-3"> 
                                <label class="mb-1" >
                                    <h6 class="mb-0 text-sm"  style="color:black; margin-right: 10px">Course Description</h6>
                                </label> 
                                <textarea name="cdescription" cols="8" id="txtEditor" value="{!!old('cdescription')!!}" style="height: 35px;width: 100%;">
                            </textarea>
                                
                            </div>
                            <br><br>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline">   </div>
                            </div>
                            <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Create</button> </div>
                        </div>
                    </form>
                </div>
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

    <script src="//code.jquery.com/jquery-3.4.1.js"></script>
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
       