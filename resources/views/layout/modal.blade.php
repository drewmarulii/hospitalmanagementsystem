<!-- Modal -->
<div class="modal fade" id="medRecApp-{{$record->RECORD_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header bg-success">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Medical Certificate {{$record->RECORD_ID}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

        <div class="card">
        <div class="card-body">
            <div>
                <img src="{{ asset('dist/img/logo.png') }} " class="brand-image">
                <span class="brand-text font-weight-light"><strong> Adventist Hospital</strong> Medical Record</span>
                <button type="button" class="btn btn-outline-primary float-right">Export PDF</button>
                <button type="button" class="btn btn-outline-dark float-right mr-2">Send Email</button>
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

                        <!-- End Table Treatment Received    -->
                    </div>
                    <div class="col">
                        <!-- Table Medicine Prescription    -->

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

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Email</button>
        </div>
        </div>
    </div>
</div>
<!-- End Modal -->