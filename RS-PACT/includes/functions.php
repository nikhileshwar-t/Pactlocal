<?php


function isLoginSessionExpired() {
	$login_session_duration = 900; 
	$current_time = time(); 
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION["user_id"])){  
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
			return true; 
		} 
	}
	return false;
}

function createLog( $event ) {
	global $DB;
	$sessionToken = $_SESSION['access_token'];
	$userId = $_SESSION['user_id'];

	$query= "SELECT logid                   
			 FROM userlog                                               
			 WHERE user_id = '{$userId}'
	AND event_type = '{$event}'
	AND session_token  = '{$sessionToken}'
	ORDER BY logid LIMIT 1";                       

	$result = $DB->freeRun($query);	
	if ($result->num_rows > 0)return;	
	$log = array(    		
		"user_id"	    => $_SESSION['user_id'],
		"session_token"	=> $_SESSION['access_token'],
		"event_type"	=> $event,
		"created_date"  =>"now()"
	);
	$userID = $DB->insert("userlog", $log );
}


function getAdminMenu(){

	$server = HTTP_SERVER;
	$menu = "<a href='{$server}admin/index.php' class='list-group-item list-group-item-action bg-light'>Dashboard</a>";
	
	if( !empty($_SESSION["AdminLogin"]) )
		$menu .= "<a href='{$server}admin/index.php?p=manage-users' class='list-group-item list-group-item-action bg-light'>Manage Users</a>";
	
	$menu .= "<a href='{$server}admin/index.php?p=tenant-config' class='list-group-item list-group-item-action bg-light'>Tenant config</a>";
	
	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["RBL_WEB"]["permission"]) )
		$menu .= "<a href='{$server}admin/rbl-editor-web/index.html' data-event='rbl-editor-web' class='addLogAndRedirect list-group-item list-group-item-action bg-light'>RBL Editor</a>";

	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["BR-VALIDATOR-TOOL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=br-validator-tool&p=index' data-event='br-validator-tool' class='list-group-item list-group-item-action bg-light'>BR Validator Tool</a>";

	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["AUTHORIZATION_MODEL_TOOL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=authorization-model-tool&p=authconfig-api' class='list-group-item list-group-item-action bg-light'>Authorization Model Tool</a>";
		
	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["GRAPH_PROCESS_TOOL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=graph-process-tool&p=index' class='list-group-item list-group-item-action bg-light'>Graph Process Tool</a>";

	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["UI_CONFIG_TOOL"]["permission"]) )
		$menu .= "<a href='https://pact-uiconfigurator.riversand.com/' data-event='ui-config-tool' class=' addLogAndRedirect list-group-item list-group-item-action bg-light'>UI Configuration Tool</a>";

	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["WORKFLOW_APP_MODEL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=workflow-app-model&p=workflow-app-model' data-event='ui-config-tool'class='list-group-item list-group-item-action bg-light'>Workflow App Model </a>";

	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["RBL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=rbl-editor-desktop&p=rbl' class='list-group-item list-group-item-action bg-light'>RBL Editor Desktop Version</a>";
	
	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["OTUT"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=otut&p=index' class='list-group-item list-group-item-action bg-light'>One-time Utility tools</a>";

		
	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["ATTR_MAPPING_TOOL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=attribute-mapping-tool&p=index' class='list-group-item list-group-item-action bg-light'>Attribute Mapping tool</a>";
	
	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["ENTITY_DATA_FILLING_TOOL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=entity-data-filling-tool&p=index' class='list-group-item list-group-item-action bg-light'>Entity Data Filling Tool</a>";

	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["FILE_COMPARISON_TOOL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=file-comparison-tool&p=index' class='list-group-item list-group-item-action bg-light'>File Comparison Tool</a>";

	if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["FILE_COMPARISON_LOVS_TOOL"]["permission"]) )
		$menu .= "<a href='{$server}admin/index.php?t=file-comparison-lovs-tool&p=index' class='list-group-item list-group-item-action bg-light'>File Comparison Lovs Tool</a>";
	return $menu;
}

function getUserPermissions($userId){
	global $DB;
	$permissions = array();
	$query= "SELECT page, page_code, tool_slug FROM application_pages ORDER BY id ";
	$result = $DB->selectFreeRun($query);
	if(!empty($result) && mysqli_num_rows($result) > 0) {
		while ($row = $result->fetch_assoc()) {
			$permissions[$row['page_code']] = array( "page" => $row['page'], 
													 "code" =>$row['page_code'],
													 "tool_slug" => $row['tool_slug'], 
													 "permission" => '0');
		}
	}

	if(!empty($userId) ) {

		$query= "SELECT page_code, page_permission 
				 FROM user_permissions 
				 WHERE user_id ='{$userId}' 
				 ORDER BY permission_id ";
		$result = $DB->selectFreeRun($query);
		if(!empty($result) && mysqli_num_rows($result) > 0) {
			while ($row = $result->fetch_assoc()) {
				$permissions[$row['page_code']]['permission'] = $row['page_permission'];
			}
		}
	}
	return $permissions;
}

function getUser( $userId) {
	global $DB;
	$query= "SELECT user_id, uuid, email, nickname, name, status, is_admin, last_login, created_date 
             FROM users 
			 WHERE user_id = '{$user_id}'
			 ORDER BY name";
    return $DB->selectRaw($query);
}

function validateToken( $access_token) {
	global $DB;
	$query= "SELECT user_id, uuid, email, nickname, name, status, is_admin, last_login, created_date 
             FROM users 
			 WHERE access_token = '{$access_token}'
			 ORDER BY name";
    return $DB->selectRaw($query);
}

function validateAPIToken( $access_token) {
	global $DB;
	$query= "SELECT user_id, uuid, email, nickname, name, status, is_admin, last_login, created_date 
             FROM users 
			 WHERE api_token = '{$access_token}'
			 ORDER BY name";
    return $DB->selectRaw($query);
}

function getUserActiveTanant($user_id) {	
	global $DB;
	$query= "SELECT tc.*, u.nickname
				FROM tenantconfig tc
				LEFT JOIN users u ON u.uuid=tc.uuid 
				WHERE tc.user_id = '{$user_id}'
				AND tc.status = '1'                         
				ORDER BY tc.name";  
				
	return $DB->selectRaw($query);
}

function getTenantUsersAndRoles($user_id){
	
	$postParameters = '{
		"params": {
			"query": {		   
				"filters" : {
					"typesCriterion": [ "user" ]
				}
		  	},
		  	"fields" : {
				"attributes" : ["_ALL"],
				"relationships": ["_ALL"]
		  	}
			}
		  }';
	
	$tenant = getUserActiveTanant($user_id);
	$url = $tenant[0]['web_url'];
	// if(!empty($tenant[0]['web_port']) && !empty($tenant[0]['tenant_id']) ){
	// 	$url .= ":".$tenant[0]['web_port']."/".$tenant[0]['tenant_id'];
	// } 

	$url .= "/api/entitymodelservice/get";	
	$headers = getHeaders( $tenant );

	$result =  curlCall($url, $postParameters, $headers);
	$result = json_decode($result);
	if(!$result->response) return "Problem connecting to the tenant. Please check the details.";

	$userRoles = array();
	foreach($result->response->entityModels as $key => $users ) {
		if(is_array($users->properties->roles)) {
			foreach($users->properties->roles as $k => $role){
				$userRoles[$role] = $userRoles[$role]. $users->properties->email.PHP_EOL;
			}
		} else {
			$userRoles[$users->properties->roles] = $userRoles[$users->properties->roles]. $users->properties->email.PHP_EOL;
		}
	}

	$response = array();
	foreach($userRoles as $key => $value ) {
		$response[] = array("role" =>   $key, "user" => $value );
	}
	return $response;
}

// function getApiUrl($user_id){

// 	$tenant = getUserActiveTanant($user_id);
// 	$url = $tenant[0]['web_url'];
// 	if(!empty($tenant[0]['web_port']) && !empty($tenant[0]['tenant_id']) ){
// 		$url .= ":".$tenant[0]['web_port']."/".$tenant[0]['tenant_id'];
// 	} 	
// 	return $url;

// }

function getHeaders( $tenant ){

	$headers = ($tenant[0]['headers'] == "" ) ? array() : explode(PHP_EOL, $tenant[0]['headers']);

	$headerCheck = array(
		'Content-Type' => "Content-Type:application/json",
		'x-rdp-version' => "x-rdp-version: 8.1",
		'x-rdp-clientId' => "x-rdp-clientId: rdpclient", 
		'x-rdp-tenantId' => "x-rdp-tenantId: ".$tenant[0]['tenant_id'],
		'x-rdp-userId' => "x-rdp-userId: ".$tenant[0]['api_user_id'],
		'x-rdp-userRoles' => 'x-rdp-userRoles: ["'.$tenant[0]['api_user_role'].'"]',
		"auth-client-id" => "auth-client-id: ". $tenant[0]['client_id'],
		"auth-client-secret" =>"auth-client-secret: ". $tenant[0]['client_secret']
	);
	foreach($headerCheck as $key => $value ){
		if (strpos($tenant[0]['headers'], $key) == false) {
			$headers[] = $value;
		}
	}
	return $headers;
}

function getthingEntityTypeAttributes($user_id){

	$postParameters = '{
		"params": {
			"query": {
				"domain": "thing",
				"filters": {
					"typesCriterion": [ "entityType" ]
				}
			},
			"fields": {
				"attributes": [ "_ALL" ],
				"relationships": [ "_ALL" ]
			}
		}
	}';
	
	$tenant = getUserActiveTanant($user_id);
	$url = $tenant[0]['web_url'];
	// if(!empty($tenant[0]['web_port']) && !empty($tenant[0]['tenant_id']) ){
	// 	$url .= ":".$tenant[0]['web_port']."/".$tenant[0]['tenant_id'];
	// } 

	$url .= "/api/entityappmodelservice/get";	
	$headers = getHeaders( $tenant );

	$result =  curlCall($url, $postParameters, $headers);
	$result = json_decode($result);
	
	if(!$result->response) return "Problem connecting to the tenant. Please check the details.";

	$thingEntity = array();
	foreach($result->response->entityModels as $key => $entity ) {
		//if(is_array($entity->data->attributes)) {
			foreach($entity->data->attributes as $k => $attribute){
				$thingEntity[$entity->name] = $thingEntity[$entity->name]. $k.PHP_EOL;
			}
		// } else {
		// 	$thingEntity[$entity->name] = $thingEntity[$entity->name]. $entity->properties->email.PHP_EOL;
		// }
	}

	$response = array();
	foreach($thingEntity as $key => $value ) {
		$response[] = array("entitytype" =>   $key, "entityattributes" => $value );
	}
	return $response;

}

function curlCall($url, $postParameters,  $headers){
	
	$headers = array_map('trim', $headers);
	$ch = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_URL, trim($url)); // set url to which the request will be sent
	curl_setopt($ch, CURLOPT_SSLVERSION,1); // Always use TLS V1.2 or higher
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // Verify ssl peer, this will need to be set to 1 in production
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // Production setting is always 2, this verifies the SSL host
	curl_setopt($ch, CURLOPT_HEADER, 0); // we will not be sending any headers across using CURL
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	
	curl_setopt($ch, CURLOPT_POST, TRUE); // set CURL request to use POST, always use POST
	curl_setopt($ch, CURLOPT_POSTFIELDS, str_replace(' ','',$postParameters)); // specify the data to be sent over
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // allows a data stream to come back to the CURL request
	curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE); // this helps with man in the middle attacks
	$result = curl_exec($ch); // execute the CURL call and set the returned data into the results variable

	if (curl_errno($ch)) { 
		//error_log("(".__LINE__.") ".__FILE__." -->".curl_errno($ch)." ERROR\n");		
		//print_r(curl_errno($ch)); 
	}
	curl_close($ch); // close the CURL connection
	return ($result);	
}



function getContext($user_id){
	
	$postParameters = '{
		"params": {
			"query": {
				 "id": "thing_entityContextModel",
				"contexts": [ {} ],
				"filters": {
					"typesCriterion": [ "entityContextModel" ]
				}
			},
			"fields": {
				"properties": [ "_ALL" ],
				"attributes": [ "_ALL" ],
				"relationships": [ "_ALL" ]
			}
		}
	}';
	
	$tenant = getUserActiveTanant($user_id);
	$url = $tenant[0]['web_url'];

	$url .= "/api/entitymodelservice/get";	
	$headers = getHeaders( $tenant );

	$result =  curlCall($url, $postParameters, $headers);
	$result = json_decode($result);
	if(!$result->response) return "Problem connecting to the tenant. Please check the details.";
	if(empty($result->response->entityModels[0]->properties->coalesceInfo)) return "No context defined in the Tanant.";

	$contextType = array();
	$contype =  array();
	
	foreach($result->response->entityModels[0]->properties->coalesceInfo as $coalesceInfo ) {		
		$contextType[] = $coalesceInfo->contextKey;	
		$contype[] = '"'. $coalesceInfo->contextKey . '"';		
	}
	//get the context names 

	$postParameters = '{
		"params": {
			"query": {
				"filters": {
					"typesCriterion": [
						'. implode(", ", $contextType).'
					]
				},
				"contexts": [ {} ]
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
		
	$url = $tenant[0]['web_url'];
	$url .= "/api/entityservice/get";
	$result =  curlCall($url, $postParameters, $headers);
	$result = json_decode($result);

	$contextEntity = array();
	$contextList = array();
	foreach($result->response->entities as $key => $entity ) {				
		$contextEntity[$entity->type] = $contextEntity[$entity->type].$entity->name.PHP_EOL;
		$contextList[] = $entity->name;
	}
	$response = array();
	foreach($contextEntity as $key => $value ) {
		$response['context'][] = array("contexttype" =>   $key, "contextnames" => $value );
	}
	$response['contextList'] = $contextList;
	return $response;
}
