<?php
session_start();
include("../connect.php");

$id = $_SESSION["id"];
//$id = htmlspecialchars($_GET["id"]); //alternative
$query ="SELECT d.name, a.* FROM appointments as a JOIN doctors as d ON a.doctorID=d.id WHERE patientID={$id} ORDER BY date";
$result = $conn->query($query);
if($result->num_rows > 0){
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DocWebox</title>
    <meta name="description" content="DocWebox"/>
    <link rel="icon" type="image/png" sizes="32x32" href="assets\img\icons\favicon-16x16.png">
    <!--== Main Style CSS ==-->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
<div>
    <div class="content-wrapper">
        <header class="header-area header-default transparent sticky" style="background-color : #1B0F09 !important">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="header-align">
                            <div class="header-logo-area">
                            </div>
                            <div class="header-navigation-area">
                                <ul class="main-menu nav justify-content-center">
                                    <li id="home"><a href="../index.php">Home</a></li>

                                    <?php if ($_SESSION['type'] === 'patient'){
                                        echo '<li id="searchDocs"><a href="searchDocs.php?id='.$_SESSION['id'].'">Search Doctors</a></li>
                                                <li id="myAppointments"><a href="myAppointments.php?id='.$_SESSION['id'].'">My Appointments</a></li>';
                                    } else if($_SESSION['type'] === 'doctor'){
                                        echo '<li id="myAppointments"><a href="myAppointments.php?id='.$_SESSION['id'].'">My Appointments</a></li>
                                                <li id="myProfiel"><a href="myProfile.php?id='.$_SESSION['id'].'">My Profile</a></li>';
                                    } else if($_SESSION['type'] === 'admin'){
                                        '<li id="mngAppointments"><a href="admin/manageAppointments.php">Manage Appointments</a></li>
                                         <li id="mngDocs"><a href="admin/manageDoctors.php">Manage Doctors</a></li>';
                                    }
                                    ?>

                                    <li id="services"><a href="../services.php">Services</a></li>
                                    <li id="about"><a href="../about.php">About</a></li>
                                    <li id="contact"><a href="../contact.php">Contact</a></li>
                                </ul>
                            </div>
                            <div class="header-action-area">
                                <div class="login-reg">
                                    <a href=""><?php echo $_SESSION['username']?></a><span>/</span><a href="../logout.php">logout</a> <i class="icon icofont-user-alt-3"></i>
                                </div>
                                <button class="btn-menu d-lg-none">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid text-center">
            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto mt-4">

                <div class="table-responsive  table-sm mb-5">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Doctor Name</th>
                            <th>Date</th>
                            <th>Confirmation</th>
                            <th></th>
                        </tr>
                        <?php
                        if(isset($appointments) ){
                            foreach ($appointments as $value) {
                                $confirmation = $value["confirmed"] ? "Confirmed" : "Awaiting Confirmation";
                                echo "
                                <tr>
                                <td>{$value['name']}</td>
                                <td>{$value['date']}</td>
                                <td>{$confirmation}</td>
                                <td><a href='../doctor/myProfile.php?id={$value['doctorID']}' type='button' class='btn btn-outline-primary'>Go to Profile</a></td>
                                </tr>
                            ";
                            }
                        }else{
                            echo "<b class='h2 text-danger'>You don't have any appointments with our doctors</b>";
                            echo '<button href="../doctor/myProfile.php" type="button" class="btn btn-block btn-danger col-sm-6 mx-auto mt-4 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                            </svg>
                            Book Now!
                            </button>';
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!--=======================Javascript============================-->
<!--=== Modernizr Min Js ===-->
<script src="../assets/js/modernizr.js"></script>
<!--=== jQuery Min Js ===-->
<script src="../assets/js/jquery-main.js"></script>
<!--=== jQuery Migration Min Js ===-->
<script src="../assets/js/jquery-migrate.js"></script>
<!--=== Popper Min Js ===-->
<script src=../assets/js/popper.min.js"></script>
<!--=== Bootstrap Min Js ===-->
<script src="../assets/js/bootstrap.min.js"></script>
<!--=== jquery UI Min Js ===-->
<script src="../assets/js/jquery-ui.min.js"></script>
<!--=== Plugin Collection Js ===-->
<script src="../assets/js/plugincollection.js"></script>
<!--=== Custom Js ===-->
<script src="../assets/js/custom.js"></script>
<!--=======================Javascript============================-->

<script>
    $("#myProfile").addClass("active");
</script>