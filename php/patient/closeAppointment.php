<?php
session_start();
include("../connect.php");

if(isset($_POST["data"])){
   echo "Data: " . $_POST["data"];
}

?>