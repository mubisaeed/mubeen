@extends('layouts.app')

@section('content')
                    <form method="POST" action="/studentstore" enctype="multipart/form-data">
                    @csrf
                        <div class="card2 card border-0 px-4 py-5">
                          @foreach ($errors->all() as $error)

  <div class="alert alert-danger">{{ $error }}</div>

@endforeach
                            <div class="login_text">
                                <h3>create Student</h3>
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black">Student name</h6>
                                </label> 
                                <input type="text" name="sname" class="mb-4" placeholder="Enter class name" required="">
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black">Student Image</h6>
                                </label> 
                                <input type="file" name="image">
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black">Father name</h6>
                                </label> 
                                <input type="text" name="fname" class="mb-4" placeholder="Enter department" required="">
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black">Phone Number</h6>
                                </label> 
                                <input type="number" name="phno" class="mb-4" placeholder="Enter room number" required="">
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black">CNIC</h6>
                                </label> 
                                <input type="text" name="cnic" class="mb-4" placeholder="Enter room number" required="">
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black">Address</h6>
                                </label> 
                                <input type="text" name="add" class="mb-4" placeholder="Enter room number" required="">
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black">Class</h6>
                                </label> 
                                <input type="text" name="class" class="mb-4" placeholder="Enter room number" required="">
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color:black">Roll Number</h6>
                                </label> 
                                <input type="text" name="rno" class="mb-4" placeholder="Enter room number" required="">
                            </div>
                            
                                
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline">   </div>
                            </div>
                            <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Create</button> </div>
                        </div>
                    </form>
                </div>
            
@endsection
       