<?php
require_once('../includes/mongoDB.php');
try {
        $a_response = array(
            "status" => "success",
            "data" => ""  );
          
        if (!isset($_REQUEST['method'])) 
            throw new Exception("Method not defined for Processing Request", 1);

        switch ($_REQUEST['method']) {

            case 'add' : 
                if (!isset($_REQUEST['table_name'])) 
                throw new Exception("table Name  not defined for Processing Request", 1);
                if (!isset($_REQUEST['json_data'])) 
                throw new Exception("json data  not defined for Processing Request", 1);

                $result = $Mdb->insertRow($_REQUEST['table_name'] , $_REQUEST['json_data']);
            break;

            case 'get':
                if (!isset($_REQUEST['table_name'])) 
                throw new Exception("table Name  not defined for Processing Request", 1);
                if (!isset($_REQUEST['row_name'])) 
                throw new Exception("row Name  not defined for Processing Request", 1);

                $result =  $Mdb->readRow($_REQUEST['table_name'],$_REQUEST['row_name']);              
               
                $a_response['data'] = $result ;
            break;

            case 'get_all':
                if (!isset($_REQUEST['table_name'])) 
                throw new Exception("table Name  not defined for Processing Request", 1);

                $result = $Mdb->getDocuments($_REQUEST['table_name']);
                $a_response['data'] = $result;
            break;

            case 'delete' :
                if (!isset($_REQUEST['table_name'])) 
                throw new Exception("table Name  not defined for Processing Request", 1);
                if (!isset($_REQUEST['row_name'])) 
                throw new Exception("row Name  not defined for Processing Request", 1);
                $result =  $Mdb->deleteRow($_REQUEST['table_name'],$_REQUEST['row_name']);   
                

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
