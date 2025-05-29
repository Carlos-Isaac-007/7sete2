<!DOCTYPE html>
<html lang="pt">
<?php
$title = "Início | AKA Churros";
include 'head.php';
?>
<body>

  <?php require_once('header.php') ?>
  
<!-- Menu de Categorias -->
<section class="categorias py-3 bg-light">
  <div class="container">
    <div class="row justify-content-center text-center">
        
      <div class="col-4 col-sm-2 mb-3">
        <a href="produtos.php?categoria=churros-doce">
        <img src="assets/img/menu1.jpg" alt="Churros" class="img-fluid rounded-circle border border-2" style="width: 80px; height: 80px;">
        <small class="d-block mt-2">Churros</small>
        </a>
      </div>
      
      <div class="col-4 col-sm-2 mb-3">
        <a href="produtos.php?categoria=gelados">
        <img src="assets/img/menu2.jpg" alt="Gelados" class="img-fluid rounded-circle border border-2" style="width: 80px; height: 80px;">
        <small class="d-block mt-2">Gelados</small>
        </a>
      </div>
      
      <div class="col-4 col-sm-2 mb-3">
        <a href="produtos.php?categoria=bebidas">
        <img src="assets/img/menu3.jpg" alt="Bebidas" class="img-fluid rounded-circle border border-2" style="width: 80px; height: 80px;">
        <small class="d-block mt-2">Bebidas</small>
        </a>
      </div>
      
      <div class="col-4 col-sm-2 mb-3">
        <a href="produtos.php?categoria=lanches">
        <img src="assets/img/menu4.jpg" alt="Lanches" class="img-fluid rounded-circle border border-2" style="width: 80px; height: 80px;">
        <small class="d-block mt-2">Lanches</small>
        </a>
      </div>
    </div>
  </div>
</section>


  <!-- Hero Section -->
  <section class="hero">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
      <div class="text">
        <h1>Uma experiência <br><span style="color:#D17835">saborosa</span> e única</h1>
        <p>Delicie-se com nossos churros artesanais, hambúrgueres, gelados e milkshakes!</p>
        <a href="produtos.php" class="btn-main">Explorar</a>
        <a href="reservar.php" class="btn-outline">Reservar</a>
      </div>
      <div class="img mt-5 mt-md-0">
        <img src="assets/img/churros-hero.jpg" class="img-fluid" alt="Churros">
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section class="about-section">
    <div class="container">
      <h2 class="menu-title">Sobre Nós</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <img src="assets/img/sobre1.jpg" class="img-fluid rounded" alt="Prato 1">
        </div>
        <div class="col-md-4">
          <div class="about-card">
            <h5>Tradição & Sabor</h5>
            <p>Unimos receitas clássicas com um toque especial, criando momentos inesquecíveis para cada cliente.</p>
            <a href="#" class="btn-light-outline">Saiba mais</a>
          </div>
        </div>
        <div class="col-md-4">
          <img src="assets/img/sobre2.jpg" class="img-fluid rounded" alt="Prato 2">
        </div>
      </div>
    </div>
  </section>


 <!-- Our Menu Section -->
<section class="menu-section" id="menu">
  <div class="container">
    <h2 class="menu-title mb-3" data-aos="fade-up">Nosso Menu</h2>
    <p class="mb-5" data-aos="fade-up" data-aos-delay="100">
      Descubra os sabores incríveis que preparamos com carinho. Dos churros artesanais aos milkshakes refrescantes!
    </p>
  </div>

  <div class="swiper">
    <div class="swiper-wrapper" id="lista-produto">
    <!--preechimenti via AJAX-->
    </div>

    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</section>

<section class="gallery-section py-5 bg-gallery" id="gallery">
  <div class="container text-center gallery-overlay">
    <h2 class="menu-title mb-4" data-aos="fade-up" style="color: #4B1E00">Galeria</h2>
    <p class="mb-5" data-aos="fade-up" data-aos-delay="100">Momentos deliciosos capturados com nossos clientes.</p>
    
    <div class="row g-3">
      <div class="col-md-4" data-aos="zoom-in"><img src="assets/img/cliente1.jpg" class="img-fluid rounded" alt="Galeria 1"></div>
      <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100"><img src="assets/img/cliente2.jpg" class="img-fluid rounded" alt="Galeria 2"></div>
      <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200"><img src="assets/img/cliente3.jpg" class="img-fluid rounded" alt="Galeria 3"></div>
      <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300"><img src="assets/img/cliente4.jpg" class="img-fluid rounded" alt="Galeria 4"></div>
      <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400"><img src="assets/img/cliente5.jpg" class="img-fluid rounded" alt="Galeria 5"></div>
      <div class="col-md-4" data-aos="zoom-in" data-aos-delay="500"><img src="assets/img/cliente6.jpg" class="img-fluid rounded" alt="Galeria 6"></div>
    </div>
  </div>
</section>

<?php require_once('carrinho.php'); ?>

<script>
    fetch('api/busca_produto.php')
    .then(response => response.json())
    .then(data =>{
        const container = document.getElementById('lista-produto');
    data.forEach(produto => {
        const item = `
         <div class="swiper-slide">
            <img src="assets/img/${produto.img}" class="card-img-top" alt="${produto.nome}">
            <div class="menu-card">
            <a href = 'produtos.php?categoria=${produto.categoria}'>
              <h5>${produto.nome}</h5>
              <p>${produto.descricao}</p>
            </a>
            </div>
         </div> `;
         container.innerHTML += item;
    });
    })
    .catch(error => console.error('erro ao carregar produtos:', error));
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
var swiper = new Swiper(".swiper", {
    initialSlide: 1,
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 3,
    spaceBetween: 30,
    coverflowEffect: {
    rotate: 50,
    stretch: 0,
    depth: 100,
    modifier: 1,
    slideShadows: true,
    },
    pagination: {
    el: ".swiper-pagination",
    },
    navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
    },

});
  </script>
  <script src="js/carrinho.js"></script>
<?php require_once('footer.php') ?>

</body>
</html>
