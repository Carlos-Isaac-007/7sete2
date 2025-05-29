<?php 
require_once('database.php');// ou seu caminho correto de conexão ao PDO

// Arquivo de conexão com o banco de dados

header("Content-Type: application/json"); // Define resposta como JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row)
{

$total_latest_product_home = $row['total_latest_product_home'];


}

try {

    $base_url = "https://7setetech.com/assets/uploads/";

  $statement = $pdo->prepare("SELECT p_id, p_name, p_current_price, p_featured_photo, brand 
        FROM tbl_product   WHERE p_is_active=? ORDER BY RAND() LIMIT ".$total_latest_product_home);
        $statement->execute(array(1));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as &$row) {
        $row['p_featured_photo'] = $base_url . $row['p_featured_photo'];
        $row['brand'] = $base_url .$row['brand'];
    }

    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}


