<?php
include('./includes/configure.php');
$loginUrl = HTTP_SERVER."ad/index.php";

$userID = $_SESSION["user_id"];
createLog("logout");
$DB->update("users", array("last_logout" => "now()", "access_token" => ""), "user_id = '{$userID}'" );

session_unset();
session_destroy(); // destroy session
session_write_close();
setcookie("PHPSESSID","",time()-3600,"/");

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
        <a href="index.php"><img src="./assets/images/rs-logo2.png" alt="" class="img-fluid"></a>
      </div>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="get-started"  id="login" ><a href="<?php echo $loginUrl?>">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <main id="main">
   
    <!-- ======= Offering Section ======= -->
    <section id="notAuthorize" class="offering">
        <div class="container">
          <div class="section-title">
            <h2>Not Authorized</h2>          
            <div class="row">
              <div class="col-md-12">
                <p>You are not Authorized to access this application. </p> </br>
                <p>Please contact administrator.</p></br>
              </div>
            </div>
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

