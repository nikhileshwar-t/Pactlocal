<?php
include('../includes/configure.php');
//Check session 
if(time() - $_SESSION['loggedin_time'] > 900) { //subtract new timestamp from the old one 
  header("Location:{$logoutUrl}?session_expired=1");
  exit;
} else {
  $_SESSION['loggedin_time'] = time(); //set new timestamp
}

// Check user active status 
if(!isset($_SESSION['userActive']) || $_SESSION['userActive'] == '0') header("Location: " .HTTP_SERVER. "not-authorize.php");

//Define constant URL
$avtar = "https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={$_SESSION['name']}";
$tenantUrl = (empty($_SESSION['tenant_name']))? '' : "<li class='get-started'style='padding:8px'><a class='redirect' href='".HTTP_SERVER."admin/index.php?p=tenant-config'>{$_SESSION['tenant_name']} </a></li> ";
$logoutUrl = HTTP_SERVER."logout.php";
$feedbackUrl = HTTP_SERVER . "admin/index.php?p=feedback";


if($_GET["p"] == "tenant-config") {
  $tenant = getUserActiveTanant($_SESSION['user_id']);
  $_SESSION["tenant_name"]  = (empty($tenant))? '' :  $tenant[0]['name'];
}


//Redirect to the page 
$tool = "";
if(!empty($_GET["t"])){
  createLog($_GET["t"]);
  $tool = $_GET["t"]."/"; 
}

$page = "dashboard.php" ;
if(!empty($_GET["p"])) {
  $page = $_GET["p"]. '.php'; 
  if(empty($_GET["t"])){
    createLog($_GET["p"]);
  }
}

// Check user permissions 
$hasPermission = 0;
if(!empty($tool) && empty($_SESSION["AdminLogin"]) ) {
  foreach($_SESSION['permissions'] as $key => $permission) {    
    if($permission['tool_slug'] == $_GET["t"] ){
      $hasPermission = 1;
      break;
    }
  }
  if(empty($hasPermission)) header("Location: " .HTTP_SERVER. "not-authorize.php");
}


//Set 404 not founc condition 
if (!is_file($tool.$page)) header("Location: " .HTTP_SERVER. "404.html");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link href="../assets/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
      <meta charset="UTF-8">
      <title>Riversand | PACT Platform</title>
      <meta http-equiv="refresh" content="900;url=<?php echo $logoutUrl; ?>" />
      
      <!-- jQUERY   -->
      <script src="../assets/js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <!-- Auth0 -->
      <script src="../assets/js/auth0.min.js"></script>

      <!-- Vendor CSS Files -->
      <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
      <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
      <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

      <!-- Template Main CSS File -->
      <link href="../assets/css/theamstyle.css" rel="stylesheet">
      <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
      <link rel="stylesheet" href="../assets/css/style.css"> 

   </head>
   <body >

   <!-- ======= Header ======= -->
   <header id="header" class="top">
   
    <div class="container d-flex">
      <button class="navbar-toggler toggler-example" id="menu-toggle">
         <span class="dark-blue-text"><i class="icofont-navigation-menu"></i></span>
      </button>
      <div class="logo mr-auto">
        <a href="index.php"><img src="../assets/images/large-PACT-logo.png" alt="" class="img-fluid">&nbsp; <label>(Beta) </label></a>
      </div>  
       
      
    <nav class="nav-menu d-none d-lg-block">
 
       <ul>
         
         <?php echo $tenantUrl ?>
       
        <li class="nav-item dropdown" style="padding:8px">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="top" title="Actions">
            <img src="../assets/images/mainlogo.png" style="width:15px">  
            </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" href="#"data-toggle="modal" data-target="#help">Download Configs</a>
             <a class='redirect' href="<?php echo $feedbackUrl;?>">Feedback</a>
          </div>
         </li>
        

       
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" >
            <img src="<?php echo $avtar ?>" class="rounded-circle avtar" > 
            </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" id="logout"  href="<?php echo $logoutUrl;?>">Logout</a>
            </div>
          </li> 
        </ul>
      </nav><!-- .nav-menu -->
      

    </div>
   </header><!-- End Header -->
   <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <!-- <div class="sidebar-heading"></div> -->
        <div class="list-group list-group-flush">
          <?php echo getAdminMenu() ?>
          
        </div>
      </div>
      <!-- /#sidebar-wrapper -->

    <div id="page-content-wrapper">
      <main id="main">
         <?php require_once($tool.$page);?>
      </main><!-- End #main -->
    </div>
    </div>
   


    <!-- ======= Modal ======= -->
    <div class="modal fade" id="help">
    <div class="modal-dialog modal-sm">
  
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Download Configs</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <table class="table table-bordered">
    <thead>
      <tr>
        <th>Configs</th>
        <th>links</th>
      
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Graph Process</td>
        <td><a onclick="graphsdata()" href="#">Download</a></td>
      </tr>
      <tr>
        <td>Integration Profiles</td>
        <td><a  onclick="Profiles()" href="#">Download</a></td>
        
      </tr>
      <tr>
        <td>Match Configs</td>
        
        <td><a  onclick="matchConfigs()"href="#" >Download</a></td>
      </tr>
       <tr>
        <td>Ui-Configs</td>
        <td> <a   onclick="result()" href="#">Download</a></td>
        </tr>
        <tr>
        <td>Service Configs</td>
        <td> <a   onclick="serviceconfigs()" href="#">Download</a></td>
        </tr>
        <tr>
        <td>Integration Configs</td>
        <td> <a   onclick="integrationconfigs()" href="#">Download</a></td>
        </tr>
        <tr>
        <td>Savedsearch Configs</td>
        <td> <a   onclick="savedsearchconfigs()" href="#">Download</a></td>
        </tr>
        <tr>
        <td>Sheduletask Configs</td>
        <td> <a   onclick="sheduletaskconfigs()" href="#">Download</a></td>
        </tr>
        <tr>
        <td>Notification Configs</td>
        <td> <a onclick="notificationConfigs()" href="#">Download</a></td>
        </tr>
        <tr>
        <td>SavedScope Configs</td>
        <td> <a onclick="savedscopeconfigs()" href="#">Download</a></td>
        </tr>
        <tr>
        <td>Rendition Configs</td>
        <td> <a onclick="rendetionconfigs()" href="#">Download</a></td>
        </tr>
    </tbody>
  </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        </button>
                        
        </div>
        
      </div>
    </div>
  </div>
  
</div>
        
  

        
        
  

   
<!-- ======= Footer ======= -->
<footer id="footer">
<div class="container py-4">
  <a href="https://www.riversand.com/" class="logofooter"><img src="../assets/images/rs-logo2.png" ></a>
  <div class="copyright">&copy; 2020 Riversand All Rights Reserved. 
  </div> 
</div>
</footer><!-- End Footer -->
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="../assets/vendor/venobox/venobox.min.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>

<script type="text/javascript" language="javascript" >
   var HTTP_SERVER = '<?php echo HTTP_SERVER ?>';
  //  var JSON_PATH = HTTP_SERVER+ "admin/attribute-mapping-tool/";
</script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" > </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"
    integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"
    integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ=="
    crossorigin="anonymous"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>
<script src="../assets/js/download-configs.js"></script>
<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

  $('a.redirect').click(function (event) {
    event.preventDefault();
    var href = $(this).attr('href')
    window.location= href;
  });

  $('a.addLogAndRedirect').click(function (event) {
    event.preventDefault();
    var href = $(this).attr('href')
    var event = $(this).data('event')

    $.ajax({
              url: "<?php echo HTTP_SERVER ?>/api/users.php?method=addLog",                       
              type: 'POST',
              dataType: 'text',               
              contentType: 'application/x-www-form-urlencoded',
              data: { "event": event }, 
              success: function (response) {
                  // response = JSON.parse(response);
              }
          }); 
    window.open(href, '_blank');
    //window.location = href;
  });


</script>

</body>
</html>

