@extends('layout')

@section('title')
<h1 class="m-0">Medical Summary <span class="text-success h4">#{{ $newMedical -> RECORD_ID }}</span></h1>
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

      <div class="jumbotron text-center bg-success p-2 bg-opacity-10">
        <h1 class="display-3">Success!</h1>
        <p class="lead"><strong>Medical Record with ID [{{ $newMedical -> RECORD_ID }}] has been added!</p>
        <hr>
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="{{url('/myQueue')}}" role="button">Appointment List</a>
        </p>
      </div>


      </div>
    </div>
  </div>
</div>
@endsection