@extends('layout')


@section('title')
<h1><span class="text-success h1">| </span>Create New Patient</h1>
@endsection

@section('breadcrumb')

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
               Create New Patient Information
            </div>
            <div class="card-body">
              <form name="addpatient" id="myForm" method="POST" action="{{url('createform')}}" onsubmit="openModal()">
              @csrf
              <label for="inputFirstname">PERSONAL INFORMATION</label>
              <hr class="mt-1">

               <div class="form-row">

                <div class="form-group col-sm">
                  <label for="inputFirstname">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_FNAME" name="PAT_FNAME" placeholder="First Name" autofocus required>
                </div>

                <div class="form-group col-sm">
                  <label for="inputMiddlename">Middle Name (Optional)</label>
                  <input type="text" class="form-control" id="PAT_MNAME" name="PAT_MNAME" placeholder="Middle Name">
                </div>

                <div class="form-group col-sm">
                  <label for="inputLastname">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_LNAME" name="PAT_LNAME" placeholder="Last Name" required>
                </div>

              </div>

              <div class="form-row">

                <div class="form-group col-sm">
                  <label for="inputFirstname">Nationality / Passport ID <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_CITIZEN_ID" name="PAT_CITIZEN_ID" placeholder="Nationality / Passport ID" required>
                </div>

                <div class="form-group col-sm">
                  <label for="cars">Religion <span class="text-danger">*</span></label>
                  <select class="form-select" id="PAT_RELIGION" name="PAT_RELIGION" placeholder="Gender" required>
                    <option selected disabled>Choose Religion</option>
                    <option value="Christian">Christian</option>
                    <option value="Islam">Islam</option>
                    <option value="Catholic">Catholic</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="None">None</option>
                  </select>
                </div>

                <div class="form-group col-sm">
                  <label for="cars">Gender <span class="text-danger">*</span></label>
                  <select class="form-select" id="PAT_GENDER" name="PAT_GENDER" placeholder="Gender" required>
                    <option selected disabled>Choose Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>

              </div>

              <div class="form-row">

                <div class="form-group col-sm">
                  <label for="inputFirstname">Place of Birth <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_POB" name="PAT_POB" placeholder="Place of Birth" required>
                </div>

                <div class="form-group col-sm">
                  <label for="inputMiddlename">Date of Birth <span class="text-danger">*</span></label>
                  <input type="date" class="form-control" id="PAT_DOB" name="PAT_DOB" placeholder="Date of Birth" required>
                </div>

                <div class="form-group col-sm">
                  <label for="inputLastname">Occupation <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_OCCUPATION" name="PAT_OCCUPATION" placeholder="Occupation" required>
                </div>

              </div>

              <div class="form-row">

                <div class="form-group col-sm">
                  <label for="inputFirstname">Phone Number <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_PHONENUMBER" name="PAT_PHONENUMBER" placeholder="Phone Number" required>
                </div>

                <div class="form-group col-sm">
                  <label for="inputMiddlename">Email <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="PAT_EMAIL" name="PAT_EMAIL" placeholder="Email" required>
                </div>
                
                <div class="form-group col-sm">
                  <label for="cars">Marital Status <span class="text-danger">*</span></label>
                  <select class="form-select" id="PAT_MARITALSTAT" name="PAT_MARITALSTAT" placeholder="Gender" required>
                    <option selected disabled>Choose Status</option>
                    <option value="Married">Married</option>
                    <option value="Umarried">Umarried</option>
                  </select>
                </div>

              </div>
              <label for="inputFirstname">ADDRESS INFORMATION</label>
              <hr class="mt-1">
              <div class="form-group">
                <label for="inputAddress">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="PAT_ADDRESS" name="PAT_ADDRESS" placeholder="Address" required>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <label for="inputCity">City <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="PAT_CITY" id="PAT_CITY" placeholder="City" required>
                </div>

                <div class="form-group col">
                  <label for="inputCity">Province <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="PAT_PROVINCE" id="PAT_PROVINCE" placeholder="Province" required>
                </div>

                <div class="form-group col">
                  <label for="inputZip">Zip Code <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="PAT_ZIPCODE" id="PAT_ZIPCODE" placeholder="Zip Code" required>
                </div>

                <div class="form-group col">
                  <label for="inputCity">Country <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="PAT_COUNTRY" id="PAT_COUNTRY" placeholder="Country" required>
                </div>
              </div>
              <p for="inputAddress"><span class="text-danger">* Indicates Required Field </span></p>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
              </form>
              
            </div>
          </div>
      </div>
    </div>

@endsection

