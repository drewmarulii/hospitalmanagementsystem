<!-- Start -->
<div class="row"> 
    <div class="col">
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">ID</p>
        </div>
        <div class="col-sm-9">
            <p class="mb-0">: {{$record->PATIENTID}}</p>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Name</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: {{$record->PAT_FNAME}} {{$record->PAT_MNAME}} {{$record->PAT_LNAME}}</p>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Religion</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: {{$record->PAT_RELIGION}}</p>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Citizen ID</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: {{$record->PAT_CITIZEN_ID}}</p>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Birth</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: <?php echo(date('d M Y', strtotime($record->PAT_DOB))); ?></p>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Marital</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: {{$record->PAT_MARITALSTAT}}</p>
        </div>
        </div>
    </div>

    <div class="col">
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Job</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: {{$record->PAT_OCCUPATION}}</p>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Phone</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: 0{{$record->PAT_PHONENUMBER}}</p>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Email</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: {{$record->PAT_EMAIL}}</p>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Address</p>
        </div>
        <div class="col-sm-9">
            <p class=" mb-0">: {{$record->PAT_ADDRESS}} {{$record->PAT_CITY}}, {{$record->PAT_COUNTRY}}</p>
        </div>
        </div> 
    </div>
</div>
<!-- End -->