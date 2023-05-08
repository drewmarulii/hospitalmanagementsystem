@extends('layout')

@section('title')
<a href="{{ url('/invoices') }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
@foreach($transaction as $medDetail)
<h1><span class="text-success h5">{{$medDetail -> PATIENT_ID}} / </span>Create Invoice</h1>
@endforeach
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
                Create Invoice
            </div>
            <div class="card-body">

                <!-- Order Information -->
                <div class="row">
                    <div class="col">
                    @foreach($transaction as $medDetail)
                    <!-- Start -->
                    <div class="row">
                        <div class="col">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title"><span class="text-success h6">| </span><b>Medical Detail</b></h5>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0"> Physician</p>
                        </div>
                        <div class="col-sm-9">
                            
                            <p class="mb-0">: Dr. {{$medDetail->user_fname}} {{$medDetail->user_mname}} {{$medDetail->user_lname}}</p>

                        </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Date</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0">: <?php echo(date('d M Y', strtotime($medDetail->APP_DATE))); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">AppID</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0">: 
                                    <a href="" data-toggle="modal" data-target="#modal-{{$medDetail->APPOINTMENT_ID}}">{{$medDetail->APPOINTMENT_ID}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Status</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0">: {{$medDetail->APPOINTMENT_STATUS}}</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- End -->
                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="modal-{{$medDetail->APPOINTMENT_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <p class="mb-0">: {{$medDetail->APPOINTMENT_STATUS}}</p>
                                </div>
                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><strong>ID</strong></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">: {{$medDetail->APPOINTMENT_ID}}</p>
                                </div>
                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><strong>PATIENT</strong></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">: {{$medDetail->PATIENT_ID}}</p>
                                </div>
                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><strong>PAT. NAME</strong></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">: {{$medDetail->PAT_FNAME}} {{$medDetail->PAT_MNAME}} {{$medDetail->PAT_LNAME}}</p>
                                </div>
                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><strong>DATE</strong></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">: <?php echo(date('d M Y', strtotime($medDetail->APP_DATE))); ?></p>
                                </div>
                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><strong>PHYSICIAN</strong></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">: Dr. {{$medDetail->user_fname}} {{$medDetail->user_mname}} {{$medDetail->user_lname}}</p>
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
                    <p class="mb-0">{{ $medDetail -> PATIENT_ID }}</p>
                    </div>
                    <div class="row">
                        <p class=" mb-0">{{$medDetail->PAT_FNAME}} {{$medDetail->PAT_MNAME}} {{$medDetail->PAT_LNAME}}</p>
                    </div>
                    <div class="row">
                        <p class=" mb-0">0{{ $medDetail -> PAT_PHONENUMBER }} </p>
                    </div>
                    <div class="row">
                        <p class=" mb-0">{{ $medDetail -> PAT_ADDRESS }} {{ $medDetail -> PAT_CITY }}, {{ $medDetail -> PAT_COUNTRY }}</p>
                    </div>
                    <!-- End -->
                    @endforeach
                    </div>
                </div>
                <!-- End Order Information -->
            </div>
            </div>

            <div class="card">
            <div class="card-body">
            <span class="text-success">| </span><strong>Treatment Received</strong>
                <hr class="mb-0">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col" style="width:5%;"></th>
                    <th scope="col" style="width:15%;">Treceived ID</th>
                    <th scope="col">Treatment ID</th>
                    <th scope="col" style="width:35%;">Treatment Name</th>
                    <th class="text-right" scope="col">Sub-Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach($treatement as $detail)
                    <tr>
                    <th class="text-center" scope="row">{{$i}}</th>
                    <?php $i++ ?>
                    <td>{{$detail->TRECEIVED_ID}}</td>
                    <td>{{$detail->TREATMENT_ID}}</td>
                    <td>{{$detail->TREATMENT_NAME}}</td>
                    <td class="text-right" style="width:15%;">@money($detail->TREATMENT_PRICE)</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>

            <div class="card">
            <div class="card-body">
            <span class="text-success">| </span><strong>Medicine Order</strong>
                <hr class="mb-0">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col" style="width:5%;"></th>
                    <th scope="col" style="width:15%;">Medicine ID</th>
                    <th scope="col">Medicine Name</th>
                    <th class="text-center" scope="col" style="width:10%;">Status</th>
                    <th class="text-center" scope="col" style="width:10%;">QTY</th>
                    <th class="text-right" scope="col" style="width:15%;">Item Price</th>
                    <th class="text-right" scope="col" style="width:15%;">Sub-Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1 ?>
                    @foreach($medicine as $detail)
                    <tr>
                    <th class="text-center" scope="row">{{$i}}</th>
                    <?php $i++ ?>
                    <td>{{$detail->MEDICINE}}</td>
                    <td>{{$detail->MEDICINE_NAME}}</td>
                    <td class="text-center">{{$detail->ORD_STATUS}}</td>
                    <td class="text-center">{{$detail->QUANTITY}} {{$detail->MED_PACKTYPE}}</td>
                    <td class="text-right">@money($detail->MED_PRICE)</td>
                    <td class="text-right">@money(($detail->MED_PRICE)*($detail->QUANTITY))</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
            @foreach($transaction as $medDetail)
            <form name="addmedicalrecord" id="myForm"  method="POST" enctype="multipart/form-data" action="{{ url('/invoices/'.$medDetail->PATIENT_ID.'/'.$medDetail->RECORD_ID.'/generate') }}">  
            @csrf
            <div class="row">
            <div class="col-8">
                <div class="card">
                <div class="card-body">
                <span class="text-success">| </span><strong>Additional Items:</strong>
                    <hr class="mb-0">
                    <table class="table table-bordered" id="addRemoveInvoice">
                        <tr>
                            <th class="text-center" scope="col" style="width:5%;">
                            <button type="button" name="add" id="dynamic-ar" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                            </th>
                            <th style="width:50%;">Invoice Item<span class="text-danger"> *</span></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <select class="form-select" name="ITEM_ID[0]" id="addMoreInputFields[0][item]" aria-label="Default select example" required>
                                <option disabled selected>Additional Item</option>
                                @foreach($item as $additem)
                                <option value="{{$additem->ITEM_ID}}">{{$additem->ITEM_NAME}}</option>
                                @endforeach
                                </select>
                            </td>
                            <td class="text-right"></td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
            <div class="col-4">
            <div class="card">
                <div class="card-body">
                <span class="text-success">| </span><strong>Summary:</strong>
                    <hr>
                </div>
                <div class="card-footer">
                <!-- Temporary -->
                <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Create an Invoice?');">Submit</button>
                <a href="{{ url('/invoices') }}" class="btn btn-danger mr-2 float-right text-light" onclick="return confirm('Cancel Invoice?');">Cancel</a>
                </form>
                @endforeach
                <!-- Temporary -->
                </div>
                </div>
            </div>
            </div>


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#addRemoveInvoice").append(
            '<tr>'+
                '<td><button type="button" class="btn btn-danger btn-sm remove-input-field"><i class="fa fa-trash"></button></td>'+
                '<td>'+
                    '<select class="form-select" name="ITEM_ID['+ i +']" id="addMoreInputFields['+ i +'][item]" aria-label="Default select example">'+
                    '<option disabled selected>Additional Item</option>'+
                    '@foreach($item as $additem)'+
                    '<option value="{{$additem->ITEM_ID}}">{{$additem->ITEM_NAME}}</option>'+
                    '@endforeach'+
                    '</select>'+
                '</td>'+
            '</tr>'
          );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection