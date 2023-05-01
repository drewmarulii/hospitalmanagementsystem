@extends('layout')

@section('title')
<a href="{{ url('/useraccount') }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
  <h1><span class="h5 text-success">{{$userlist[0]->userid}} /</span> User Information</h1>
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">

          @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <div class="card">
            <div class="card-header bg-dark">
               User Profile Information
            </div>
              <div class="card-header border-0">
                <div class="row">
                  <div class="col-4">
                    <div class="card-body text-center">
                            @if($userlist[0]->user_pp)
                            <img src="{{ asset('uploads/users/'.$userlist[0]->user_pp ) }}" alt="avatar"
                              class="rounded-circle mb-4" style="width: 150px; height: 150px; ">
                            @else
                            <img src="{{ asset('uploads/users/nopic.png') }}" alt="avatar"
                              class="rounded-circle mb-4" style="width: 150px; height: 150px; ">
                            @endif
                              <br>
                              <a href="{{ url('/user/'.$userlist[0]->userid.'/edit') }}" class="btn btn-primary"><i class="far fa-edit"></i> Edit Profile</a>
                    </div>

                  </div>
                  <div class="col-8">
                    
            <div class="card-body">
              <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">ID</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$userlist[0]->userid}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$userlist[0]->user_fname}} {{$userlist[0]->user_mname}} {{$userlist[0]->user_lname}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$userlist[0]->username}}</p>
              </div>
            </div>
             <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$userlist[0]->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$userlist[0]->user_gender}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Room Number</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$userlist[0]->user_room}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Account Role</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$userlist[0]->role_name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Account Polyclinic</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$userlist[0]->poly_name}}</p>
              </div>
            </div>
            <hr>
                
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