@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>User Account Record</h1>
@endsection

@section('breadcrumb')

@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
          <!-- Summary Card -->
              <div class="row">

              <div class="col-sm">
                <div class="small-box bg-primary">
                  <div class="inner">
                  <h4>{{ $useraccount->count() }}</h4>
                    <p>All Users</p>
                  </div>
                  <div class="icon">
                  <i class="ion ion-android-people"></i>
                  </div>
                </div>
              </div>

              <div class="col-sm">
              <div class="small-box bg-info">
                <div class="inner">
                <h4>{{ $useraccount->count() }}</h4>
                  <p>Admin</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-people"></i>
                </div>
              </div>
            </div>

            <div class="col-sm">
              <div class="small-box bg-warning">
                <div class="inner">
                <h4>{{ $useraccount->count() }}</h4>
                  <p>Receptionist</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-people"></i>
                </div>
              </div>
            </div>

            <div class="col-sm">
              <div class="small-box bg-success">
                <div class="inner">
                <h4>{{ $useraccount->count() }}</h4>
                  <p>Physician</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-people"></i>
                </div>
              </div>
            </div>

            <div class="col-sm">
              <div class="small-box bg-danger">
                <div class="inner">
                <h4>{{ $useraccount->count() }}</h4>
                  <p>Pharmacy</p>
                </div>
                <div class="icon">
                <i class="ion ion-android-people"></i>
                </div>
              </div>
            </div>

            <div class="col-sm">
              <div class="small-box bg-dark">
                <div class="inner">
                <h4>{{ $useraccount->count() }}</h4>
                  <p>Finance</p>
                </div>
                <div class="icon">
                <i class="ion ion-android-people"></i>
                </div>
              </div>
            </div>
            </div>
            <!-- End Summary Card -->
            <!-- Table Card -->
            <div class="card">
              <div class="card-header border-0">

              <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>USER ID</th>
                <th>FULL NAME</th>
                <th>GENDER</th>
                <th>ROOM</th>
                <th>POLYCLINIC</th>
                <th>ROLE</th>
                <th style="width: 100px;">ACTION</th>
            </tr>
        </thead>
        <tbody>
              @foreach($useraccount as $useritem) 
              <tr>
                  <td>{{$useritem->userid}}</td>
                  <td>{{$useritem->user_fname}} {{$useritem->user_mname}} {{$useritem->user_lname}}</td>
                  <td>{{$useritem->user_gender}}</td>
                  <td>{{$useritem->user_room}}</td>
                  <td>{{$useritem->poly_name}}</td>
                  <td>{{$useritem->role_name}}</td>
                  <td>
                    <a href="{{ url('/user/'.$useritem->userid) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
                    <a href="{{ url('/user/'.$useritem->userid.'/edit') }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-pen"></i></a>
                    <a href="{{ url('/user/'.$useritem->userid.'/delete') }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true"  onclick="return confirm('Do you really want to Delete User? ID : {{$useritem->userid}}');"><i class="fas fa-trash"></i></a>
                  </td>
              </tr>
              @endforeach
        </tbody>
    </table>

              <!-- <table id="userTable" class="display" style="width: 100%;">
                    <thead class="table-dark" style="width: 100%;">
                        <tr>
                            <th>USER ID</th>
                            <th>FULL NAME</th>
                            <th>GENDER</th>
                            <th>ROOM</th>
                            <th>POLYCLINIC</th>
                            <th>ROLE</th>
                            <th style="width: 120px;">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($useraccount as $useritem) 
                        <tr>
                            <td>{{$useritem->userid}}</td>
                            <td>{{$useritem->user_fname}} {{$useritem->user_mname}} {{$useritem->user_lname}}</td>
                            <td>{{$useritem->user_gender}}</td>
                            <td>{{$useritem->user_room}}</td>
                            <td>{{$useritem->polyid}}</td>
                            <td>{{$useritem->level}}</td>
                            <td>
                              <a href="{{ url('/user/'.$useritem->userid) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
                              <a href="{{ url('/user/'.$useritem->userid.'/edit') }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-pen"></i></a>
                              <a href="{{ url('/user/'.$useritem->userid.'/delete') }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> -->

              </div>
            </div>
            <!-- End Table Card -->
          </div>
        </div>
      </div>
    </div>
@endsection
