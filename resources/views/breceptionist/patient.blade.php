@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Patient Record</h1>
@endsection

@section('breadcrumb')

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
            <!-- Summary Card -->
              <div class="row">

              <div class="col-sm">
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>{{ $patient->count() }}</h3>
                    <p>All Patient</p>
                  </div>
                  <div class="icon">
                  <i class="ion ion-android-people"></i>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Summary Card -->

            <div class="card">
              <div class="card-header border-0">

              <table id="patientTable" class="table table-striped" style="width:100%">
                    <thead class="bg-dark" style="width: 100%;">
                        <tr>
                            <th>Patient ID</th>
                            <th>Full Name</th>
                            <th>Religion</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th style="width: 100px;">Action</th>
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
@endsection