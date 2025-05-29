

<div class="produto-wrapper">
    <div class="produto_container">
        <?php foreach ($result as $row): ?>
         <style>
                .product-item{
                    width: 100%;
                    margin: 0;
                }
            </style>
            <div class="product-item card-produto">
                <a href="product?id=<?= $row['p_id'] ?>" class="no-link">
                    <picture>
                      <source srcset="assets/uploads/<?= htmlspecialchars($row['p_featured_photo']) ?>" type="image/webp">
                      <img src="assets/uploads/<?= htmlspecialchars($row['p_featured_photo']) ?>" 
                         alt="<?= htmlspecialchars($row['p_name']) ?>" loading="lazy">
                    </picture>
                   
                </a>
                <div class="product-desc">
                    <h5><?= htmlspecialchars($row['p_name']) ?></h5>

                    <!-- Preço -->
                    <div class="price">
                        <span class="current-price"><?=  formatarKZ($row['p_current_price']) ?></span>
                        <?php if (!empty($row['p_old_price'])): ?>
                            <del class="old-price"><?= formatarKZ($row['p_old_price']) ?></del>
                        <?php endif; ?>
                    </div>
                    
                    <div class="brand">
                    <img src="<?= empty($row['brand']) || !$row['brand'] ? 'assets/uploads/SETE-NOVO-LOGOTIPO.png' : 'assets/uploads/' . htmlspecialchars($row['brand']) ?>"
                         class="brand-logo"
                         alt="Logo da Marca">
                    </div>




   
                            <div class="btn-container">
                                <a href="product?id=<?= $row['p_id'] ?>" class="btn-details btn-sm"><i class="fa fa-info-circle"></i> Ver Detalhes</a>
                            </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


