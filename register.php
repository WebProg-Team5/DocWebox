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
            <form action="register.php" method="post">
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus name="username">
                <label for="inputEmail">Username</label>
              </div>
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
                <label for="inputEmail">Email address</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
                <label for="inputPassword">Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required name="password_confirm">
                <label for="inputConfirmPassword">Confirm Password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
            </form>
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
