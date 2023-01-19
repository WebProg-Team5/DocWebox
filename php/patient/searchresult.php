<?php
include ('../connect.php');
$return = '';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name_Spec = mysqli_real_escape_string($conn, $_POST["name_Spec"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $insurance = mysqli_real_escape_string($conn, $_POST["insurance"]);

    $query = "SELECT * FROM doctors WHERE 1=1";
   
    if(!empty($name_Spec)){
        $query .= " AND (name LIKE '%$name_Spec%' OR specialisation LIKE '%$name_Spec%')";
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
        <div class="table-responsive">
        <table class="table table bordered">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Specialiasation</th>
            <th>Location</th>
            <th>Insurance</th>
        </tr>';

        while($row1 = mysqli_fetch_array($result))
        {
            $return .= '
            <tr>
            <td><img src="' . $row1["avatarUrl"] . '" width="60px"></td>
            <td>'.$row1["name"].'</td>
            <td>'.$row1["specialisation"].'</td>
            <td>'.$row1["location"].'</td>
            <td>'.$row1["insurance"].'</td>
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