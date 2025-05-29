<?php
ob_start();
 require_once 'header.php'; 
ob_end_clean();


// Arquivo de conexão com o banco de dados

header("Content-Type: application/json"); // Define resposta como JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "UPDATE notificacoes SET status = 'visualizada' WHERE status = 'pendente' AND mensagem = 'Novo pedido recebido! Verifique os detalhes.'";
$pdo->query($sql);

echo json_encode(['status' => 'ok']);

?>
