<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once('database.php');

try {
    $stmt = $pdo->prepare("SELECT country_id, country_name FROM tbl_country ORDER BY country_name ASC");
    $stmt->execute();
    $provincias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($provincias);
} catch (Exception $e) {
    echo json_encode(['error' => 'Erro ao buscar províncias']);
}
