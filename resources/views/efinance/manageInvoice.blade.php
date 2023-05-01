@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Invoice Record</h1>
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

            <table id="invoiceTable" class="table table-striped" style="width:100%">
                <thead class="bg-light" style="width: 100%;">
                    <tr>
                        <th></th>
                        <th>Invoice ID</th>
                        <th>Date</th>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1 ?>
                    @foreach($invoice as $detail)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$detail->INVOICE_ID}}</td>
                        <td><?php echo(date('d M Y', strtotime($detail->INVOICE_DATE))); ?></td>
                        <td>{{$detail->PATIENTID}}</td>
                        <td>{{$detail->PAT_FNAME}} {{$detail->PAT_MNAME}} {{$detail->PAT_LNAME}}</td>
                        <td>{{$detail->INVOICE_STATUS}}</td>
                        <td class>
                            <a href="{{url('/showInvoice/'.$detail->PATIENTID.'/'.$detail->INVOICE_ID.'/show')}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">View</a>
                        </td>
                    </tr>
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