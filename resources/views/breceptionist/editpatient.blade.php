@extends('layout')

@section('title')
<h1 class="m-0">Update Appointment</h1>
@endsection

@section('content')
            <div class="content">
              <div class="container-fluid">
                @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
                @endif
          <div class="card">
          <div class="card-header bg-dark">
               Update Patient Information for ID : <span class="text-warning"><b>{{$patient->PATIENT_ID}}</b></span>
            </div>
            
            <div class="card-body">
            <label for="inputFirstname">PERSONAL INFORMATION</label>
              <hr class="mt-1 mb-1">
              <form name="addpatient" id="addpatient" method="POST" action="{{url('/updatepatient/'.$patient->PATIENT_ID)}}" onsubmit="return confirm('Do you really want to update Patient information?');">
              @csrf
              <p class="mt-1" for="inputAddress"><span class="text-danger">[<strong>Double click</strong> on field to UPDATE the value]</span></p>
               <div class="form-row">

                <div class="form-group col-sm">
                  <label for="inputFirstname">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_FNAME" name="PAT_FNAME" value="{{$patient->PAT_FNAME}}" placeholder="First Name" readonly="true" ondblclick="this.readOnly='';" required>
                </div>

                <div class="form-group col-sm">
                  <label for="inputMiddlename">Middle Name (Optional)</label>
                  <input type="text" class="form-control" id="PAT_MNAME" name="PAT_MNAME" value="{{$patient->PAT_MNAME}}" placeholder="Middle Name" readonly="true" ondblclick="this.readOnly='';">
                </div>

                <div class="form-group col-sm">
                  <label for="inputLastname">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_LNAME" name="PAT_LNAME" value="{{$patient->PAT_LNAME}}" placeholder="Last Name" readonly="true" ondblclick="this.readOnly='';" required>
                </div>

              </div>

              <div class="form-row">

                <div class="form-group col-sm">
                  <label for="inputFirstname">Nationality / Passport ID <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_CITIZEN_ID" name="PAT_CITIZEN_ID" value="{{$patient->PAT_CITIZEN_ID}}" placeholder="Nationality / Passport ID" readonly="true" ondblclick="this.readOnly='';" required>
                </div>

                <div class="form-group col-sm">
                  <label for="cars">Religion <span class="text-danger">*</span></label>
                  <select class="form-select" id="PAT_RELIGION" name="PAT_RELIGION" value="{{$patient->PAT_RELIGION}}" placeholder="Gender" required>
                    <option selected disabled>Choose Religion</option>
                    <option value="Christian" <?php if($patient->PAT_RELIGION=="Christian") echo 'selected="selected"'; ?>>Christian</option>
                    <option value="Islam" <?php if($patient->PAT_RELIGION=="Islam") echo 'selected="selected"'; ?>>Islam</option>
                    <option value="Catholic" <?php if($patient->PAT_RELIGION=="Catholic") echo 'selected="selected"'; ?>>Catholic</option>
                    <option value="Hindu" <?php if($patient->PAT_RELIGION=="Hindu") echo 'selected="selected"'; ?>>Hindu</option>
                    <option value="Buddha" <?php if($patient->PAT_RELIGION=="Buddha") echo 'selected="selected"'; ?>>Buddha</option>
                    <option value="None" <?php if($patient->PAT_RELIGION=="None") echo 'selected="selected"'; ?>>None</option>
                  </select>
                </div>

                <div class="form-group col-sm">
                  <label for="cars">Gender <span class="text-danger">*</span></label>
                  <select class="form-select" id="PAT_GENDER" name="PAT_GENDER"  placeholder="Gender" required>
                    <option selected disabled>Choose Gender</option>
                    <option value="Male" <?php if($patient->PAT_GENDER=="Male") echo 'selected="selected"'; ?>>Male</option>
                    <option value="Female" <?php if($patient->PAT_GENDER=="Female") echo 'selected="selected"'; ?>>Female</option>
                  </select>
                </div>

              </div>

              <div class="form-row">

                <div class="form-group col-sm">
                  <label for="inputFirstname">Place of Birth <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_POB" name="PAT_POB" value="{{$patient->PAT_POB}}" placeholder="Place of Birth"  readonly="true" ondblclick="this.readOnly='';" required>
                </div>

                <div class="form-group col-sm">
                  <label for="inputMiddlename">Date of Birth <span class="text-danger">*</span></label>
                  <input type="date" class="form-control" id="PAT_DOB" name="PAT_DOB" value="<?php echo date('Y-m-d',strtotime($patient->PAT_DOB)) ?>" placeholder="Date of Birth"  readonly="true" ondblclick="this.readOnly='';" required>
                </div>

                <div class="form-group col-sm">
                  <label for="inputLastname">Occupation <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_OCCUPATION" name="PAT_OCCUPATION" value="{{$patient->PAT_OCCUPATION}}" placeholder="Occupation"  readonly="true" ondblclick="this.readOnly='';" required>
                </div>

              </div>

              <div class="form-row">

                <div class="form-group col-sm">
                  <label for="inputFirstname">Phone Number <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_PHONENUMBER" name="PAT_PHONENUMBER" value="0{{$patient->PAT_PHONENUMBER}}" placeholder="Phone Number"  readonly="true" ondblclick="this.readOnly='';" required>
                </div>

                <div class="form-group col-sm">
                  <label for="inputMiddlename">Email <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_EMAIL" name="PAT_EMAIL" value="{{$patient->PAT_EMAIL}}" placeholder="Email"  readonly="true" ondblclick="this.readOnly='';" required>
                </div>
                
                <div class="form-group col-sm">
                  <label for="cars">Marital Status <span class="text-danger">*</span></label>
                  <select class="form-select" id="PAT_MARITALSTAT" name="PAT_MARITALSTAT" placeholder="Gender" required>
                    <option selected disabled>Choose Status</option>
                    <option value="Married" <?php if($patient->PAT_MARITALSTAT=="Married") echo 'selected="selected"'; ?>>Married</option>
                    <option value="Umarried" <?php if($patient->PAT_MARITALSTAT=="Umarried") echo 'selected="selected"'; ?>>Umarried</option>
                  </select>
                </div>

              </div>
              <label for="inputFirstname">ADDRESS INFORMATION</label>
              <hr class="mt-1">
              <div class="form-group">
                <label for="inputAddress">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="PAT_ADDRESS" name="PAT_ADDRESS" value="{{$patient->PAT_ADDRESS}}" placeholder="Address"  readonly="true" ondblclick="this.readOnly='';" required>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">Province <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="PAT_PROVINCE" id="PAT_PROVINCE" value="{{$patient->PAT_PROVINCE}}" placeholder="Province"  readonly="true" ondblclick="this.readOnly='';" required>
                </div>

                <div class="form-group col">
                  <label for="inputZip">Zip Code <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="PAT_ZIPCODE" id="PAT_ZIPCODE" value="{{$patient->PAT_ZIPCODE}}" placeholder="Zip Code"  readonly="true" ondblclick="this.readOnly='';" required>
                </div>

                <div class="form-group col">
                  <label for="inputCity">Country <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="PAT_COUNTRY" id="PAT_COUNTRY" value="{{$patient->PAT_COUNTRY}}" placeholder="Country"  readonly="true" ondblclick="this.readOnly='';">
                </div>
              </div>
              <p for="inputAddress"><span class="text-danger">* Indicates Required Field </span></p>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
              <a class="btn btn-danger text-light float-right mr-2" onclick="history.back()">Cancel</a>
              </form>
            </div>
          </div>
      </div>
    </div>



@endsection

