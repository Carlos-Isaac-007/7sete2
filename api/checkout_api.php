<?php
header('Content-Type: application/json');
require_once('config.php'); // Configuração do PDO para conexão com o banco de dados

session_start();

if (!isset($_SESSION['cart_p_id'])) {
    echo json_encode(['error' => 'Carrinho vazio']);
    exit;
}

$cart_items = [];
$total_price = 0;
$shipping_cost = 0;

// Carregar os itens do carrinho
foreach ($_SESSION['cart_p_id'] as $key => $value) {
    $cart_items[] = [
        'id' => $_SESSION['cart_p_id'][$key],
        'quantity' => $_SESSION['cart_p_qty'][$key],
        'price' => $_SESSION['cart_p_current_price'][$key],
        'name' => $_SESSION['cart_p_name'][$key],
        'photo' => $_SESSION['cart_p_featured_photo'][$key],
    ];

    $total_price += $_SESSION['cart_p_current_price'][$key] * $_SESSION['cart_p_qty'][$key];
}

// Verificar o custo de envio com base no bairro
if (isset($_SESSION['customer'])) {
    $customer_state = $_SESSION['customer']['cust_state'];

    // Buscar o custo de envio baseado no bairro
    $statement = $pdo->prepare("SELECT * FROM tbl_bairro WHERE nome_bairro=?");
    $statement->execute([$customer_state]);
    $result_bairro = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result_bairro) {
        $bairro_id = $result_bairro['bairro_id'];

        $statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost WHERE bairro_id=?");
        $statement->execute([$bairro_id]);
        $result_shipping = $statement->fetch(PDO::FETCH_ASSOC);
        $shipping_cost = $result_shipping ? $result_shipping['amount'] : 0;
    }
}

$total = $total_price + $shipping_cost;

echo json_encode([
    'cart_items' => $cart_items,
    'total_price' => $total_price,
    'shipping_cost' => $shipping_cost,
    'total' => $total,
]);
