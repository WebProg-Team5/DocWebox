<?php
session_start();
include("../connect.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $date =  $_POST['date'] . ":00";
   $confirmed = 0;
   $doctorId = intval($_POST['doctorId']);
   $patientId  = intval($_POST['patientId']);

   // echo $date . " " . $confirmed . " " . $doctorId . " " . $patientId . "<br>";
   // echo var_dump($date);
   // echo var_dump($confirmed);
   // echo var_dump($doctorId);
   // echo var_dump($patientId);

   $query = "INSERT INTO appointments (id, date, confirmed, patientID, doctorID) VALUES (NULL, '$date', '$confirmed', '$patientId', '$doctorId');";
   $result = mysqli_query($conn , $query);
   if(mysqli_affected_rows($conn) > 0){
      echo "<b class='h4 text-success'>Appointment Set Successfully</b>";
   }

}

?>