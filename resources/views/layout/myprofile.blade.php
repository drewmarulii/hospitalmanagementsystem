@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>My Profile</h1>
@endsection

@section('breadcrumb')

@endsection

@section('content')
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">

            <div class="card">
            <div class="card-header bg-dark">
               User Profile Information
            </div>
              <div class="card-header border-0">
                <div class="row">
                  <div class="col-4">
                    <div class="card-body text-center">
                            @if($user->user_pp)
                            <img src="{{ asset('uploads/users/'.$user->user_pp ) }}" alt="avatar"
                              class="rounded-circle mb-4" style="width: 150px; height: 150px; ">
                            @else
                            <img src="{{ asset('uploads/users/nopic.png') }}" alt="avatar"
                              class="rounded-circle mb-4" style="width: 150px; height: 150px; ">
                            @endif
                          <br>
                    </div>

                  </div>
                  <div class="col-8">
                    
            <div class="card-body">
              <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">ID</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->userid}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->user_fname}} {{$user->user_mname}} {{$user->user_lname}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->username}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Password</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><a href="{{ url('/myprofile/'.$user->userid.'/changepassword') }}"><u>Change Password</u></a></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->user_gender}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Room Number</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->user_room}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Account Role</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->role_name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Account Polyclinic</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->poly_name}}</p>
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