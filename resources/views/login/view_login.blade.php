<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adventist Hospital</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/logo.png') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

  <script>
    $("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 5000 ); // 5 secs
  });
  </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">

  <div class="card">
  <div class="card-body bg-dark">
    <a href="{{ url('login') }}" class="mb-0"><b>Adventist</b> Hospital</a>
  </div>
</div>
                
  </div>

    @if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
    </div>
    @endif
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
          @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

      <form action="{{ url('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input autofocus type="text" class="form-control
          @error('username')
            is-invalid
          @enderror"
          name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user text-dark"></span>
            </div>
          </div>
          @error('username')
          <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control
          @error('password')
            is-invalid
          @enderror"
          name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock  text-dark"></span>
            </div>
          </div>
          @error('password')
          <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>

          <div class="col-12 mt-2">
            <a href="{{url('forget-password')}}">
                <i>Forgot Password?</i>
            </a>
          </div>
            
        </div>
      </form>


    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>