<?php
  require_once "connect.php";
  session_start();

  if(!isset($_SESSION['loggedIn'])){
    header('Location: login.php');
  }

  // echo "<br><br><br><br><br><br><br>" .
  //   $_SESSION['username'] . "<br>" . 
  //   $_SESSION['loggedIn'] . "<br>" . 
  //   $_SESSION['type'];
  //   "<br><br><br>";

?>

<!-- Head Element -->
<?php include 'commonsPhp/head.php'?>

<body>
  <!--wrapper start-->
  <div class="wrapper home-default-wrapper">

      <!--== Start Header Wrapper ==-->
    <?php include 'commonsPhp/navigation.php'?>
      <!--== End Header Wrapper ==-->

    <main class="main-content site-wrapper-reveal">

      <!--== Start Hero Area Wrapper ==-->
      <?php include 'commonsPhp/heroArea.php'?>
      <!--== End Hero Area Wrapper ==-->

      <!--== Start Feature Area Wrapper ==-->
      <?php include 'commonsPhp/featureArea.php'?>
      <!--== End Feature Area Wrapper ==-->

    <!--== Start Footer Area Wrapper ==-->
    <?php include 'commonsPhp/footer.php'?>
    <!--== End Footer Area Wrapper ==-->

    <!--== Scroll Top Button / Side Menu ==-->
    <?php include 'commonsPhp/topButton_sideMenu.php'?>
    <!--== End Scroll Top Button / Side Menu ==-->
    
  </div>

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
  <!--=======================Javascript============================-->

  <script>
    $("#home").addClass("active");
  </script>
</body>
</html>