<?php
session_start();
include("../connect.php");

$id = htmlspecialchars($_GET["id"]);
$query ="SELECT * FROM doctors WHERE id={$id}";
$result = $conn->query($query);
if($result->num_rows == 1){
    $doctor = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
}

$query ="SELECT AVG(rating) as avg FROM reviews WHERE doctorID={$id}";
$result = $conn->query($query);
if($result->num_rows == 1){
    $rating = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["avg"];
    $rating = round($rating)/2;
}

$reviewCount = 0;
$query ="SELECT p.name, r.date, r.rating, r.content FROM reviews as r JOIN patients as p ON r.patientID=p.id WHERE doctorID={$id} ORDER BY date DESC";
$result = $conn->query($query);
if($result->num_rows > 0){
    $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $reviewCount = count($reviews);
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
                    echo '<li id="searchDocs"><a href="patient/searchDocs.php?id='.$_SESSION['id'].'">Search Doctors</a></li>
                          <li id="myAppointments"><a href="patient/myAppointments.php?id='.$_SESSION['id'].'">My Appointments</a></li>';
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
            <?php echo "<img src={$doctor["avatarUrl"]} alt='Doctor Avatar'>" ?>
            <?php echo "<h2 class='text-primary m-4'>{$doctor["name"]}</h2>"?>
            <?php if($_SESSION['type'] == "patient") {
                echo '<a href="" type="button" class="btn btn-outline-danger">Book Now</a>';
            } ?>
            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto mt-4">
                <div class="row mt-5">
                    <div class="table-responsive table-sm">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th scope="row">Insurance</th>
                                <td><?php echo $doctor["insurance"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">Specialisation</th>
                                <td><?php echo $doctor["specialisation"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">Price</th>
                                <td><?php echo $doctor["price"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">Ratings</th>
                                <td><?php echo $rating?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <?php echo "<h5 class='mt-4'>{$doctor["description"]}</h5>"?>

                <div class="row mt-5">
                    <div class="table-responsive table-sm">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th scope="row">Email</th>
                                <td><?php echo $doctor["email"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">Phone</th>
                                <td><?php echo $doctor["phone"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">City</th>
                                <td><?php echo $doctor["location"]?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h3 class="mt-3">Reviews (<?php echo $reviewCount?> Found)</h3>

                <div class="table-responsive  table-sm mb-5">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Rating</th>
                            <th>Content</th>
                        </tr>
                    <?php
                        if ($reviewCount>0) {
                            foreach ($reviews as $key => $value) {
                                $rating = $value['rating']/2;
                                echo "
                                <tr>
                                <td>{$value['name']}</td>
                                <td>{$value['date']}</td>
                                <td>{$rating} stars</td>
                                <td>{$value['content']}</td>
                                </tr>
                            ";
                            }
                        }
                    ?>
                </div>

                <!-- <div class="row mt-5">
                    Insurance: <?php echo "<h4 class='text-primary m-4'>{$doctor["insurance"]}</h4>"?>
                    Specialisation: <?php echo "<h4 class='text-primary m-4'>{$doctor["specialisation"]}</h4>"?>
                    Price: <?php echo "<h4 class='text-primary m-4'>\${$doctor["price"]}</h4>"?>
                    Ratings: <?php echo "<h4 class='text-primary m-4'>{$rating} stars</h4>"?>
                </div>
                <?php echo "<h5 class=''>{$doctor["description"]}</h5>"?>
                <div class="row mt-5">
                    Email: <?php echo "<h5 class='text-primary m-4'>{$doctor["email"]}</h5>"?>
                    Phone: <?php echo "<h5 class='text-primary m-4'>{$doctor["phone"]}</h5>"?>
                    City: <?php echo "<h5 class='text-primary m-4'>{$doctor["location"]}</h5>"?>
                </div> -->
                
                <!-- <h3>Reviews (<?php echo $reviewCount?> Found)</h3>
                <div class="table-responsive  table-sm">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Rating</th>
                            <th>Content</th>
                        </tr>
                <?php
                    if ($reviewCount>0) {
                        foreach ($reviews as $key => $value) {
                            $rating = $value['rating']/2;
                            echo "
                            <tr>
                            <td>{$value['name']}</td>
                            <td>{$value['date']}</td>
                            <td>{$rating} stars</td>
                            <td>{$value['content']}</td>
                            </tr>
                        ";
                        }
                    }
                ?>
                </div> -->
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