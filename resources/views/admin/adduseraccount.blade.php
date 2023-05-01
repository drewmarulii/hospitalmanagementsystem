@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Add User Account</h1>
@endsection

@section('breadcrumb')

@endsection

@section('content')

      <div class="container-fluid">
        <div class="row">
          <div class="col">
          <div class="content">
            
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif


            <div class="row">
              <div class="col-8">
            <!-- Create User Form Card -->
            <div class="card">
            <div class="card-header bg-dark">
              1. User Profile
            </div>
              <div class="card-body border-0">
              <form name="addpatient" id="myForm"  method="POST" enctype="multipart/form-data" action="{{url('createaccount')}}">
              @csrf
                <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="inputLastname">First Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="user_fname" name="user_fname" value="{{old('user_fname')}}" placeholder="First Name" autofocus required>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="inputLastname">Middle Name (optional)</label>
                      <input type="text" class="form-control" id="user_mname" name="user_mname"  value="{{old('user_mname')}}" placeholder="Middle Name" >
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="inputLastname">Last Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="user_lname" name="user_lname"  value="{{old('user_lname')}}" placeholder="Last Name" required>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                <div class="form-group col-sm">
                <label for="inputState">Gender <span class="text-danger">*</span></label>
                <select id="inputState" class="form-select" id="user_gender" name="user_gender" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="Male" {{ old('user_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('user_gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                </div>
                <div class="form-group col-sm">
                  <label for="inputMiddlename">Room Number <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="user_room" name="user_room"  value="{{old('user_room')}}"  placeholder="Room Number"  required>
                </div>
                <div class="form-group col-sm">
                <label for="inputState">Polyclinic <span class="text-danger">*</span></label>
                <select id="inputState" class="form-select" id="polyid" name="polyid" required>
                  <option selected disabled value="">Choose...</option>
                    @foreach($poly as $polyitem)
                        <option value="{{$polyitem->poly_id}}" {{ old('polyid') == $polyitem->poly_id ? 'selected' : '' }}>{{$polyitem->poly_name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group col-sm">
                <label for="inputState">Role <span class="text-danger">*</span></label>
                <select class="form-select" id="level" name="level" required>
                <option selected disabled value="">Choose...</option>
                    @foreach($role as $roleitem)
                        <option value="{{$roleitem->role_id}}" {{ old('level') == $roleitem->role_id ? 'selected' : '' }} >{{$roleitem->role_name}}</option>
                    @endforeach
                </select>
                </div>
                </div>
                <div class="form-group">
                    <label for="inputState">Profile Picture</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="PAYMENT_PROOF_FILE" id="image" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- End Table Card -->
              </div>
              <div class="col-4">
              <div class="card ">
                <div class="card-header bg-dark">
                  2. Account
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group">
                      <label for="inputMiddlename">Username <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="username" name="username"   value="{{old('username')}}"  placeholder="Username" >
                      @if($errors->has('username'))
                        <span class="text-danger">{{$errors->first('username')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputMiddlename">Email <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" id="email" name="email"   value="{{old('email')}}"  placeholder="Email" >
                      @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputMiddlename">Password <span class="text-danger">*</span></label>
                      <span id="message" class="float-right"></span></u>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                      @if($errors->has('password'))
                        <span class="text-danger">{{$errors->first('password')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputMiddlename">Re-type password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Re-type Password"  onkeyup='check()' >
                    </div>
                  </div>
         
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                  </form> 
                </div>
                </div>
              </div>
              </div>
            </div>

            

            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                      <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
          </div>
        </div>
      </div>
    </div>

                <script>
                  
                  $('#password, #confirm_password').on('keyup', function () {
                    if ($('#password').val() == $('#confirm_password').val()) {
                      $('#message').html('Password Match!').css('color', 'green');
                    } else 
                      $('#message').html('Password Not Match!').css('color', 'red');
                  });

                </script>
@endsection
