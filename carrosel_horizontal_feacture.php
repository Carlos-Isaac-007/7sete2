<style>
    .carousel-wrapper {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel-container {
    display: flex;
    transition: transform 0.4s ease-in-out;
}

.product-item {
    flex: 0 0 auto;
    width: 250px; /* ajuste conforme necessário */
    margin: 0 10px;
}

</style>
<style>

.brand-logo {
    width: 48px;
    height: 24px;
    object-fit: contain;
    background: #fff;
    border-radius: 4px;
    border: 1px solid #eee;
}



.carousel-controls {
    position: absolute;
    top: 50%;
    left: 0; right: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    pointer-events: none;
    z-index: 10;
    padding: 0 12px;
}

.carousel-btn {
    background: rgba(255,255,255,0.95);
    color: #000c78;
    font-size: 2.2rem;
    border: none;
    border-radius: 50%;
    width: 48px;
    height: 48px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    cursor: pointer;
    pointer-events: all;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s, color 0.2s;
}
.carousel-btn:hover {
    background: #000c78;
    color: #fff;
}

@media (max-width: 900px) {
    .carousel-container { gap: 12px; padding: 0 16px; }
    .carousel-btn { width: 38px; height: 38px; font-size: 1.5rem; }
}
</style>
<div class="carousel-wrapper">

    <div class="carousel-container">
        <?php foreach ($result as $row): ?>
            <div class="product-item">
                <a href="<?=ROOT?>product?id=<?= $row['p_id']; ?>" style="text-decoration:none;"> 
                    <picture>
                      <source srcset="<?=ROOT?>assets/uploads/<?=$row['p_featured_photo']?>" type="image/webp">
                      <img src="<?=ROOT?>assets/uploads/<?=$row['p_featured_photo']?>" alt="<?= $row['p_name']; ?>" loading="lazy">
                    </picture>
                </a>
                <div class="product-desc">
                    <h5><a href="<?=ROOT?>product?id=<?= $row['p_id']; ?>"><?=$row['p_name']?></a></h5>
                    <!-- Linha com marca + preço -->
                    <!-- Preço -->
                    <div class="price">
                        
                        <span class="current-price"><?= formatrKzemPhp($row['p_current_price']) ?></span>
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
        <?php endforeach; ?>
    </div>

    <div class="carousel-controls">
        <button class="carousel-btn prev-btn" aria-label="Anterior">&#10094;</button>
        <button class="carousel-btn next-btn" aria-label="Próximo">&#10095;</button>
    </div>
</div>


