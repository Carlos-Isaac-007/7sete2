<?php
ob_start();
 require_once 'header.php'; 
ob_end_clean();


// Arquivo de conexão com o banco de dados

header("Content-Type: application/json"); // Define resposta como JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT * FROM notificacoes WHERE mensagem = 'Novo bairro Adicionado! Adicione o custo de envio.' AND status = 'pendente' ORDER BY data_criacao DESC";
$stmt = $pdo->query($sql);
$notificacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($notificacoes);

?>
