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
                        <form action="login.php" method="post">
                        <div class="form-label-group">
                            <input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus name="username">
                            <label for="inputEmail">Username</label>
                        </div>
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block textoff" type="submit">Sign in</button>
                        </form>
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