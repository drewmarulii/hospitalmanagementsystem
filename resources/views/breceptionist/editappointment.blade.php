@extends('layout')

@section('title')
<h1 class="m-0">Update Appointment</h1>
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
              <div class="card-header border-0">

              <form method="GET">
                            <div class="row">
                            <label for="exampleInputEmail1">Check Patient Information (PATIENT ID)</label>
                                <div class="col-md-8">
                                    <input type="text" id="PATIENTID" name="PATIENT_ID" placeholder="Input Patient ID" value="PBAH-2023-" class="form-control">
                                </div>
                                <div class="col-md-4">
                                  <button type="submit" class="btn-sm btn-success mr-2">Check</button>
                                  <a href="/addappointment" class="text-danger">
                                    <strong><u>reset</u></strong>
                                  </a>
                                </div>
                            </div>
                          </form>
                      <hr>

            <form name="addappointment" id="addappointment" method="POST" action="{{url('/updateappointment/'.$appcard[0]->APPOINTMENT_ID)}}" onsubmit="return confirm('Do you really want to update Appointment information?');">
            @csrf

                <div class="form-group">
                    <label for="exampleInputPassword1">Patient ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="PATIENTID" name="PATIENTID" value="{{$appcard[0]->PATIENTID}}" placeholder="Input Patient ID" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Appointment Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="APP_DATE" name="APP_DATE" value="{{$appcard[0]->APP_DATE}}" placeholder="Appointment Date" required>
                </div>

                <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Appointment Status</label>
                    <input type="text" class="form-control" id="APPOINTMENT_STATUS" name="APPOINTMENT_STATUS" value="NEW" placeholder="Appointment Status" readonly="readonly">
                </div> -->

                <div class="form-group">
                  <label for="cars">Physician <span class="text-danger">*</span></label>
                  <select class="form-select" id="DOCTOR_ID" name="DOCTOR_ID" placeholder="Polyclinic" required>
                    <option selected disabled>Choose Physician</option>
                    @foreach($useraccount as $physician)
                      <option value="{{$physician->userid}}" <?php  if($appcard[0]->DOCTOR_ID==$physician->userid) echo 'selected="selected"'; ?>>Dr. {{$physician->user_fname}} {{$physician->user_mname}} {{$physician->user_lname}}</option>
                    @endforeach
                  </select>
                </div>

                <button type="submit" id="btnSubmit2" name="addappointment" class="btn btn-primary">Submit</button>
                <a class="btn btn-danger text-light" onclick="history.back()">Cancel</a>
                </form>


              </div>
            </div>
          </div>

          <div class="col-8">

            <div class="card">
            <div class="card-header border-0">

            <h5>Patient Information</h5>
                        @include('layout.check-patient')
            </div>
            </div>
          </div>

        </div>
      </div>
    </div>

@endsection

