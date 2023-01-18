<?php 
    require_once "connect.php";
    session_start();
?>

<!-- Head Element -->
<?php include 'commonsPhp/head.php'?>

<body>

<!--wrapper start-->
<div class="wrapper">

  <!--== Start Header Wrapper ==-->
  <?php include 'commonsPhp/navigation.php'?>
  <!--== End Header Wrapper ==-->

  <main class="main-content site-wrapper">
  <!--== Start Hero Area Wrapper ==-->
  <section class="home-slider-area slider-default bg-img" data-bg-img="assets/img/slider/main-slide-01.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- Start Slide Item -->
            <div class="slider-content-area" data-aos="fade-zoom-in" data-aos-duration="1300">
              <h5>Take action now</h5>
              <h2>Book Your <span>Appointment</span></h2>
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

  </main>

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

</body>

</html>