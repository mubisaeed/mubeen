@extends('layouts.app')

@section('content')
            <div class="breadcrumb_main">
              <ol class="breadcrumb">
                <li><a href = "#">Home</a></li>
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
                          <button type="button">Add Event</button>
                          <div class="radio_event_list">
                            <label class="container_radio">All
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
                            <label class="container_radio">Populated
                              <input type="radio" name="radio">
                              <span class="checkmark"></span>
                            </label>
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
          </div>
         @endsection