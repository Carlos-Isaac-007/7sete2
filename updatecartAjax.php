<?php 
ob_start();
require_once 'header.php'; 
ob_end_clean();

$response = ["status" => "error", "message" => "", "qt" => "", "price" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['id'], $_POST['quantity'])) {
            throw new Exception("Dados inválidos enviados.");
        }

        $product_id = intval($_POST['id']);
        $quantity = intval($_POST['quantity']);
      
        if ($product_id <= 0 || $quantity <= 0) {
            throw new Exception("ID do produto ou quantidade inválidos.");
        }

        require_once 'admin/inc/config.php'; // Conexão PDO ($pdo)

        // 🔍 Pegando quantidade e preço atual
        $stmt = $pdo->prepare("SELECT p_qty, p_current_price FROM tbl_product WHERE p_id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            throw new Exception("Produto não encontrado.");
        }

        if ($product['p_qty'] < $quantity) {
            throw new Exception("Quantidade indisponível no estoque.");
        }

        // 🔧 Atualiza a sessão corretamente
        if (!empty($_SESSION['cart_p_id'])) {
            foreach ($_SESSION['cart_p_id'] as $index => $id) {
                if ($id == $product_id) {
                    $_SESSION['cart_p_qty'][$index] = $quantity;
                    break;
                }
            }
        }

        $total_price = $product['p_current_price'] * $quantity;

        $response["status"] = "success";
        $response["message"] = "Quantidade atualizada com sucesso!";
        $response["qt"] = $quantity;
        $response["price"] = number_format($total_price, 2, ',', ''); // ou use apenas $total_price se preferir o valor bruto
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
}

header("Content-Type: application/json");
echo json_encode($response);
exit;
