<?php
//http://localhost/T1emprego02/profile.php?id=88964
// print_r($_GET['url']);
// die;
function split_url(){
  $url = isset($_GET['url'])?$_GET['url']:'home';
  return explode("/", filter_var(trim($url,"/"),FILTER_SANITIZE_URL));
}

// crianado a variavel root
$root = "";
$root = $_SERVER['REQUEST_SCHEME']."://". $_SERVER['SERVER_NAME']. $_SERVER['PHP_SELF']; 

$root = str_replace("index.php","",$root);
//print_r($root);

define("ROOT",$root);

//echo "<pre>";
$URL = split_url();
//print_r($URL);
// print_r(ROOT);
// die;
if(file_exists($URL[0] . ".php")){
require_once($URL[0].".php");  
}else {
  require_once '404.php';
}
