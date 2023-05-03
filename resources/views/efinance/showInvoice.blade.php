@extends('layout')

@section('title')
<a href="{{ url('/mnginvoices') }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
<h1><span class="text-success h5">{{$invoice->INVOICE_ID}} / </span>Invoice</h1>
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
                <div class="col-8">

                <div class="card">
                <div class="card-body">
                <div>
                    <img src="{{ asset('dist/img/logo.png') }} " class="brand-image">
                    <span class="brand-text font-weight-light"><strong> Adventist Hospital</strong> Invoice</span>
                    @if($invoice->INVOICE_STATUS=="WAITING-PAYMENT")
                    <a type="button" class="btn btn-outline-success float-right text-success" data-toggle="modal" data-target="#exampleModal">Add Payment</a>
                    @include('layout.modal-finance.addpayment')
                    @endif
                    <a href="{{url('/Invoice/'.$invoice->INVOICE_ID.'/PDF')}}" type="button" class="btn btn-outline-primary float-right mr-2" target="_blank">Export PDF</a>
                </div>
                <hr class="hr hr-blurry" style="border: none; border-bottom: 2px solid gray;" />

                <div class="row">

                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title"><b>Invoice</b></h5>
                        </div>
                    </div>
                <!-- Start -->
                <div class="row">
                    <div class="col">
                    <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0"> Invoice ID</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="mb-0">: {{$invoice->INVOICE_ID}}</p>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Invoice Date</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0">: <?php echo(date('d M Y', strtotime($invoice->INVOICE_DATE))); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Invoice Status</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0">: {{$invoice->INVOICE_STATUS}}</p>
                        </div>
                    </div>
                    <br>
                    </div>
                </div>
                <!-- End -->
                </div>
                <div class="col text-right">

                <div class="row ">
                    <div class="col text-right">
                        <div class="row">
                            <h5 class="card-title text-right"><b>Patient Information</b></h5>
                            <p class="mb-0">{{$patientDetail->PATIENT_ID}}</p>
                        </div>
                        <div class="row">
                            <p class=" mb-0">{{$patientDetail->PAT_FNAME}} {{$patientDetail->PAT_MNAME}} {{$patientDetail->PAT_LNAME}}</p>
                        </div>
                        <div class="row">
                            <p class=" mb-0">0{{$patientDetail->PAT_PHONENUMBER}}</p>
                        </div>
                        <div class="row">
                            <p class=" mb-0">{{$patientDetail->PAT_ADDRESS}}</p>
                        </div>
                        <div class="row">
                            <p class=" mb-0">{{$patientDetail->PAT_CITY}}, {{$patientDetail->PAT_COUNTRY}}</p>
                        </div>
                    </div>
                </div>

                </div>
                </div>
                <hr class="hr hr-blurry" style="border: none; border-bottom: 1px solid gray;" />
                    <p class="mt-3 mb-3 h5">Invoice Item</p>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col" style="width:5%;"></th>
                        <th scope="col">ITEM</th>
                        <th class="text-right" scope="col"  style="width:20%;">Sub-Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($itemBill as $itBill)
                        <tr>
                        <th scope="row" class="text-center">{{$i}}</th>
                        <td>{{$itBill->ITEM_NAME}}</td>
                        <td class="text-right">@money($itBill->ITEM_PRICE)</td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                    </table>    

                    <p class="mt-3 mb-3 h5">Treatment Bill</p>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col" style="width:5%;"></th>
                        <th scope="col">TREATMENT</th>
                        <th class="text-right" scope="col"  style="width:20%;">Sub-Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($treatmentBill as $trBill)
                        <tr>
                        <th scope="row" class="text-center">{{$i}}</th>
                        <td>{{$trBill->TREATMENT_NAME}}</td>
                        <td class="text-right">@money($trBill->TREATMENT_PRICE)</td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                    </table>            

                    <p class="mt-3 mb-3 h5">Medicine Bill</p>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col" style="width:5%;"></th>
                        <th scope="col">MEDICINE</th>
                        <th scope="col" class="text-center" style="width:5%;">QUANTITY</th>
                        <th scope="col" class="text-right"   style="width:20%;">PRICE</th>
                        <th class="text-right" scope="col"  style="width:20%;">Sub-Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($medicineBill as $medBill)
                        <tr>
                        <th scope="row" class="text-center">{{$i}}</th>
                        <td>{{$medBill->MEDICINE_NAME}}</td>
                        <td class="text-center">{{$medBill->QUANTITY}} {{$medBill->MED_PACKTYPE}}</td>
                        <td class="text-right">@money($medBill->MED_PRICE)</td>
                        <td class="text-right">@money(($medBill->MED_PRICE)*($medBill->QUANTITY))</td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                    </table>   
                    
                    <table class="mt-3 table table-borderless bg-dark">
                    <tbody>
                        <tr>
                        <td class="text-right"><strong>Total Price</strong></td>
                        <td class="text-right" style="width:20%;">@money($totalprice)</td>
                        </tr>
                    </tbody>
                    </table>   
                </div>
                </div>

                </div>
                <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        @if($invoice->INVOICE_STATUS=='PAID')
                        <div>
                            <img src="{{ asset('dist/img/logo.png') }} " class="brand-image">
                            <span class="brand-text font-weight-light"><strong> Adventist Hospital</strong> Receipt</span>
                            <a href="{{url('/Payment/'.$payment->PAYMENT_ID.'/PDF')}}" type="button" class="btn btn-outline-primary float-right mr-2" target="_blank">Print</a>
                        </div>
                        <hr class="hr hr-blurry" style="border: none; border-bottom: 2px solid gray;" />
                        <!-- Start -->
                            <div class="row">
                                <div class="col">
                                <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0"> Payment ID</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0">: {{$payment->PAYMENT_ID}}</p>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="mb-0">Date</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="mb-0">: <?php echo(date('d M Y', strtotime($invoice->INVOICE_DATE))); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="mb-0">Status</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="mb-0">: {{$invoice->INVOICE_STATUS}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="mb-0">Method</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="mb-0">: {{$payment->PAYMENT_METHOD}}</p>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="mb-0">Bill Amount</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-0 text-right text-danger">@money($invoice->INVOICE_AMOUNT)</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="mb-0">Amount Paid</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-0 text-right text-success">@money($payment->AMOUNT_PAID)</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="mb-0">Exchange</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-0 text-right">@money($payment->EXCHANGE)</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @else
                                Receipt has not been generated
                            @endif
                    </div>
                    </div>
                    @if($invoice->INVOICE_STATUS=='PAID')
                    <div class="card">
                    <div class="card-body">
                        @if($payment->PAYMENT_PROOF_FILE)
                        <a type="button" class="btn btn-warning float-right mb-2" data-toggle="modal" data-target="#updatePayment-{{$payment->PAYMENT_ID}}">Update Payment</a>
                        <p>Proof of Payment:</p>
                        @include('layout.modal-finance.addpayment')
                        <img class="clickable-image img-thumbnail" src="{{ asset('uploads/payment/'.$payment->PAYMENT_PROOF_FILE) }}" alt="Thumbnail Image" data-src="{{ asset('uploads/payment/'.$payment->PAYMENT_PROOF_FILE) }}">
                        @endif
                    </div>
                    </div>
                    @endif
                   

                </div>
                
            </div>

            <script>
    $(document).ready(function() {
        $('.clickable-image').click(function() {
            var fullsizeUrl = $(this).data('src');
            $('.fullsize-image').attr('src', fullsizeUrl);
            $('.fullsize-image').show();
        });
        $('.fullsize-image').click(function() {
            $(this).hide();
        });
    });
</script>

            
        
            

            </div>
        </div>
    </div>
</div>
@endsection