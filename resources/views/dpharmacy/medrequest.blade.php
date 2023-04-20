@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Medicine Prescription</h1>
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

                <div class="col-sm">
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h4>50</h4>
                    <p>Cancelled</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-android-people"></i>
                    </div>
                </div>
                </div>

                <div class="col-sm">
                <div class="small-box bg-success">
                    <div class="inner">
                    <h4>50</h4>
                    <p>Finished</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-android-people"></i>
                    </div>
                </div>
                </div>
                
                </div>
                <!-- End Summary Card -->


                <div class="card">
                    <div class="card-header">
                        Medicine Request List
                    </div>
                <div class="card-body">
                    <table id="medicineOrder" class="table table-striped" style="width:100%">
                        <thead class="bg-light" style="width: 100%;">
                            <tr>
                                <th></th>
                                <th>Record ID</th>
                                <th>Date</th>
                                <th>PAT ID</th>
                                <th>Patient</th>
                                <th>AppointmentID</th>
                                <th>Physician</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($orderMed as $medItems)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$medItems->RECORD_ID}}</td>
                                <td><?php echo(date('d M Y', strtotime($medItems->APP_DATE))); ?></td>
                                <td>{{$medItems->PATIENTID}}</td>
                                <td>{{$medItems->PAT_FNAME}} {{$medItems->PAT_MNAME}} {{$medItems->PAT_LNAME}}</td>
                                <td>
                                    @if($medItems->APPOINTMENT_STATUS =='FINISH')         
                                    <a type="button" class="btn btn-success btn-sm text-light" data-toggle="modal" data-target="#modal-{{$medItems->APPOINTMENT_ID }}">
                                        {{$medItems->APPOINTMENT_ID}}
                                    </a>
                                    @elseif($medItems->APPOINTMENT_STATUS =='FIN-UNPAID')         
                                    <a type="button" class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal-{{$medItems->APPOINTMENT_ID }}">
                                        {{$medItems->APPOINTMENT_ID}}
                                    </a>
                                    @elseif($medItems->APPOINTMENT_STATUS =='PROGRESS')         
                                    <a type="button" class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#modal-{{$medItems->APPOINTMENT_ID }}">
                                        {{$medItems->APPOINTMENT_ID}}
                                    </a>  
                                    @elseif($medItems->APPOINTMENT_STATUS =='NEW')         
                                    <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal-{{$medItems->APPOINTMENT_ID }}">
                                        {{$medItems->APPOINTMENT_ID}}
                                    </a>  
                                    @endif
                                </td>
                                <td>Dr. {{$medItems->user_fname}} {{$medItems->user_mname}} {{$medItems->user_lname}}</td>
                                <td>
                                    <a href="{{ url('/medOrderID/'.$medItems->RECORD_ID) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-pen"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <!-- Modal -->
                      <div class="modal fade bd-example-modal-lg" id="modal-{{ $medItems->APPOINTMENT_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                      <p class="mb-0">: {{$medItems->APPOINTMENT_STATUS}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>ID</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$medItems->APPOINTMENT_ID}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PATIENT</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$medItems->PATIENTID}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PAT. NAME</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$medItems->PAT_FNAME}} {{$medItems->PAT_MNAME}} {{$medItems->PAT_LNAME}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>DATE</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$medItems->APP_DATE}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PHYSICIAN</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: Dr. {{$medItems->user_fname}} {{$medItems->user_mname}} {{$medItems->user_lname}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End Modal -->
                          <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                

            </div>
        </div>
    </div>
</div>
          
@endsection