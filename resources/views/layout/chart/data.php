<?php
  $con = mysqli_connect("localhost","root","","adv_hospital");
 if (!$con) {
     # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         $sql ="SELECT * FROM patient";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $PATIENT_ID[]  = $row['PATIENT_ID']  ;
            $PAT_FNAME[] = $row['PAT_FNAME'];
        }
 
 }
?>