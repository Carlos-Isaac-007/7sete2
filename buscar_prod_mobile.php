<?php 
ob_start();
 require_once 'header.php'; 
 ob_end_clean();

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $base_url = "https://7setetech.com/assets/uploads/";

   // Usa a nova coluna para ordenar aleatoriamente de forma eficiente
    $statement = $pdo->prepare("
        SELECT p_id, p_name, p_current_price, p_featured_photo, brand 
        FROM tbl_product 
        ORDER BY p_id DESC 
        LIMIT :limit OFFSET :offset
    ");


    $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
    $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as &$row) {
        $row['p_featured_photo'] = $base_url . $row['p_featured_photo'];
        $row['brand'] = $base_url .$row['brand'];
    }

    echo json_encode($result);

} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}
