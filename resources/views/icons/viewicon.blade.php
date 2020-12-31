<!DOCTYPE html>
<html lang="en">
  <head>


<style>

table, th, td {
    border-bottom: 5px solid #ddd;
}


#customers { font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%; }

#customers td, #customers th { border: 1px solid #ddd;
				padding: 8px; }

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}


</style>



    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{('img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
    Greecon
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
      <!-- CSS Files -->
      <link href="{{('css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet" />
      <!-- CSS Just for demo purpose, don't include it in your project -->
      <link href="{{('demo/demo.css')}}" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.css">
      <script src="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="">
       @include('layouts.sidebar')
      <div class="main-panel">
        <!-- Navbar -->
       @include('layouts.navbar')
        <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">
            
            @include('layouts.top_menu_bar')
           
            <div id="message">
              @if (Session::has('message'))
                <div class="alert alert-info">
                  {{ Session::get('message') }}
                </div>
              @endif
              </div>
              

{{-- <div>
@if(count($icons)>0)
<h3>All Icons</h3>
@else
<h3>No Icons Available</h3>
@endif
</div> --}}
{{-- <th> Icons </th> --}}
@if(count($icons)>0)
<table id="customers">
<tr>

{{-- <th> ID </th> --}}
<th> Title </th>
<th> Image </th>
{{-- <th> created date </th> --}}
<th> Action </th>
</tr>
@foreach ($icons as $icon )
<tr>
{{-- <td>{{$icon->id}}</td> --}}
<td>{{$icon->title}}</td>
<td><img src="{{asset('img/icons/'.$icon->image)}}" height="50" width="50"></td>
{{-- <td>{{$icon->created_at}}</td> --}}
<td><a href="{{url('editicon/'. $icon->id)}}"><button>Edit</button></a>

<a class="delete" href="javascript:void(0);" data-id="<?php echo $icon->id; ?>">Delete</a>

</td>
</tr>

@endforeach

</table>
@else
<h2>There is no icon<h2>
@endif

<script type="text/javascript">
  setTimeout(function() {
    $('#message').fadeOut('fast');
}, 2000);
</script>

              <!--   Core JS Files   -->
              <script src="{{('js/core/jquery.min.js')}}"></script>
              <script src="{{('js/core/popper.min.js')}}"></script>
              <script src="{{('js/core/bootstrap-material-design.min.js')}}"></script>
              <script src="{{('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
              <!-- Plugin for the momentJs  -->
              <script src="{{('js/plugins/moment.min.js')}}"></script>
              <!--  Plugin for Sweet Alert -->
              <script src="{{('js/plugins/sweetalert2.js')}}"></script>
              <!-- Forms Validations Plugin -->
              <script src="{{('js/plugins/jquery.validate.min.js')}}"></script>
              <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
              <script src="{{('js/plugins/jquery.bootstrap-wizard.js')}}"></script>
              <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
              <script src="{{('js/plugins/bootstrap-selectpicker.js')}}"></script>
              <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
              <script src="{{('js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
              <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
              <script src="{{('js/plugins/jquery.dataTables.min.js')}}"></script>
              <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
              <script src="{{('js/plugins/bootstrap-tagsinput.js')}}"></script>
              <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
              <script src="{{('js/plugins/jasny-bootstrap.min.js')}}"></script>
              <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
              <script src="{{('js/plugins/fullcalendar.min.js')}}"></script>
              <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
              <script src="{{('js/plugins/jquery-jvectormap.js')}}"></script>
              <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
              <script src="{{('js/plugins/nouislider.min.js')}}"></script>
              <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js')}}"></script>
              <!-- Library for adding dinamically elements -->
              <script src="{{('js/plugins/arrive.min.js')}}"></script>
              <!--  Google Maps Plugin    -->
              <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
              <!-- Chartist JS -->
              <script src="{{('js/plugins/chartist.min.js')}}"></script>
              <!--  Notifications Plugin    -->
              <script src="{{('js/plugins/bootstrap-notify.js')}}"></script>
              <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
              <script src="{{('js/material-dashboard.js?v=2.1.2')}}" type="text/javascript"></script>
              <!-- Material Dashboard DEMO methods, don't include it in your project! -->
              <script src="{{('demo/demo.js')}}"></script>
              <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
              <script>
              $(document).ready(function() {
              $().ready(function() {
              $sidebar = $('.sidebar');
              $sidebar_img_container = $sidebar.find('.sidebar-background');
              $full_page = $('.full-page');
              $sidebar_responsive = $('body > .navbar-collapse');
              window_width = $(window).width();
              fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
              if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
              if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
              $('.fixed-plugin .dropdown').addClass('open');
              }
              }
              $('.fixed-plugin a').click(function(event) {
              // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
              if ($(this).hasClass('switch-trigger')) {
              if (event.stopPropagation) {
              event.stopPropagation();
              } else if (window.event) {
              window.event.cancelBubble = true;
              }
              }
              });
              $('.fixed-plugin .active-color span').click(function() {
              $full_page_background = $('.full-page-background');
              $(this).siblings().removeClass('active');
              $(this).addClass('active');
              var new_color = $(this).data('color');
              if ($sidebar.length != 0) {
              $sidebar.attr('data-color', new_color);
              }
              if ($full_page.length != 0) {
              $full_page.attr('filter-color', new_color);
              }
              if ($sidebar_responsive.length != 0) {
              $sidebar_responsive.attr('data-color', new_color);
              }
              });
              $('.fixed-plugin .background-color .badge').click(function() {
              $(this).siblings().removeClass('active');
              $(this).addClass('active');
              var new_color = $(this).data('background-color');
              if ($sidebar.length != 0) {
              $sidebar.attr('data-background-color', new_color);
              }
              });
              $('.fixed-plugin .img-holder').click(function() {
              $full_page_background = $('.full-page-background');
              $(this).parent('li').siblings().removeClass('active');
              $(this).parent('li').addClass('active');
              var new_image = $(this).find("img").attr('src');
              if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
              $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
              });
              }
              if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
              var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
              $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
              });
              }
              if ($('.switch-sidebar-image input:checked').length == 0) {
              var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
              var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              }
              if ($sidebar_responsive.length != 0) {
              $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
              }
              });
              $('.switch-sidebar-image input').change(function() {
              $full_page_background = $('.full-page-background');
              $input = $(this);
              if ($input.is(':checked')) {
              if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
              }
              if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
              }
              background_image = true;
              } else {
              if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
              }
              if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
              }
              background_image = false;
              }
              });
              $('.switch-sidebar-mini input').change(function() {
              $body = $('body');
              $input = $(this);
              if (md.misc.sidebar_mini_active == true) {
              $('body').removeClass('sidebar-mini');
              md.misc.sidebar_mini_active = false;
              $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
              } else {
              $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
              setTimeout(function() {
              $('body').addClass('sidebar-mini');
              md.misc.sidebar_mini_active = true;
              }, 300);
              }
              // we simulate the window Resize so the charts will get updated in realtime.
              var simulateWindowResize = setInterval(function() {
              window.dispatchEvent(new Event('resize'));
              }, 180);
              // we stop the simulation of Window Resize after the animations are completed
              setTimeout(function() {
              clearInterval(simulateWindowResize);
              }, 1000);
              });
              });
              });
              </script>
              <script>
              $(document).ready(function() {
              // Javascript method's body can be found in assets/js/demos.js
              md.initDashboardPageCharts();
              });
              </script>
              <script>
              window.onload = function () {
              var chart = new CanvasJS.Chart("chartContainer", {
              animationEnabled: true,
              title:{
              text: "Music Album Sales by Year"
              },
              axisY: {
              title: "Units Sold",
              valueFormatString: "#0,,.",
              suffix: "mn",
              stripLines: [{
              value: 3366500,
              label: "Average"
              }]
              },
              data: [{
              yValueFormatString: "#,### Units",
              xValueFormatString: "YYYY",
              type: "spline",
              dataPoints: [
              {x: new Date(2002, 0), y: 2506000},
              {x: new Date(2003, 0), y: 2798000},
              {x: new Date(2004, 0), y: 3386000},
              {x: new Date(2005, 0), y: 6944000},
              {x: new Date(2006, 0), y: 6026000},
              {x: new Date(2007, 0), y: 2394000},
              {x: new Date(2008, 0), y: 1872000},
              {x: new Date(2009, 0), y: 2140000},
              {x: new Date(2010, 0), y: 7289000},
              {x: new Date(2011, 0), y: 4830000},
              {x: new Date(2012, 0), y: 2009000},
              {x: new Date(2013, 0), y: 2840000},
              {x: new Date(2014, 0), y: 2396000},
              {x: new Date(2015, 0), y: 1613000},
              {x: new Date(2016, 0), y: 2821000},
              {x: new Date(2017, 0), y: 2000000}
              ]
              }]
              });
              chart.render();
              }
              </script>
              <script>
              // chart colors
              var colors = ['#007bff','#28a745','#444444','#c3e6cb','#dc3545','#6c757d'];
              var chBar = document.getElementById("chBar");
              var chartData = {
              labels: ["S", "M", "T", "W", "T", "F", "S"],
              datasets: [{
              data: [589, 445, 483, 503, 689, 692, 634],
              backgroundColor: colors[0]
              },
              {
              data: [209, 245, 383, 403, 589, 692, 580],
              backgroundColor: colors[1]
              },
              {
              data: [489, 135, 483, 290, 189, 603, 600],
              backgroundColor: colors[2]
              },
              {
              data: [639, 465, 493, 478, 589, 632, 674],
              backgroundColor: colors[4]
              }]
              };
              if (chBar) {
              new Chart(chBar, {
              type: 'bar',
              data: chartData,
              options: {
              scales: {
              xAxes: [{
              barPercentage: 0.4,
              categoryPercentage: 0.5
              }],
              yAxes: [{
              ticks: {
              beginAtZero: false
              }
              }]
              },
              legend: {
              display: false
              }
              }
              });
              }
              </script>
              <script>
              "use strict";
              // function that creates dummy data for demonstration
              function createDummyData() {
              var date = new Date();
              var data = {};
              for (var i = 0; i < 10; i++) {
              data[date.getFullYear() + i] = {};
              for (var j = 0; j < 12; j++) {
              data[date.getFullYear() + i][j + 1] = {};
              for (var k = 0; k < Math.ceil(Math.random() * 10); k++) {
              var l = Math.ceil(Math.random() * 28);
              try {
              data[date.getFullYear() + i][j + 1][l].push({
              startTime: "10:00",
              endTime: "12:00",
              text: "Some Event Here"
              });
              } catch (e) {
              data[date.getFullYear() + i][j + 1][l] = [];
              data[date.getFullYear() + i][j + 1][l].push({
              startTime: "10:00",
              endTime: "12:00",
              text: "Some Event Here"
              });
              }
              }
              }
              }
              return data;
              }
              // creating the dummy static data
              var data = createDummyData();
              // initializing a new calendar object, that will use an html container to create itself
              var calendar = new Calendar(
              "calendarContainer", // id of html container for calendar
              "small", // size of calendar, can be small | medium | large
              [
              "Wednesday", // left most day of calendar labels
              3 // maximum length of the calendar labels
              ],
              [
              "#E91E63", // primary color
              "#C2185B", // primary dark color
              "#FFFFFF", // text color
              "#F8BBD0" // text dark color
              ]
              );
              // initializing a new organizer object, that will use an html container to create itself
              var organizer = new Organizer(
              "organizerContainer", // id of html container for calendar
              calendar, // defining the calendar that the organizer is related to
              data // giving the organizer the static data that should be displayed
              );
              </script>




<script src="{{url('backend/sweetalerts/sweetalert2.all.js')}}"></script>

<script type="text/javascript">
$("body").on( "click", ".delete", function () {
var task_id = $( this ).attr( "data-id" );
console.log(task_id);
var form_data = {
id: task_id
};
swal({
title: "Do you want to delete this Icon",

type: 'info',
showCancelButton: true,
confirmButtonColor: '#F79426',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes',
showLoaderOnConfirm: true
}).then( ( result ) => {
if ( result.value == true ) {
$.ajax( {
type: 'get',

url: '<?php echo url("/deleteicon/{id}"); ?>',
data: form_data,
success: function ( msg ) {
swal( "@lang('Icon Deleted')", '', 'success' )
setTimeout( function () {
location.reload();
}, 1000 );
}
} );
}
} );
} );
</script>
<style>
.sweet-alert h2 {
font-size: 1.3rem !important;
}

.sweet-alert .sa-icon {
margin: 30px auto 35px !important;
}
</style>





            </body>
          </html>