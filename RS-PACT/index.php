<?php
include('./includes/configure.php');
$loginUrl = HTTP_SERVER."ad/index.php";
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link href="./assets/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
      <meta charset="UTF-8">
      <title>Riversand | PACT Platform</title>
      <link rel="stylesheet" href="./assets/css/style.css">
      <!-- jQUERY   -->
      <script src="./assets/js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <!-- Auth0 -->
      <script src="./assets/js/auth0.min.js"></script>
      <!-- Vendor CSS Files -->
      <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
      <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
      <link href="assets/vendor/aos/aos.css" rel="stylesheet">

      <!-- Template Main CSS File -->
      <link href="./assets/css/theamstyle.css" rel="stylesheet">      
   </head>
   <body >

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <a href="index.php"><img src="./assets/images/large-PACT-logo.png" alt="" class="img-fluid"> &nbsp; <label>(Beta) </label></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="get-started"  id="login" ><a href="<?php echo $loginUrl?>">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Pinfo Section ======= -->
    <section class="pinfo section-bg">
      <div class="container">
        <div class="row">

          <div class="col-md-9">
            <h2>Productivity Accelerator Tools (PACT)</h2></br>
            <p>Riversand offers an integrated platform for productivity improvement</p> </br>
            <p>Provide ease to your manual efforts in MDM application</p></br>
          </div>
          <div class="col-md-3">
          <img src="./assets/images/rsglobe.png" >      
          </div>
        </div>
      </div>
    </section><!-- End Pinfo Section -->
    <!-- ======= Offering Section ======= -->
    <section id="offering" class="offering">
        <div class="container">

          <div class="section-title">
            <h2>Riversand PACT Offerings</h2>
            <div class="row">
            <div class="col-md-2 "></div>
            
              <div class="col-md-4 ">
              <a href="<?php echo $loginUrl?>">
                <div id="authdesc" class="offering-card " data-aos="fade-up">
                  <br>
                  <div class="authsec"></div>
                  <h4>Authorization Model</h4>   </br>         
                  <p>Enables generation of authorization model based on details provided</p>
                </div>
                </a>
              </div>
              

              <div class="col-md-4">
              <a href="<?php echo $loginUrl?>">
                <div id="wfdesc" class="offering-card " data-aos="fade-up">
                  <br>
                  <div class="wfsec"></div>
                  <h4>Workflow App Model</h4>   </br>         
                  <p>Enables generation of workflow app model based on workflow XAMLS</p>
                </div>
                </a>
              </div>
              <div class="col-md-2 "></div>
            </div>

            <div class="row">
            <div class="col-md-2 "></div>
              <div class="col-md-4">
              <a href="<?php echo $loginUrl?>">
                <div id="rbldesc" class="offering-card " data-aos="fade-up">                
                  <br>
                  <div class="rblsec"></div>
                  <h4>RBL Editor</h4>   </br>         
                  <p>IDE for business rules development using RBL</p>
                </div>
                </a>
              </div>

              <div class="col-md-4">
              <a href="<?php echo $loginUrl?>">
              <div id="uidesc" class="offering-card " data-aos="fade-up">
                <br>
                <div class="uisec"></div>
                <h4>UI Config Tool</h4>   </br>         
                <p>Eases development of UI configs</p>
              </div>
              </a>
            </div>
            <div class="col-md-2 "></div>      
        </div>
      </section><!-- End offering Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
  <div class="container py-4">
    <a href="https://www.riversand.com/" class="logofooter"><img src="./assets/images/rs-logo2.png" ></a>
    <div class="copyright">&copy; 2020 Riversand All Rights Reserved.
    </div>  
  </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>
</html>

