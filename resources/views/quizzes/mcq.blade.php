@extends('layouts.app')
@section('content')
<div class="breadcrumb_main">
  <ol class="breadcrumb">
    <li><a href = "{{url('/dashboard')}}">Home</a></li>
    <li><a href = "#">Quizzes/Tests</a></li>
    <li class = "active">Add Quizzes/Tests</li>
  </ol>
</div> 
<div id="message">
	@if (Session::has('message'))
	    <div class="alert alert-info">
	    {{ Session::get('message') }}
	    </div>
	@endif  
</div>
<div class="content_main">
  <div class="card-header assesment_main">
    <h3>Add Quizzes/Tests</h3>
    <div class="main_quiz">
      <div class="quiz_tabs">
        <ul class="nav nav-tabs ">
          <li class="quiz_tab_link active">
            <a href="{{url('/mcq/create')}}">
            Multiple Choice </a>
          </li>
          <li class="quiz_tab_link second">
            <a href="{{url('/tf/create')}}">
            True/False </a>
          </li>
          
        </ul>
        <div class="tab-content">
          	<div class="tab-pane active" id="tab_default_1">
          		<form method="POST" action="{{url('/mcq/store')}}">
          			@csrf
		            <div class="quiz_head">
		              <h5>Question -1</h5>
		              <div class="quiz_form">
		                <div class="custom_input_main remove_ex_margin">
		                  <textarea class="form-control" name="label" value="{!!old('label')!!}" required="" style="height: 100px !important;"> </textarea>
		                  <label>Topic <span class="red">*</span></label>
		                </div>
		              </div>
		              <div class="qa_quiz">
		                <div class="row">
		                  <div class="col-md-10 p_left">
		                    <div class="quiz_op">
		                      <h4>Options</h4>
		                    </div>
		                    <div class="col-md-12">
		                      <div class="custom_input_main mobile_field">
		                        <input type="text" class="form-control" name="opt1" value="{{old('opt1')}}" required="" autofocus="">
		                        <label>Option - 1.
		                          <span class="red">*</span></label>
		                          <div class="cr_btn">
		                    	<label>Correct</label>
		                      <input type="radio" value="opt1" name="correct" class="btn" checked="checked"/>
		                    </div>
		                      </div>
		                    </div>
		                    <div class="col-md-12">
		                      <div class="custom_input_main mobile_field">
		                        <input type="text" class="form-control" name="opt2" value="{{old('opt2')}}" required="" autofocus="">
		                        <label>Option - 2.
		                          <span class="red">*</span></label>
		                          <div class="cr_btn">
		                    	<label>Correct</label>
		                      <input type="radio" value="opt2" name="correct" class="btn"/>
		                    </div>
		                      </div>
		                    </div>
		                    <div class="col-md-12">
		                      <div class="custom_input_main mobile_field">
		                        <input type="text" class="form-control" name="opt3" value="{{old('opt3')}}" required="" autofocus="">
		                        <label>Option - 3.
		                          <span class="red">*</span></label>
		                          <div class="cr_btn">
		                    	<label>Correct</label>
		                      <input type="radio" value="opt3" name="correct" class="btn" />
		                    </div>
		                      </div>
		                    </div>
		                    <div class="col-md-12">
		                      <div class="custom_input_main mobile_field">
		                        <input type="text" class="form-control" name="opt4" value="{{old('opt4')}}" required="" autofocus="">
		                        <label>Option - 4.
		                          <span class="red">*</span></label>
		                          <div class="cr_btn">
		                    	<label>Correct</label>
		                      <input type="radio" value="opt4" name="correct" class="btn"/>
		                    </div>
		                      </div>
		                    </div>
		                  </div>
		                  <div class="col-md-2 p_right">
		                    <div class="quiz_ans">
		                      <h4>Answer</h4>
		                    </div>
		                    <!-- <div class="cr_btn">
		                    	<label>Correct</label>
		                      <input type="radio" value="correct" name="correct" class="btn" checked="checked"/>
		                    </div>
		                    <div class="cr_btn">
		                    	<label>Correct</label>
		                      <input type="radio" value="correct" name="correct" class="btn"/>
		                    </div>
		                    <div class="cr_btn">
		                    	<label>Correct</label>
		                      <input type="radio" value="correct" name="correct" class="btn"/>
		                    </div>
		                    <div class="cr_btn">
		                    	<label>Correct</label>
		                      <input type="radio" value="correct" name="correct" class="btn"/>
		                    </div> -->
		                    <!-- <div class="cr_btn">
		                      <button type="button" class="btn">Correct</button>
		                    </div>
		                    <div class="cr_btn active_cr_btn">
		                      <button type="button" class="btn">Correct</button>
		                    </div>
		                    <div class="cr_btn">
		                      <button type="button" class="btn">Correct</button>
		                    </div>
		                    <div class="cr_btn">
		                      <button type="button" class="btn">Correct</button>
		                    </div> -->
		                  </div>
		                  <div class="save_next_btn text-center w-100">
		                  <button type="submit" class="btn">Save and next</button>
		                </div>
		                </div>
		                
		              </div>
		            </div>
		        </form>
          	</div>          
        </div>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'txtEditor' );
</script>
   <script type="text/javascript">
      setTimeout(function() {
        $('#message').fadeOut('fast');
    }, 2000);
    </script> 
@endsection