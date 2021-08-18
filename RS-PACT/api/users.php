<?php
require_once('../includes/configure.php');
try {
        $a_response = array(
            "status" => "success",
            "data" => ""  );
            $uuid = $_SESSION['uuid'];

        if (!isset($_REQUEST['method'])) 
            throw new Exception("Method not defined for Processing Request", 1);

        switch ($_REQUEST['method']) {

            case 'getUsers':
                
                $query= "SELECT user_id, uuid, email, name, status, is_admin, 
                        last_login, last_logout, created_date, is_partner, partner_name,
                        CASE
                        WHEN (access_token IS NULL OR access_token = '') THEN 0 ELSE 1
                        END AS is_online                                
                        FROM users ORDER BY name";
                $a_response['data'] =$DB->selectRaw($query);
            break;


            case "getUserLog": 

                $query = "SELECT GROUP_CONCAT(ul.event_type SEPARATOR '<br />')as event, 
                GROUP_CONCAT(ul.created_date  SEPARATOR '<br />')as log_date,
                u.*,
                CASE
                WHEN (u.access_token =ul.session_token ) THEN 1 ELSE 0
                        END AS is_online 
                FROM `userlog` ul
                left join users u on u.user_id = ul.user_id               
                group by ul.user_id, ul.session_token";
                $a_response['data'] =$DB->selectRaw($query);

            break;



            case 'add':

                if(isset($_POST['name']) && $_POST['name'] == "" ) throw new Exception("User Name not defined.", 1);
                if(isset($_POST['email']) && $_POST['email'] == "") throw new Exception("Email not defined.", 1);
                $email = strtolower($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception("Email not valid.", 1);

                $query ="SELECT user_id FROM users WHERE email = '{$email}' ORDER BY email LIMIT 1";    
                $result = $DB->selectFreeRun($query); 
                 
                if(!empty(($result)) &&  mysqli_num_rows($result) > 0) {
                    throw new Exception("Email already exist in database.", 1);
                }

                $user = array(                    
                    "nickname"      => $_POST['name'],
                    "name"          => $_POST['name'],
                    "email"         => $email,
                    "status"        => (isset($_POST['status'])) ? 1: 0,
                    "last_login"    => "now()",
                    "is_partner"    => (isset($_POST['is_partner'])) ? 1: 0,
                    "partner_name"  => $_POST['partner_name'],
                );

                $userID = $DB->insert("users", $user );                
                $a_response['data'] = "User added successfully.";

            break;

            case 'savePermissions':

                //Store user data in variable for link account
                if(!isset($_POST['user_id']) && !empty($_POST['user_id'])) throw new Exception("user id not defined.", 1);
                $user_id = $_POST['user_id'];

                //update user 
                $updateArray = array( "is_admin" => (isset($_POST['administrator']))? "1" : "0 ");               
                $result = $DB->update("users", $updateArray, "user_id = '{$user_id}'" );
                 
                //update user permissions 
                $DB->freeRun("DELETE FROM user_permissions WHERE user_id = '{$user_id}' " );               

                if(!empty($_POST['user_id']) && !empty($_POST['user_id'])) { 
                    $permissions = getUserPermissions($_POST['user_id']) ;
                }
                foreach($permissions as $key => $permission ) {

                    foreach($_POST as $pkey => $pvalue){
                        if($key == $pkey) {
                            $insertData = array(
                                "user_id" => $_POST['user_id'],
                                "page_code"  => $pkey,
                                "page_permission"  => '1'
                            );                            
                            $result = $DB->insert("user_permissions", $insertData );
                        }
                    }
                }
                $a_response['data'] = "Permissions Saved successfully.";     

            break;

            case 'setStatus':

                //Store user data in variable for link account                              
                $insertData = array( "status" => ($_POST['status'] == 0) ? 1 : 0  );
                
                if(isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])){
                    $user_id = $_POST['user_id'];
                    $result = $DB->update("users", $insertData, "user_id = '{$user_id}'" );
                }
                $a_response['data'] = "Status updated successfully.";
            break;

            case 'getUserPermissions':

                $permissions = array();
                if(!empty($_POST['user_id']) && !empty($_POST['user_id'])) { 
                    $permissions = getUserPermissions($_POST['user_id']) ;
                }
                $a_response['data'] = $permissions;
            break;

            //Authorization App Model API to get the tenant specific users and Roles 
            case 'getTenantUsersAndRoles':
                $response = getTenantUsersAndRoles($_SESSION['user_id']);  
                if(!is_array($response)) throw new Exception( $response, 1);              
                $a_response['data'] = $response;
            break;

            //Authorization App Model API to get the tenant specific users and Roles 
            case 'getthingEntityTypeAttributes':
                $response = getthingEntityTypeAttributes($_SESSION['user_id']); 
                if(!is_array($response)) throw new Exception( $response, 1);          
                $a_response['data'] = $response;
            break;

            //Authorization App Model API to get the tenant specific users and Roles 
            case 'getUserActiveTenant':
                $response = getUserActiveTanant($_SESSION["user_id"]);
                $a_response['data'] = $response;
            break;
            //Authorization App Model API to get the tenant specific users and Roles 
            case 'getContext':
                $response = getContext($_SESSION["user_id"]);
                if(!is_array($response)) throw new Exception( $response, 1); 
                $a_response['data'] = $response;
            break;

            case 'addLog':
                createLog( $_POST['event'] );
                //$a_response['data'] = $response;
            break;
                   
            default:
                $a_response['status'] = 'error';
                $a_response['data']   = 'Method requested does not exist.';
            break;
        }
    } catch (Exception $e) {
        $a_response['status'] = 'error';
        $a_response['data']     = $e->getMessage();
    }
// Send Json response to api
echo json_encode($a_response);
