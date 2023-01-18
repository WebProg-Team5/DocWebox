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
    <!--== Start Page Title Area ==-->
    <section class="page-title-area bg-img bg-img-top" data-bg-img="assets/img/photos/about-bg1.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 m-auto">
            <div class="page-title-content content-style5 text-center">
              <h4 class="title">About <span>DocWebox</span></h4>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Page Title Area ==-->

    <!--== Start About Area Wrapper ==-->
    <section class="about-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p class="text-pra">We make digital products and help organistation big and small connect with their audience.</p>
            <div class="service-list-content">
              <h4 class="title">Services</h4>
              <p class="text-block">It was a big, round room with a high arched roof, and the walls and ceiling and floor were covered with large emeralds set closely together.</p>
              <p>In a word, the whale was seized and sold, and his Grace the Duke of Wellington received the money. Thinking that viewed in some particular lights, the case might by a bare possibility in some small degree be deemed, under the circumstances, a rather hard one, an honest clergyman of the town addressed a note to his Grace.</p>
              <div class="service-list">
                <ul>
                  <li>Psychiartry</li>
                  <li>Opthalmology</li>
                  <li>Cardiology</li>
                  <li>Immunology</li>
                </ul>
                <ul>
                  <li>Gastroenterology</li>
                  <li>Hematology</li>
                  <li>Orthopedics</li>
                  <li>Pulmonary</li>
                </ul>
                <ul>
                  <li>Oncology</li>
                  <li>Physiotherapy</li>
                  <li>Dental</li>
                  <li>Rheumatology</li>
                </ul>
              </div>
            </div>
            <div class="office-center-content">
              <h4 class="title">Our center</h4>
              <p>It was shaped like a chair and sparkled with gems, as did everything else. In the center of the chair was an enormous Head, without a body to support it or any arms or legs whatever.</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="gallery-item mb-30">
                    <div class="thumb">
                      <a class="lightbox-image" data-fancybox="gallery" href="assets/img/about/01.jpg">
                        <img src="assets/img/about/01.jpg" alt="Image">
                      </a>
                      <div class="overlay"><i class="icofont-plus"></i></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="gallery-item mb-30">
                    <div class="thumb">
                      <a class="lightbox-image" data-fancybox="gallery" href="assets/img/about/02.jpg">
                        <img src="assets/img/about/02.jpg" alt="Image">
                      </a>
                      <div class="overlay"><i class="icofont-plus"></i></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="gallery-item">
                    <div class="thumb">
                      <a class="lightbox-image" data-fancybox="gallery" href="assets/img/about/03.jpg">
                        <img src="assets/img/about/03.jpg" alt="Image">
                      </a>
                      <div class="overlay"><i class="icofont-plus"></i></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="office-address-content">
                <div class="office-address-item">
                  <h5>Melbourne</h5>
                  <ul>
                    <li class="info-address">258 New Design St, VIC 10000, Austria</li>
                    <li class="info-phone">+0900 8618 3725 69</li>
                    <li class="info-mail">hello@mexi.com</li>
                  </ul>
                </div>
                <div class="office-address-item">
                  <h5>Newyork</h5>
                  <ul>
                    <li class="info-address">3rd Floor, 692 Orchard St, NY 10000, Newyork</li>
                    <li class="info-phone">+04200 4739 6899 6880</li>
                    <li class="info-mail">office@mexi.com</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End About Area Wrapper ==-->
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
    $("#about").addClass("active");
</script>

</body>

</html>