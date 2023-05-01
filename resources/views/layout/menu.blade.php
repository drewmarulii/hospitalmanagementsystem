  
        @if($user->level=='R001')
          <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-light"></i>
              <p class="text-light">
                Dashboard
              </p>
            </a>
          </li>
          <li class="text-light nav-header">User Management</li>


              <li class="nav-item">
                <a href="{{ url('createaccount') }}" class="nav-link">
                <i class="fas fa-user-plus nav-icon text-light"></i>
                  <p class="text-light">User Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ url('useraccount') }} " class="nav-link">
                <i class="fas fa-user-nurse nav-icon text-light"></i>
                  <p class="text-light">User Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('role') }}" class="nav-link">
                  <i class="fas fa-user-tag nav-icon text-light"></i>
                  <p class="text-light">Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('polyclinic') }}" class="nav-link">
                  <i class="fas fa-medkit nav-icon text-light"></i>
                  <p class="text-light">Polyclinic</p>
                </a>
              </li>
   
        @endif

        @if($user->level=='R002')
        <p class="text-light float-right"><strong>RECEPTIONIST</strong></p>
        <li class="nav-item text-light">
            <a href="{{ url('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-light"></i>
              <p class="text-light">
                Dashboard
              </p>
            </a>
          </li>
          
          <li class="nav-header text-light">PATIENT</li>
              <li class="nav-item">
                <a href="{{ url('addpatient') }}" class="nav-link">
                <i class="fas fa-user-plus nav-icon text-light"></i>
                  <p class="text-light">Patient Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ url('patient') }} " class="nav-link">
                <i class="fas fa-user-nurse nav-icon text-light"></i>
                  <p class="text-light">Patient Information</p>
                </a>
              </li>

          <li class="nav-header text-light ">APPOINTMENT</li>
              <li class="nav-item">
                <a href="{{ url('addappointment') }}" class="nav-link">
                <i class="fas fa-calendar-plus nav-icon text-light"></i>
                  <p class="text-light">Create Appointment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ url('appointment') }} " class="nav-link">
                <i class="fas fa-calendar-check nav-icon text-light"></i>
                  <p class="text-light">List Appointment</p>
                </a>
              </li>

          <li class="nav-header text-light">PHYSICIAN</li>
              <li class="nav-item">
                <a href="{{ url('physician') }}" class="nav-link">
                <i class="fas fa-calendar-plus nav-icon text-light"></i>
                  <p class="text-light">Physician Information</p>
                </a>
              </li>
        @endif

        @if($user->level=='R003')
        <p class="text-light float-right"><strong>PHYSICIAN</strong></p>
        <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-light"></i>
              <p class="text-light">
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header text-light">APPOINTMENT</li>
              <li class="nav-item">
                <a href="{{ url('myQueue') }}" class="nav-link">
                <i class="fas fa-list nav-icon text-light"></i>
                  <p class="text-light">Patient Queue</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('myAppointment') }}" class="nav-link">
                <i class="fas fa-calendar-check nav-icon text-light"></i>
                  <p class="text-light">Patient Appointment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('myMedicalRecord') }}" class="nav-link">
                <i class="fas fa-book nav-icon text-light"></i>
                  <p class="text-light">Medical Record</p>
                </a>
              </li>
        @endif

        @if($user->level=='R004')
        <p class="text-light float-right"><strong>PHARMACY</strong></p>
        <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-light"></i>
              <p class="text-light">
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header text-light">MEDICINE</li>
              <li class="nav-item">
                <a href="{{ url('medOrder') }}" class="nav-link">
                <i class="fas fa-list nav-icon text-light"></i>
                  <p class="text-light">Medicine Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('medInstock') }}" class="nav-link">
                <!-- <i class="fas fa-list nav-icon text-light"></i> -->
                <i class="fas nav-icon fa-tablets text-light"></i>
                  <p class="text-light">Medicine Instock</p>
                </a>
              </li>
        @endif

        @if($user->level=='R005')
        <p class="text-light float-right"><strong>FINANCE</strong></p>
        <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-light"></i>
              <p class="text-light">
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header text-light">INVOICE</li>
              <li class="nav-item">
                <a href="{{ url('invoices') }}" class="nav-link">
                <i class="fas fa-file-invoice nav-icon text-light"></i>
                  <p class="text-light">Create Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('mnginvoices') }}" class="nav-link">
                <i class="fas fa-file-invoice-dollar nav-icon text-light"></i>
                  <p class="text-light">Manage Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('treatmentitem') }}" class="nav-link">
                <i class="fas fa-list nav-icon text-light"></i>
                  <p class="text-light">Treatment Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('invoiceitem') }}" class="nav-link">
                <i class="fas fa-list nav-icon text-light"></i>
                  <p class="text-light">Invoice Item</p>
                </a>
              </li>
        @endif





