@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Patient Record</h1>
@endsection

@section('breadcrumb')
<div class="small-box bg-dark mb-0" style="width:300px;">
  <div class="inner">
  <h5 class="mb-4 mt-2">Total Patient:<span class="float-right h1 mt-0 mr-3">{{$patient->count()}}</span></h5> 
  </div>
  <div class="icon">
  <i class="ion ion-android-people"></i>
  </div>
</div>
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
                Patient Table
              </div>
              <div class="card-body">
              <table id="patientTable" class="table table-striped" style="width:100%">
                <thead class="bg-light" style="width: 100%;">
                    <tr>
                        <th>Patient ID</th>
                        <th>Full Name</th>
                        <th>Religion</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patient as $patien) 
                    <tr>
                        <td>{{$patien->PATIENT_ID}}</td>
                        <td>{{$patien->PAT_FNAME}} {{$patien->PAT_MNAME}} {{$patien->PAT_LNAME}}</td>
                        <td>{{$patien->PAT_RELIGION}}</td>
                        <td>{{$patien->PAT_GENDER}}</td>
                        <td>0{{$patien->PAT_PHONENUMBER}}</td>
                        <td>{{$patien->PAT_EMAIL}}</td>
                        <td>
                          <a href="{{ url('/patient/'.$patien->PATIENT_ID) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
                          <a href="{{ url('/patient/'.$patien->PATIENT_ID.'/edit') }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-pen"></i></a>
                          <a href="{{ url('/patient/'.$patien->PATIENT_ID.'/delete') }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true" onclick="return confirm('Do you really want to Delete Patient? ID : {{$patien->PATIENT_ID}}');"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              </div>      

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection