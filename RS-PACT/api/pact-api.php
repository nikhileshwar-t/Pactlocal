<?php
require_once('../includes/configure.php');
try {
        $a_response = array(
            "status" => "success",
            "data" => ""  );

        if (!isset($_REQUEST['method'])) 
            throw new Exception("Method not defined for processing Request", 1);
        
        if (!isset($_REQUEST['access_token']) || empty($_REQUEST['access_token'])) 
            throw new Exception("Access token not defined for processing Request", 1);       

        switch ($_REQUEST['method']) {

            case 'getUserActiveTenant':

                $user = validateAPIToken($_REQUEST['access_token']);
                if (empty($user)) throw new Exception("Un-authorized user ", 1);                
                $user = $user[0];

                if (empty($user['status']))throw new Exception("User is in-active.", 1);
                               
                $tenantData = getUserActiveTanant($user["user_id"]);
                if (empty($tenantData)) throw new Exception("No active tenant found.", 1);

                $tenantData = $tenantData[0];                
                unset($user['is_admin']);
                unset($user['last_login']);
                unset($user['created_date']);
                unset($tenantData['tenantconfig_id']);
                unset($tenantData['user_id']);
                unset($tenantData['uuid']);
                unset($tenantData['created_date']);
                              
                $a_response['data'] = array('user' => $user, "tenant" => $tenantData );

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
