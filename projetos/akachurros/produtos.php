<!DOCTYPE html>
<html lang="pt">
<?php
$title = "Produtos";
include 'head.php';
?>
<style>
body {
  background: url('assets/img/bg4.webp') center/cover no-repeat;
  background-attachment: fixed;
  position: relative;

}

body::before {
  content: "";

  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6); /* 60% de opacidade preta */

}

.filter-btn.active-filter {
  background-color: #D97B00 !important;
  color: white !important;
  border-color: #D97B00 !important;
}
.product-card {
  border-radius: 12px;
  background-color: #fff;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.product-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.btn-aka {
  background-color: #D97B00;
  color: #fff;
  border: none;
  transition: background-color 0.3s ease;
}

.btn-aka:hover {
  background-color: #b46200;
}

</style>
<body>

<?php require_once('header.php') ?> <!-- Navbar já existente -->

<section class="py-5 ">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold menu-title">Nossos Produtos</h2>

    <!-- Filtros -->
    <div class="mb-4 d-flex flex-wrap gap-2 justify-content-center">
      <button class="btn btn-outline-light filter-btn" data-filter="all">Todos</button>
      <button class="btn btn-outline-light filter-btn" data-filter="churros-doce">Churros Doces</button>
      <button class="btn btn-outline-light filter-btn" data-filter="churros-salgado">Churros Salgados</button>
      <button class="btn btn-outline-light filter-btn" data-filter="gelados">Gelados</button>
      <button class="btn btn-outline-light filter-btn" data-filter="bebidas">Bebidas</button>
      <button class="btn btn-outline-light filter-btn" data-filter="lanches">Lanches</button>
    </div>

    <!-- Produtos -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="product-list">
        <!--Carregamento dinamico via AJAX-->
    </div>
  </div>
</section>

<?php require_once('carrinho.php') ?>

<?php require_once('footer.php') ?>

<script src="js/produtos_filt.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/carrinho.js"></script>
</body>
</html>
