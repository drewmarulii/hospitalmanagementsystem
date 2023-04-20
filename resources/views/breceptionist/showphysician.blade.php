@extends('layout')


@section('title')
<a href="{{ url()->previous() }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
    @foreach($physician as $physicians)
        <h1><span class="h5 text-success">{{$physicians->userid}} /</span> Physician Information</h1>
    @endforeach
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="row">

              <div class="col-5">
                <!-- Profile Card -->
                <div class="card">
                  <div class="card-header bg-dark text-center">
                    Physician Profile Information
                  </div>
                  @foreach($physician as $physicians)
                  <div class="card-body text-center">
                    <div class="row">
                      <div class="col-4">
                            @if($physicians->user_pp)
                            <img src="{{ asset('uploads/users/'.$physicians->user_pp ) }}" alt="avatar"
                              class="mb-4 img-thumbnail" style="width: 150px; height: 150px; ">
                            @else
                            <img src="{{ asset('uploads/users/nopic.png') }}" alt="avatar"
                              class="mb-4 img-thumbnail" style="width: 150px; height: 150px; ">
                            @endif
                      </div>
                      <div class="col-8 text-left">
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0">ID</p>
                              </div>
                              <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$physicians->userid}}</p>
                              </div>
                            </div>
                            <hr class="mt-1">
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0">Name</p>
                              </div>
                              <div class="col-sm-9">
                                <p class="text-muted mb-0">Dr. {{$physicians->user_fname}} {{$physicians->user_mname}} {{$physicians->user_lname}}</p>
                              </div>
                            </div>
                            <hr class="mt-1">
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                              </div>
                              <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$physicians->email}}</p>
                              </div>
                            </div>
                            <hr class="mt-1">
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0">Room</p>
                              </div>
                              <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$physicians->user_room}}</p>
                              </div>
                            </div>
                            <hr class="mt-1">
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0">Poly</p>
                              </div>
                              <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$physicians->poly_name}}</p>
                              </div>
                            </div>
                            <hr class="mt-1">
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                <!-- End Profile Card -->
                <!-- Action Card -->
                <div class="row">

                  <div class="col-sm">
                    <div class="small-box bg-primary">
                      <div class="inner">
                      <h4>50</h4>
                        <p>New Appointment</p>
                      </div>
                      <div class="icon">
                      <i class="ion ion-android-people"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm">
                  <div class="small-box bg-info">
                    <div class="inner">
                    <h4>50</h4>
                      <p>On-Treatment</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-people"></i>
                    </div>
                  </div>
                  </div>

                </div>        

                <div class="row">

                  <div class="col-sm">
                    <div class="small-box bg-primary">
                      <div class="inner">
                      <h4>50</h4>
                        <p>New Appointment</p>
                      </div>
                      <div class="icon">
                      <i class="ion ion-android-people"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm">
                  <div class="small-box bg-info">
                    <div class="inner">
                    <h4>50</h4>
                      <p>On-Treatment</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-people"></i>
                    </div>
                  </div>
                  </div>

                </div>  
                <!-- End Action Card -->

              </div>

              <div class="col-7">
                <div class="card">
                  <div class="card-body">

                  <table id="phyAppTable" class="table table-striped" style="width:100%">
                    <thead class="bg-dark" style="width: 100%;">
                        <tr>
                            <th>Appointment ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Patient</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appcard as $appointments) 
                        <tr>
                            <td>{{$appointments->APPOINTMENT_ID}}</td>
                            <td>{{$appointments->APP_DATE}}</td>
                            <td>{{$appointments->APPOINTMENT_STATUS}}</td>
                            <td>{{$appointments->PAT_FNAME}} {{$appointments->PAT_MNAME}} {{$appointments->PAT_LNAME}}</td>
                            <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-{{ $appointments->APPOINTMENT_ID }}">
                              <i class="fas fa-eye"></i>
                            </button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="modal-{{ $appointments->APPOINTMENT_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                      <p class="mb-0"><strong>POLYCLINIC</strong></p>
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
    </div>
@endsection