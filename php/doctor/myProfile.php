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
    <link rel="icon" type="image/png" sizes="32x32" href="../assets\img\icons\favicon-16x16.png">
    <!--== Main Style CSS ==-->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/propellerkit@1.3.1/dist/css/propeller.min.css" rel="stylesheet"></link>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    .focused { background: #E0F8E0 !important;}


        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star { display: none; }

        label.star {

        float: right;

        padding: 10px;

        font-size: 25px;

        color: #4A148C;

        transition: all .2s;

        }



        input.star:checked ~ label.star:before {

        content: '\f005';

        color: #FD4;

        transition: all .25s;

        }


        input.star-5:checked ~ label.star:before {

        color: #FE7;

        text-shadow: 0 0 20px #952;

        }



        input.star-1:checked ~ label.star:before { color: #F62; }

        

        label.star:hover { transform: rotate(-15deg) scale(1.3); }



        label.star:before {

        content: '\f006';

        font-family: FontAwesome;

        }
    </style>
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
                            echo '<li id="searchDocs"><a href="../patient/searchDocs.php">Search Doctors</a></li>
                                <li id="myAppointments"><a href="../patient/myAppointments.php">My Appointments</a></li>';
                        } else if($_SESSION['type'] === 'doctor'){
                            echo '<li id="myAppointments"><a href="myAppointments.php">My Appointments</a></li>
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

        <div class="container-fluid text-center mt-5">
            <?php
                echo "<img id='avatar' src={$doctor["avatarUrl"]} alt='Doctor Avatar'>";
                echo "<input hidden id='doctorId' value='".$_GET["id"]."'>";
                echo "<input hidden id='patientId' value='".$_SESSION["id"]."'>";
                echo "<h3 id='doctorName'class='editable text-secondary m-4'>{$doctor['name']}</h3>";
            ?>

            <?php if( ($_SESSION['type'] == "doctor" && $_SESSION['id'] == $id ) || $_SESSION['type'] == "admin") {
                echo '<input id="avatarInput" class="form-control form-control-sm mt-3 mb-3 col-sm-6 mx-auto" type="file" id="formFile" style="display: none">';
                echo "<button id='edit' name='edit' class='btn btn-lg btn-danger mt-4'>Edit Your Profile</button>
                      <button id='save' name='save' class='btn btn-lg btn-success mt-4' style='display: none'>Save Changes</button>
                      <button id='cancel' name='cancel' class='btn btn-lg btn-danger mt-4' style='display: none'>Cancel Changes</button>";
                echo '<div id="result" class="mt-5">
                      </div>';
            }
            ?>

               <?php if($_SESSION['type'] == "patient") {
                    echo '<div class="container">
                    <div class="row">
                        <div class="col-sm-6 mx-auto">
                            <div class="form-group">
                                <div class="input-group date"id="datetimepicker">
                                    <input id="datetime" type="text" class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <button id="submit" class="btn btn-outline-light bg-danger  btn-lg mt-4">Book Now</button>
                                <div id="result" class="mt-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                } ?>

                <div class="container mx-auto mt-4">
                    <div class="row mt-5">
                        <div class="table-responsive table-sm">
                            <table class="table table-bordered">
                                <tr>
                                    <th scope="row">Insurance</th>
                                    <td id="insurance"  class='editable'><?php echo $doctor["insurance"]?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Specialisation</th>
                                    <td id="specialisation"  class='editable'><?php echo $doctor["specialisation"]?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td id="price" class='editable'><?php echo $doctor["price"]?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ratings</th>
                                    <td id="ratings" class='editable'><?php echo $rating?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <?php echo "<textarea class='form-control editable' disabled rows='8' id='description'class='editable mt-4'>{$doctor["description"]}</textarea>"?>

                    <div class="row mt-5">
                        <div class="table-responsive table-sm">
                            <table class="table table-bordered">
                                <tr>
                                    <th scope="row">Email</th>
                                    <td id="email" class='editable'><?php echo $doctor["email"]?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone</th>
                                    <td id="phone" class='editable'><?php echo $doctor["phone"]?></td>
                                </tr>
                                <tr>
                                    <th scope="row">City</th>
                                    <td id="location" class='editable'><?php echo $doctor["location"]?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- STAR RATING AS A PATIENT -->
                    <h3 class="mt-3">Reviews (<?php echo $reviewCount?> Found)</h3>
                    <?php if($_SESSION['type'] == "patient"){
                        echo 
                        '<div class="stars">
                            <form action="" >
                            <h3 class="mt-3">Rate Doctor</h3>
                            <input class="star star-5" id="star-5" type="radio" name="star"/>
                            <label class="star star-5" for="star-5"></label>
                            <input class="star star-4" id="star-4" type="radio" name="star"/>
                            <label class="star star-4" for="star-4"></label>
                            <input class="star star-3" id="star-3" type="radio" name="star"/>
                            <label class="star star-3" for="star-3"></label>
                            <input class="star star-2" id="star-2" type="radio" name="star"/>
                            <label class="star star-2" for="star-2"></label>
                            <input class="star star-1" id="star-1" type="radio" name="star"/>
                            <label class="star star-1" for="star-1"></label>
                            </form> 
                        </div>';
                    }
                    ?>
                    
                    <!-- REVIEWS -->
                    <div class="table-responsive mb-5">
                        <table class="table table-hover table-sm table-bordered">
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
                </div>
        </div>
    </div>
</div>
</body>
</html>

<!--=======================Javascript============================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<script>
    let datetimepickerVal = $('#datetimepicker').data();
    let doctorIdVal = $("#doctorId").val();
    let patientIdVal = $("#patientId").val();

    $(document).ready(function(){
        $("#myProfile").addClass("active");
        $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        minDate: new Date()
        });
        
    });

    $("#submit").on('click', function() {;
        $.ajax({
            url: "../patient/closeAppointment.php",
            method:"POST",
            data:{
                date: datetimepickerVal.date,
                confirmed: 0,
                doctorId : doctorIdVal,
                patientId : patientIdVal
            },
            success: function(data)
            {
                $('#result').html(data);
                console.log(data);
            }
        });
    });

    $

    $("#edit").on('click', function(){
        $('#avatarInput').show();
        $('#edit').hide();
        $('#save').show();
        $('#cancel').show();
        $('.editable').each(function(){
            $(this).prop('contenteditable', true); 
            if($(this).is("td")) {
                let tr = $(this).closest('tr');
                tr.addClass('info');
            }
            if($(this).is("textarea")){
                $(this).prop('disabled', false);
            }
            if($(this).is("h3")){
                var input = $('<input id="fullName" class="editable form-control mt-5 mb-5 col-sm-6 mx-auto" />').val($(this).text());
                $(this).replaceWith(input);
            }
            $(this).attr('editing', 1);
        });
    });

    $("#save").on('click', function(){
        $('#avatarInput').hide();
        $('#save').hide();
        $('#cancel').hide();
        $('#edit').show();

        let assoc = {};
        assoc['id'] = $('#doctorId').val();
        assoc['avatarUrl'] = $('#avatarInput').val();
        $('.editable').each(function(){
            let key = $(this).attr('id');
            let value = $(this).text();
            $(this).prop('contenteditable', false); 
            if($(this).is("td")) {
                let tr = $(this).closest('tr');
                tr.removeClass('info');
            }
            if($(this).is("textarea")){
                $(this).prop('disabled', true);
            }
            if($(this).is("input")){
                let h3 = $("<h3 id='doctorName'class='editable text-secondary m-4'>{$doctor['name']}</h3>").text($(this).val());
                $(this).replaceWith(h3);
                key = "name";
                value = $(this).val();
            }
            $(this).attr('editing', 0);
            assoc[key] = value;
        });
        
        console.log(assoc);

        $.ajax({
                    url:"updateProfile.php",
                    method:"POST",
                    data: assoc,
                    success: function(data)
                    {
                        $('#result').html(data);
                    }
        });    
    });

    $("#cancel").on('click', function(){
        location.reload();
    });

    

  </script>