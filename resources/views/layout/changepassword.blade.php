@extends('layout')

@section('title')
<a href="{{ url('/myprofile') }}" type="button" class="btn btn-primary">Go Back</a>
<h1 class="mt-4"><span class="text-success h1">| </span>Change Password</h1>
@endsection

@section('breadcrumb')

@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
           <div class="row">
                <div class="col-sm-3">

                <div class="card">
                <div class="card-body">
                                   
                <form name="changePassword" id="myForm"  method="POST" enctype="multipart/form-data" action="{{url('/myprofile/'.$user->userid.'/changepassword')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Current Password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" name="current_password" aria-describedby="emailHelp" placeholder="Current Password" required>
                    @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" id="password" name="new_password" placeholder="New Password" required>
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
                </div>
                </div>

                </div>

                <div class="col-sm-9">

                </div>

            </div>
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