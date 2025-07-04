<?php
session_start(); // <== ESSENCIAL para usar $_SESSION
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

require_once('../admin/inc/config.php');

// Recebe os dados JSON
$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['cust_email']) || empty($data['cust_password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Email e senha são obrigatórios.']);
    exit;
}

$cust_email = $data['cust_email'];
$cust_password = $data['cust_password'];

$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email = ?");
$statement->execute([$cust_email]);

$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    http_response_code(401);
    echo json_encode(['error' => 'Email não encontrado.']);
    exit;
}

if (md5($cust_password) !== $user['cust_password']) {
    http_response_code(401);
    echo json_encode(['error' => 'Senha inválida.']);
    exit;
}

if ($user['cust_status'] == 0) {
    http_response_code(403);
    echo json_encode(['error' => 'Conta inativa.']);
    exit;
}

// Aqui você mantém a lógica de sessão, como no sistema atual
$_SESSION['customer'] = $user;

// Aqui você geraria um token JWT, por exemplo
echo json_encode([
    'message' => 'Login realizado com sucesso.',
    'redirect' => isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : URL . 'dashboard',
    'user' => [
        'id' => $user['cust_id'],
        'email' => $user['cust_email'],
        'name' => $user['cust_name']
    ]
]);
?>
