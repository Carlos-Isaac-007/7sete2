<?php
// Iniciar a sessão e a conexão com o banco de dados
session_start();
require_once('database.php'); // Inclua o arquivo de conexão com o banco de dados

// Verificar se o ID do produto foi fornecido
if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {
    echo json_encode(['error' => 'Produto não encontrado.']);
    exit;
}

$productId = $_REQUEST['id'];

// Verificar se o ID do produto é válido
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id = ?");
$statement->execute([$productId]);
$product = $statement->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo json_encode(['error' => 'Produto não encontrado.']);
    exit;
}

// Buscar as categorias relacionadas ao produto
$statement = $pdo->prepare("SELECT
    t1.ecat_name,
    t2.mcat_name,
    t3.tcat_name
    FROM tbl_end_category t1
    JOIN tbl_mid_category t2 ON t1.mcat_id = t2.mcat_id
    JOIN tbl_top_category t3 ON t2.tcat_id = t3.tcat_id
    WHERE t1.ecat_id = ?");
$statement->execute([$product['ecat_id']]);
$categories = $statement->fetch(PDO::FETCH_ASSOC);

// Buscar tamanhos disponíveis para o produto
$statement = $pdo->prepare("SELECT size_id FROM tbl_product_size WHERE p_id = ?");
$statement->execute([$productId]);
$sizes = $statement->fetchAll(PDO::FETCH_ASSOC);

// Buscar cores disponíveis para o produto
$statement = $pdo->prepare("SELECT color_id FROM tbl_product_color WHERE p_id = ?");
$statement->execute([$productId]);
$colors = $statement->fetchAll(PDO::FETCH_ASSOC);

// Buscar as avaliações e calcular a média
$statement = $pdo->prepare("SELECT rating FROM tbl_rating WHERE p_id = ?");
$statement->execute([$productId]);
$ratings = $statement->fetchAll(PDO::FETCH_ASSOC);

$totalRatings = count($ratings);
$averageRating = 0;

if ($totalRatings > 0) {
    $sumRatings = array_sum(array_column($ratings, 'rating'));
    $averageRating = $sumRatings / $totalRatings;
}

// Atualizar visualizações do produto
$newTotalView = $product['p_total_view'] + 1;
$updateStatement = $pdo->prepare("UPDATE tbl_product SET p_total_view = ? WHERE p_id = ?");
$updateStatement->execute([$newTotalView, $productId]);

// Organizar os dados para resposta
$response = [
    'product' => [
        'id' => $product['p_id'],
        'name' => $product['p_name'],
        'old_price' => $product['p_old_price'],
        'current_price' => $product['p_current_price'],
        'quantity' => $product['p_qty'],
        'description' => $product['p_description'],
        'short_description' => $product['p_short_description'],
        'condition' => $product['p_condition'],
        'return_policy' => $product['p_return_policy'],
        'total_view' => $newTotalView,
        'featured_photo' => $product['p_featured_photo'],
        'is_featured' => $product['p_is_featured'],
        'is_active' => $product['p_is_active'],
    ],
    'categories' => $categories,
    'sizes' => $sizes,
    'colors' => $colors,
    'average_rating' => $averageRating,
    'total_ratings' => $totalRatings,
];

// Retornar os dados como JSON
echo json_encode($response);
?>
