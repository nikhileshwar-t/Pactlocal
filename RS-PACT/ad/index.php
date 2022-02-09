<?php
// test test
// Use Composers autoloading
require '../vendor/autoload.php';
include('../includes/configure.php');
session_start();

$config = [
    'authentication' => [
        'ad' => [
            'client_id' => AZURE_AD_CLIENT_ID,
            'client_secret' => AZURE_AD_CLIENT_SECRET,
            'enabled' => 'yes',
            'directory' => 'common',
            'return_url' => HTTP_SERVER."ad/index.php",
        ]
    ]
];

$request = new \Zend\Http\PhpEnvironment\Request();
$ad = new \Magium\ActiveDirectory\ActiveDirectory(
    new \Magium\Configuration\Config\Repository\ArrayConfigurationRepository($config),
    Zend\Psr7Bridge\Psr7ServerRequest::fromZend(new \Zend\Http\PhpEnvironment\Request())
);

$entity = $ad->authenticate();

if (isset($entity)) {
      
    $uuid = $entity->getOid();
    $email = strtolower($entity->__get('email'));
    $query ="SELECT user_id, status, is_admin, access_token 
             FROM users WHERE email = '{$email}' 
             ORDER BY email LIMIT 1";    
    $result = $DB->selectFreeRun($query); 
    $dbUser = array();  
    if(!empty(($result)) &&  mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $dbUser = $row ;
        }
    }
    $user = array(
        "uuid"          => $uuid,
        "nickname"      => $entity->getPreferredUsername(),
        "name"          => $entity->getName(),
        "email"         => strtolower($entity->__get('email')),
        "last_login"    => "now()",
        "access_token"  => $entity->__get("access_token")
    );

    if(count($dbUser) == 0 ){
        $userID = $DB->insert("users", $user );
        $query ="SELECT user_id, status, is_admin, access_token 
                 FROM users WHERE user_id = '{$userID}' 
                 ORDER BY email LIMIT 1";    
        $result = $DB->selectFreeRun($query); 
        $dbUser = array();  
        if(!empty(($result)) &&  mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $dbUser = $row ;
            }
        }
    } else {
        $userID = $dbUser["user_id"];
        $DB->update("users", $user, "user_id = '{$userID}'" );
    }
    $_SESSION['userActive']  = $user['status'];
    if($user['status'] == '0') header("Location: " .HTTP_SERVER. "not-authorize.php");

    $tenant = getUserActiveTanant($userID);
    $_SESSION["tenant_name"]  = (empty($tenant))? '' :  $tenant[0]['name'];

    $_SESSION["AdminLogin"]  = $dbUser['is_admin'];
    $_SESSION['user_id']     = $userID;
    $_SESSION['uuid']        = $user['uuid'];
    $_SESSION['name']        = $user['name'];
    $_SESSION['email']       = $user['email'];
    $_SESSION['access_token']= $user['access_token'];
    $_SESSION['userActive']  = $dbUser['status'];
    $_SESSION['permissions'] = getUserPermissions($userID);
    $_SESSION['loggedin_time']     = time();
    $_SESSION['date']        = date(DATE_RFC850);

    createLog("login");
   
    header("Location: " .HTTP_SERVER. "admin/index.php");        
}
  
