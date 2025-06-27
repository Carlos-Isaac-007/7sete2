<?php
header('Content-Type: application/json');
require_once('../../admin/inc/config.php');

// Recebe os parâmetros via GET
$table = isset($_GET['table']) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['table']) : '';
$select = isset($_GET['select']) ? preg_replace('/[^a-zA-Z0-9_,]/', '', $_GET['select']) : '*';
$where_field = isset($_GET['where_field']) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['where_field']) : '';
$where_value = isset($_GET['id']) ? $_GET['id'] : null;

if (!$table || !$where_field || $where_value === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Parâmetros insuficientes']);
    exit;
}

try {
    $sql = "SELECT $select FROM $table WHERE $where_field = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$where_value]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erro ao buscar dados',
        'detalhes' => $e->getMessage()
    ]);
}