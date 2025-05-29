<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="id-ID">
  <head>
    <title>Ser Job Rent a Car</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="images/logo.png" rel="icon" type="image/x-icon"/>
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
    
    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/owl.theme.default.min.css"/>
    <link rel="stylesheet" href="css/magnific-popup.css"/>

    <link rel="stylesheet" href="css/aos.css"/>

    <link rel="stylesheet" href="css/ionicons.min.css"/>

    <link rel="stylesheet" href="css/bootstrap-datepicker.css"/>
    <link rel="stylesheet" href="css/jquery.timepicker.css"/>

    
    <link rel="stylesheet" href="css/flaticon.css"/>
    <link rel="stylesheet" href="css/icomoon.css"/>
    <link rel="stylesheet" href="css/style.css?v=1.4"/>
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="/"><img alt="logo" width="80px" src="images/logo.png"/></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="/" class="nav-link">Página inicial</a></li>
	          <li class="nav-item"><a href="https://wa.me/6281220131929" class="nav-link">Fale conosco</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          	<div class="text w-100 text-center mb-md-5 pb-md-5">
	            <h1 class="mb-4">A maneira mais rápida &amp; fácil de alugar um carro</h1>
	            <p style="font-size: 18px;">Com a Ser Jobs, alugar um carro é rápido, fácil e sem burocracia. Tenha mobilidade com conforto e confiança sempre que precisar.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
        <span class="subheading">O que oferecemos</span>
        <h2 class="mb-2">Veículos em Destaque</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="carousel-car owl-carousel">

        <?php 
          require_once("../cursos/inc/config.php"); // Caminho correto para seu arquivo de conexão

          $sql = "SELECT * FROM carros ORDER BY id DESC LIMIT 8"; // Ajuste conforme necessário
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo '
              <div class="item">
                <div class="car-wrap rounded ftco-animate">
                  <div class="img rounded d-flex align-items-end" style="background-image: url('. htmlspecialchars($row['imagem']) .');">
                  </div>
                  <div class="text">
                    <h2 class="mb-0"><a href="#">' . htmlspecialchars($row['nome']) . '</a></h2>
                    <div class="d-flex mb-3">
                      <span class="cat">' . htmlspecialchars($row['nome']) . '</span>
                      <p class="price ml-auto">' . htmlspecialchars($row['preco']) . ' Kz<span>/dia</span></p>
                    </div>
                    <p class="d-flex mb-0 d-block">
                      <a href="detalhes.php?id=' . $row['id'] . '" class="btn btn-primary py-2 mr-1">Reserve agora</a>
                      <a href="#" class="btn btn-secondary py-2 ml-1">Detalhes</a>
                    </p>
                  </div>
                </div>
              </div>';
            }
          } else {
            echo "<p class='text-center'>Nenhum veículo encontrado.</p>";
          }

          $conn->close();
        ?>

        </div>
      </div>
    </div>
  </div>
</section>


		<section class="ftco-section ftco-intro" style="background-image: url(images/motorista.webp);  background-position: 100% center; background-size: auto 580px;">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-md-6 heading-section heading-section-white ftco-animate">
            <h2 class="mb-3">Quer ganhar com a gente? Então não perca tempo.</h2>
            <a href="#" class="btn btn-primary btn-lg">Torne-se um Motorista</a>
          </div>
				</div>
			</div>
		</section>


    <section class="ftco-section testimony-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Testemunho</span>
            <h2 class="mb-3">Clientes Satisfeitos</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">FAluguei um carro na Ser JOB Rent-a-Car e fui muito bem atendido! O veículo estava limpo, em ótimo estado e todo o processo foi rápido e sem complicações. Recomendo a todos que procuram um serviço de qualidade em Benguela!</p>
                    <p class="name">Carlos Isaac</p>
                    <span class="position">Estudande de Engenharia</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person3.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Aluguei um carro na Ser JOB Rent-a-Car e fui muito bem atendido! O veículo estava limpo, em ótimo estado e todo o processo foi rápido e sem complicações. Recomendo a todos que procuram um serviço de qualidade em Benguela!</p>
                    <p class="name">Lucas Simão</p>
                    <span class="position">Balconista BFA</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person4.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Aluguei um carro na Ser JOB Rent-a-Car e fui muito bem atendido! O veículo estava limpo, em ótimo estado e todo o processo foi rápido e sem complicações. Recomendo a todos que procuram um serviço de qualidade em Benguela!</p>
                    <p class="name">Alice Cordeiro</p>
                    <span class="position">Medica</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Aluguei um carro na Ser JOB Rent-a-Car e fui muito bem atendido! O veículo estava limpo, em ótimo estado e todo o processo foi rápido e sem complicações. Recomendo a todos que procuram um serviço de qualidade em Benguela!</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person2.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Aluguei um carro na Ser JOB Rent-a-Car e fui muito bem atendido! O veículo estava limpo, em ótimo estado e todo o processo foi rápido e sem complicações. Recomendo a todos que procuram um serviço de qualidade em Benguela!</p>
                    <p class="name">Manumar Heneriques</p>
                    <span class="position">CEO DA 7sete Tecnology</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-counter ftco-section img bg-light" id="section-counter">
			<div class="overlay"></div>
    	<div class="container">
    		<div class="row">
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="20">0</strong>
                <span>Anos <br> de Experiencia</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="200">0</strong>
                <span>Total <br> de Carros</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="1255">0</strong>
                <span>Clientes <br>Satisfeitos</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text d-flex align-items-center">
                <strong class="number" data-number="10">0</strong>
                <span>Total <br> de Lojas</span>
              </div>
            </div>
          </div>
        </div>
    	</div>
    </section>	

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><a href="/" class="logo"><img alt="logo" width="80px" src="images/logo.png"/></a></h2>
              <p>Ser Job Rent a Car é um serviço de aluguel de carros confiável na cidade de Benguela, Angola.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="https://wa.me/6281220131929"><span class="icon-whatsapp"></span></a></li>
                <li class="ftco-animate"><a href="javascript:void(0);"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="javascript:void(0);"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Informações de contato</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Angola, Benguela, Rua xxxxx</span></li>
	                <li><span class="icon icon-phone"></span><span class="text">9xx xxx xxx</span></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
          </div>
        </div>
      </div>
    </footer>

<p align="center">© 2025 Ser Job Rent a Car</p>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>