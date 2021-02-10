@extends('layouts.app')

@section('content')


<div class="breadcrumb_main">

  <ol class="breadcrumb">

    <li><a href = "{{url('/dashboard')}}">Home</a></li>

    <li class = "active">Quiz View</li>

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
          <form method="POST" action="{{url('/quiz/solved_quiz_by_student')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="quiz_id" value="{{$id}}">

            @foreach($questions as $q)
              <?php 
                $qstn = DB::table('questions')->where('id', $q->question_id)->get()->first();
                if($qstn->type == "question/answer")
                  {
                    $opts = $qstn->options;
                  }
                else
                  {
                    $opts = unserialize($qstn->options);
                  }
              ?>
              <div>
                <div>
                  <h4>{{$qstn->label}}</h4>
                </div>
                @if($qstn->type == 'mcq')
                <input type="hidden" name="mcqlabel" value="{{$qstn->label}}">
                <input type="hidden" name="question_id[]" value="{{$qstn->id}}">
                  <div class="row">
                    <div class="col-md-3">
                      <label>{{$opts['opt1']}}</label>
                      <input type="checkbox" value="{{$opts['opt1']}}" name="correct{{$qstn->id}}[]" class="btn"/>
                    </div>
                    <div class="col-md-3">
                      <label>{{$opts['opt2']}}</label>
                      <input type="checkbox" value="{{$opts['opt2']}}" name="correct{{$qstn->id}}[]" class="btn"/>
                    </div>
                    <div class="col-md-3">
                      <label>{{$opts['opt3']}}</label>
                      <input type="checkbox" value="{{$opts['opt3']}}" name="correct{{$qstn->id}}[]" class="btn"/>
                    </div>
                    <div class="col-md-3">
                      <label>{{$opts['opt4']}}</label>
                      <input type="checkbox" value="{{$opts['opt4']}}" name="correct{{$qstn->id}}[]" class="btn"/>
                    </div>
                  </div>
                @elseif($qstn->type == 't/f')
                <input type="hidden" name="tfabel" value="{{$qstn->label}}">
                <input type="hidden" name="question_id[]" value="{{$qstn->id}}">
                  <div>
                    <div class="row">
                      <div class="col-md-6 p_left">
                        <label>{{$opts['true']}}</label>

                        <input type="radio" value="true" name="correcttf{{$qstn->id}}" class="btn"/>

                        <label>{{$opts['false']}}</label>

                        <input type="radio" value="false" name="correcttf{{$qstn->id}}" class="btn"/>
                                           
                      </div>
                    </div>
                  </div>
                  @elseif($qstn->type == 'question/answer')
                  <input type="hidden" name="qalabel" value="{{$qstn->label}}">
                  <input type="hidden" name="question_id[]" value="{{$qstn->id}}">
                  <div>
                    <div class="row">
                      <div class="col-md-6 p_left">

                        <textarea class="form-control" name="ans" value="{!!old('ans')!!}" autofocus="" required="" style="height: 100px !important;"> </textarea>
                                  
                                  
                      </div>
                    </div>
                  </div>
                @endif
              </div> 
             
            @endforeach
                <button type="submit" class="btn btn-success">Submit Quiz</button>

          </form>
      </div>

    </div>

  </div>

</div>

  <script>
    getPagination('#table-id');
  
    function getPagination(table) {
      var lastPage = 1;

      $('#maxRows')
        .on('change', function(evt) {
          //$('.paginationprev').html('');            // reset pagination

        lastPage = 1;
          $('.pagination')
            .find('li')
            .slice(1, -1)
            .remove();
          var trnum = 0; // reset tr counter
          var maxRows = parseInt($(this).val()); // get Max Rows from select option

          if (maxRows == 5000) {
            $('.pagination').hide();
          } else {
            $('.pagination').show();
          }

          var totalRows = $(table + ' tbody tr').length; // numbers of rows
          $(table + ' tr:gt(0)').each(function() {
            // each TR in  table and not the header
            trnum++; // Start Counter
            if (trnum > maxRows) {
              // if tr number gt maxRows

              $(this).hide(); // fade it out
            }
            if (trnum <= maxRows) {
              $(this).show();
            } // else fade in Important in case if it ..
          }); //  was fade out to fade it in
          if (totalRows > maxRows) {
            // if tr total rows gt max rows option
            var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
            //  numbers of pages
            for (var i = 1; i <= pagenum; ) {
              // for each page append pagination li
              $('.pagination #prev')
                .before(
                  '<li data-page="' +
                    i +
                    '" class="pager__item">\
                      <span class="pager__link">' +
                    i++ +
                    '<span class="sr-only">(current)</span></span>\
                    </li>'
                )
                .show();
            } // end for i
          } // end if row count > max rows
          $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
          $('.pagination li').on('click', function(evt) {
            // on click each page
            evt.stopImmediatePropagation();
            evt.preventDefault();
            var pageNum = $(this).attr('data-page'); // get it's number

            var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

            if (pageNum == 'prev') {
              if (lastPage == 1) {
                return;
              }
              pageNum = --lastPage;
            }
            if (pageNum == 'next') {
              if (lastPage == $('.pagination li').length - 2) {
                return;
              }
              pageNum = ++lastPage;
            }

            lastPage = pageNum;
            var trIndex = 0; // reset tr counter
            $('.pagination li').removeClass('active'); // remove active class from all li
            $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
            // $(this).addClass('active');          // add active class to the clicked
          limitPagging();
            $(table + ' tr:gt(0)').each(function() {
              // each tr in table not the header
              trIndex++; // tr index counter
              // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
              if (
                trIndex > maxRows * pageNum ||
                trIndex <= maxRows * pageNum - maxRows
              ) {
                $(this).hide();
              } else {
                $(this).show();
              } //else fade in
            }); // end of for each tr in table
          }); // end of on click pagination list
        limitPagging();
        })
        .val(5)
        .change();

      // end of on select change

      // END OF PAGINATION
    }

    function limitPagging(){
      // alert($('.pagination li').length)

      if($('.pagination li').length > 7 ){
          if( $('.pagination li.active').attr('data-page') <= 3 ){
          $('.pagination li:gt(5)').hide();
          $('.pagination li:lt(5)').show();
          $('.pagination [data-page="next"]').show();
        }if ($('.pagination li.active').attr('data-page') > 3){
          $('.pagination li:gt(0)').hide();
          $('.pagination [data-page="next"]').show();
          for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
            $('.pagination [data-page="'+i+'"]').show();

          }

        }
      }
      if($('.pagination li').length == 2){
        document.getElementsByClassName('pagination').hide();
      }
    }
    
  </script>

<script>

    $(document).ready(function(){

      $("#search").on("keyup", function() {

        var value = $(this).val().toLowerCase();

        // alert(value);

        $("#mybody tr").filter(function() {

          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

        });

      });

    });

  </script>

  <script type="text/javascript">

    setTimeout(function() {

      $('#message').fadeOut('fast');

  }, 2000);

  </script>

  <script type="text/javascript">

    $("body").on( "click", ".delete", function () {

    var task_id = $( this ).attr( "data-id" );

    console.log(task_id);

    var form_data = {

    id: task_id

    };

    swal({

    title: "Do you want to delete this Quiz?",

    type: 'info',

    showCancelButton: true,

    confirmButtonColor: '#F79426',

    cancelButtonColor: '#d33',

    confirmButtonText: 'Yes',

    showLoaderOnConfirm: true

    }).then( ( result ) => {

    if ( result.value == true ) {

    $.ajax( {

    type: 'POST',
    headers: {

                    'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )

                },

    url: '<?php echo url("/quiz/delete"); ?>',

    data: form_data,

    success: function ( msg ) {

    swal( "@lang('Quiz Deleted')", '', 'success' )

    setTimeout( function () {

    location.reload();

    }, 1000 );

    }

    } );

    }

    } );

    } );

  </script>


@endsection