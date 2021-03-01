@extends('layouts.app')

@section('content')


<div class="breadcrumb_main">

  <ol class="breadcrumb">

    <li><a href = "{{url('/dashboard')}}">Home</a></li>

    <li><a href = "{{url('/classes')}}">Terms/Sessions</a></a></li>

    <li>Courses</li>

    <li>Course weekly details</li>

    <li class = "active">Solved quiz</li>

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

  <div class="all_courses_main">

    

    <div class="course_table mt-0">

      <div class="course card-header card-header-warning card-header-icon">
        <h3>Quiz View 


              @foreach($student_quiz_details as $key => $q)

                <?php 
                // dd($q);
                  if($q->type == "question/answer")
                    {
                      $opts = $q->options;
                    }
                  else
                    {
                      $opts = unserialize($q->options);
                    }
                    if($q->type == "mcq")
                    {
                      $qcorrect = unserialize($q->correct);
                    }
                ?>

                <div id="firstdiv">
                  <div>
                    <h4>{{$q->label}}</h4>
                  </div>
                  @if($q->type == 'mcq')

                  <?php
                  ?>
                  <input type="hidden" name="mcqlabel" value="{{$q->label}}">
                  <input type="hidden" name="question_id[]" value="{{$q->id}}">
                    <div class="row">
                      <div class="col-md-3">
                        <label>{{$opts['opt1']}}</label>
                        <input type="checkbox" value="{{$opts['opt1']}}" name="correct{{$q->id}}[]" class="btn" {{ (isset($q->correct) && in_array($opts['opt1'], $qcorrect)) ? 'checked' : '' }}/>
                      </div>
                      <div class="col-md-3">
                        <label>{{$opts['opt2']}}</label>
                        <input type="checkbox" value="{{$opts['opt2']}}" name="correct{{$q->id}}[]" class="btn" {{ (isset($q->correct) && in_array($opts['opt2'], $qcorrect)) ? 'checked' : '' }}/>
                      </div>
                      <div class="col-md-3">
                        <label>{{$opts['opt3']}}</label>
                        <input type="checkbox" value="{{$opts['opt3']}}" name="correct{{$q->id}}[]" class="btn" {{ (isset($q->correct) && in_array($opts['opt3'], $qcorrect)) ? 'checked' : '' }}/>
                      </div>
                      <div class="col-md-3">
                        <label>{{$opts['opt4']}}</label>
                        <input type="checkbox" value="{{$opts['opt4']}}" name="correct{{$q->id}}[]" class="btn" {{ (isset($q->correct) && in_array($opts['opt4'], $qcorrect)) ? 'checked' : '' }}/>
                      </div>
                    </div>
                  @elseif($q->type == 't/f')
                  <input type="hidden" name="tfabel" value="{{$q->label}}">
                  <input type="hidden" name="question_id[]" value="{{$q->id}}">
                    <div>
                      <div class="row">
                        <div class="col-md-6 p_left">
                          <label>{{$opts['true']}}</label>

                          <input type="radio" value="true" name="correcttf{{$q->id}}" class="btn" required="required" {{ (isset($q->correct) && $q->correct == 'true') ? 'checked' : '' }} />

                          <label>{{$opts['false']}}</label>

                          <input type="radio" value="false" name="correcttf{{$q->id}}" class="btn" required="required" {{ (isset($q->correct) && $q->correct == 'false') ? 'checked' : '' }} />
                                             
                        </div>
                      </div>
                    </div>
                    @elseif($q->type == 'question/answer')
                    <input type="hidden" name="qalabel" value="{{$q->label}}">
                    <input type="hidden" name="question_id[]" value="{{$q->id}}">
                    <div>
                      <div class="row">
                        <div class="col-md-6 p_left">

                          <textarea class="form-control" readonly="" name="ans" value="{!! $q->correct !!}" autofocus="" required="" style="height: 100px !important;">{!! $q->correct !!}</textarea>
                                    
                                    
                        </div>
                      </div>
                    </div>
                  @endif
                  
                </div> 
              @endforeach


          <a  href="{{url('/quiz/attempted_by/'. $qid .'/'. $insid .'/'. $cid .'/'. $week .'/'. $clasid)}}"><button type="button" class="btn btn-info">Go Back</button></a>

      </div>

    </div>

  </div>

</div>

<script type="text/javascript">
  
$(':radio,:checkbox').click(function(){
    return false;
});

</script>

@endsection