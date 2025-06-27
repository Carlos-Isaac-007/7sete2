<?php
require_once('../../admin/inc/config.php');

function formatarKZ($valorTexto) {
    $numero = preg_replace('/[^\d]/', '', $valorTexto);
    $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($numero, 'AOA');
}

$where = [];
$params = [];

// Verifica se foi enviado 'mid_cat' (categoria média)
if (!empty($_POST['mid_cat']) && is_array($_POST['mid_cat'])) {
    // Remove valores vazios e reindexa o array
    $midCatArray = array_values(array_filter($_POST['mid_cat']));
    $endCatArray = array_values(array_filter($_POST['end_cat']));
    // Se existir 'all' dentro do array, busca todos os produtos ativos, sem filtro por categoria média
    if (in_array('all', $midCatArray, true) && count(array_unique($midCatArray)) <= 1 && count(array_unique($endCatArray)) <=1) {
       // Pegamos os ecat_ids permitidos da categoria atual (vindo do atributo data-final_ecat_ids, enviado via requires/product-category.php
        $final_ecat_ids = isset($_POST['final_ecat_ids']) && is_array($_POST['final_ecat_ids'])
        ? array_map('intval', $_POST['final_ecat_ids']) : [];

        // Garantimos que só inteiros entrem
        $final_ecat_ids = array_filter($final_ecat_ids, fn($id) => is_numeric($id));
        
        if (!empty($final_ecat_ids)) {
            $placeholders = implode(',', array_fill(0, count($final_ecat_ids), '?'));
            $where[] = "p_is_active = 1 AND ecat_id IN ($placeholders)";
            $params = array_merge($params, $final_ecat_ids);
        }

    } elseif(in_array('all', $midCatArray, true) && count(array_unique($midCatArray)) > 1 && count(array_unique($endCatArray)) > 1){
        // Filtra o array, removendo todos os valores 'all'
        $endCatFiltrado = array_values(array_filter($_POST['end_cat'], fn($v) => $v !== 'all'));

        // Pega o primeiro valor diferente de 'all', se existir
        $cat_end_id = isset($endCatFiltrado[0]) ? (int) $endCatFiltrado[0] : null;

        if ($cat_end_id !== null) {
            $where[] = "ecat_id = ?";
            $params[] = $cat_end_id;
        }

    }elseif (!empty($midCatArray)) {
        // Filtra o array, removendo todos os valores 'all'
        $midCatFiltrado = array_values(array_filter($_POST['mid_cat'], fn($v) => $v !== 'all'));

        // Pega o primeiro valor diferente de 'all', se existir
        $cat_med_id = isset($midCatFiltrado[0]) ? (int) $midCatFiltrado[0] : null;

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
    } else {
        // Nenhum ID válido recebido
        echo "Nenhum ID válido recebido.";
        exit;
    }
} else {
    // Se não enviou mid_cat, filtra só produtos ativos
    $where[] = 'p_is_active = 1';
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
    $sql = "SELECT * FROM tbl_product";
    if ($where) {
        $sql .= " WHERE " . implode(' AND ', $where);
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>


    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Título da categoria -->
        <h2 class="fs-4 fw-bold mb-0"><?= htmlspecialchars($title ?? '') ?></h2>
        <!-- Quantidade de produtos -->
        <span class="text-muted small"><?= count($produtos) ?> produtos</span>
    </div>
    <?php if (count($produtos) == 0): ?>
        <!-- Mensagem caso não haja produtos -->
        <div class="alert alert-info">Nenhum produto encontrado nesta categoria.</div>
    <?php else: ?>
        <div class="row g-3">
        <?php foreach ($produtos as $produto): ?>
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
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
