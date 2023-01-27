   
    <!--== Start Header Wrapper ==-->
    <header class="header-area header-default transparent sticky-header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="header-align">
              <div class="header-logo-area">
              </div>
              <div class="header-navigation-area">
                <ul class="main-menu nav justify-content-center">
                  <li id="home"><a href="index.php">Home</a></li>

                  <?php if ($_SESSION['type'] === 'patient'){
                      echo '<li id="searchDocs"><a href="patient/searchDocs.php">Search Doctors</a></li>
                          <li id="myAppointments"><a href="patient/myAppointments.php">My Appointments</a></li>';
                  } else if($_SESSION['type'] === 'doctor'){
                      echo '<li id="myAppointments"><a href="doctor/myAppointments.php">My Appointments</a></li>
                          <li id="myProfiel"><a href="doctor/myProfile.php?id='.$_SESSION['id'].'">My Profile</a></li>';
                  } else if($_SESSION['type'] === 'admin'){
                      echo'<li id="mngAppointments"><a href="admin/manageAppointments.php">Manage Appointments</a></li>
                          <li id="mngDocs"><a href="admin/manageUsers.php">Manage Users</a></li>';
                  }
                  ?>
                  
                  <li id="services"><a href="services.php">Services</a></li>
                  <li id="about"><a href="about.php">About</a></li>
                  <li id="contact"><a href="contact.php">Contact</a></li>
                </ul>
              </div>
              <div class="header-action-area">
                <div class="login-reg">
                  <a class="page-item disabled"><?php echo $_SESSION['username']?></a><span>/</span><a href="logout.php">logout</a> <i class="icon icofont-user-alt-3"></i>
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