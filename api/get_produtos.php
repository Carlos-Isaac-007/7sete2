<?php
require_once('database.php'); // Conexão com PDO
header('Content-Type: application/json');

$id = $_GET['id'] ?? null;
$type = $_GET['type'] ?? null;

if (!$id || !$type) {
    echo json_encode([]);
    exit;
}

$final_ecat_ids = [];
$base_url = "https://7setetech.com/assets/uploads/";

if ($type === 'top-category') {
    $stmt = $pdo->prepare("SELECT mcat_id FROM tbl_mid_category WHERE tcat_id = ?");
    $stmt->execute([$id]);
    $mid_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if ($mid_ids) {
        $placeholders = str_repeat('?,', count($mid_ids) - 1) . '?';
        $stmt = $pdo->prepare("SELECT ecat_id FROM tbl_end_category WHERE mcat_id IN ($placeholders)");
        $stmt->execute($mid_ids);
        $final_ecat_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}

if ($type === 'mid-category') {
    $stmt = $pdo->prepare("SELECT ecat_id FROM tbl_end_category WHERE mcat_id = ?");
    $stmt->execute([$id]);
    $final_ecat_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

if ($type === 'end-category') {
    $final_ecat_ids[] = $id;
}

if (empty($final_ecat_ids)) {
    echo json_encode([]);
    exit;
}

$placeholders = str_repeat('?,', count($final_ecat_ids) - 1) . '?';
$stmt = $pdo->prepare("
    SELECT p_id, p_name, p_current_price, p_featured_photo, brand 
    FROM tbl_product 
    WHERE ecat_id IN ($placeholders) AND p_is_active = 1
");
$stmt->execute($final_ecat_ids);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Corrigir as URLs usando referência
foreach ($produtos as &$row) {
    $row['p_featured_photo'] = $base_url . $row['p_featured_photo'];
    if (!empty($row['brand'])) {
        $row['brand'] = $base_url . $row['brand'];
    }
}
unset($row); // Boa prática

echo json_encode($produtos);
