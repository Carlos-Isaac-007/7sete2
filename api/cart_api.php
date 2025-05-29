<?php
session_start();
require_once('database.php'); // contém $pdo e outras configurações
header('Content-Type: application/json');

// Adicionando cabeçalhos CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$action = $_GET['action'] ?? $_POST['action'] ?? null;

if (!$action) {
    echo json_encode(['status' => 'error', 'message' => 'Ação não especificada.']);
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Verifica se ação foi passada
$action = $_GET['action'] ?? $_POST['action'] ?? null;

if (!$action) {
    echo json_encode(['status' => 'error', 'message' => 'Ação não especificada.']);
    exit;
}

// Helper para responder
function response($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

// 🔐 Garante que carrinho existe
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

switch ($action) {

    // 📦 Adicionar item ao carrinho
    case 'add':
        $product_id = intval($_POST['product_id'] ?? 0);
        $quantity = intval($_POST['quantity'] ?? 1);

        if ($product_id <= 0) response(['status' => 'error', 'message' => 'ID de produto inválido.'], 400);

        $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            response(['status' => 'error', 'message' => 'Produto não encontrado.'], 404);
        }

        if ($product['p_qty'] < $quantity) {
            response(['status' => 'error', 'message' => 'Estoque insuficiente.'], 400);
        }

        $_SESSION['cart'][$product_id] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'name' => $product['p_name'],
            'price' => $product['p_current_price'],
            'photo' => $product['p_featured_photo']
        ];

        response(['status' => 'success', 'message' => 'Produto adicionado ao carrinho.', 'cart' => $_SESSION['cart']]);
        break;

    // 🔄 Atualizar item do carrinho
    case 'update':
        $product_id = intval($_POST['product_id'] ?? 0);
        $quantity = intval($_POST['quantity'] ?? 1);

        if (!isset($_SESSION['cart'][$product_id])) {
            response(['status' => 'error', 'message' => 'Produto não está no carrinho.'], 404);
        }

        $stmt = $pdo->prepare("SELECT p_qty FROM tbl_product WHERE p_id = ?");
        $stmt->execute([$product_id]);
        $stock = $stmt->fetchColumn();

        if ($stock < $quantity) {
            response(['status' => 'error', 'message' => 'Estoque insuficiente.'], 400);
        }

        $_SESSION['cart'][$product_id]['quantity'] = $quantity;

        response(['status' => 'success', 'message' => 'Quantidade atualizada.', 'cart' => $_SESSION['cart']]);
        break;

    // ❌ Remover item do carrinho
    case 'remove':
        $product_id = intval($_POST['product_id'] ?? 0);

        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
            response(['status' => 'success', 'message' => 'Produto removido.']);
        } else {
            response(['status' => 'error', 'message' => 'Produto não encontrado no carrinho.'], 404);
        }
        break;

    // 🧹 Limpar carrinho
    case 'clear':
        $_SESSION['cart'] = [];
        response(['status' => 'success', 'message' => 'Carrinho limpo.']);
        break;

    // 📋 Listar itens do carrinho
    case 'list':
        response(['status' => 'success', 'cart' => $_SESSION['cart']]);
        break;

    default:
        response(['status' => 'error', 'message' => 'Ação inválida.'], 400);
        break;
}
