<?php
// busca_produto.php
// Retorna somente <div class="product-item"> via AJAX para o carregamento infinito

require '../admin/inc/config.php';

// Função para formatar moeda Kz
function formatarKZ($valorTexto) {
    $numero = preg_replace('/[^\d]/', '', $valorTexto);
    $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($numero, 'AOA');
}

// Obtém parâmetros da requisição
$page = isset($_GET['page'])      ? intval($_GET['page'])   : 0;
$ecat_id = isset($_GET['ecat_id'])  ? intval($_GET['ecat_id']): 0;
$exclude_id = isset($_GET['exclude_id']) ? intval($_GET['exclude_id']): 0;

$limit  = 6;
$offset = $page * $limit;

// 1) Busca produtos da mesma categoria com offset
$stmtCat = $pdo->prepare(
    "SELECT * FROM tbl_product
     WHERE ecat_id = ? AND p_id != ?
     ORDER BY p_id DESC
     LIMIT $limit OFFSET $offset"
);
$stmtCat->execute([$ecat_id, $exclude_id]);
$resultCategoria = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// 2) Se não existirem produtos na categoria para este offset, busca aleatórios
if (count($resultCategoria) > 0) {
    $result = $resultCategoria;
} else {
    $stmtRand = $pdo->prepare(
        "SELECT * FROM tbl_product
         WHERE ecat_id != ? AND p_id != ?
         ORDER BY RAND()
         LIMIT $limit"
    );
    $stmtRand->execute([$ecat_id, $exclude_id]);
    $result = $stmtRand->fetchAll(PDO::FETCH_ASSOC);
}

// 3) Output: cada produto como <div class="product-item"> via include
foreach ($result as $row) {
    include '../produtos_relacionados.php';
}
