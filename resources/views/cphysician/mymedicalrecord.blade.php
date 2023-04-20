@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Medical Record</h1>
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
              <div class="card-header border-0">

              <table id="appointmentTable" class="table table-striped" style="width:100%">
                    <thead class="bg-light" style="width: 100%;">
                        <tr>
                            <th></th>
                            <th>Record ID</th>
                            <th>Patient Name</th>
                            <th>Appointment ID</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($medRECORD as $record) 
                    <tr>
                        <td>
                          {{$i}}
                        </td>
                        <td>{{$record->RECORD_ID}}</td>
                        <td>{{$record->PAT_FNAME}} {{$record->PAT_MNAME}} {{$record->PAT_LNAME}}</td>
                        <td>
                          @if($record->APPOINTMENT_STATUS =='FINISH')         
                          <a type="button" class="btn btn-success btn-sm text-light" data-toggle="modal" data-target="#modal-{{$record->APPOINTMENT_ID }}">
                              {{$record->APPOINTMENT_ID}}
                          </a>
                          @elseif($record->APPOINTMENT_STATUS =='FIN-UNPAID')         
                          <a type="button" class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal-{{$record->APPOINTMENT_ID }}">
                              {{$record->APPOINTMENT_ID}}
                          </a> 
                          @elseif($record->APPOINTMENT_STATUS =='PROGRESS')         
                          <a type="button" class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#modal-{{$record->APPOINTMENT_ID }}">
                              {{$record->APPOINTMENT_ID}}
                          </a>  
                          @elseif($record->APPOINTMENT_STATUS =='NEW')         
                          <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal-{{$record->APPOINTMENT_ID }}">
                              {{$record->APPOINTMENT_ID}}
                          </a>  
                          @endif
                        </td>
                        <td><?php echo(date('d M Y', strtotime($record->MEDREC_DATE))); ?></td>
                        <td>                          
                          <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#medRECORD-{{$record->RECORD_ID}}">
                            <i class="fas fa-eye"></i>
                          </a>
                        </td>
                    </tr>
                      <!-- Modal -->
                      <div class="modal fade bd-example-modal-lg" id="modal-{{ $record->APPOINTMENT_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                      <p class="mb-0">: {{$record->APPOINTMENT_STATUS}}</p>
                                    </div>
                                  </div>

                                  <hr>

                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>ID</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$record->APPOINTMENT_ID}}</p>
                                    </div>
                                  </div>

                                  <hr>

                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PATIENT</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$record->PATIENTID}}</p>
                                    </div>
                                  </div>

                                  <hr>

                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PAT. NAME</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$record->PAT_FNAME}} {{$record->PAT_MNAME}} {{$record->PAT_LNAME}}</p>
                                    </div>
                                  </div>

                                  <hr>

                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>DATE</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$record->APP_DATE}}</p>
                                    </div>
                                  </div>

                                  <hr>

                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PHYSICIAN</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: Dr. {{$record->user_fname}} {{$record->user_mname}} {{$record->user_lname}}</p>
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
                          <!-- Modal Medical Record-->
                          <div class="modal fade" id="medRECORD-{{$record->RECORD_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-success">
                                  <h5 class="modal-title" id="exampleModalScrollableTitle">Medical Record <span>[ID: {{$record->RECORD_ID}}]</span></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p class="mb-1"><b>Medical Record Information</b></p>
                                    @include('layout.medrec-info')
                                  <p class="mb-1"><b>Patient Information</b></p>
                                    @include('layout.patient-info-medrec')
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{ url('/myMedicalRecord/'.$record->PATIENT_ID.'/'.$record->RECORD_ID) }}" type="button" class="btn btn-primary">View Details</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--End Modal -->
                    <?php $i++ ?>
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