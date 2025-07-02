<div class="carousel-wrapper">
  <div class="carousel-container">
    <?php foreach ($result as $row): ?>
      <div class="card custom-product-card">
        <div class="custom-product-image-wrapper position-relative">
           <!-- Brand logo no topo esquerdo em círculo -->
          <div class="brand-circle position-absolute top-0 start-0 m-2">
            <img src="<?= empty($row['brand']) || !$row['brand'] ? 'assets/uploads/SETE-NOVO-LOGOTIPO.png' : 'assets/uploads/' . htmlspecialchars($row['brand']) ?>"
                 class="custom-brand-logo"
                 alt="Marca">
          </div>
          <a href="<?= ROOT ?>product?id=<?= $row['p_id']; ?>">
            <picture>
              <source srcset="<?= ROOT ?>assets/uploads/<?= $row['p_featured_photo'] ?>" type="image/webp">
              <img src="<?= ROOT ?>assets/uploads/<?= $row['p_featured_photo'] ?>"
                   class="custom-product-image"
                   alt="<?= $row['p_name']; ?>"
                   loading="lazy">
            </picture>
          </a>

           <?php if (!empty($row['p_old_price']) && $row['p_current_price'] < $row['p_old_price']): ?>
            <span class="promo-badge-modern position-absolute top-0 end-0 m-2 d-flex align-items-center gap-1">
              <svg width="18" height="18" fill="none" viewBox="0 0 20 20">
                <circle cx="10" cy="10" r="10" fill="#ff3366"/>
                <path d="M7 10.5l2 2 4-4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="promo-badge-text">Promo</span>
            </span>
          <?php endif; ?>
        </div>

        <div class="card-body d-flex flex-column">
          <h5 class="card-title mb-1">
            <a href="<?= ROOT ?>product?id=<?= $row['p_id']; ?>" style="text-decoration: none; color: inherit;">
              <?= $row['p_name'] ?>
            </a>
          </h5>

          <div class="mb-2">
            <?php if (!empty($row['p_old_price']) && $row['p_current_price'] < $row['p_old_price']): ?>
              <span class="text-decoration-line-through text-secondary me-2"><?= formatrKzemPhp($row['p_old_price']) ?></span>
            <?php endif; ?>
            <span class="fw-bold text-primary" style="color:#000c78 !important;"><?= formatrKzemPhp($row['p_current_price']) ?></span>
          </div>

          <div class="mt-auto d-flex gap-2">
            <form method="POST" class="custom-cart-form w-100 add-cart">
              <input type="hidden" name="p_qty" value="1">
              <input type="hidden" name="id" value="<?= $row['p_id'] ?>">
              <input type="hidden" name="p_current_price" value="<?= $row['p_current_price'] ?>">
              <input type="hidden" name="p_name" value="<?= $row['p_name'] ?>">
              <input type="hidden" name="p_featured_photo" value="<?= $row['p_featured_photo'] ?>">
              <button type="submit" class="btn btn-primary btn-sm w-100" style="background:#000c78;border:none;">
                <i class="bi bi-cart-plus"></i> Carrinho
              </button>
            </form>
            <a href="<?= ROOT ?>product?id=<?= $row['p_id']; ?>" class="btn btn-outline-primary btn-sm w-100" style="color:#000c78; border-color:#000c78;">
              <i class="bi bi-info-circle"></i> Detalhes
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

<style>
.carousel-wrapper {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 10px;
  padding-left: 10px;
  padding-right: 10px;
}

.carousel-container {
  display: flex;
  transition: transform 0.4s ease-in-out;
  gap: 16px;
  padding: 0 16px;
}


.carousel-controls {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  pointer-events: none;
  z-index: 10;
  padding: 0 12px;
  transform: translateY(-50%);
}

.carousel-btn {
  background: rgba(255, 255, 255, 0.95);
  color: #000c78;
  font-size: 2.2rem;
  border: none;
  border-radius: 50%;
  width: 48px;
  height: 48px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
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
  .carousel-container {
    gap: 12px;
    padding: 0 8px;
  }

  .carousel-btn {
    display: none;
  }

 
}
</style>

