<?php 
  $con = mysqli_connect("localhost","root","","adv_hospital");

  if(!$con) {
    echo "Not connected!";
  } else {
    echo "Nice!";
  }

?>

