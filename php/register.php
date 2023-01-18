<?php
  session_start();
  include 'connect.php';
  $errors=[];

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // process the form

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);

    //Check if the passwords match
    if ($password != $password_confirm) {
      array_push($errors, "The two passwords do not match!");
    }

    //Check if the user already exists 
    if ($stmt = $conn->prepare('SELECT username, email FROM patients WHERE username = ? OR email= ?')) {
      $stmt->bind_param('ss', $username, $email);
      $stmt->execute();
      $result = $stmt -> get_result();
      $user = $result->fetch_assoc(); 

      if ($user) { // if user exists
        if ($user['username'] === $username) {
          array_push($errors, "Username already exists!");
        }
    
        if ($user['email'] === $email) {
          array_push($errors, "Email already exists!");
        }
      
      }

      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);//encrypt the password before saving in the database
    
        $stmt = $conn->prepare("INSERT INTO patients (username, password, email) VALUES (? , ?, ?)");
        $stmt->bind_param("sss",$username, $password, $email);
        $stmt->execute();

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;
        $_SESSION['loggedIn'] = TRUE;
        header('location: index.php');
      }
      $stmt->close();
      $conn->close();
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

            <h5 class="card-title text-center">Register</h5>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <div class="form-label-group">
                <label for="inputEmail">Username</label>
                <input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus name="username">
              </div>
              <div class="form-label-group">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
              </div>
              <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
              </div>
              <div class="form-label-group">
                <label for="inputConfirmPassword">Confirm Password</label>
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required name="password_confirm">
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase mt-2" type="submit">Register</button>
            </form>
            <?php 
              if (count($errors) > 0) {
                foreach ($errors as $error){
                  echo"<b class='text-danger'>$error</b>";
                }
              }?>
            <div class="text-center">
              <a class="small" href="login.php">Already have an account? Sign in here!</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
