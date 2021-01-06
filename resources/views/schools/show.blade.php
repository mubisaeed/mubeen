@extends('layouts.app')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">School Detail</h4>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="">
                     
                <table id="myTable" class="text-primary display table tablesorter">
                    <thead class="text-primary">

                        <tr>
                            <th>Father name</th>
                            <th>Phone</th>
                            <th>CNIC</th>
                            <th>Address</th>
                            <th class="text-center">Actions</th>
                        </tr></thead>
                    <tbody>
                        <tr class="custom_color" >
                            <td>{{$schooldetail->father_name}}</td>
                            <td>{{$schooldetail->phone}}</td>
                            <td>{{$schooldetail->cnic}}</td>
                            <td>{{$schooldetail->address}}</td>
                            <td class="text-right">
                              <a class="btn btn-sm btn-success" href="{{url('/schools')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                            </td>
                        </tr>
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