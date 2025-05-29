<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ser JOB Rent-a-Car</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
  <link rel="stylesheet" href="style/style.css?v=1.8">
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    /* Efeito de fundo sutil e gradiente */
#home {
  background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(52, 58, 64, 0.6)), url('img/homegb.jpg') no-repeat center center/cover;
  padding: 100px 0;
  text-align: center;
}

#home .section-title {
  font-size: 2.5rem;
  font-weight: bold;
  color: #fd821f;
  text-transform: uppercase;
  letter-spacing: 2px;
}

#sobre {
  background-color: #2f353b;
}

#sobre h2.section-title {
  font-size: 2rem;
  font-weight: bold;
  color: #fd821f;
  text-transform: uppercase;
  letter-spacing: 2px;
}

#sobre p {
  font-size: 1.1rem;
  color: #ccc;
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
</head>
<body>

  <?php include('header.php'); ?>
  <?php include('nav.php'); ?>

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
    <h2 class="section-title display-4 text-white mb-4" data-aos="fade-up">Bem-vindo à Ser JOB</h2>
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
        <i class="bi bi-car-front fs-1 mb-3" style="color: #fd821f;"></i>
        <h5>Carros de Qualidade</h5>
        <p>Veículos novos e bem conservados para garantir conforto e segurança.</p>
      </div>
      <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="600">
        <i class="bi bi-person-circle fs-1 mb-3" style="color: #fd821f;"></i>
        <h5>Atendimento Personalizado</h5>
        <p>Nosso time está sempre pronto para atender suas necessidades com eficiência.</p>
      </div>
      <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="800">
        <i class="bi bi-geo-alt fs-1 mb-3" style="color: #fd821f;"></i>
        <h5>Locação em Benguela</h5>
        <p>Com pontos estratégicos na cidade, facilitamos o acesso aos nossos carros.</p>
      </div>
    </div>
  </div>
</section>

    <?php 
    require_once("../cursos/inc/config.php");
    // Consultar os carros
$sql = "SELECT * FROM carros"; // Altere o nome da tabela para a que você está usando
$result = $conn->query($sql);
?>
    <section id="catalogo" class="mb-5" data-aos="zoom-in-down">
      <h2 class="section-title">Catálogo de Carros</h2>
      <div class="row" id="carros">
        <?php
        // Verificar se existem resultados
        if ($result->num_rows > 0) {
          // Exibir cada carro como um card
          while($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 mb-4">
                    <a href="detalhes.php?id=' . $row['id'] . '" class="text-decoration-none text-dark">
                      <div class="card">
                        <img src="' . $row['imagem'] . '" class="card-img-top" alt="' . $row['nome'] . '">
                        <div class="card-body">
                          <h5 class="card-title">' . $row['nome'] . '</h5>
                          <p class="card-text">' . $row['descricao'] . '</p>
                        </div>
                        <div class="card-overlay">
                          <span>Ver detalhes</span>
                        </div>
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
    </section>
  </main>

  <?php include('footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
