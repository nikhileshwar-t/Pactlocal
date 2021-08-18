<?php
	ob_start();
	session_start();
	// Report all errors except E_NOTICE   
	//error_reporting(E_ALL ^ E_NOTICE);
	error_reporting(0);
	// date_default_timezone_set('Asia/Calcutta');
	// ini_set('max_execution_time','100');
	// ini_set('session.gc_maxlifetime', '100');
	
	define('HTTP_SERVER', 'http://localhost/RS-PACT/');
	// define('HTTP_SERVER_ADMIN', 'http://localhost/projects/Painter/MK-admin/'); 
	// define('IMAGES', 'http://localhost/projects/Painter/images/');
	
	define('AZURE_AD_CLIENT_ID', 'eb31d325-384e-4d89-bd2b-1f00f9aecf07');
	// define('AZURE_AD_CLIENT_SECRET', '8.njVcd?dGuDKSsn@nP722Wu@Yk=_aVx');
	 define('AZURE_AD_CLIENT_SECRET', '6~9PxQRk13Vih-Tzj9xoiO-z.~QoJAi2De');

	define('DB_SERVER', 'localhost');
	define('DB_SERVER_USERNAME', 'root');
	define('DB_SERVER_PASSWORD', '');
	define('DB_DATABASE', 'pacttool');

	define('SMTP_HOST', 'smtp.office365.com');
	define('SMTP_PORT', 587 );
	define('SMTP_USERNAME', 'PACTTeam@riversand.com');
	define('SMTP_PASSWORD', '');
	define('SMTP_SENDTO_EMAIL', 'PACTTeam@riversand.com');

	require_once('MysqlDB.php');
	require_once('functions.php');
	
		
	
