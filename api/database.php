<?php
// Error Reporting Turn On
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Setting up the time zone
date_default_timezone_set('Africa/Luanda');

// Host Name
$dbhost = '127.0.0.1:3306';

// Database Name
$dbname = 'u322980294_seteEcomerce';

// Database Username
$dbuser = 'u322980294_sete';

// Database Password
$dbpass = '7$Ete2@25';



try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}