<div class="row mb-3">
              <div class="col-sm-3">
                <p class="mb-0">ID</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PATIENT_ID}}</p>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PAT_FNAME}} {{$patient->PAT_MNAME}} {{$patient->PAT_LNAME}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Religion</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PAT_RELIGION}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Gender</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PAT_GENDER}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Citizen</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PAT_CITIZEN_ID}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Birth</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PAT_POB}}, <?php echo(date('d M Y', strtotime($patient->PAT_DOB))); ?></p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Age</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$years}} Years Old</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Job</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PAT_OCCUPATION}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">0{{$patient->PAT_PHONENUMBER}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PAT_EMAIL}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$patient->PAT_ADDRESS}}, {{$patient->PAT_PROVINCE}}, {{$patient->PAT_COUNTRY}}</p>
                </div>
              </div>