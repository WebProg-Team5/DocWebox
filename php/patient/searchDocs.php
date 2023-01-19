<?php 
	include("../connect.php");
 
    $query ="SELECT DISTINCT insurance FROM doctors";
    $result = $conn->query($query);
    if($result->num_rows> 0){
      $available_insurances = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    $query = "SELECT DISTINCT location from doctors";
    $result = $conn->query($query);
    if($result->num_rows> 0){
      $available_locations = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // //!!! fetch name and specializations on load ISOS TO KANW 
    // $query = "SELECT DISTINCT name from doctors";
    // $result = $conn->query($query);
    // if($result->num_rows> 0){
    //   $available_Doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // }

    // $query = "SELECT DISTINCT specialisation from doctors";
    // $result = $conn->query($query);
    // if($result->num_rows> 0){
    //   $available_Specs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // }
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
		<h2 class="text-primary m-4">Find the best Doctors for your needs</h2>
        <img src="../assets\img\brand-logo\docwebox(160x100).png" alt="DocWeboxLogo">
		<div class="row mt-3">
            <div class="col-sm-12 col-lg-5 col-xl-5 mx-auto form-inline">
                <div class="mt-4">
                    <input type="text" name="name_Spec" id="name_Spec" placeholder="Name or Specialization" class="form-control" />
                    <select id="location"class="form-select btn border">
                        <option value="" selected>Location</option>
                        <?php 
                            foreach ($available_locations as $loc){
                                echo '<option class="dropdown-item" value="'.$loc['location'].'">'.$loc['location'].'</option>';
                            }
                        ?>
                    </select>
                    <select id="insurance"class="form-select btn border">
                        <option value="" selected>Insurance</option>
                        <?php 
                            foreach ($available_insurances as $inc){
                                echo '<option class="dropdown-item" value="'.$inc['insurance'].'">'.$inc['insurance'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>	
        </div>
        <div class="col-sm-12 col-md-10 mx-auto mt-4" id="result">         
        </div>
	</div>
</div>
</div>
</body>
</html>

<script>
    $('.bookNow').on('click', function pageRedirect() {
        console.log("Clicked");
        window.location.href = "../doctor/myprofile?" + $this.attr('id');
    });

    $('#name_Spec').on("keyup",
    function(){     
        let name_Spec_value = $('#name_Spec').val();
        let location_value = $('#location :selected').val();
        let insurance_value = $('#insurance :selected').val();

        if(name_Spec_value != "" || location_value != "" || insurance_value != ""){
            $.ajax({
                    url:"searchresult.php",
                    method:"POST",
                    data:{
                        name_Spec: name_Spec_value,
                        location: location_value,
                        insurance: insurance_value
                    },
                    success: function(data)
                    {
                        $('#result').html(data);
                    }
            });
        }
    });

    $("#location,#insurance").on('change', function() {
        let name_Spec_value = $('#name_Spec').val();
        let location_value = $('#location :selected').text();
        let insurance_value = $('#insurance :selected').text();

        if(name_Spec_value != "" || location_value != "" || insurance_value != ""){
            $.ajax({
                    url:"searchresult.php",
                    method:"POST",
                    data:{
                        name_Spec: name_Spec_value,
                        location: location_value,
                        insurance: insurance_value
                    },
                    success: function(data)
                    {
                        $('#result').html(data);
                    }
            });
        }
    });
	</script>