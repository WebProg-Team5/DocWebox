<?php
session_start();
include("../connect.php");

if (isset($_POST)) {
    $operation = isset($_POST['operation']) ? $_POST['operation'] : null;
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    // Appointment Confirmation
    if ($id != null && $operation == "confirm") {
        $query ="UPDATE appointments SET confirmed = 1 WHERE id={$id}";
        $conn->query($query);
    }
    // Appointment Deletion
    if ($id != null && $operation == "delete") {
        $query ="DELETE FROM appointments WHERE id={$id}";
        $conn->query($query);
    }

    if ($operation == "insert") {
        $date = $_POST['date'];
        $patient = $_POST['patient'];
        $doctor = $_POST['doctor'];
        $query ="INSERT INTO appointments (date, patientID, doctorID) VALUES ('$date', '$patient', '$doctor')";
        $conn->query($query);
    }
}

$id = $_SESSION["id"];
//$id = htmlspecialchars($_GET["id"]); //alternative
$query ="SELECT p.name as pName, d.name as dName, a.* FROM appointments as a JOIN patients as p ON a.patientID=p.id JOIN doctors d on a.doctorID = d.id ORDER BY date";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
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
                                        echo '<li id="mngAppointments"><a href="manageAppointments.php">Manage Appointments</a></li>
                                                <li id="mngDocs"><a href="manageUsers.php">Manage Users</a></li>';
                                    }
                                    ?>

                                    <li id="services"><a href="../services.php">Services</a></li>
                                    <li id="about"><a href="../about.php">About</a></li>
                                    <li id="contact"><a href="../contact.php">Contact</a></li>
                                </ul>
                            </div>
                            <div class="header-action-area">
                                <div class="login-reg">
                                    <a disabled><?php echo $_SESSION['username']?></a><span>/</span><a href="../logout.php">logout</a> <i class="icon icofont-user-alt-3"></i>
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

                <h3>Appointments</h3>
                <button type="button" data-bs-toggle="modal" data-bs-target="#insertModal" class="btn btn-block btn-primary col-sm-6 mx-auto mt-4 mb-4">
                    Insert Appointment
                </button>

                <!-- Modal -->
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Insert Appointment</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="insertForm" method='post' action='manageAppointments.php'>
                                    <input type='hidden' id='operation' name='operation' value=insert>
                                    PATIENT
                                    <select name="patient" class="form-select" size="10">
                                        <?php
                                        $query ="SELECT * FROM patients";
                                        $result = $conn->query($query);
                                        if($result->num_rows > 0){
                                            $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        }
                                        foreach ($patients as $value) {
                                            echo "<option value='{$value['id']}'>{$value['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                    Doctor
                                    <select name="doctor" class="form-select" size="10">
                                        <?php
                                        $query ="SELECT * FROM doctors";
                                        $result = $conn->query($query);
                                        if($result->num_rows > 0){
                                            $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        }
                                        foreach ($patients as $value) {
                                            echo "<option value='{$value['id']}'>{$value['name']}, {$value['specialisation']}, {$value['location']}</option>";
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    Date
                                    <input type="datetime-local" name="date">
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" form="insertForm" class="btn btn-primary" value="Insert">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive  table-sm mb-5">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Date</th>
                            <th>Confirmation</th>
                        </tr>
                        <?php
                        foreach ($appointments as $value) {
                            $form = "<form method='post' action='manageAppointments.php'>
                                        <input type='hidden' id='operation' name='operation' value=confirm>
                                        <input type='hidden' id='id' name='id' value={$value['id']}>
                                        <input type='submit' class='btn btn-primary' name='' value='Confirm'>
                                     </form>";
                            $confirmation = $value["confirmed"] ? "<button type='button' class='btn btn-success' disabled>Confirmed</button>" : $form;
                            echo "
                            <tr>
                            <td>{$value['pName']}</td>
                            <td>{$value['dName']}</td>
                            <td>{$value['date']}</td>
                            <td>
                                $confirmation
                                <form method='post' action='manageAppointments.php'>
                                  <input type='hidden' id='operation' name='operation' value=edit>
                                  <input type='hidden' name='id' value={$value['id']}>
                                  <input type='submit' value='Change Date' class='btn btn-warning mt-3'>
                                </form>
                                <form method='post' action='manageAppointments.php'>
                                  <input type='hidden' id='operation' name='operation' value=delete>
                                  <input type='hidden' name='id' value={$value['id']}>
                                  <input type='submit' value='Delete' class='btn btn-danger'>
                                </form>
                            </td>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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