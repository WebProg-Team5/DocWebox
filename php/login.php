<?php
    require_once 'connect.php';
    session_start();
    $error=""; //Variable to contain error message

    //Check if the form is submited
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //Sanitize the form data
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        //!!! CHANGE THE SQL STATEMENT FOR MULTIPLE TABLES
    if ($stmt = $conn->prepare('SELECT id, username ,password FROM patients WHERE username = ? OR email = ?')) {
        $stmt->bind_param('ss', $username,$username);
        $stmt->execute();
        $result = $stmt -> get_result();
        $user = $result->fetch_assoc(); 

        if ($user) {

            // Account exists, now we verify the password.
            // !!!Note: remember to use password_hash in your registration file to store the hashed passwords.
            if (password_verify($password, $user['password'])) { 
                // Verification success! User has logged-in!
                // Create sessions
                session_regenerate_id();
                $_SESSION['loggedIn'] = TRUE;
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];

                //Check if the remember checkbox is checked and set a cookie for username and password for 30 days
                if(!empty($_POST["rememberPwd"])) {
                    setcookie ("username",$username,time()+ 86400 * 30,"/");
                    setcookie ("password",$password,time()+ 86400 * 30,"/");
                } else {
                    setcookie("username","");
                    setcookie("password","");
                }

                header("Location: index.php");

            } else {
                // Incorrect password
                $error='Incorrect username and/or password!';
            }
        } else {
            // Incorrect username
            $error= 'Incorrect username and/or password!';
        }

        $stmt->close();
    }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>DocWebox</title>
  <meta name="description" content="DocWebox"/>
  <link rel="icon" type="image/png" sizes="32x32" href="assets\img\icons\favicon-16x16.png">

  <!--== Main Style CSS ==-->
  <link href="assets/css/style.css" rel="stylesheet" />

</head>
    
<body>
  <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-label-group">
                            <label for="inputEmail">Username</label>
                            <input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus name="username" 
                            value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" >
                        </div>
                        <div class="form-label-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password"
                            value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="rememberPwd" class="custom-control-input" id="rememberPwd">
                            <label class="custom-control-label" for="rememberPwd">Remember password</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block textoff" type="submit" value="submit" name="submit">Sign in</button>
                        </form>
                        <?php echo"<b class='text-danger'>$error</b>"?>
                        <div class="text-center">
                            <a class="small" href="register.php">Don't have an account? Register here!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

 <!--=======================Javascript============================-->

  <!--=== Modernizr Min Js ===-->
  <script src="assets/js/modernizr.js"></script>
  <!--=== jQuery Min Js ===-->
  <script src="assets/js/jquery-main.js"></script>
  <!--=== jQuery Migration Min Js ===-->
  <script src="assets/js/jquery-migrate.js"></script>
  <!--=== Popper Min Js ===-->
  <script src="assets/js/popper.min.js"></script>
  <!--=== Bootstrap Min Js ===-->
  <script src="assets/js/bootstrap.min.js"></script>
  <!--=== jquery UI Min Js ===-->
  <script src="assets/js/jquery-ui.min.js"></script>
  <!--=== Plugin Collection Js ===-->
  <script src="assets/js/plugincollection.js"></script>
  <!--=== Custom Js ===-->
  <script src="assets/js/custom.js"></script>

</body>

</html>