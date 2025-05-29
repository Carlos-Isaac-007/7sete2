<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once('database.php'); // Inclui conexão PDO

try {
    if (isset($_GET['cust_id'])) {
        $cust_id = intval($_GET['cust_id']);

        $stmt = $pdo->prepare("
            SELECT 
                cust_name AS nome, 
                cust_email AS email, 
                cust_phone AS telefone, 
                cust_country AS provincia, 
                cust_city AS municipio, 
                cust_state AS bairro 
            FROM tbl_customer 
            WHERE cust_id = :cust_id
        ");
        $stmt->bindParam(':cust_id', $cust_id, PDO::PARAM_INT);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            echo json_encode([
                'status' => 'success',
                'usuario' => $usuario
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'mensagem' => 'Usuário não encontrado.'
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'mensagem' => 'cust_id não informado.'
        ]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'mensagem' => 'Erro no servidor: ' . $e->getMessage()
    ]);
}
?>
