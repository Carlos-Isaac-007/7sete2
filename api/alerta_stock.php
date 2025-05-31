<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../admin/inc/config.php');
require_once('../admin/inc/functions.php');
header("Content-Type: application/json");

$sql = "SELECT * FROM tbl_product WHERE p_qty = :p_qty";
$stmt = $pdo->prepare($sql);
$stmt->execute(['p_qty' => '0']);
$outOfStockProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$jsonResponse = json_encode($outOfStockProducts);
if (json_last_error() !== JSON_ERROR_NONE) {
    $jsonResponse = json_encode(['error' => 'Failed to encode JSON: ' . json_last_error_msg()]);
}

// Caminho do arquivo para armazenar o último estado
$alertFile = __DIR__ . '/last_alert.json';

// Carrega o último estado salvo
$lastAlert = [];
if (file_exists($alertFile)) {
    $lastAlert = json_decode(file_get_contents($alertFile), true);
}

// Obtém os IDs dos produtos sem estoque atualmente
$currentIds = array_column($outOfStockProducts, 'p_id');

// Obtém os IDs do último alerta
$lastIds = is_array($lastAlert) ? $lastAlert : [];

// Só envia e-mail se houver alteração
if ($currentIds !== $lastIds && !empty($outOfStockProducts)) {
    $productNames = array_column($outOfStockProducts, 'p_name');
    $productList = implode(", ", $productNames);
    $to = "7setetechnology01@gmail.com";
    $subject = "Alerta de Estoque: Produtos para Reabastecer";
    $message = "Os seguintes produtos estão sem estoque e precisam ser reabastecidos: " . $productList;
    $headers = "suporte@7setetech.com\r\n";
    enviarEmail($to, $headers, $subject, $message);

    // Salva o novo estado
    file_put_contents($alertFile, json_encode($currentIds));
}

echo $jsonResponse;
