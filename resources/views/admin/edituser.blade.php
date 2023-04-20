@extends('layout')

@section('title')
<h1> Edit User Information <span class="h5 text-success"> / {{$userlist[0]->userid}}</span></h1>
@endsection

@section('breadcrumb')

@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">

          @foreach ($userlist as $item)
          <form name="addpatient" id="addpatient" method="POST" enctype="multipart/form-data" action="{{url('/updateuser/'.$item->userid)}}" onsubmit="return confirm('Do you really want to update user information?');">
          @csrf
          <div class="card">
            <div class="card-header bg-dark">
               User Profile Information
            </div>
              <div class="card-header border-0">
                <div class="row">
                  <div class="col-4">
                    <div class="card-body text-center">
                            @if($userlist[0]->user_pp)
                            <img id="frame" src="{{ asset('uploads/users/'.$userlist[0]->user_pp) }}" alt="avatar"
                              class="rounded-circle mb-4" style="width: 150px; height: 150px; ">
                              <br>
                              <label>Change Picture (.png, .jpeg)</label>
   
                              <input type="file" class="form-control" name="image" id="image" />
                            @else
                              <img id="frame" src="{{ asset('uploads/users/nopic.png') }}" alt="avatar"
                              class="rounded-circle mb-4" style="width: 150px; height: 150px;" name="image" />
                              <br>
                              <label>Add Picture (.png, .jpeg)</label>

                              <input type="file" class="form-control" name="image" id="image" />
                            @endif
                              
                              
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
                <div class="row">
                  <div class="col-sm">
                  <input type="text" class="form-control" id="user_fname" name="user_fname" value="{{$item->user_fname}}" placeholder="First Name" required>
                  </div>
                  <div class="col-sm">
                  <input type="text" class="form-control" id="user_mname" name="user_mname" value="{{$item->user_mname}}" placeholder="Middle Name">
                  </div>
                  <div class="col-sm">
                  <input type="text" class="form-control" id="user_lname" name="user_lname" value="{{$item->user_lname}}" placeholder="Last Name" required>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
              <input type="text" class="form-control" id="email" value="{{$item->email}}" name="email" placeholder="Email" required>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
              <select class="form-select" id="user_gender" name="user_gender" placeholder="Gender" required>
                    <option  value="Male" <?php if($item->user_gender=="Male") echo 'selected="selected"'; ?>>Male</option>
                    <option  value="Female" <?php if($item->user_gender=="Female") echo 'selected="selected"'; ?>>Female</option>
                  </select>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Room Number</p>
              </div>
              <div class="col-sm-9">
              <input type="text" class="form-control" id="user_room" value="{{$item->user_room}}" name="user_room" placeholder="Room Number" required>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Account Role</p>
              </div>
              <div class="col-sm-9">
              <select class="form-select" id="level" name="level" placeholder="User Role" required>
                    @foreach($role as $roleitem)
                    <option value="{{$roleitem->role_id}}" <?php  if($item->level==$roleitem->role_id) echo 'selected="selected"'; ?> >{{$roleitem->role_name}}</option>
                    @endforeach
                  </select>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Account Polyclinic</p>
              </div>
              <div class="col-sm-9">
              <select class="form-select" id="polyid" name="polyid" placeholder="Polyclinic" required>
                    @foreach($polyclinic as $polyitem)
                      <option value="{{$polyitem->poly_id}}" <?php  if($item->polyid==$polyitem->poly_id) echo 'selected="selected"'; ?> >{{$polyitem->poly_name}}</option>
                    @endforeach
                  </select>
              </div>
            </div>
            <hr>

              <button type="submit" class="btn btn-primary">Submit</button>
              <a class="btn btn-danger text-light" onclick="history.back()">Cancel</a>
              </form> 
                
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      @endforeach

        </div>
      </div>
    </div>
@endsection