<!-- Start -->
<div class="row">
    <div class="col">
    <div class="row">
    <div class="col-sm-3">
        <p class="mb-0"> ID</p>
    </div>
    <div class="col-sm-9">
        <p class="mb-0">: {{$record->RECORD_ID}}</p>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Date</p>
        </div>
        <div class="col-sm-9">
            <p class="mb-0">: <?php echo(date('d M Y', strtotime($record->MEDREC_DATE))); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Appointment ID</p>
        </div>
        <div class="col-sm-9">
            <p class="mb-0">: {{$record->APPOINTMENT_ID}} ({{$record->APPOINTMENT_STATUS}})</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p class="mb-0">Physician</p>
        </div>
        <div class="col-sm-9">
            <p class="mb-0">: Dr. {{$record->user_fname}} {{$record->user_mname}} {{$record->user_lname}}</p>
        </div>
    </div>
    <br>
    </div>
</div>
<!-- End -->