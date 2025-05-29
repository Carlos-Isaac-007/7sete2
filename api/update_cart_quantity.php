<?php
session_start();
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
$productId = $input['id'] ?? null;
$newQty = $input['quantity'] ?? 1;

if ($productId !== null && isset($_SESSION['cart_p_id'])) {
    foreach ($_SESSION['cart_p_id'] as $index => $id) {
        if ($id == $productId) {
            $_SESSION['cart_p_qty'][$index] = $newQty;
            echo json_encode(['success' => true]);
            exit;
        }
    }
}

echo json_encode(['success' => false]);
