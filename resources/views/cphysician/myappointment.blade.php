@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Appointment Information</h1>
@endsection

@section('breadcrumb')

@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">

          <!-- Summary Card -->
          <div class="row">
            <div class="col-sm">
            <div class="small-box bg-primary">
                <div class="inner">
                <h4>{{$appcard->count()}}</h4>
                <p>Total Appointment</p>
                </div>
                <div class="icon">
                <i class="ion ion-android-people"></i>
                </div>
            </div>
            </div>

            <div class="col-sm">
            <div class="small-box bg-info">
            <div class="inner">
                <h4>{{$new->count()}}</h4>
                <p>New Appointment</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-success">
            <div class="inner">
            <h4>{{$finish->count()}}</h4>
                <p>Completed Appointment</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-dark">
            <div class="inner">
                <h4>{{$todayAppointment -> count()}}</h4>
                <p>Today [<?php echo(date('d M Y', strtotime($today))); ?>]</p>
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

              <table id="appointmentTable" class="table table-striped" style="width:100%">
                    <thead class="bg-light" style="width: 100%;">
                        <tr>
                            <th>Appointment ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Physician</th>
                            <th>Polyclinic</th>
                            <th>Patient</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appcard as $appointments) 
                        <tr>
                            <td>{{$appointments->APPOINTMENT_ID}}</td>
                            <td>{{$appointments->APP_DATE}}</td>
                            @if($appointments->APPOINTMENT_STATUS=='NEW')
                            <td class="bg-primary">{{$appointments->APPOINTMENT_STATUS}}</td>
                            @elseif($appointments->APPOINTMENT_STATUS=='PROGRESS')
                            <td class="bg-warning">{{$appointments->APPOINTMENT_STATUS}}</td>
                            @elseif($appointments->APPOINTMENT_STATUS=='WAIT-MEDICINE')
                            <td class="bg-warning">{{$appointments->APPOINTMENT_STATUS}}</td>
                            @elseif($appointments->APPOINTMENT_STATUS=='FINISH')
                            <td class="bg-success">{{$appointments->APPOINTMENT_STATUS}}</td>
                            @endif
                            <td>Dr. {{$appointments->user_fname}} {{$appointments->user_mname}} {{$appointments->user_lname}}</td>
                            <td>{{$appointments->poly_name}}</td>
                            <td>{{$appointments->PAT_FNAME}} {{$appointments->PAT_MNAME}} {{$appointments->PAT_LNAME}}</td>
                            <td>

                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-{{ $appointments->APPOINTMENT_ID }}">
                              <i class="fas fa-eye"></i>
                            </button>

                            </td>
                        </tr>

                          <!-- Modal -->
                          <div class="modal fade bd-example-modal-lg" id="modal-{{ $appointments->APPOINTMENT_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-success">
                                  <h5 class="modal-title" id="exampleModalLabel">Appointment Card</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                             
                                <div class="col">

                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>STATUS</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->APPOINTMENT_STATUS}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>ID</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->APPOINTMENT_ID}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PATIENT</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->PATIENTID}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PAT. NAME</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->PAT_FNAME}} {{$appointments->PAT_MNAME}} {{$appointments->PAT_LNAME}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>DATE</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->APP_DATE}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PHYSICIAN</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: Dr. {{$appointments->user_fname}} {{$appointments->user_mname}} {{$appointments->user_lname}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>POLY</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->poly_name}}</p>
                                    </div>
                                  </div>

                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End Modal -->

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