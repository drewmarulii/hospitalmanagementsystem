@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Polyclinic Information Record</h1>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      
        <div class="col-5">
          @if(session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
          @endif
          <div class="card">
            <div class="card-header border-0">

              <table id="polyTable" class="table table-striped" style="width:100%">
                <thead class="bg-light" style="width: 100%;">
                    <tr>
                        <th style="width:25%;">Poly ID</th>
                        <th>Poly Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($polyclinic as $poly) 
                    <tr>
                        <td>{{$poly->poly_id}}</td>
                        <td>{{$poly->poly_name}}</td>
                        <td>
                          <a class="btn btn-warning btn-sm float-right" role="button" aria-pressed="true" data-toggle="modal" data-target="#editClinic-{{$poly->poly_id}}">Edit</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editClinic-{{$poly->poly_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog center" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Clinic Name</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form name="editrole" id="editrole" method="POST" action="{{url('editclinic/'.$poly->poly_id)}}">
                            @csrf
                              <div class="form-group">
                                  <label for="exampleInputPassword1">Poly Name</label>
                                  <input type="text" class="form-control" id="poly_name" name="poly_name" value="{{$poly->poly_name}}">
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
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
@endsection