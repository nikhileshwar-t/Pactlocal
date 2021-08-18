<?php
	ob_start();
	session_start();
	// Report all errors except E_NOTICE   
	error_reporting(E_ALL ^ E_NOTICE);
	// date_default_timezone_set('Asia/Calcutta');
	// ini_set('max_execution_time','100');
	// ini_set('session.gc_maxlifetime', '100');
	
	define('HTTP_SERVER', 'https://pact.riversand.com/');
	// define('HTTP_SERVER_ADMIN', 'http://localhost/projects/Painter/MK-admin/');
	// define('IMAGES', 'http://localhost/projects/Painter/images/');
	
	define('AZURE_AD_CLIENT_ID', '');
	define('AZURE_AD_CLIENT_SECRET', '');

	define('DB_SERVER', 'localhost');
	define('DB_SERVER_USERNAME', '');
	define('DB_SERVER_PASSWORD', '');
	define('DB_DATABASE', '');

	require_once('MysqlDB.php');
	require_once('functions.php');
	
		
	
