@extends('layout')

@section('title')
<a href="{{ url('/patient/') }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
<h1><span class="text-success h5">{{$patient->PATIENT_ID}} / </span>Patient Information</h1>
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

        <div class="row">
          <div class="col-4">
          
          <!-- Card Patient Information -->
          <div class="card">
            <div class="card-header bg-dark">
              Patient Profile Information
              <a class="btn-sm float-right mb" href="{{ url('/patient/'.$patient->PATIENT_ID.'/edit') }}" role="button" aria-pressed="true">
                <strong><i class="far fa-edit"></i></strong>
              </a>
              <a href="{{ url('/sendpatient/'.$patient->PATIENT_ID) }}" class="btn-sm float-right mb mr-2" role="button" aria-pressed="true"
              onclick="return confirm('Send Patient Card through Email?');">
                <i class="fas fa-share"></i>
              </a>
            </div>
            <div class="card-body">
              @include('layout.patient-info-show')
            </div>
          </div>
          <!-- End Card Patient Information -->
            <div class="row">
              @include('layout.sum-card-show-patient')
            </div>
          </div>
          <div class="col-8">

          <div class="card">
            <div class="card-header bg-success">
              Medical Record
              <span class="float-right">Total: <strong>{{$medRECORD->count()}}</strong></span>
            </div>
            <div class="card-body">
              <table id="patRecTable" class="table table-striped" style="width:100%">
                <thead style="width: 100%;">
                    <tr>
                        <th>Record ID</th>
                        <th>Doctor</th>
                        <th>Record Date</th>
                        <th style="width: 20px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medRECORD as $record) 
                    <tr>
                        <td>{{$record->RECORD_ID}}</td>
                        <td>{{$record->user_fname}} {{$record->user_mname}} {{$record->user_lname}}</td>
                        <td><?php echo(date('d M Y', strtotime($record->MEDREC_DATE))); ?></td>
                        <td>                          
                          <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#medRECORD-{{$record->RECORD_ID}}">
                            <i class="fas fa-eye"></i>
                          </a>
                        </td>
                    </tr>
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
                              <a href="{{ url('/patient/'.$record->PATIENT_ID.'/medicalRecord/'.$record->RECORD_ID) }}" type="button" class="btn btn-primary">View Details</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--End Modal -->
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="card">
            <div class="card-header bg-warning">
              Appointments
              <span class="float-right">Total: <strong>{{$appointment->count()}}</strong> | New: <strong>{{$new->count()}}</strong> | Finish: <strong>{{$finish->count()}}</strong> | In-Progress: <strong>{{$inProgress->count()}}</strong> </span>
            </div>
            <div class="card-body">
            <table id="patAppTable" class="table table-striped" style="width:100%">
                <thead style="width: 100%;">
                    <tr>
                        <th>Appointment ID</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="width: 20px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointment as $app) 
                    <tr>
                        <td>{{$app->APPOINTMENT_ID}}</td>
                        <td>{{$app->user_fname}} {{$app->user_mname}} {{$app->user_lname}}</td>
                        <td><?php echo(date('d M Y', strtotime($app->APP_DATE))); ?></td>
                        <td>{{$app->APPOINTMENT_STATUS}}</td>
                        <td>
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal1-{{$app->APPOINTMENT_ID}}">
                              <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                          <!-- Modal -->
                          <div class="modal fade bd-example-modal-lg" id="modal1-{{$app->APPOINTMENT_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-warning">
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
                                      <p class="mb-0">: {{$app->APPOINTMENT_STATUS}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>ID</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$app->APPOINTMENT_ID}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PATIENT</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$app->PATIENTID}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PAT. NAME</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: {{$app->PAT_FNAME}} {{$app->PAT_MNAME}} {{$app->PAT_LNAME}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>DATE</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: <?php echo(date('d M Y', strtotime($app->APP_DATE))); ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0"><strong>PHYSICIAN</strong></p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="mb-0">: Dr. {{$app->user_fname}} {{$app->user_mname}} {{$app->user_lname}}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

          <div class="card">
            <div class="card-header bg-dark">
              Invoices
              <span class="float-right">Total: <strong>{{$appointment->count()}}</strong> | Waiting-Payment: <strong>{{$unpaid->count()}}</strong> </span>
            </div>
            <div class="card-body">
            <table id="patInvTable" class="table table-striped" style="width:100%">
                <thead style="width: 100%;">
                    <tr>
                        <th>Invoice ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="width: 20px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice as $invoiceDetail) 
                    <tr>
                        <td>{{$invoiceDetail->INVOICE_ID}}</td>
                        <td>{{$invoiceDetail->INVOICE_STATUS}}</td>
                        <td><?php echo(date('d M Y', strtotime($invoiceDetail->INVOICE_DATE))); ?></td>
                        <td>                          
                          <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#invoice-{{$invoiceDetail->INVOICE_ID}}">
                            <i class="fas fa-eye"></i>
                          </a>
                        </td>
                    </tr>
                    <!-- Modal Invoice Record-->
                    <div class="modal fade" id="invoice-{{$invoiceDetail->INVOICE_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                      <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-dark">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Invoice <span>[ID: {{$invoiceDetail->INVOICE_ID}}]</span></h5>
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
                                <p class="mb-0">: {{$invoiceDetail->INVOICE_STATUS}}</p>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0"><strong>Amount</strong></p>
                              </div>
                              <div class="col-sm-9">
                                <p class="mb-0">: @money($invoiceDetail->INVOICE_AMOUNT)</p>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0"><strong>PATIENT</strong></p>
                              </div>
                              <div class="col-sm-9">
                                <p class="mb-0">: {{$invoiceDetail->PATIENTID}}</p>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0"><strong>PAT. NAME</strong></p>
                              </div>
                              <div class="col-sm-9">
                                <p class="mb-0">: {{$app->PAT_FNAME}} {{$app->PAT_MNAME}} {{$app->PAT_LNAME}}</p>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-3">
                                <p class="mb-0"><strong>DATE</strong></p>
                              </div>
                              <div class="col-sm-9">
                                <p class="mb-0">: <?php echo(date('d M Y', strtotime($invoiceDetail->INVOICE))); ?></p>

                              </div>
                            </div>
                            <hr>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--End Modal -->
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>

    </div>
  </div>
</div>
@endsection