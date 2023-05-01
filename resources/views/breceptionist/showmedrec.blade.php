@extends('layout')

@section('title')
<a href="{{ url()->previous() }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
    @foreach($medRECORD as $record)
        <h1><span class="h5 text-success">{{$record->RECORD_ID}} /</span> Medical Record</h1>
    @endforeach
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            
    @foreach($medRECORD as $record)
    <div class="card">
        <div class="card-body">
            <div>
                <img src="{{ asset('dist/img/logo.png') }} " class="brand-image">
                <span class="brand-text font-weight-light"><strong> Adventist Hospital</strong> Medical Record</span>
                <a href="{{ url('/MedicalRecord/'.$record->RECORD_ID.'/PDF') }}" type="button" class="btn btn-outline-primary float-right" target="_blank">Download PDF</a>
            </div>
            <hr class="hr hr-blurry" style="border: none; border-bottom: 2px solid gray;" />

            <div class="row">

                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title"><b>Medical Record Information</b></h5>
                        </div>
                    </div>
                    @include('layout.medrec-info')
                </div>
                <div class="col text-right">
                
                <div class="row ">
    
                <div class="col text-right">
                    <div class="row">
                        <h5 class="card-title text-right"><b>Patient Information</b></h5>
                        <p class="mb-0">{{$record->PATIENTID}}</p>
                    </div>

                    <div class="row">
                        <p class=" mb-0">{{$record->PAT_FNAME}} {{$record->PAT_MNAME}} {{$record->PAT_LNAME}}</p>
                    </div>

                    <div class="row">
                        <p class=" mb-0">0{{$record->PAT_PHONENUMBER}}</p>
                    </div>

                    <div class="row">
                        <p class=" mb-0">{{$record->PAT_ADDRESS}} {{$record->PAT_CITY}}, {{$record->PAT_COUNTRY}}</p>
                    </div>
                </div>
            
            </div>
                
                </div>
            </div>

            <div class="row">
            <div class="col-8">
            <!-- Table Complaints and Diagnosis    -->
            <table class="table table-bordered">
            <thead>
                <tr>
                <th  colspan="1">Patient Complaints</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td scope="row">{{$record->MEDREC_COMPLAINTS}} </td>
                </tr>
            </tbody>
            </table> 
            <!-- End Table Complaints and Diagnosis    -->  
            <!-- Table Complaints and Diagnosis    -->
            <table class="table table-bordered">
            <thead>
                <tr>
                <th colspan="1">Physician Diagnosis & Medical Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td scope="row">{{$record->MEDREC_COMPLAINTS}} </td>
                </tr>
            </tbody>
            </table> 
            <!-- End Table Complaints and Diagnosis    -->
            
                <div class="row">
                    <div class="col">
                        <!-- Table Treatment Received    -->
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th colspan="1">Treatment Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($treatREC as $treatment)
                            <tr>
                            <td scope="row">
                                <p class="mb-3">{{$treatment->TREATMENT_NAME}}</p>
                                <footer class="blockquote-footer mb-0">Description: <?php if($treatment->TREATMENT_DESC) echo $treatment->TREATMENT_DESC; else echo '<i>No Description</i>';?></footer>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table> 
                        <!-- End Table Treatment Received    -->
                    </div>
                    <div class="col">
                        <!-- Table Medicine Prescription    -->
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th colspan="1">Medicine Prescription</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicineREC as $medicine)
                            <tr>
                            <td scope="row">
                                <p class="mb-3">{{$medicine->MEDICINE_NAME}}</p>
                                <footer class="blockquote-footer mb-0">Quantity: {{$medicine->QUANTITY}} {{$medicine->MED_PACKTYPE}} | Instruction: {{$medicine->INSTRUCTION}}</footer>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table> 
                        <!-- End Table Medicine Prescription    -->
                    </div>
                </div>

            </div>
            <div class="col-4">
            <!-- Table Vital Sign    -->
            <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="2">Vital Sign Record</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Weight</td>
                <td>{{$record->VS_WEIGHT}} kg</td>
            </tr>
            <tr>
                <td>Height</td>
                <td>{{$record->VS_HEIGHT}} cm</td>
            </tr>
            <tr>
                <td>Temperature</td>
                <td>{{$record->VS_TEMPERATURE}} &#8451;</td>
            </tr>
            <tr>
                <td>Heartrate</td>
                <td>{{$record->VS_HEARTRATE}} /min</td>
            </tr>
            <tr>
                <td>Blood Pressure</td>
                <td>{{$record->VS_SYSTOLIC}}/{{$record->VS_DIASTOLIC}} mmHg</td>
            </tr>
            <tr>
                <td>Respiration</td>
                <td>{{$record->VS_RESPIRATION}} /min</td>
            </tr>
            </tbody>
            </table>
            <!-- End Table Vital Sign -->
            </div>
            </div>

        </div>
    </div>
    @endforeach

            </div>
        </div>
    </div>
</div>
@endsection