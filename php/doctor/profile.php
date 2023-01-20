<?php
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <div class="content-wrapper">
        <div class="container-fluid text-center">
            <?php echo "<img src={$doctor["avatarUrl"]} alt='Doctor Avatar'>" ?>
            <?php echo "<h2 class='text-primary m-4'>{$doctor["name"]}</h2>"?>
            <a href="" type="button" class="btn btn-outline-danger">Book Now</a>
            <div class="col-sm-12 col-md-10 mx-auto mt-4">
                <div class="row mt-5">
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
                </div>
                <h3>Reviews (<?php echo $reviewCount?> Found)</h3>
                <div class="table-responsive">
                    <table class="table table bordered">
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
</body>
</html>