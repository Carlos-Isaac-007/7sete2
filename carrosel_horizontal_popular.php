 <div class="carousel-wrapper">
    <button class="carousel-btn prev-btn" aria-label="Anterior">&#10094;</button>

    <div class="carousel-container">
        <?php foreach($result as $row): ?>
            <div class="product-item">
                <a href="<?=ROOT?>product?id=<?= $row['p_id']; ?>">
                    <picture>
                      <source srcset="<?=ROOT?>assets/uploads/<?=$row['p_featured_photo']?>" type="image/webp">
                      <img src="<?=ROOT?>assets/uploads/<?=$row['p_featured_photo']?>" alt="<?= $row['p_name']; ?>" loading="lazy">
                    </picture>
                    
                </a>
                <div class="product-desc">
                    <h5>
                        <a href="<?=ROOT?>product?id=<?= $row['p_id']; ?>"><?= $row['p_name']; ?></a>
                    </h5>
                    <!-- Preço -->
                    <div class="price">
                        <span class="current-price"><?= formatrKzemPhp( $row['p_current_price']) ?></span>
                        <?php if (!empty($row['p_old_price'])): ?>
                            <del class="old-price"><?= formatrKzemPhp($row['p_old_price']) ?></del>
                        <?php endif; ?>
                    </div>

<div class="brand">
    <img src="<?= empty($row['brand']) || !$row['brand'] ? 'assets/uploads/SETE-NOVO-LOGOTIPO.png' : 'assets/uploads/' . htmlspecialchars($row['brand']) ?>"
         class="brand-logo"
         alt="Logo da Marca">
</div>
  
                    <div class="btn-container">
                        <a href="<?=ROOT?>product?id=<?= $row['p_id']; ?>" class="btn-details btn-sm">
                            <i class="fa fa-info-circle"></i> Ver Detalhes
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>

    <button class="carousel-btn next-btn" aria-label="Próximo">&#10095;</button>
</div>
