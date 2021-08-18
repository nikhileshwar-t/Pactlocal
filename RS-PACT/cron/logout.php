<?php
include('../includes/configure.php');
$query= "SELECT GROUP_CONCAT(ul.event_type)as event, 
        GROUP_CONCAT(ul.created_date)as log_date,
        u.*
        FROM `userlog` ul
        left join users u on u.user_id = ul.user_id
        WHERE u.access_token != ''
        and u.access_token = ul.session_token
        group by ul.user_id";

$result = $DB->selectFreeRun($query);
if(!empty($result) && mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        $userID = $row["user_id"];
        $logTime = end(explode(',',$row["log_date"] ));       

        $diff = date_diff( date_create($logTime), date_create(date("Y-m-d h:i:s")));        
        if($diff->h > 6 ) {
            $log = array(    		
                "user_id"	    => $row['user_id'],
                "session_token"	=> $row['access_token'],
                "event_type"	=> 'logout',
                "created_date"  =>"now()"
            );
            $userID = $DB->insert("userlog", $log );

            $DB->update("users", array("last_logout" => "now()", "access_token" => ""), "user_id = '{$userID}'" );     

        }
    }
}