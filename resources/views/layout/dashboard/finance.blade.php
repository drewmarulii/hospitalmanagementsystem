@extends('layout')

@section('title')
    @include('layout.dashboard.title')
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
            <div class="small-box bg-dark">
                <div class="inner">
                <h4>{{$waitInvoice->count()}}</h4>
                <p>Waiting Invoices</p>
                </div>
                <div class="icon">
                <i class="ion ion-android-people"></i>
                </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-primary">
            <div class="inner">
                <h4>{{$invoice->count()}}</h4>
                <p>Total Invoices</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-warning">
            <div class="inner">
            <h4>{{$unpaidInvoice->count()}}</h4>
                <p>Unpaid Invoices</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-success">
            <div class="inner">
            <h4>{{$paidInvoice->count()}}</h4>
                <p>Paid Invoices</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="icon">
            <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            </div>
            <!-- End Summary Card -->

            
            </div>
        </div>
    </div>
</div>
@endsection

