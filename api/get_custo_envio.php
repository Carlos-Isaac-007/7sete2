<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once('../admin/inc/config.php');

$id_bairro = intval($_GET['id_bairro'] ?? 0);

try {
    // Prepare a consulta com placeholder
    $stmt = $pdo->prepare("SELECT amount FROM tbl_shipping_cost WHERE bairro_id = ? LIMIT 1");
    $stmt->execute([$id_bairro]);

    // Obtem resultado
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode(['custo' => $row['amount']]);
    } else {
        echo json_encode(['erro' => 'Custo de envio não encontrado.']);
    }
} catch (Exception $e) {
    echo json_encode(['erro' => 'Erro ao buscar custo de envio: ' . $e->getMessage()]);
}
