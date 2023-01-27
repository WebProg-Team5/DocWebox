<?php
session_start();
include ('../connect.php');
$return = '';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $insurance = mysqli_real_escape_string($conn, $_POST["insurance"]);
    $specialisation = mysqli_real_escape_string($conn, $_POST["specialisation"]);

    // var_dump($name, $location, $insurance, $specialisation);

    $query = "SELECT * FROM rankedDoctors WHERE 1=1";
   
    if(!empty($name)){
        $query .= " AND name LIKE '%$name%'";
    }

    if(!empty($specialisation && $specialisation != "Specialisation")){
        $query .= " AND specialisation LIKE '%$specialisation%'";
    }

    if(!empty($location) && $location != "Location"){
        $query .= " AND location LIKE '%$location%' ";
    }

    if(!empty($insurance && $insurance != "Insurance")){
        $query .= " AND insurance LIKE '%$insurance%' ";
    }


    //Execute the query
    $stmt = $conn->prepare($query);
    // !!!$stmt-> bind_param();
    $stmt-> execute();
    $result = $stmt->get_result();

    if(mysqli_num_rows($result) > 0){
        $return .='
        <div class="table-responsive table-sm">
        <table class="table table-hover bordered">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Specialisation</th>
            <th>Location</th>
            <th>Insurance</th>
            <th>Rating</th>
        </tr>';

        while($row1 = mysqli_fetch_array($result))
        {
            $avgRating = $row1['rating'];
            $rate5 = round($avgRating) / 2; //4.5
            $starRate = "";
           
            $starRate = str_repeat('<i class="fa fa-star" aria-hidden="true"></i>', floor($rate5));

            if($rate5 !== floor($rate5)){
                $starRate .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
            }

            $return .= '
            <tr>
            <td><img src="' . $row1["avatarUrl"] . '" width="60px"></td>
            <td>'.$row1["name"].'</td>
            <td>'.$row1["specialisation"].'</td>
            <td>'.$row1["location"].'</td>
            <td>'.$row1["insurance"].'</td>
            <td>'.$starRate. '</td>
            <td>
            <a href="../doctor/myProfile.php?id='.$row1["id"] .'" type="button" class="btn btn-outline-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
            </svg>
            Book Now!
            </a>
            </td>

            </tr>';
        }
        echo $return;
    }
    else
    {
        echo '<b>No results containing all your search terms were found.<b>';
    }
}
    
?>