<?php
header('Content-Type: application/json');
require_once('config.php');

session_start();

if (!isset($_SESSION['customer'])) {
    echo json_encode(['error' => 'Você precisa estar logado para finalizar a compra.']);
    exit;
}

if (!isset($_SESSION['cart_p_id']) || empty($_SESSION['cart_p_id'])) {
    echo json_encode(['error' => 'Carrinho vazio']);
    exit;
}

$customer_id = $_SESSION['customer']['cust_id'];
$cart_items = [];
$total_price = 0;
$shipping_cost = 0;

// Carregar os itens do carrinho
foreach ($_SESSION['cart_p_id'] as $key => $value) {
    $cart_items[] = [
        'product_id' => $_SESSION['cart_p_id'][$key],
        'quantity' => $_SESSION['cart_p_qty'][$key],
        'price' => $_SESSION['cart_p_current_price'][$key],
        'name' => $_SESSION['cart_p_name'][$key],
    ];

    $total_price += $_SESSION['cart_p_current_price'][$key] * $_SESSION['cart_p_qty'][$key];
}

// Verificar o custo de envio
if (isset($_SESSION['customer'])) {
    $customer_state = $_SESSION['customer']['cust_state'];

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

// Criar um novo pedido no banco de dados
$statement = $pdo->prepare("INSERT INTO tbl_orders (customer_id, total_price, shipping_cost, final_total, status, created_at) 
                            VALUES (?, ?, ?, ?, ?, NOW())");
$statement->execute([$customer_id, $total_price, $shipping_cost, $total, 'pending']);

// Obter o ID do pedido recém-criado
$order_id = $pdo->lastInsertId();

// Inserir os itens do pedido na tabela `tbl_order_items`
foreach ($cart_items as $item) {
    $statement = $pdo->prepare("INSERT INTO tbl_order_items (order_id, product_id, quantity, price) 
                                VALUES (?, ?, ?, ?)");
    $statement->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
}

// Limpar o carrinho após o pedido ser finalizado
unset($_SESSION['cart_p_id']);
unset($_SESSION['cart_p_qty']);
unset($_SESSION['cart_p_current_price']);
unset($_SESSION['cart_p_name']);
unset($_SESSION['cart_p_featured_photo']);

// Retornar a resposta de sucesso
echo json_encode([
    'success' => true,
    'message' => 'Pedido realizado com sucesso!',
    'order_id' => $order_id,
    'total' => $total,
]);
