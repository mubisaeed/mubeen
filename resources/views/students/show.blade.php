@extends('layouts.app')

@section('content')
<div class="col-md-12">
  <div class="card ">
    <div class="card-header">
      <div class="row">
          <div class="col-8">
              <h4 class="card-title">Student Detail</h4>
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
                <th>Class</th>
                <th>Roll no</th>
                <th>Blood Group</th>
                <th>Diabetes</th>
                <th>Alergy</th>
                <th class="text-center">Actions</th>
              </tr>
              </thead>
              <tbody>
                  <tr class="custom_color" >
                    @foreach($studentsdetail as $st) 
                  <tr>
                    <td>{{$st->father_name}}</td>
                    <td>{{$st->phone}}</td>
                    <td>{{$st->cnic}}</td>
                    <td>{{$st->address}}</td>
                    <td>{{$st->class}}</td>
                    <td>{{$st->rollno}}</td>
                    <td>{{$st->blood_group}}</td>
                    <td>{{$st->diabetes}}</td>
                    <td>{{$st->alergy}}</td>
                    <td class="text-right">
                      <a class="btn btn-sm btn-success" href="{{url('/students')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
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
@endsection            
