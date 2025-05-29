<!DOCTYPE html>
<html lang="pt-PT">
<?php
// Ativa exibição de todos os erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
    $title = "Smart Car";
    require_once('head.php');
?>

<style>

a{
    text-decoration: none;
}
.section-title {
  margin-bottom: 20px;
  font-size: 1.5rem;
  font-weight: bold;
}

#home p {
  color: #2C2C2C; /* Texto escuro */
}

.carousel-caption {
  background-color: rgba(0, 0, 0, 0.5);
  padding: 1rem;
  border-radius: 10px;
}

.carousel img {
  object-fit: cover;
  height: 400px;
  border-radius: 20px;
}
.carousel{
    margin-top: 200px;
    width: 82%;
    margin: 0 auto;
    border-radius: 20px;
}

@media (max-width: 768px) {
  .carousel img {
    height: 250px;
  }
}



/* Efeito de fundo sutil e gradiente */
#home {
  background: linear-gradient(135deg, rgba(0, 0, 0, 0.95), rgba(44, 44, 44, 0.85)), url('img/homegb3.jpg') no-repeat center center/cover;
  padding: 100px 0;
  text-align: center;
  border-radius: 25px;
}

#sobre {
  background: linear-gradient(135deg, rgba(0, 0, 0, 0.95), rgba(44, 44, 44, 0.85)), url('img/homebg2.jpg') no-repeat center center/cover;
  padding: 100px 0;
  text-align: center;
  border-radius: 25px;
}

.section-title {
  font-size: 2.5rem;
  font-weight: bold;
  color: #FF8C00; /* dourado metálico SMARTCAR */
  text-transform: uppercase;
  letter-spacing: 2px;
}

.section-subtitle {
  font-size: 1.5rem;
  font-weight: bold;
  color: #FF8C00; /* dourado metálico SMARTCAR */
  text-transform: uppercase;
  letter-spacing: 2px;
}

#sobre {
  background-color: #2C2C2C; /* cinza escuro metálico */
}

#sobre p {
  font-size: 1.1rem;
  color: #CCCCCC; /* texto claro */
}

#sobre .col-md-4 {
  margin-bottom: 2rem;
}

/* Adicionando animação de fade-in ao carregar */
[data-aos="fade-up"] {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

[data-aos="fade-up"].aos-animate {
  opacity: 1;
  transform: translateY(0);
}

/* Ajustes de responsividade */
@media (max-width: 768px) {
  #home .section-title {
    font-size: 2rem;
  }

  #sobre .col-md-4 {
    margin-bottom: 1rem;
  }
}
</style>



<body style="background-color: #f8f9fa">

  <?php include('header.php'); ?>
  <?php include('nav.php'); ?>
<style>
#menu-visivel {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 25px;
}

.menu-item {
  position: relative;
  flex: 1;
  min-width: 300px;
  height: 250px;
  overflow: hidden;
}

.menu-item .bg-img {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background-size: cover;
  background-position: center;
  filter: blur(2.5px); /* <-- DESFOQUE aplicado aqui */
  transform: scale(1.05); /* aumenta levemente para compensar o corte causado pelo blur */
  z-index: 1;
}

.menu-item .overlay {
  position: relative;
  z-index: 2;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0,0,0,0.8);
}

.menu-item h3 {
  font-size: 2rem;
  color: #FF8C00;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin: 0;
}
.menu-item:hover .bg-img {
  filter: blur(1px); /* ou use blur(0px) para remover totalmente */
  transform: scale(1.1); /* leve zoom para efeito dinâmico */
  transition: all 0.5s ease;
}

.menu-item .bg-img {
  transition: all 0.5s ease; /* garante transição suave */
}
@media (max-width: 768px) {
  .menu-item {
    height: 180px;
  }

  .menu-item h3 {
    font-size: 1.3rem;
  }
}

</style>
<!-- Menu Visual com Imagem de Fundo -->
<section id="menu-visivel" class="d-flex flex-wrap text-white text-center">
  <div class="menu-item">
    <div class="bg-img" style="background-image: url('img/bgauto.jpg');"></div>
    <a href="standauto.php">
    <div class="overlay">
      <h3>Stand Auto</h3>
    </div>
    </a>
  </div>
  <div class="menu-item">
    <div class="bg-img" style="background-image: url('img/bgoficina.jpg');"></div>
    <a href="oficina.php">
    <div class="overlay">
      <h3>Oficina</h3>
    </div>
    </a>
  </div>
  <div class="menu-item">
    <div class="bg-img" style="background-image: url('img/bgrent.jpg');"></div>
    <a href="rentacar.php">
    <div class="overlay">
      <h3>Rent a Car</h3>
    </div>
    </a>
  </div>
</section>


  <!-- Banner Carousel -->
  <div id="carouselBanner" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/banner1.jpg" class="d-block w-100" alt="Banner 1">
      </div>
      <div class="carousel-item">
        <img src="img/banner2.jpg" class="d-block w-100" alt="Banner 2">
      </div>
      <div class="carousel-item">
        <img src="img/banner3.jpg" class="d-block w-100" alt="Banner 3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <main class="container my-5">
   <section id="home" class="mb-5 text-center">
  <div class="container">
  <!-- Título Bem-vindo -->
  <h2 class="section-title display-4 mb-4" data-aos="fade-up">Bem-vindo à SMARTCAR</h2>
  <p class="lead text-light" data-aos="fade-up" data-aos-delay="200">
    Oferecemos o melhor serviço de aluguel de carros em Benguela, com veículos de qualidade e atendimento personalizado.
  </p>
</div>
</section>

<section id="sobre" class="bg-dark text-light py-5">
  <div class="container">
    <!-- Título Somos -->
    <h2 class="section-title text-center mb-4" data-aos="fade-up">Quem Somos</h2>
    <p class="text-center lead" data-aos="fade-up" data-aos-delay="200">
      A Ser JOB Rent-a-Car se destaca pela excelência em serviços de aluguel de carros, proporcionando uma experiência única para nossos clientes. Trabalhamos com uma frota de veículos modernos, sempre prontos para atender às suas necessidades, seja para viagens de negócios ou lazer.
    </p>

    <!-- ícones e descrição dos serviços -->
    <div class="row mt-5">
      <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="400">
        <i class="bi bi-car-front fs-1 mb-3" style="color: #FF8C00;"></i>
        <h5>Carros de Qualidade</h5>
        <p>Veículos novos e bem conservados para garantir conforto e segurança.</p>
      </div>
      <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="600">
        <i class="bi bi-person-circle fs-1 mb-3" style="color: #FF8C00;"></i>
        <h5>Atendimento Personalizado</h5>
        <p>Nosso time está sempre pronto para atender suas necessidades com eficiência.</p>
      </div>
      <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="800">
        <i class="bi bi-geo-alt fs-1 mb-3" style="color: #FF8C00;"></i>
        <h5>Locação em Benguela</h5>
        <p>Com pontos estratégicos na cidade, facilitamos o acesso aos nossos carros.</p>
      </div>
    </div>
  </div>
</section>

<style>
#carros {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  gap: 20px; /* Espaço entre os cards */
  padding: 10px 0; /* Espaçamento superior e inferior */
  position: relative; /* Necessário para as setas */
  scrollbar-width: none; /* Firefox */
}
#carros::-webkit-scrollbar {
  display: none; /* Chrome, Safari */
}

.card {
  width: 250px; /* Largura fixa para os cards */
  flex-shrink: 0; /* Impede que os cards encolham */
  box-shadow: 0 4px 10px rgba(44, 44, 44, 0.2);
  background-color: #FFFFFF;
}

.card-body {
  flex-grow: 1;
}
.card-body p {
  text-align: center;
  font-weight: bold;
  font-size: 14pt;
  color: #FF8C00;
}
.card-body h5 {
  text-align: center;
}
.card-img-top {
  object-fit: cover;
  height: 200px;
}

.card-overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.3s ease;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1;
}

.card:hover .card-overlay {
  opacity: 1;
}

.card-overlay span {
  font-size: 1.1rem;
  padding: 10px 20px;
  color: white;
  background-color: #FF8C00; /* Acento metálico */
  border-radius: 5px;
}

/* Estilo para a barra de navegação com setas e botão central */
#carros-control {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 20px 0;
  position: absolute;
  width: 100%;
  top: 50%; /* Centraliza verticalmente */
  transform: translateY(-50%); /* Ajusta a posição exata */
  z-index: 2;
}

#carros-control .btn-rent-car {
  background-color: #FF8C00;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-weight: bold;
  font-size: 1rem;
  text-transform: uppercase;
  letter-spacing: 1px;
}

#carros-control .arrow {
  font-size: 2rem;
  color: #4a3b20;
  cursor: pointer;
}

#carros-control .arrow:hover {
  color: #FF8C00;
}

#catalogo {
  background: linear-gradient(to right, #1A1A1A, #292929); /* Fundo moderno escuro com gradiente */
  padding: 50px 20px;
  border-radius: 20px;
  box-shadow: 0 0 20px rgba(0,0,0,0.3);
  position: relative;
  overflow: hidden;
  margin-top: 25px;
  background: url('img/bgcata.jpg') no-repeat center center;
   background-size: cover;
}

#catalogo .section-subtitle {
  text-align: center;
  color: #FF8C00;
  font-size: 2rem;
  margin-bottom: 30px;
  font-weight: bold;
  letter-spacing: 1px;
  text-transform: uppercase;
}
#catalogo::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  z-index: 0;
  background-color: rgba(0,0,0,0.8);
}
#catalogo > * {
  position: relative;
  z-index: 1;
}

</style>

    <?php 
    require_once("../cursos/inc/config.php");
    // Consultar os carros
$sql = "SELECT * FROM carros"; // Altere o nome da tabela para a que você está usando
$result = $conn->query($sql);
?>
    <section id="catalogo" class="mb-5" data-aos="zoom-in-down">
  <h3 class="section-subtitle">Quer alugar um carro, que tal!?</h3>
  <div id="carros">
    <?php
    // Consultar os carros
    require_once("../cursos/inc/config.php");
    $sql = "SELECT * FROM carros"; // Altere o nome da tabela para a que você está usando
    $result = $conn->query($sql);
    
    // Verificar se existem resultados
    if ($result->num_rows > 0) {
      // Exibir cada carro como um card
      while($row = $result->fetch_assoc()) {
        echo '<div class="card">
                <a href="detalhes.php?id=' . $row['id'] . '" class="text-decoration-none text-dark">
                  <img src="' . $row['imagem'] . '" class="card-img-top" alt="' . $row['nome'] . '">
                  <div class="card-body">
                    <h5 class="card-title">' . $row['nome'] . '</h5>
                    <!--<p class="card-text">' . $row['descricao'] . '</p>-->
                  </div>
                  <div class="card-overlay">
                    <span>Ver detalhes</span>
                  </div>
                </a>
              </div>';
      }
    } else {
      echo "<p>Não há carros disponíveis no momento.</p>";
    }


    ?>
  </div>
  <style>
     .scroll {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
  margin-top: 20px;
}

.nav-btn {
  background-color: #FF8C00;
  color: #1A1A1A;
  border: none;
  border-radius: 50%;
  width: 44px;
  height: 44px;
  font-size: 22px;
  cursor: pointer;
  transition: background 0.3s;
}
.nav-btn:hover {
  background-color: #d0a84d;
}

.rent-btn {
  background-color: #FF8C00;
  color: #1A1A1A;
  border: none;
  padding: 10px 20px;
  font-weight: bold;
  border-radius: 20px;
  cursor: pointer;
  transition: background 0.3s;
}
.rent-btn:hover {
  background-color: #d0a84d;
}
.nav-btn {
  transition: opacity 0.3s ease;
}
.nav-btn[style*="display: none"] {
  opacity: 0;
  pointer-events: none;
}
  </style>
  <div class="scroll">
         <button class="nav-btn left-btn" onclick="scrollCarros(-1)">&#10094;</button>

  <button class="rent-btn">Ver mais</button>

  <button class="nav-btn right-btn" onclick="scrollCarros(1)">
    &#10095;
  </button>

    </div>
</section>

<!-- Stand Auto-->
 <section id="catalogo" class="mb-5" data-aos="zoom-in-down" style = "background: url('img/bgauto2.jpg') no-repeat center center;">
  <h3 class="section-subtitle">Os melhores Carros, Os Melhores Precos, So Aqui!</h3>
  <div id="carros">
    <?php
    // Consultar os carros
    require_once("../cursos/inc/config.php");
    $sql = "SELECT * FROM carros"; // Altere o nome da tabela para a que você está usando
    $result = $conn->query($sql);
    
    // Verificar se existem resultados
    if ($result->num_rows > 0) {
      // Exibir cada carro como um card
      while($row = $result->fetch_assoc()) {
        echo '<div class="card">
                <a href="detalhes.php?id=' . $row['id'] . '" class="text-decoration-none text-dark">
                  <img src="' . $row['imagem'] . '" class="card-img-top" alt="' . $row['nome'] . '">
                  <div class="card-body">
                    <h5 class="card-title">' . $row['nome'] . '</h5>
                    <p class="card-text">' . $row['preco'] . ' AOA</p>
                  </div>
                  <div class="card-overlay">
                    <span>Ver detalhes</span>
                  </div>
                </a>
              </div>';
      }
    } else {
      echo "<p>Não há carros disponíveis no momento.</p>";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>
  </div>

  <div class="scroll">
         <button class="nav-btn left-btn" onclick="scrollCarros(-1)">&#10094;</button>

  <a href="standauto.php" class="rent-btn">Ver mais</a>

  <button class="nav-btn right-btn" onclick="scrollCarros(1)">
    &#10095;
  </button>

    </div>
</section>

  </main>

  <?php require_once('footer.php'); ?>
 <script>
function scrollCarros(direction) {
  const container = document.getElementById('carros');
  const scrollAmount = container.clientWidth * 0.8;

  container.scrollBy({
    left: direction * scrollAmount,
    behavior: 'smooth'
  });

  setTimeout(updateScrollButtons, 400); // espera o scroll suave terminar
}

function updateScrollButtons() {
  const container = document.getElementById('carros');
  const leftBtn = document.querySelector('.left-btn');
  const rightBtn = document.querySelector('.right-btn');

  // Verifica se está no início
  if (container.scrollLeft <= 0) {
    leftBtn.style.display = 'none';
  } else {
    leftBtn.style.display = 'inline-block';
  }

  // Verifica se está no fim
  if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 5) {
    rightBtn.style.display = 'none';
  } else {
    rightBtn.style.display = 'inline-block';
  }
}

// Atualiza ao carregar e ao rolar
document.addEventListener('DOMContentLoaded', updateScrollButtons);
document.getElementById('carros').addEventListener('scroll', updateScrollButtons);
</script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
