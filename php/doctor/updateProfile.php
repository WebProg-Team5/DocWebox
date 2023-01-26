<?php
session_start();
include '../connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = mysqli_real_escape_string($conn, $_POST["id"]);;
    $avatarUrl = mysqli_real_escape_string($conn, $_POST['avatarUrl']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $insurance = mysqli_real_escape_string($conn, $_POST['insurance']);
    $specialisation = mysqli_real_escape_string($conn, $_POST['specialisation']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $ratings = mysqli_real_escape_string($conn, $_POST['ratings']);;
    $description = mysqli_real_escape_string($conn, $_POST['description']);;
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);;

    $query = "UPDATE doctors SET name='$name' , email='$email', avatarUrl='$avatarUrl', phone='$phone',
    location='$location', insurance='$insurance', specialisation='$specialisation', price='$price',
    description='$description' WHERE id = '$id' ";

    $result = mysqli_query($conn , $query);
   if(mysqli_affected_rows($conn) > 0){
      echo "<b class='h4 text-success'>Profile Updated Successfully</b>";
   }
    
}

?>