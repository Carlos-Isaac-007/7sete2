<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    $productId = $input['id'] ?? null;

    if ($productId !== null && isset($_SESSION['cart_p_id'])) {
        foreach ($_SESSION['cart_p_id'] as $index => $id) {
            if ($id == $productId) {
                // Remove de todas as arrays relacionadas
                unset($_SESSION['cart_p_id'][$index]);
                unset($_SESSION['cart_size_id'][$index]);
                unset($_SESSION['cart_size_name'][$index]);
                unset($_SESSION['cart_color_id'][$index]);
                unset($_SESSION['cart_color_name'][$index]);
                unset($_SESSION['cart_p_qty'][$index]);
                unset($_SESSION['cart_p_current_price'][$index]);
                unset($_SESSION['cart_p_name'][$index]);
                unset($_SESSION['cart_p_featured_photo'][$index]);

                // Reindexar as arrays
                foreach ($_SESSION as $key => $array) {
                    if (is_array($array)) {
                        $_SESSION[$key] = array_values($array);
                    }
                }

                echo json_encode(['success' => true]);
                exit;
            }
        }
    }
}

echo json_encode(['success' => false, 'message' => 'Produto não encontrado']);
