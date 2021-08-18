<?php
include('./includes/configure.php');

$userID = $_SESSION["user_id"];
createLog("logout");
$DB->update("users", array("last_logout" => "now()", "access_token" => ""), "user_id = '{$userID}'" );

session_unset();
session_destroy(); // destroy session
session_write_close();
setcookie("PHPSESSID","",time()-3600,"/"); 
header("location: ". HTTP_SERVER."index.php");
// session_start();
// session_unset();
// session_destroy();
// session_write_close();
// setcookie(session_name(),'',0,'/');
// session_regenerate_id(true);