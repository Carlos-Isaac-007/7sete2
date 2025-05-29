<?php
// Error Reporting Turn On
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Setting up the time zone
date_default_timezone_set('Africa/Luanda');

// Host Name
$dbhost = 'localhost';

// Database Name
$dbname = '7sete';

// Database Username
$dbuser = 'root';

// Database Password
$dbpass = '';

// Defining base url
// crianado a variavel root
$url = $_SERVER['REQUEST_SCHEME']."://". $_SERVER['SERVER_NAME']."/";
// url do Admin ou sej a para todos os arquivos no admin pasta
$urlAmin = $_SERVER['REQUEST_SCHEME']."://". $_SERVER['SERVER_NAME']."/admin"."/";

$root = $_SERVER['REQUEST_SCHEME']."://". $_SERVER['SERVER_NAME']. $_SERVER['PHP_SELF']; 
// crinado as variavel de qualquer acesso para a as url do site
define("URL",$url);
define("URLADMIN",$urlAmin);

define("BASE_URL", $root);
define("NOME_EMPRESA","7Setetechnology");
// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");


try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("SET time_zone = '+01:00'");
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}