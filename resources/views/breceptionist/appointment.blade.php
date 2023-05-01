@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Appointment Information Record</h1>
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
              <div class="small-box bg-warning">
                <div class="inner">
                <h4>{{$inProgress->count()}}</h4>
                  <p>In-Progress</p>
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
                <h4>{{$todayAppointment->count()}}</h4>
                  <p>Today's Appointment</p>
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
                    <thead class="bg-dark" style="width: 100%;">
                        <tr>
                            <th>Appointment ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Physician</th>
                            <th>Polyclinic</th>
                            <th>Patient</th>
                            <th style="width: 120px;">Action</th>
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
                            <td class="bg-info">{{$appointments->APPOINTMENT_STATUS}}</td>
                            @elseif($appointments->APPOINTMENT_STATUS=='COMPLETED')
                            <td class="bg-success">{{$appointments->APPOINTMENT_STATUS}}</td>
                            @endif
                            <td>Dr. {{$appointments->user_fname}} {{$appointments->user_mname}} {{$appointments->user_lname}}</td>
                            <td>{{$appointments->poly_name}}</td>
                            <td>{{$appointments->PAT_FNAME}} {{$appointments->PAT_MNAME}} {{$appointments->PAT_LNAME}}</td>
                            <td>
                            @if($user->level=='R002')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-{{ $appointments->APPOINTMENT_ID }}">
                              <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-{{ $appointments->APPOINTMENT_ID }}">
                              <i class="fas fa-edit"></i>
                            </button>
                            <!-- <a href="{{ url('/patient/'.$appointments->APPOINTMENT_ID.'/appointment/edit') }}" type="button" class="btn btn-warning btn-sm userinfo" role="button" aria-pressed="true"><i class="fas fa-pen"></i></a> -->
                            <a href="{{ url('/patient-app/'.$appointments->APPOINTMENT_ID.'/delete') }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true" onclick="return confirm('Are you sure want to delete Appointment ID: {{ $appointments->APPOINTMENT_ID }} ')"><i class="fas fa-trash"></i></a>
                            @endif
                            </td>
                        </tr>

                          <!-- Modal -->
                          <div class="modal fade bd-example-modal-lg" id="modal-{{ $appointments->APPOINTMENT_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal" role="document">
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
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>ID</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->APPOINTMENT_ID}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PATIENT</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->PATIENTID}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PAT. NAME</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->PAT_FNAME}} {{$appointments->PAT_MNAME}} {{$appointments->PAT_LNAME}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>DATE</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$appointments->APP_DATE}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PHYSICIAN</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: Dr. {{$appointments->user_fname}} {{$appointments->user_mname}} {{$appointments->user_lname}}</p>
                                    </div>
                                  </div>
                                  <hr>
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

                          <!-- Modal -->
                          <div class="modal fade" id="edit-{{ $appointments->APPOINTMENT_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-warning">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Edit Appointment</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form name="addappointment" id="addappointment" method="POST" action="{{url('/updateappointment/'.$appointments->APPOINTMENT_ID)}}" onsubmit="return confirm('Do you really want to update Appointment information?');">
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Patient ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="PATIENTID" name="PATIENTID" value="{{$appointments->PATIENTID}}" placeholder="Input Patient ID" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Appointment Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="APP_DATE" name="APP_DATE" value="{{$appointments->APP_DATE}}" placeholder="Appointment Date" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="cars">Polyclinic <span class="text-danger">*</span></label>
                                      <select class="form-select" id="poly_id" name="poly_id" placeholder="Polyclinic" required>
                                        <option selected disabled>Choose Polyclinic</option>
                                        @foreach($polyclinic as $polyitem)
                                          <option value="{{$polyitem->poly_id}}" <?php  if($appointments->poly_id==$polyitem->poly_id) echo 'selected="selected"'; ?>>{{$polyitem->poly_name}}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="cars">Physician <span class="text-danger">*</span></label>
                                      <select class="form-select" id="DOCTOR_ID" name="DOCTOR_ID" placeholder="Polyclinic" required>
                                        <option selected disabled>Choose Physician</option>
                                        @foreach($useraccount as $physician)
                                          <option value="{{$physician->userid}}" <?php  if($appointments->DOCTOR_ID==$physician->userid) echo 'selected="selected"'; ?>>Dr. {{$physician->user_fname}} {{$physician->user_mname}} {{$physician->user_lname}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                  <a class="btn btn-danger text-light" data-dismiss="modal">Cancel</a>
                                  <button type="submit" id="btnSubmit2" name="addappointment" class="btn btn-primary">Submit</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End Edit Modal -->


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