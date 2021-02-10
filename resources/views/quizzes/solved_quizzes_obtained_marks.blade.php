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
          @if ($percentage > 90.9)
            <p> Your final grade for the quiz will be: A+ </p>
            <br />

          @elseif ($percentage > 85.9)
            <p> Your final grade for the quiz will be: A </p>
            <br />
      
          @elseif ($percentage > 76.9)
            <p> Your final grade for the quiz will be: B+ </p>
            <br />
      
            
          @elseif ($percentage >71.9)
            <p> Your final grade for the quiz will be: B </p>
            <br />
          
          @elseif ($percentage > 65.9)
            <p> Your final grade for the quiz will be: C+ </p>
            <br />


          @elseif ($percentage > 59.9)
            <p> Your final grade for the quiz will be: C </p>
            <br />
           
         
          @elseif ($percentage > 49.9)
            <p> Your final grade for the quiz will be: P </p>
            <br />

          @else
            <p> Your final grade for the quiz will be: F </p>
            <br />
            
          @endif

      </div>

    </div>

  </div>

</div>


@endsection