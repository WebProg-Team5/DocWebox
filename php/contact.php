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

  <main class="main-content site-wrapper-reveal">

    <!--== Start Hero Area Wrapper ==-->
  <section class="home-slider-area slider-default bg-img" data-bg-img="assets/img/slider/main-slide-01.jpg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <!-- Start Slide Item -->
          <div class="slider-content-area" data-aos="fade-zoom-in" data-aos-duration="1300">
            <h5>Take action now</h5>
            <h2>Contact us <span> for further information</span></h2>
          </div>
        </div>
      </div>
    </div>
</section>
<!--== End Hero Area Wrapper ==-->

    <!--== Start Contact Area ==-->
    <section class="contact-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="contact-info-content">
              <div class="info-address">
                <h2 class="title">Brooklyn, <span>New York</span></h2>
                <p>849 Diamond Str, 07th Floor, NY 10012, New York, United State America</p>
                <a href="mailto://hello@yourdomain.com"><span>Email:</span> infor@docwebox.com</a>
              </div>
              <div class="brand-office">
                <div class="info-tem style-two">
                  <h6>Call directly:</h6>
                  <p>+1 212-226-3126</p>
                </div>
                <div class="info-tem">
                  <h6>Brand Offices:</h6>
                  <p>Allentown PA | Allanta, GA | Chicago, IL | Dallas, TX, Edison, NJ | Houston, TX</p>
                </div>
                <div class="info-tem mb-0">
                  <h6>Work Hours:</h6>
                  <p>Mon - Sat: 8.00 - 17.00, Sunday closed</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">            
            <div class="contact-form">
              <div class="section-title text-center">
                <h5>Contact</h5>
                <h2 class="title">Always Ready <span>To Help You</span></h2>
              </div>
              <form class="contact-form-wrapper" id="contact-form" action="http://whizthemes.com/mail-php/raju/arden/mail.php" method="post">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input class="form-control" type="text" name="con_name" placeholder="Your Name">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input class="form-control" type="email" name="con_email" placeholder="Email Address">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input class="form-control" type="text" name="con_subject" placeholder="Subject (optional)">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-0">
                      <textarea name="con_message" rows="5" placeholder="Write your message here"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">
                    <div class="form-group mb-0">
                      <button class="btn btn-theme btn-block" type="submit">Send Message</button>
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
    </section>
    <!--== End Contact Area ==-->
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
<script>
    $("#contact").addClass("active");
</script>

</body>

</html>