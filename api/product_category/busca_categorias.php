<?php
header('Content-Type: application/json');
require_once('../../admin/inc/config.php');



$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

try {
    $statement = $pdo->prepare("SELECT mcat_id, mcat_name FROM tbl_mid_category WHERE tcat_id = ?");
    $statement->execute([$id]);
    $midCategories = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($midCategories);
} catch (PDOException $e) {
    http_response_code(500); // erro interno
    echo json_encode([
        'error' => 'Erro ao buscar categorias médias',
        'detalhes' => $e->getMessage()
    ]);
}