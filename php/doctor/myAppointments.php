<?php
session_start();
include("../connect.php");

// Appointment Confirmation
if (isset($_POST)) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    if ($id != null) {
        $query ="UPDATE appointments SET confirmed = 1 WHERE id={$id}";
        $conn->query($query);
    }
}

$id = $_SESSION["id"];
//$id = htmlspecialchars($_GET["id"]); //alternative
$query ="SELECT p.name, a.* FROM appointments as a JOIN patients as p ON a.patientID=p.id WHERE doctorID={$id} ORDER BY date";
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
                                        echo '<li id="searchDocs"><a href="patient/searchDocs.php">Search Doctors</a></li>
                                                <li id="myAppointments"><a href="patient/myAppointments.php">My Appointments</a></li>';
                                    } else if($_SESSION['type'] === 'doctor'){
                                        echo '<li id="myAppointments"><a href="myAppointments.php">My Appointments</a></li>
                                                <li id="myProfiel"><a href="myProfile.php?id='.$_SESSION['id'].'">My Profile</a></li>';
                                    } else if($_SESSION['type'] === 'admin'){
                                        '<li id="mngAppointments"><a href="admin/manageAppointments.php">Manage Appointments</a></li>
                                         <li id="mngDocs"><a href="admin/manageUsers.php">Manage Doctors</a></li>';
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
                            <th>Patient Name</th>
                            <th>Date</th>
                            <th>Confirmation</th>
                        </tr>
                        <?php
                        foreach ($appointments as $value) {
                            $form = "<form method='post'' action='myAppointments.php'>
                                        <input type='hidden' id='id' name='id' value={$value['id']}>
                                        <input type='submit' class='btn btn-outline-primary' name='' value='Confirm'>
                                     </form>";
                            $confirmation = $value["confirmed"] ? "<button type='button' class='btn btn-outline-dark' disabled>Confirmed</button>" : $form;
                            echo "
                            <tr>
                            <td>{$value['name']}</td>
                            <td>{$value['date']}</td>
                            <td>{$confirmation}</td>
                            </tr>
                        ";
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
    <!--== Scroll Top Button / Side Menu ==-->
  <?php include '../commonsPhp/topButton_sideMenu.php'?>
  <!--== End Scroll Top Button / Side Menu ==--> 
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
<script src="../assets/js/popper.min.js"></script>
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