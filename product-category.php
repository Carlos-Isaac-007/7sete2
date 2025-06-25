<?php
    // Inclui o cabeçalho da página
    require_once('header.php');
    // Inclui o arquivo que trata a lógica da categoria de produtos
    require_once('requires/product-category.php');
    // Inclui o CSS específico para a categoria de produtos
    require_once('requires/prod-cat-css.php');

    // Se o cliente não está logado, salva a URL atual para redirecionar após login
    if (!isset($_SESSION['customer']['cust_id'])) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    }
?>

<main class="container-fluid py-4 bg-white">
    <!-- Banner Carousel -->
    <section class="mb-4">
        <div id="promoCarousel" class="carousel slide rounded shadow-sm overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($promocionais as $idx => $promo): ?>
                    <!-- Item do carrossel de promoções -->
                    <div class="carousel-item <?= $idx === 0 ? 'active' : '' ?>">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between" style="min-height:220px;">
                            <!-- Imagem do produto promocional -->
                            <img src="assets/uploads/<?= htmlspecialchars($promo['p_featured_photo']) ?>"
                                 class="d-block w-100 w-md-50 object-fit-cover"
                                 alt="<?= htmlspecialchars($promo['p_name']) ?>"
                                 style="max-height:220px;">
                            <!-- Informações do produto promocional -->
                           <div class="carousel-caption d-block text-start bg-white bg-opacity-75 p-3 rounded shadow-sm ms-md-3">
                                <h5 class="fw-bold text-dark"><?= htmlspecialchars($promo['p_name']) ?></h5>
                                <p class="mb-2 text-muted"><?= htmlspecialchars($promo['p_short_desc'] ?? '') ?></p>
                                <div class="mb-2">
                                    <?php if (!empty($promo['p_old_price'])): ?>
                                        <!-- Preço antigo riscado -->
                                        <span class="text-decoration-line-through text-secondary me-2"><?= formatarKZ($promo['p_old_price']) ?></span>
                                    <?php endif; ?>
                                    <!-- Preço atual -->
                                    <span class="fw-bold text-primary" style="color:#000c78 !important;"><?= formatarKZ($promo['p_current_price']) ?></span>
                                </div>
                                <!-- Botão para ver detalhes -->
                                <a href="product?id=<?= $promo['p_id'] ?>" class="btn btn-sm btn-primary me-2" style="background:#000c78;border:none;">
                                    Ver detalhes
                                </a>
                                <!-- Botão para adicionar ao carrinho -->
                                
                                    <!-- Botão para adicionar ao carrinho -->
                                <form class="add-cart" method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $promo['p_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-primary" style="color:#000c78;border-color:#000c78;">
                                        <i class="bi bi-cart-plus"></i> Adicionar ao carrinho
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Controles do carrossel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>
    </section>

    <div class="row gx-4">
        <!-- Filtros Lateral -->
        <aside class="col-lg-3 mb-4 mb-lg-0">
            <!-- Botão para abrir filtros no mobile -->
            <button class="btn btn-outline-primary d-lg-none mb-3 w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters" aria-controls="offcanvasFilters" style="color:#000c78;border-color:#000c78;">
                <i class="bi bi-funnel"></i> Filtros
            </button>
            <!-- Offcanvas para mobile -->
            <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasFilters" aria-labelledby="offcanvasFiltersLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasFiltersLabel">Filtros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Inclui filtros para mobile -->
                    <?php include 'requires/prod-cat-filters.php'; ?>
                </div>
            </div>
            <!-- Filtros desktop -->
            <div class="d-none d-lg-block">
                <!-- Inclui filtros para desktop -->
                <?php include 'requires/prod-cat-filters.php'; ?>
            </div>
        </aside>

        <!-- Grade de Produtos -->
        <section class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Título da categoria -->
                <h2 class="fs-4 fw-bold mb-0"><?= htmlspecialchars($title) ?></h2>
                <!-- Quantidade de produtos -->
                <span class="text-muted small"><?= $prod_count ?> produtos</span>
            </div>
            <?php if ($prod_count == 0): ?>
                <!-- Mensagem caso não haja produtos -->
                <div class="alert alert-info">Nenhum produto encontrado nesta categoria.</div>
            <?php else: ?>
                <div class="row g-3">
                    <?php foreach ($produtos as $produto): ?>
                        <!-- Card de produto -->
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card produto-card h-100 shadow-sm border-0">
                                <div class="position-relative">
                                    <!-- Imagem do produto -->
                                    <img src="assets/uploads/<?= htmlspecialchars($produto['p_featured_photo']) ?>"
                                         class="card-img-top produto-img"
                                         alt="<?= htmlspecialchars($produto['p_name']) ?>">
                                    <?php if (!empty($produto['p_old_price']) && $produto['p_current_price'] < $produto['p_old_price']): ?>
                                        <!-- Selo de promoção -->
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">Promoção</span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <!-- Nome do produto -->
                                    <h5 class="card-title produto-nome mb-1"><?= htmlspecialchars($produto['p_name']) ?></h5>
                                    <!-- Marca do produto -->
                                    <div class="mb-2 d-flex align-items-center gap-2">
                                        <img src="<?= empty($produto['brand']) ? 'assets/uploads/SETE-NOVO-LOGOTIPO.png' : 'assets/uploads/' . htmlspecialchars($produto['brand']) ?>"
                                             alt="Marca"
                                             class="brand-logo rounded"
                                             style="width:24px;height:24px;object-fit:contain;">
                                        <span class="text-muted small"><?= htmlspecialchars($produto['brand_name'] ?? '') ?></span>
                                    </div>
                                    <!-- Preço do produto -->
                                    <div class="mb-2">
                                        <?php if (!empty($produto['p_old_price']) && $produto['p_current_price'] < $produto['p_old_price']): ?>
                                            <span class="text-decoration-line-through text-secondary me-2"><?= formatarKZ($produto['p_old_price']) ?></span>
                                        <?php endif; ?>
                                        <span class="fw-bold text-primary" style="color:#000c78 !important;"><?= formatarKZ($produto['p_current_price']) ?></span>
                                    </div>
                                    <!-- Botões de ação -->
                                    <div class="mt-auto d-flex gap-2">
                                        <form id="add-cart" class="add-cart" method="POST" style="display: inline;">
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
        </section>
    </div>
</main>

<!-- Estilos customizados -->
<style>
    /* Estilo do card de produto */
    .produto-card {
        transition: box-shadow .2s, transform .2s;
        border-radius: 0.75rem;
        background: #fff;
    }
    .produto-card:hover {
        box-shadow: 0 6px 24px rgba(0,12,120,0.08);
        transform: translateY(-2px) scale(1.01);
    }
    /* Imagem do produto */
    .produto-img {
        object-fit: cover;
        height: 180px;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        background: #f6f8fa;
    }
    /* Logo da marca */
    .brand-logo {
        width: 24px;
        height: 24px;
        object-fit: contain;
        background: #fff;
        border: 1px solid #eee;
        padding: 2px;
    }
    /* Botão primário */
    .btn-primary, .btn-outline-primary:hover {
        background: #000c78 !important;
        border-color: #000c78 !important;
    }
    /* Botão outline primário */
    .btn-outline-primary {
        color: #000c78 !important;
        border-color: #000c78 !important;
        background: #fff !important;
    }
    .btn-outline-primary:active, .btn-outline-primary:focus {
        background: #000c78 !important;
        color: #fff !important;
    }
    /* Legenda do carrossel */
    .carousel-caption {
        color: #000c78 !important;
    }
    /* Responsividade para mobile */
    @media (max-width: 767.98px) {
        .produto-img {
            height: 120px;
        }
        .produto-card {
            font-size: 0.97rem;
        }
    }
</style>

<script>
    document.querySelectorAll('.add-cart').forEach(form => {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const dados = new FormData(this);

        try {
            const resposta = await fetch('<?=ROOT?>ajax_add_to_cart.php', {
                method: 'POST',
                body: dados
            });
            const texto = await resposta.text();
            console.log('Resposta bruta:', texto);

            // Só tenta converter se houver conteúdo
            if (texto) {
            const resultado = JSON.parse(texto);
            console.log(resultado);
            } else {
            console.warn('Resposta vazia do servidor');
            }
            // Aqui você pode mostrar uma mensagem de sucesso, atualizar o carrinho, etc.
        } catch (erro) {
            console.error('Erro ao adicionar ao carrinho:', erro);
        }
    });
});
</script>
<?php require_once('footer.php'); // Inclui o rodapé da página ?>
