<?php
require_once('../../admin/inc/config.php');
function formatarKZ($valorTexto) {
    $numero = preg_replace('/[^\d]/', '', $valorTexto);
    $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($numero, 'AOA');
}

$where = [];
$params = [];


// Verifica se foi enviado 'mid-cat' (categoria média)
if (!empty($_POST['mid_cat']) && is_array($_POST['mid_cat'])) {
    // Remove valores vazios e reindexa o array
    $midCatArray = array_values(array_filter($_POST['mid_cat']));
    // Verifica se ao menos um valor válido existe
    if (!empty($midCatArray)) {
        $cat_med_id = (int) $midCatArray[0]; // Pega o primeiro valor válido
    } else {
        echo "Nenhum ID válido recebido.";
        exit;
    }

    // 1. Obtem todos os cat_final_id vinculados a essa categoria média
    $statement = $pdo->prepare("SELECT ecat_id FROM tbl_end_category WHERE mcat_id = ?");
    $statement->execute([$cat_med_id]);
    $cat_final_ids = $statement->fetchAll(PDO::FETCH_COLUMN);

    if (!empty($cat_final_ids)) {
        // Gera placeholders dinâmicos (?, ?, ?, ...)
        $placeholders = implode(',', array_fill(0, count($cat_final_ids), '?'));
        $where[] = "ecat_id IN ($placeholders)";
        $params = array_merge($params, $cat_final_ids);
    } else {
        // Nenhuma categoria final encontrada → retorna vazio
        $produtos = [];
    }
}

// Outros filtros
if (!empty($_POST['preco_min'])) {
    $where[] = 'p_current_price >= ?';
    $params[] = $_POST['preco_min'];
}
if (!empty($_POST['preco_max'])) {
    $where[] = 'p_current_price <= ?';
    $params[] = $_POST['preco_max'];
}
if (!empty($_POST['tamanho'])) {
    $where[] = 'p_size = ?';
    $params[] = $_POST['tamanho'];
}
if (!empty($_POST['marca'])) {
    $where[] = 'brand_id = ?';
    $params[] = $_POST['marca'];
}
if (!empty($_POST['promocao'])) {
    $where[] = 'p_old_price > p_current_price';
}

// Monta a query final
if (!isset($produtos)) { // evita sobrescrever se já tiver setado vazio antes
    $sql = "SELECT * FROM tbl_product WHERE p_is_active = 1";
    if ($where) {
        $sql .= " AND " . implode(' AND ', $where);
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// HTML dos produtos (mantém o que você já tem)
foreach ($produtos as $produto) {
?>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card produto-card h-100 shadow-sm border-0">
            <div class="position-relative">
                <img src="assets/uploads/<?= htmlspecialchars($produto['p_featured_photo']) ?>"
                     class="card-img-top produto-img"
                     alt="<?= htmlspecialchars($produto['p_name']) ?>">
                <?php if (!empty($produto['p_old_price']) && $produto['p_current_price'] < $produto['p_old_price']) { ?>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">Promoção</span>
                <?php } ?>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title produto-nome mb-1"><?= htmlspecialchars($produto['p_name']) ?></h5>
                <div class="mb-2 d-flex align-items-center gap-2">
                    <img src="<?= empty($produto['brand']) ? 'assets/uploads/SETE-NOVO-LOGOTIPO.png' : 'assets/uploads/' . htmlspecialchars($produto['brand']) ?>"
                         alt="Marca"
                         class="brand-logo rounded"
                         style="width:24px;height:24px;object-fit:contain;">
                    <span class="text-muted small"><?= htmlspecialchars($produto['brand_name'] ?? '') ?></span>
                </div>
                <div class="mb-2">
                    <?php if (!empty($produto['p_old_price']) && $produto['p_current_price'] < $produto['p_old_price']) { ?>
                        <span class="text-decoration-line-through text-secondary me-2"><?= formatarKZ($produto['p_old_price']) ?></span>
                    <?php } ?>
                    <span class="fw-bold text-primary" style="color:#000c78 !important;"><?= formatarKZ($produto['p_current_price']) ?></span>
                </div>
                <div class="mt-auto d-flex gap-2">
                    <form class="add-cart" method="POST" style="display: inline;">
                        <input type="hidden" name="p_qty" value="1">
                        <input type="hidden" name="id" value="<?= $produto['p_id'] ?>">
                        <input type="hidden" name="p_current_price" value="<?= $produto['p_current_price'] ?>">
                        <input type="hidden" name="p_name" value="<?= $produto['p_name'] ?>">
                        <input type="hidden" name="p_featured_photo" value="<?= $produto['p_featured_photo'] ?>">
                        <button type="submit" class="btn btn-primary btn-sm flex-fill" style="background:#000c78;border:none;">
                            <i class="bi bi-cart-plus"></i> Carrinho
                        </button>
                    </form>
                    <a href="product?id=<?= $produto['p_id'] ?>" class="btn btn-outline-primary btn-sm flex-fill" style="color:#000c78;border-color:#000c78;">
                        <i class="bi bi-info-circle"></i> Detalhes
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
