<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');

function connect_database() {
	$fetchType = "array";
	$dbHost    = "localhost";
	$dbLogin   = "jwyvwind_kalwa";
	$dbPwd     = "jwyvwind_kalwa";
	$dbName    = "jwyvwind_kalwa";
	$con       = mysqli_connect($dbHost, $dbLogin, $dbPwd, $dbName);
	if (!$con) {
		die("Database Connection failes" . mysqli_connect_errno());
	}
	return ($con);
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'jwyvwind_kalwa');
define('DB_PASSWORD', 'jwyvwind_kalwa');
define('DB_NAME', 'jwyvwind_kalwa');
?>