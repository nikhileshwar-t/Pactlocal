<?php
include('../includes/configure.php');

try {
        $a_response = array(
            "status" => "success",
            "data" => ""  );
            $uuid = $_SESSION['uuid'];

        if (!isset($_REQUEST['method'])) 
            throw new Exception("Method not defined for Processing Request", 1);

        switch ($_REQUEST['method']) {

            case 'getTenantConfigs':
                
                $finalResultArr = [];
                $query= "SELECT *                   
                         FROM tenantconfig                                               
                         WHERE uuid = '{$_SESSION['uuid']}'
                         ORDER BY name";

                $result = $DB->selectFreeRun($query);

                //if (empty($result))  throw new Exception("No records found", 1); 
               
                if(!empty($result) && mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $finalResultArr[] = $row;
                    }
                    $a_response['data'] = $finalResultArr;
                }

            break;

            case 'deleteTenantConfigs':
                
                if (!isset($_REQUEST['tenantconfig_id'])) 
                    throw new Exception("Please specify the id", 1);
                   
                $tenantconfig_id = $_REQUEST['tenantconfig_id'];
                if( !is_numeric($tenantconfig_id))
                    throw new Exception("Please enter a valid id", 1);                   

                    //CHECKING USED LOGGEDIN OR NOT
                    //if(isset($_SESSION['uuid']) || (isset($_GET['uuid']) && !empty($_GET['uuid']))) {

                    //Fetching camp_id from engageme_offers table
                    $query= "DELETE FROM tenantconfig                                               
                    WHERE tenantconfig_id = {$tenantconfig_id}
                    AND uuid = '{$_SESSION['uuid']}'";

                    $result = $DB->freeRun($query); 
                    if (empty($result))  throw new Exception("You do not have permission to delete the record.", 1);
                    $a_response['data'] = 'Record deleted Successfully.';                  
                //}
            break;

            case 'upsertTenantConfigs':

                //Store user data in variable for link account
                if(empty($_POST['name'])) throw new Exception("Tenant configuration name not defined.", 1);
                if(empty($_POST['web_url'])) throw new Exception("Tenant URL not defined.", 1);
                if(empty($_POST['tenant_id'])) throw new Exception("Tenant id not defined.", 1);
                
                $insertData = array(
                    "uuid" => $_SESSION['uuid'],
                    "user_id" => $_SESSION['user_id'],
                    "name"  => $_POST['name'],
                    "tenant_id"  => $_POST['tenant_id'],
                    "web_url" => $_POST['web_url'],
                    "web_port" => empty($_POST['web_port']) ? 0 : $_POST['web_port'],
                    "headers" => $_POST['headers'],
                    "client_id" => $_POST['client_id'],
                    "client_secret" => $_POST['client_secret'],
                    "api_user_role" => $_POST['api_user_role'],
                    "api_user_id" => $_POST['api_user_id']
                );

                if(isset($_POST['tenantconfig_id']) && !empty($_POST['tenantconfig_id']) && is_numeric($_POST['tenantconfig_id'])){
                    $tenantconfig_id = $_POST['tenantconfig_id'];
                    $result = $DB->update("tenantconfig", $insertData, "tenantconfig_id = {$tenantconfig_id}" );
                    $a_response['data'] = 'Record updated Successfully.'; 
                } else {
                    $tenantId  = $_POST['tenant_id'];
                    $userId  = $_SESSION['user_id'];
                    $query= "SELECT *                   
                        FROM tenantconfig                                               
                        WHERE tenant_id  = '{$tenantId}'
                        AND user_id = '{$userId}'
                        ORDER BY name LIMIT 1";                       

                    $result = $DB->freeRun($query);
                    if ($result->num_rows > 0) throw new Exception("Tenant details for the tenant ID already exist", 1);

                    $result = $DB->insert("tenantconfig", $insertData );
                    $a_response['data'] = 'Record inserted Successfully.'; 
                }             

            break;
            case 'setStatus':

                //Store user data in variable for link account
                if(!isset($_POST['name']) && !empty($_POST['name'])) throw new Exception("Name not defined.", 1);

                if(isset($_POST['status']) ){
                    $result = $DB->selectFreeRun("UPDATE tenantconfig SET status = 0 WHERE uuid = '{$_SESSION['uuid']}'");
                }                
                $insertData = array( "status" => ($_POST['status'] == 0) ? 1 : 0  );

                if(isset($_POST['tenantconfig_id']) && !empty($_POST['tenantconfig_id']) && is_numeric($_POST['tenantconfig_id'])){
                    $tenantconfig_id = $_POST['tenantconfig_id'];
                    $result = $DB->update("tenantconfig", $insertData, "tenantconfig_id = {$tenantconfig_id}" );
                }               
            break;

            case 'getTenantConfigById':

                if(!empty($_POST['tenantconfig_id']) && !empty($_POST['tenantconfig_id'])) { 
                    $tenantconfig_id = $_POST['tenantconfig_id'];
                    $query= "SELECT *                   
                        FROM tenantconfig                                               
                        WHERE tenantconfig_id = {$tenantconfig_id}
                        ORDER BY name LIMIT 1";

                $result = $DB->selectFreeRun($query);

                if (empty($result))  throw new Exception("No records found", 1); 
               
                if(mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $finalResultArr[] = $row;
                    }
                    $a_response['data'] = $finalResultArr;
                }                 

                } else {
                    throw new Exception("tenantconfig_id not specified", 1);
                }
            break;
            case 'testConnection':

                //Store user data in variable for link account
                //Store user data in variable for link account
                if(empty($_POST['name'])) throw new Exception("Tenant configuration name not defined.", 1);
                if(empty($_POST['web_url'])) throw new Exception("Tenant URL not defined.", 1);
                if(empty($_POST['tenant_id'])) throw new Exception("Tenant id not defined.", 1);

                $postParameters = '{
                    "params": {
                        "query": {
                            "domain": "thing",
                            "filters": {
                                "typesCriterion": [
                                    "entityType"
                                ]
                            }
                        },
                        "fields": {
                            "attributes": [
                                "_ALL"
                            ],
                            "relationships": [
                                "_ALL"
                            ]
                        }
                    }
                }';
                $url = $_POST['web_url'];
                $url .= "/api/entityappmodelservice/get";

                $tenant = array(
                    "0" => array(
                        "tenant_id" => $_POST['tenant_id'],
                        "api_user_id" => $_POST['api_user_id'],
                        "api_user_role" => $_POST['api_user_role'],
                        "client_id" => $_POST['client_id'],
                        "client_secret" => $_POST['client_secret'],
                        "web_url" => $_POST['web_url']
                        )
                );
                $headers = getHeaders( $tenant );
                $result =  curlCall($url, $postParameters, $headers);
                $result = json_decode($result);                
                if(!$result->response) throw new Exception("Problem connecting to the tenant. Please check the details.", 1);
                $a_response['data'] = 'Valid tenant details, Connected successfully.';               
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