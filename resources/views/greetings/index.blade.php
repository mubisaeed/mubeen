@extends('layouts.app')

@section('content')



<div class="breadcrumb_main">

  <ol class="breadcrumb">

    <li><a href = "{{url('/dashboard')}}">Home</a></li>

    <li class = "active">All greetings</li>

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

     

@if(count($greetings)>0)        

        <h3>All greetings</h3>



         <div class="table_filters">

            <div class="table_search">

              <input type="text" name="search" id="search" value="" placeholder="Search...">

              <a href="#"> <i class="fa fa-search"></i> </a>

            </div>
<!-- 
            <div class="table_select">

              <select class="selectpicker">

                <option>All Schools</option>

                <option>Today </option>

                <option>Macro Economics I</option>

                <option>Macro Economics II</option>

              </select>

            </div> -->

          </div>

          <table class="table table-hover" id="table-id">

            <thead>

              <tr>

                <!-- <th scope="col">ID</th> -->

                <th scope="col">Title</th>

                <th scope="col">Image</th>

                <th scope="col">Description</th>

                <th scope="col">Action</th>

            
              </tr>

            </thead>

            <tbody id="mybody">

            

            @foreach ($greetings as $greeting)
           
            <tr>

<td class="first_row">{{$greeting->title}}</td>

<td class="first_row">  

{{-- src="{{asset('assets/img/upload/'.$sp_edu->signature)}}" --}}

<img src="{{asset('assets/img/upload/'.$greeting->image)}}" width="50" alt="" class="img-fluid">

  {{-- <p>{{$greeting->ImageName}}</p> --}}
  
</td>

<td class="first_row">{{$greeting->description}}</td>

<td class="align_ellipse first_row">

  <li class="nav-item dropdown">

    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

      <span class="material-icons">

        more_horiz

      </span>

      <div class="ripple-container"></div>

    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

      <a class="dropdown-item"href="{{url('/greetings/edit/' . $greeting->id)}}"><i class="fa fa-cogs"></i>Edit</a>

      <a href="javascript:void(0);" data-id="<?php echo $greeting->id; ?>" class="dropdown-item delete"><i class="fa fa-trash"></i>Delete</a>

    </div>

  </li>

</td>

</tr>

@endforeach

</tbody>

</table>  

<div class="table_footer">
            <div class="table_pegination">
              <nav>
                <ul class="pager pagination">
                  <li data-page="prev" class="pager__item pager__item--prev"><span class="pager__link fa fa-angle-left">
                  <span class="sr-only">(current)</span></span></li>
                  <li data-page="next" id="prev" class="pager__item pager__item--prev"><span class="pager__link fa fa-angle-right">
                  <span class="sr-only">(current)</span></span></li>
                </ul>
              </nav>
            </div>
            <div class="table_rows">
              <div class="rows_main">
                <p>Rows per page</p>
                <select name="state" id="maxRows">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                </select>
              </div>
            </div>
          </div>

         @else

          <p>There is no Greetings</p>

        @endif

      </div>

    </div>

  </div>

</div>
 <script src="{{url('backend/sweetalerts/sweetalert2.all.js')}}"></script>
  
  <script type="text/javascript">

    setTimeout(function() {

      $('#message').fadeOut('fast');

    }, 30000);

  </script>

  

<script type="text/javascript">

  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>

<script type="text/javascript">

  $( "body" ).on( "click", ".delete", function () {

    var task_id = $( this ).attr( "data-id" );

    var form_data = {

        id: task_id

    };

    swal({

        title: "Do you want to delete",

        //text: "@lang('category.delete_category_msg')",

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

                url: '<?php echo url("/greetings/destroy"); ?>',

                data: form_data,

                success: function ( msg ) {

                    swal( "@lang('Greeting Delete Successfully')", '', 'success' )

                    setTimeout( function () {

                        location.reload();

                    }, 900 );

                }

            } );

        }

    } );

  } );

</script>


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

@endsection