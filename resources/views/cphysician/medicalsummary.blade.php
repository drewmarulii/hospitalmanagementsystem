@extends('layout')

@section('title')
<a href="{{ url('/myQueue') }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
  <h1><span class="h5 text-success">{{$newMedical->RECORD_ID}} /</span> Medical Summary</h1>
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

      <div class="card text-center p-2">
        <h1 class="display-3">Medical Treatment Done!</h1>
        <p class="lead"><strong>Medical Record with ID [{{ $newMedical -> RECORD_ID }}] has been added!</p>
        <hr>
        <p class="lead">
          <a class="btn btn-primary" href="{{url('/myMedicalRecord/'.$getPatient->PATIENT_ID.'/'.$newMedical->RECORD_ID)}}" role="button">View Detail</a>
        </p>
      </div>


      </div>
    </div>
  </div>
</div>
@endsection