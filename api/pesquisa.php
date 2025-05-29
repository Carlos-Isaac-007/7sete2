<?php
session_start();
require_once('database.php'); // contém $pdo e outras configurações
header('Content-Type: application/json');


// Adicionando cabeçalhos CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

try {
    // Validar entrada
    $search_text = isset($_POST['search_text']) ? trim($_POST['search_text']) : '';
    if ($search_text === '') {
        echo json_encode(['erro' => 'Busca vazia']);
        exit;
    }

    $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 6;
    $start = isset($_POST['start']) ? (int)$_POST['start'] : 0;

    $query = "SELECT p_id, p_name, p_current_price, p_featured_photo 
              FROM tbl_product 
              WHERE p_name LIKE :search 
              ORDER BY p_id DESC
              LIMIT :start, :limit";

    $stmt = $conn->prepare($query);
    $busca = '%' . $search_text . '%';

    $stmt->bindParam(':search', $busca, PDO::PARAM_STR);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($produtos);

} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro de conexão: ' . $e->getMessage()]);
}
?>