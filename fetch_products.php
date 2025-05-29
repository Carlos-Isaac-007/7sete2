<?php 

$host = 'localhost';
$user = 'root';
$password =  '';
$database = '7sete';
// Setting up the time zone
date_default_timezone_set('Africa/Luanda');

function formatarKZ($valorTexto) {
    $numero = preg_replace('/[^\d]/', '', $valorTexto);
    $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($numero, 'AOA');
}


// Conectar ao banco de dados
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}else {
   


$limit = isset($_POST["limit"]) ? (int)$_POST["limit"] : 6;
$start = isset($_POST["start"]) ? (int)$_POST["start"] : 0;

$query = " SELECT * FROM tbl_product 
ORDER BY (SELECT FLOOR(RAND() * (SELECT MAX(p_id) FROM tbl_product))) 
LIMIT ".$start.", ".$limit."";
$result = $conn->query($query);

$output = '';
$result_final = $result->fetch_assoc();
if(is_array($result_final)) {
  require_once('lista_produto.php');
}



}


?>


