<?php 
  $con = mysqli_connect("localhost","root","","adv_hospital");

  if(isset($_GET['PATIENT_ID']))
  {
      $patient = $_GET['PATIENT_ID'];

      $query = "SELECT * FROM patient WHERE PATIENT_ID='$patient' ";
      $query_run = mysqli_query($con, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
          foreach($query_run as $row)
          {
              ?>
          <hr>
          <div class="row mt-3 mb-3">   
            <div class="col-sm-3">
              <p class="mb-0">ID</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"><?= $row['PATIENT_ID']; ?></p>
            </div>
          </div>
          <hr>
          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0">Full Name</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"><?= $row['PAT_FNAME']; ?> <?= $row['PAT_MNAME']; ?> <?= $row['PAT_LNAME']; ?></p>
            </div>
          </div>
          <hr>
          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0">Birth</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"><?= $row['PAT_POB']; ?>, <?php echo(date('d M Y', strtotime($row['PAT_DOB']))); ?></p>
            </div>
          </div>
          <hr>
          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0">Age</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">
                <?php $dob = $row['PAT_DOB'];
                $today = date("Y-m-d");
                $age = date_diff(date_create($dob), date_create($today));
                echo $age->format('%y'); ?> Years Old</p>
            </div>
          </div>
          <hr>
          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0">Religion</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"><?= $row['PAT_RELIGION']; ?></p>
            </div>
          </div>

              <?php
          }
      }
      else
      {
          echo "No Record Found";
      }
  }
  
?>
                                    