<?php
require "vendor/autoload.php";
include('./includes/configure.php');

use Auth0\SDK\Auth0;

$auth0 = new Auth0([
  'domain' => 'riversandsso.auth0.com',
  'client_id' => 'FN35vvUQlFBYjDOY0M5kBhxdvqFezbAE',
  'client_secret' => 'aGwG03nptm5O-subiB6sYWzva8cxDng4IJmbSmUEZVWgcqh7Ao0B--pQ_QfuaBGU',
  'redirect_uri' => HTTP_SERVER.'callback.php',
  'audience' => 'https://riversandsso.auth0.com/userinfo',
  'persist_id_token' => true,
  'persist_access_token' => true,
  'persist_refresh_token' => true,
]);
$userInfo = $auth0->getUser();

if (!$userInfo) {
    die("Error while logging you in. Please retry");
} else {

    $uuid = str_replace("auth0|", "", $userInfo["sub"]);
    $query ="SELECT user_id FROM users WHERE uuid = {$uuid} LIMIT 1";    
    $result = $DB->selectFreeRun($query); 
    $dbUser = array();  
    if(!empty(($result)) &&  mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $dbUser = $row ;
        }
    }
      
    $user = array(
        "uuid"          => $uuid,
        "nickname"      => $userInfo["nickname"],
        "name"          => $userInfo["name"],
        "picture"       => $userInfo["picture"],
        "updated_at"    => $userInfo["updated_at"],
        "authorization" => "auth0",
        "last_login"    => "now()"
    );

    if(empty($result)){
        $DB->insert("users", $user );
    } else {
        $DB->update("users", $user, "uuid = {$uuid}" );
    }
    // Set Session 
    //session_start();
	  
    $_SESSION["AdminLogin"]="True";
    $_SESSION['uuid'] = $user['uuid'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['picture'] = $user['picture'];
    $_SESSION['timeout']=time();
    $_SESSION['date']=date(DATE_RFC850);
    header("Location: " .HTTP_SERVER. "admin/index.php");        
}
