@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Role Information Record</h1>
@endsection

@section('breadcrumb')

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
            <table id="roleTable" class="table table-striped" style="width:100%">
              <thead class="bg-light">
                  <tr>
                      <th style="width:25%;">Role ID</th>
                      <th>Role Name</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($roles as $rolee) 
                  <tr>
                      <td>{{$rolee->role_id}}</td>
                      <td>{{$rolee->role_name}}</td>
                      <td>
                        <a class="btn btn-warning btn-sm float-right" role="button" aria-pressed="true" data-toggle="modal" data-target="#editRole-{{$rolee->role_id}}">Edit</a>
                      </td>
                  </tr>
                  <div class="modal fade" id="editRole-{{$rolee->role_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog center" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Role Name</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form name="editrole" id="editrole" method="POST" action="{{url('editrole/'.$rolee->role_id)}}">
                          @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name" value="{{$rolee->role_name}}">
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
            Create Account Role
          </div>
          <div class="card-header border-0">

            <form name="addrole" id="addrole" method="POST" action="{{url('createroles')}}">
            @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">Role Name</label>
                    <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name">
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