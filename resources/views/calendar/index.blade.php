@extends('layouts.app')
<link href="{{asset('/assets/css/calendar.css')}}" rel="stylesheet" />
@section('content')
<div id="message">

  @if (Session::has('message'))

    <div class="alert alert-info">

      {{ Session::get('message') }}

    </div>

  @endif

</div>
            <div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href = "{{url('/dashboard')}}">Home</a></li>
                <li class = "active">School Calendar</li>
              </ol>
            </div>
            <div class="content_main">
              <div class="school_clndr_main">
                
                <div class="calender card-header card-header-warning card-header-icon">
                  
                    <h3>School Calendar</h3>
                  
                  <div class="calendar_main">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="clndr_event_list">
                          <button type="button" data-toggle="modal" data-target="#modal-view-event-add">Add Event</button>
                          <div class="radio_event_list">
                            <label class="container_radio">School Calendar
                              <input type="radio" checked="checked" name="radio">
                              <span class="checkmark"></span>
                            </label>
                            <label class="container_radio">Live Instructor Schedule
                              <input type="radio" name="radio">
                              <span class="checkmark"></span>
                            </label>
                            <label class="container_radio">US Holidays
                              <input type="radio" name="radio">
                              <span class="checkmark"></span>
                            </label>
                            <label class="container_radio">Events
                              <input type="radio" name="radio">
                              <span class="checkmark"></span>
                            </label>
                            <!-- <label class="container_radio">Populated
                              <input type="radio" name="radio">
                              <span class="checkmark"></span>
                            </label> -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="top_clndr">
                          <div class="">
                            <div class="card-body p-0">
                              <div id="calendar"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div id="modal-view-event" class="modal modal-top fade calendar-modal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <h4 class="modal-title"><span class="event-icon"></span><span class="event-title"></span></h4>
                    <div class="event-body"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <div id="modal-view-event-add" class="modal modal-top fade calendar-modal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form id="add-event" method="POST" action="/addevent">
                    @csrf
                    <div class="modal-body">
                      <h4>Add Event Detail</h4>
                      <div class="form-group">
                        <label>Event name</label>
                        <input type="text" class="form-control" name="ename" value="{{old('ename')}}">
                      </div>
                      <div class="form-group">
                        <label>Event Date</label>
                        <input type="date" class="datetimepicker form-control" name="edate" value="{{old('edate')}}" onchange="invoicedue(event);" class="mb-4" required="" autofocus="">
                        
                      </div>
                      <div class="form-group">
                        <label>Event Description</label>
                        <textarea class="form-control" name="edesc" value="{!! old('edesc') !!}" ></textarea>
                      </div>
                      <div class="form-group">
                        <label>Event Color</label>
                        <select class="form-control" name="ecolor" value="{{old('ecolor')}}">
                          <option value="fc-bg-default">fc-bg-default</option>
                          <option value="fc-bg-blue">fc-bg-blue</option>
                          <option value="fc-bg-lightgreen">fc-bg-lightgreen</option>
                          <option value="fc-bg-pinkred">fc-bg-pinkred</option>
                          <option value="fc-bg-deepskyblue">fc-bg-deepskyblue</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Event Icon</label>
                        <select class="form-control" name="eicon" value="{{old('eicon')}}">
                          <option value="circle">circle</option>
                          <option value="cog">cog</option>
                          <option value="group">group</option>
                          <option value="suitcase">suitcase</option>
                          <option value="calendar">calendar</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" >Save</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
<script type="text/javascript">

  setTimeout(function() {

    $('#message').fadeOut('fast');

}, 2000);

</script>
         @endsection