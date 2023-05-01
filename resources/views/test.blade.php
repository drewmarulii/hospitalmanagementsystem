@extends('layout')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            <div class="card">
            <div class="card-body">
            <div>
                <img src="{{ asset('dist/img/logo.png') }} " class="brand-image">
                <span class="brand-text font-weight-light"><strong> Adventist Hospital</strong> | Appointment Card</span>
            </div>
            <hr class="hr hr-blurry" style="border: none; border-bottom: 2px solid gray;" />

            <div class="row mb-3">
                <div class="col-sm">
                    <h5><span class="float-right p-1"></span></h5>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <p>Patient</p>
                </div>
                <div class="col-sm-8">
                : 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <p>Date</p>
                </div>
                <div class="col-sm-8">
                : 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <p>Physician</p>
                </div>
                <div class="col-sm-8">
                <p class="mb-0">: Dr. <p>
                <small class="ml-2"></small>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <p>Room</p>
                </div>
                <div class="col-sm-8">
                : 4
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm">
                <a href="" type="button" class="btn btn-outline-primary float-right">Print</a>
                <a href="" type="button" class="btn btn-outline-dark mr-2 float-right">Send Email</a>
                </div>
            </div>
            </div>
            </div>
            </div>
      

            </div>
        </div>
    </div>
</div>
@endsection