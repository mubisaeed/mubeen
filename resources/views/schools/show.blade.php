@extends('layouts.app')
@section('content')

<div class="content_main">
  <div class="all_courses_main">
    
    <div class="course_table mt-0">
      <div class="course card-header card-header-warning card-header-icon">
        
        <h3>School Details</h3>
          <div class="table_filters">
            <div class="table_search">
              <input type="text" name="search" id="search" value="" placeholder="Search...">
              <a href="#"> <i class="fa fa-search"></i> </a>
            </div>
            <div class="table_select">
              <select class="selectpicker">
                <option>All Students</option>
                <option>Today </option>
                <option>Macro Economics I</option>
                <option>Macro Economics II</option>
              </select>
            </div>
          </div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">School name</th>
                <th scope="col">School Image</th>
                <th scope="col">School Address</th>
                <th scope="col">District</th>
                <th scope="col">Phone</th>
                <th scope="col">School Identification number</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody id="mybody">
              <tr>
                <td class="first_row">
                  <div class="course_td">
                    <p>{{$schooldetail->school_name}}</p>
                  </div>
                </td>
                <td class="first_row"><img src="{{asset('/img/upload/'.$schooldetail->school_image)}}" width ="100" ></td>
                <td class="first_row">{{$schooldetail->school_address}}</td>
                <td class="first_row">{{$schooldetail->district}}</td>
                <td class="first_row">{{$schooldetail->phone}}</td>
                <td class="first_row">{{$schooldetail->school_identification_number}}</td>
                
                <td class="align_ellipse first_row">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="material-icons">
                        more_horiz
                      </span>
                      <div class="ripple-container"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                      <a class="dropdown-item" href="{{url('/schools')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    </td>
                    </div>
                  </li>
                </td>
              </tr>
            </tbody>
          </table>   
          <div class="table_footer">
            <div class="table_pegination">
              <nav>
                <ul class="pager">
                  <li class="pager__item pager__item--prev"><a class="pager__link" href="#">
                  <i class="fa fa-angle-left"></i></a></li>
                  <li class="pager__item"><a class="pager__link active" href="#">1</a></li>
                  <li class="pager__item"><a class="align_hash" href="#">/</a></li>
                  <li class="pager__item"><a class="pager__link no_border" href="#">16</a></li>
                  <li class="pager__item pager__item--prev"><a class="pager__link" href="#">
                  <i class="fa fa-angle-right"></i></a></li>
                </ul>
              </nav>
            </div>
            <div class="table_rows">
              <div class="rows_main">
                <p>Rows per page</p>
                <select>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                </select>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
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