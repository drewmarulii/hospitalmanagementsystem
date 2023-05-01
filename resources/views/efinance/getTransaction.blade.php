@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Create Invoice</h1>
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

            <div class="card">
                <div class="card-body">
                    <table id="medicineOrder" class="table table-striped" style="width:100%">
                        <thead class="bg-light" style="width: 100%;">
                            <tr>
                                <th></th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Appointment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Physician</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($transaction as $detail)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$detail->PATIENT_ID}}</td>
                                <td>{{$detail->PAT_FNAME}} {{$detail->PAT_MNAME}} {{$detail->PAT_LNAME}}</td>
                                <td>
                                    @if($detail->APPOINTMENT_STATUS =='FINISH')         
                                    <a type="button" class="btn btn-success btn-sm text-light" data-toggle="modal" data-target="#modal-{{$detail->APPOINTMENT_ID }}">
                                        {{$detail->APPOINTMENT_ID}}
                                    </a>
                                    @elseif($detail->APPOINTMENT_STATUS =='FIN-UNPAID')         
                                    <a type="button" class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal-{{$detail->APPOINTMENT_ID }}">
                                        {{$detail->APPOINTMENT_ID}}
                                    </a>  
                                    @elseif($detail->APPOINTMENT_STATUS =='PROGRESS')         
                                    <a type="button" class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#modal-{{$detail->APPOINTMENT_ID }}">
                                        {{$detail->APPOINTMENT_ID}}
                                    </a>  
                                    @elseif($detail->APPOINTMENT_STATUS =='NEW')         
                                    <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal-{{$detail->APPOINTMENT_ID }}">
                                        {{$detail->APPOINTMENT_ID}}
                                    </a>  
                                    @endif
                                </td>
                                <td>{{$detail->APPOINTMENT_STATUS}}</td>
                                <td><?php echo(date('d M Y', strtotime($detail->APP_DATE))); ?></td>
                                <td>Dr. {{$detail->user_fname}} {{$detail->user_lname}}</td>
                                <td>
                                    <a href="{{ url('/createInvoice/'.$detail->PATIENT_ID.'/'.$detail->RECORD_ID) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Create Invoice</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="modal-{{ $detail->APPOINTMENT_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <p class="mb-0">: {{$detail->APPOINTMENT_STATUS}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                            <p class="mb-0"><strong>ID</strong></p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="mb-0">: {{$detail->APPOINTMENT_ID}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                            <p class="mb-0"><strong>PATIENT</strong></p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="mb-0">: {{$detail->PATIENT_ID}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                            <p class="mb-0"><strong>PAT. NAME</strong></p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="mb-0">: {{$detail->PAT_FNAME}} {{$detail->PAT_MNAME}} {{$detail->PAT_LNAME}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                            <p class="mb-0"><strong>DATE</strong></p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="mb-0">: <?php echo(date('d M Y', strtotime($detail->APP_DATE))); ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                            <p class="mb-0"><strong>PHYSICIAN</strong></p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="mb-0">: Dr. {{$detail->user_fname}} {{$detail->user_mname}} {{$detail->user_lname}}</p>
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