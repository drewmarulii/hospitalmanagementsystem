@extends('layout')


@section('title')
<a href="{{ url('addappointment') }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
        <h1><span class="h5 text-success"> /</span> Appointment Card</h1>
@endsection


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
                
            <div class="card">
            <div class="card-body">
                <div>
                    <img src="{{ asset('dist/img/logo.png') }} " class="brand-image">
                    <span class="brand-text font-weight-light"><strong> Adventist Hospital</strong> | Appointment Card</span>
                </div>
                <hr class="hr hr-blurry" style="border: none; border-bottom: 2px solid gray;" />

                <?php 
                if($appointment->APPOINTMENT_STATUS=='NEW') {
                    $bgColor = 'bg-primary';
                } elseif($appointment->APPOINTMENT_STATUS=='PROGRESS') {
                    $bgColor = 'bg-warning';
                } elseif($appointment->APPOINTMENT_STATUS=='WAIT_MEDICINE') {
                    $bgColor = 'bg-info';
                }
                ?>
                <div class="row mb-3">
                    <div class="col-sm">
                        <h5>{{$appointment->APPOINTMENT_ID}}<span class="float-right {{$bgColor}} p-1">{{$appointment->APPOINTMENT_STATUS}}</span></h5>
                    </div>
                </div>
                    <?php if($patient->PAT_GENDER=="Male") {
                        $title = 'Mr.';
                    } else {
                        $title = 'Mrs.';
                    }?>
                <div class="row">
                    <div class="col-sm-4">
                        <p>Patient</p>
                    </div>
                    <div class="col-sm-8">
                    : {{$title}} {{$patient->PAT_FNAME}} {{$patient->PAT_LNAME}} 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-8">
                    : <?php echo(date('d M Y', strtotime($appointment->APP_DATE))); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p>Physician</p>
                    </div>
                    <div class="col-sm-8">
                    <p class="mb-0">: Dr. {{$doctor->user_fname}} {{$doctor->user_mname}} {{$doctor->user_lname}}<p>
                    <small class="ml-2">{{$poly->poly_name}}</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p>Room</p>
                    </div>
                    <div class="col-sm-8">
                    : {{$doctor->user_room}}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm">
                    <a href="{{url('/Appointment/'.$appointment->APPOINTMENT_ID.'/PDF')}}" type="button" class="btn btn-outline-primary float-right" target="_blank">Print</a>
                    <a href="{{ url('/sendpatient/'.$appointment->APPOINTMENT_ID.'/appointment') }}" type="button" class="btn btn-outline-dark mr-2 float-right">Send Email</a>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <p class="ml-1">Other Action:</p>
                    <div class="col-sm">
                    <a href="{{url('addappointment')}}">
                    <div class="card bg-primary">
                    <div class="card-body">
                        Create Appointment
                    </div>
                    </div>
                    </a>
                    </div>
                    <div class="col-sm">
                    <a href="{{url('addpatient')}}">
                    <div class="card bg-primary">
                    <div class="card-body">
                        Patient Registration
                    </div>
                    </div>
                    </a>
                    </div>
                    <div class="col-sm">
                    <a href="{{url('appointment')}}">
                    <div class="card bg-primary">
                    <div class="card-body">
                        Manage Appointment
                    </div>
                    </div>
                    </a>
                    </div>
                    <div class="col-sm">
                    <a href="{{url('physician')}}">
                    <div class="card bg-primary">
                    <div class="card-body">
                       Pysician Information
                    </div>
                    </div>
                    </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection