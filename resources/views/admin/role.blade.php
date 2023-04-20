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
          <div class="col-8">

            <div class="card">
              <div class="card-header border-0">
              <table id="roleTable" class="table table-striped" style="width:100%">
                    <thead class="bg-light" style="width: 100%;">
                        <tr>
                            <th>Role ID</th>
                            <th>Role Name</th>
                            <th style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $rolee) 
                        <tr>
                            <td>{{$rolee->role_id}}</td>
                            <td>{{$rolee->role_name}}</td>
                            <td>
                            <a href="/role/id?:{{$rolee->ROLE_ID}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
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