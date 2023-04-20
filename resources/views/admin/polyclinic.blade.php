@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Polyclinic Information Record</h1>
@endsection

@section('breadcrumb')

@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">

            <div class="card">

              <div class="card-header border-0">

              <table id="polyTable" class="table table-striped" style="width:100%">
                    <thead class="bg-dark" style="width: 100%;">
                        <tr>
                            <th>Poly ID</th>
                            <th>Poly Name</th>
                            <th style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($polyclinic as $poly) 
                        <tr>
                            <td>{{$poly->poly_id}}</td>
                            <td>{{$poly->poly_name}}</td>
                            <td>
                            <a href="/polyclinic/id?:{{$poly->POLY_ID}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-pen"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

              </div>
            </div>
          </div>

          <div class="col-4">

            <div class="card">
            <div class="card-header bg-dark">
               Create Polyclinic
            </div>
            <div class="card-header border-0">

            <form name="addrole" id="addrole" method="POST" action="{{url('createpoly')}}">
            @csrf
                <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Poly ID</label>
                    <input type="text" class="form-control" id="POLY_ID" name="POLY_ID" placeholder="Enter Poly ID">
                </div> -->
                <div class="form-group">
                    <label for="exampleInputPassword1">Poly Name</label>
                    <input type="text" class="form-control" id="poly_name" name="poly_name" placeholder="Enter Poly Name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
            </div>
            </div>

        </div>
      </div>
    </div>
@endsection