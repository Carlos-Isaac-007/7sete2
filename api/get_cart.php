<?php
session_start();
require_once('database.php'); // contém $pdo e outras configurações
header('Content-Type: application/json');

// Adicionando cabeçalhos CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Arquivo de conexão com o banco de dados

header("Content-Type: application/json"); // Define resposta como JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);


$table_total_price = 0;
$cart_items = [];

if (!empty($_SESSION['cart_p_id'])) {
    foreach ($_SESSION['cart_p_id'] as $key => $value) {
        $cart_items[] = [
                     'id'            => $_SESSION['cart_p_id'][$key],
                'size_id'       => $_SESSION['cart_size_id'][$key],
                'size_name'     => $_SESSION['cart_size_name'][$key],
                'color_id'      => $_SESSION['cart_color_id'][$key],
                'color_name'    => $_SESSION['cart_color_name'][$key],
                'quantity'      => $_SESSION['cart_p_qty'][$key],
                'price'         => $_SESSION['cart_p_current_price'][$key],
                'name'          => $_SESSION['cart_p_name'][$key],
                'photo'         => $_SESSION['cart_p_featured_photo'][$key]
        ];
    }
}

echo json_encode($cart_items);
