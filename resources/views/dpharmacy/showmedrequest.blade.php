@extends('layout')

@section('title')
<a href="{{ url('/medOrder') }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
@foreach($orderDetail as $detail)
    <h1><span class="text-success h5">{{$detail->RECORD_ID}}/ </span>Medicine Prescription</h1>
@endforeach
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            <div class="row">
                <div class="col-8">

                <div class="card">
                <div class="card-body">
                    <div>
                        <img src="{{ asset('dist/img/logo.png') }} " class="brand-image">
                        <span class="brand-text font-weight-light"><strong> Adventist Hospital</strong> Medicine Prescription</span>
                        <button type="button" class="btn btn-outline-primary float-right">Export PDF</button>
                        <button type="button" class="btn btn-outline-dark float-right mr-2">Send Email</button>
                    </div>
                    <hr class="hr hr-blurry" style="border: none; border-bottom: 2px solid gray;" />


                    <!-- Order Information -->
                    <div class="row">
                        <div class="col">
                        @foreach($orderDetail as $detail)
                        <!-- Start -->
                        <div class="row">
                            <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title"><b>Order Details</b></h5>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Record ID</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0">: {{$detail->RECORD_ID}}</p>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Date</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">: <?php echo(date('d M Y', strtotime($detail->APP_DATE))); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">AppID</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">: 
                                        <a href="" data-toggle="modal" data-target="#modal-{{$detail->APPOINTMENT_ID }}">{{$detail->APPOINTMENT_ID}}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Physician</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">: Dr. {{$detail->user_fname}} {{$detail->user_mname}} {{$detail->user_lname}}</p>
                                </div>
                            </div>
                            <br>
                            </div>
                        </div>
                        <!-- End -->
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
                                        <p class="mb-0">: {{$detail->PATIENTID}}</p>
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
                                        <p class="mb-0">: {{$detail->APP_DATE}}</p>
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

                        </div>
                        <div class="col text-right">
                        <!-- Start -->
                        <div class="row">
                        <h5 class="card-title text-right"><b>Patient Information</b></h5>
                        <p class="mb-0">{{$detail->PATIENTID}}</p>
                        </div>
                        <div class="row">
                            <p class=" mb-0">{{$detail->PAT_FNAME}} {{$detail->PAT_MNAME}} {{$detail->PAT_LNAME}}</p>
                        </div>
                        <div class="row">
                            <p class=" mb-0">0{{$detail->PAT_PHONENUMBER}} </p>
                        </div>
                        <div class="row">
                            <p class=" mb-0">{{$detail->PAT_ADDRESS}} {{$detail->PAT_CITY}}, {{$detail->PAT_COUNTRY}}</p>
                        </div>
                        <!-- End -->
                        </div>
                    </div>
                    <!-- End Order Information -->
                    @endforeach
                    <!-- Medicine Item -->
                    <div class="row">
                        <div class="col">

                        <div class="row">
                            <h5 class="card-title"><b>Medicine Item</b></h5>
                        </div>

                        <table class="table table-borderless">
                        <thead>
                            <tr>
                            <th class="text-left" scope="col"></th>
                            <th scope="col">Medicine Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Instruction</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                        @foreach($orderMed as $medITEM)
                            <tr>
                            <td class="text-left">{{$i}}</td>
                            <td>{{$medITEM->MEDICINE_NAME}}</td>
                            <td>{{$medITEM->QUANTITY}} {{$medITEM->MED_PACKTYPE}}</td>
                            <td>{{$medITEM->INSTRUCTION}}</td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                        </table>

                        </div>
                    </div>
                    <!-- End Medicine Item -->

                </div>

            </div>

                </div>
                <div class="col-4">
                @foreach($orderPrice as $price)
                <div class="card mb-4">
                <div class="card-body">
                <h5 class="mb-2">Summary</h5>
                    <ul class="list-group list-group-flush">
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Medicine
                        <span>@money($price->TOTAL_PRICE)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        Payment Status
                        <span>Unpaid</span>
                    </li>
                    </ul>
                    <hr>
                    @foreach($orderDetail as $detail)
                    <a href="{{ url('/medOrderID/'.$detail->RECORD_ID.'/preparing') }}" class="btn btn-warning" role="button" aria-pressed="true">Preparing</a>
                    <a href="{{ url('/medOrderID/'.$detail->RECORD_ID.'/release') }}" class="btn btn-success" role="button" aria-pressed="true">Release</a>
                    @endforeach
                </div>
                </div>
                @endforeach
                </div>
            </div>


            </div>
        </div>
    </div>
</div> 
@endsection