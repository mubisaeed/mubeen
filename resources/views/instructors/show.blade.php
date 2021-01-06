@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div id="message">
            @if (Session::has('message'))
              <div class="alert alert-info">
                {{ Session::get('message') }}
              </div>
            @endif
            </div>
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Instructor Detail</h4>
                            </div>

                        </div>
                    
                    </div>
                    <div class="card-body">
                        <div class="">
                                 
                            <table id="myTable" class="text-primary display table tablesorter">
                                <thead class="text-primary">

                                    <tr>
                                        <th>Phone</th>
                                        <th>CNIC</th>
                                        <th>Address</th>
                                        <th class="text-center">Actions</th>
                                    </tr></thead>
                                <tbody>
                                    <tr class="custom_color" >
                                        @foreach($instructordetail as $ins)
                                    <tr>
                                        <td>{{$ins->phone}}</td>
                                        <td>{{$ins->cnic}}</td>
                                        <td>{{$ins->address}}</td>
                                        <td class="text-right">
                                          <a class="btn btn-sm btn-success" href="{{url('/instructors')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection