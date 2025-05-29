<?php
error_reporting(E_ALL); // Relata todos os tipos de erro
ini_set('display_errors', 1); // Exibe os erros na tela

header('Content-Type: application/json');
require_once('../../cursos/inc/config.php');

$sql = "SELECT * FROM produtos WHERE ativo = 1 ORDER BY nome";
$result = $conn ->query($sql);
$produtos = [];
while($row = $result->fetch_assoc()){
    $produtos[] = $row;
}

echo json_encode($produtos);
?>