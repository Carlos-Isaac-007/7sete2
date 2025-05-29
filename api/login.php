<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Apenas para testes! Em produção, restrinja.
require_once('database.php');// ou seu caminho correto de conexão ao PDO


// Lê os dados enviados no corpo da requisição
$data = json_decode(file_get_contents("php://input"), true);

$cust_email = $data['email'] ?? '';
$cust_password = $data['senha'] ?? '';

if (empty($cust_email) || empty($cust_password)) {
    echo json_encode([
        'status' => 'error',
        'mensagem' => 'E-mail e senha são obrigatórios.'
    ]);
    exit;
}

// Consulta o banco
$stmt = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
$stmt->execute([$cust_email]);

if ($stmt->rowCount() === 0) {
    echo json_encode([
        'status' => 'error',
        'mensagem' => 'Email não encontrado.'
    ]);
    exit;
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica a senha com MD5 (como seu sistema atual usa)
if ($row['cust_password'] !== md5($cust_password)) {
    echo json_encode([
        'status' => 'error',
        'mensagem' => 'Senha incorreta.'
    ]);
    exit;
}

// Verifica se o usuário está ativo
if ($row['cust_status'] == 0) {
    echo json_encode([
        'status' => 'error',
        'mensagem' => 'Sua conta ainda não está ativada.'
    ]);
    exit;
}

// Tudo certo, retorna dados do usuário
echo json_encode([
    'status' => 'success',
    'usuario' => [
        'id' => $row['cust_id'],
        'nome' => $row['cust_name'],
        'email' => $row['cust_email']
    ]
]);
