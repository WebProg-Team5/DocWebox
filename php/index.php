<?php
  require_once "connect.php";
  session_start();

  if(!isset($_SESSION['loggedIn'])){
    header('Location: login.php');
  }

  // echo "<br><br><br><br><br><br><br>" .$_SESSION['username'] . "<br>" . 
  //   $_SESSION['password']. "<br>" . 
  //   $_SESSION['email'] . "<br>" . 
  //   $_SESSION['loggedIn'] . "<br><br><br>";

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
  <!--wrapper start-->
  <div class="wrapper home-default-wrapper">

    <!--== Start Header Wrapper ==-->
    <header class="header-area header-default transparent sticky-header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="header-align">
              <div class="header-logo-area">
                <a href="index.html">
                  <img class="logo-light" src="assets\img\brand-logo\docwebox-high-resolution-logo-color-on-transparent-background.png" alt="Logo" />
                </a>
              </div>
              <div class="header-navigation-area">
                <ul class="main-menu nav justify-content-center">
                  <li class="active"><a href="index.html">Home</a></li>
                  <li><a href="services.html">Services</a></li>
                  <li><a href="about.html">About</a></li>
                  <li><a href="contact.html">Contact</a></li>
                  <li><a href="appointment.html">Appointment</a></li>
                </ul>
              </div>
              <div class="header-action-area">
                <div class="login-reg">
                  <a href=""><?php echo $_SESSION['username']?></a><span>/</span><a href="logout.php">logout</a> <i class="icon icofont-user-alt-3"></i>
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
    <!--== End Header Wrapper ==-->

    <main class="main-content site-wrapper-reveal">
      <!--== Start Hero Area Wrapper ==-->
      <section class="home-slider-area slider-default bg-img" data-bg-img="assets/img/slider/main-slide-01.jpg">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- Start Slide Item -->
              <div class="slider-content-area" data-aos="fade-zoom-in" data-aos-duration="1300">
                <h5>feel the difference with us</h5>
                <h2>Your Health <span>Is Our Priority</span></h2>
              </div>
              <!-- End Slide Item -->
              <div class="swiper-container service-slider-container">
                <div class="swiper-wrapper service-slider service-category">

                  <div class="swiper-slide category-item">
                    <div class="icon">
                      <i class="icofont-stethoscope-alt"></i>
                    </div>
                    <h4>Diagnose</h4>
                    <p>Examination & Diagnosis</p>
                  </div>

                  <div class="swiper-slide category-item">
                    <div class="icon">
                      <i class="icofont-brain-alt"></i>
                    </div>
                    <h4>Treatment</h4>
                    <p>Treatment of the disease</p>
                  </div>

                  <div class="swiper-slide category-item">
                    <div class="icon">
                      <i class="icofont-paralysis-disability"></i>
                    </div>
                    <h4>Care Healthy</h4>
                    <p>Care and recuperation</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--== End Hero Area Wrapper ==-->

      <!--== Start Appointment Form Area Wrapper ==-->
      <section class="appointment-area" data-bg-color="#eaeded">
        <div class="appointment-form-style1">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="appointment-form">
                  <div class="section-title">
                    <h5>Always Ready To Help</h5>
                    <h2 class="title">Book An <span>Appointment</span></h2>
                  </div>
                  <form id="contact-form" action="http://whizthemes.com/mail-php/raju/arden/mail.php" method="post">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <input class="form-control" type="text" name="con_name" placeholder="Enter your name...">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input class="form-control" type="email" name="con_email" placeholder="sample@gmail.com">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input class="form-control" type="text" name="con_phone" placeholder="Phone">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group datepicker-group">
                          <label for="datepicker" class="form-label icon icofont-calendar"></label>
                          <input class="form-control" id="datepicker" type="text" name="con_date" placeholder="Date">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group mb-0">
                          <textarea name="con_message" rows="7" placeholder="Your message here..."></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group mb-0">
                          <button class="btn btn-theme" type="submit">Make an appointment</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- Message Notification -->
                <div class="form-message"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--== End Appointment Form Area Wrapper ==-->

      <!--== Start Feature Area Wrapper ==-->
      <section class="feature-area feature-default-area" data-bg-color="#eaeded">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title" data-aos="fade-up" data-aos-duration="1100">
                <h5>Why Choose DocWebox</h5>
                <h2 class="title">The Best <span>For Your Health</span></h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-xl-8">
              <div class="row icon-box-style1" data-aos="fade-up" data-aos-duration="1100">
                <div class="col-md-6">
                  <div class="icon-box-item">
                    <div class="icon">
                      <i class="icofont-prescription"></i>
                    </div>
                    <div class="content">
                      <h5 class="title">Medical Counseling</h5>
                      <p>Lorem ipsum dolor sit amet, consect adipisicing elit vero. Donec ultri sollicitudin lacus</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="icon-box-item">
                    <div class="icon">
                      <i class="icofont-doctor-alt"></i>
                    </div>
                    <div class="content">
                      <h5 class="title">Top Level Doctors</h5>
                      <p>Lorem ipsum dolor sit amet, consect adipisicing elit vero. Donec ultri sollicitudin lacus</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="icon-box-item">
                    <div class="icon">
                      <i class="icofont-microscope"></i>
                    </div>
                    <div class="content">
                      <h5 class="title">Medical Facilites</h5>
                      <p>Lorem ipsum dolor sit amet, consect adipisicing elit vero. Donec ultri sollicitudin lacus</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="icon-box-item">
                    <div class="icon">
                      <i class="icofont-ambulance-cross"></i>
                    </div>
                    <div class="content">
                      <h5 class="title">24 Hours Services</h5>
                      <p>Lorem ipsum dolor sit amet, consect adipisicing elit vero. Donec ultri sollicitudin lacus</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="icon-box-item">
                    <div class="icon">
                      <i class="icofont-blood"></i>
                    </div>
                    <div class="content">
                      <h5 class="title">Personal Services</h5>
                      <p>Lorem ipsum dolor sit amet, consect adipisicing elit vero. Donec ultri sollicitudin lacus</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="icon-box-item">
                    <div class="icon">
                      <i class="icofont-paralysis-disability"></i>
                    </div>
                    <div class="content">
                      <h5 class="title">Dedicated Patient Care</h5>
                      <p>Lorem ipsum dolor sit amet, consect adipisicing elit vero. Donec ultri sollicitudin lacus</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="thumb" data-aos="fade-left" data-aos-duration="1500">
          <img src="assets/img/photos/doctor-01.png" alt="Mexi-Image">
        </div>
      </section>
      <!--== End Feature Area Wrapper ==-->

    <!--== Start Footer Area Wrapper ==-->
    <footer class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 m-auto">
            <div class="widget-item">
              <div class="about-widget">
                <a class="footer-logo" href="index.html">
                  <img src="assets\img\brand-logo\docwebox(160x100).png" alt="Logo">
                </a>
                <p class="mb-0">Sed elit quam, iaculis sed semper sit amet udin vitae nibh at magna akal semperFusce.
                </p>
                <ul class="widget-contact-info">
                  <li class="info-address"><i class="icofont-location-pin"></i>69 Halsey St, New York, Ny 10002, United
                    States.</li>
                  <li class="info-mail"><i class="icofont-email"></i><a
                      href="mailto://DocWebox@yourdomain.com">DocWebox@yourdomain.com</a></li>
                  <li class="info-phone"><i class="icofont-ui-call"></i><a href="tel://(0091) 8547 632521">(0091) 8547
                      632521</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <div class="row text-center">
            <div class="col-sm-12">
              <div class="widget-copyright">
                <p>© 2021 <span>DocWebox</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--== End Footer Area Wrapper ==-->

    <!--== Scroll Top Button ==-->
    <div class="scroll-to-top"><span class="icofont-rounded-up"></span></div>

    <!--== Start Side Menu ==-->
    <aside class="off-canvas-wrapper">
      <div class="off-canvas-inner">
        <div class="off-canvas-overlay"></div>
        <!-- Start Off Canvas Content Wrapper -->
        <div class="off-canvas-content">
          <!-- Off Canvas Header -->
          <div class="off-canvas-header">
            <div class="logo-area">
              <a href="index.html"><img src="assets/img/logo.png" alt="Logo" /></a>
            </div>
            <div class="close-action">
              <button class="btn-close"><i class="lnr lnr-cross"></i></button>
            </div>
          </div>

          <div class="off-canvas-item">
            <!-- Start Mobile Menu Wrapper -->
            <div class="res-mobile-menu">
              <!-- Note Content Auto Generate By Jquery From Main Menu -->
            </div>
            <!-- End Mobile Menu Wrapper -->
          </div>
          <!-- Off Canvas Footer -->
          <div class="off-canvas-footer"></div>
        </div>
        <!-- End Off Canvas Content Wrapper -->
      </div>
    </aside>
    <!--== End Side Menu ==-->
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

</body>
</html>