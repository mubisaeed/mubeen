@extends('layouts.app')

@section('content')


<div class="breadcrumb_main">

  <ol class="breadcrumb">

    <li><a href = "{{url('/dashboard')}}">Home</a></li>

    <li class = "active">Your Grades</li>

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
        <h3>Quiz View</h3>   
          <p>Obtained Marks: {{$total_marks}}</p>
          <p>Total Percentage: {{$percentage}} %</p>
          @if($AA != null || $A != null || $BB != null || $B != null || $CC != null || $C != null || $DD != null || $D != null || $F!= null)
            @if($percentage >= $AA->marks_from && $percentage <= $AA->marks_to)
              <p> Your final grade for the quiz is: {{$AA->grade}}</p>
              <br />
            @elseif($percentage >= $A->marks_from && $percentage <= $A->marks_to)
              <p> Your final grade for the quiz is: {{$A->grade}}</p>
              <br />
            @elseif($percentage >= $BB->marks_from && $percentage <= $BB->marks_to)
              <p> Your final grade for the quiz is: {{$BB->grade}}</p>
              <br />
            @elseif($percentage >= $B->marks_from && $percentage <= $B->marks_to)
              <p> Your final grade for the quiz is: {{$B->grade}}</p>
              <br />
            @elseif($percentage >= $CC->marks_from && $percentage <= $CC->marks_to)
              <p> Your final grade for the quiz is: {{$CC->grade}}</p>
              <br />
            @elseif($percentage >= $C->marks_from && $percentage <= $C->marks_to)
              <p> Your final grade for the quiz is: {{$C->grade}}</p>
              <br />
            @elseif($percentage >= $DD->marks_from && $percentage <= $DD->marks_to)
              <p> Your final grade for the quiz is: {{$DD->grade}}</p>
              <br />
            @elseif($percentage >= $D->marks_from && $percentage <= $D->marks_to)
              <p> Your final grade for the quiz is: {{$D->grade}}</p>
              <br />
            @elseif($percentage >= $F->marks_from && $percentage <= $F->marks_to)
              <p> Your final grade for the quiz is: {{$F->grade}}</p>
              <br />
            @else
              <p>Your final grade for the quiz is: G</p>
              <br />
            @endif
          @else
            <p>You cannt see your grade now.</p>
            <br />
          @endif
      </div>

    </div>

  </div>

</div>


@endsection