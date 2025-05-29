<?php  
require_once("../cursos/inc/config.php"); 
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detalhes do Carro - Ser JOB Rent-a-Car</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
  <link rel="stylesheet" href="style/style.css"/>
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
  
  <style>
  
  .delivery-method {
  background: #ffffff;
  border: 1px solid #e0e0e0;
  padding: 1.5rem;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  animation: fadeInUp 0.8s ease-out both;
}

.delivery-method h4 {
  color: #007bff;
  margin-bottom: 1rem;
  font-weight: 600;
}

.delivery-method p {
  margin-bottom: 1rem;
  color: #555;
}

.delivery-method .form-check {
  margin-bottom: 0.75rem;
}

.delivery-method .form-check-input:checked {
  background-color: #fd821f;
  border-color: #fd821f;
}
  
   /* Fade-in animation */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Carousel styling */
    .carousel {
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      border-radius: 12px;
      overflow: hidden;
    }
    .carousel img { object-fit: cover; height: 400px; }
    @media (max-width: 768px) { .carousel img { height: 250px; } }

    /* Modern .product-info card */
    .product-info {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      padding: 2rem;
      animation: fadeInUp 0.6s ease-out both;
      transition: transform 0.3s, box-shadow 0.3s;
      display: grid;
      grid-template-rows: auto auto auto;
      gap: 1.5rem;
    }
    .product-info:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .product-info h2 {
      margin-bottom: 0.5rem;
      font-size: 2rem;
      color: #333;
    }
    .product-info p {
      font-size: 1rem;
      color: #555;
      margin-bottom: 1rem;
    }

    /* Feature list with icons */
    .feature-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      gap: 1rem;
    }
    .feature-item {
      display: flex;
      align-items: center;
      font-size: 0.95rem;
      color: #555;
    }
    .feature-item i {
      color: #fd821f;
      font-size: 1.2rem;
      margin-right: 0.5rem;
    }

    /* Price box */
    .price-box {
      background: linear-gradient(135deg, #fd821f, #ffb74d);
      color: #fff;
      padding: 1rem 1.5rem;
      border-radius: 12px;
      text-align: center;
      font-size: 1.5rem;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* Date inputs and total */
    .date-section {
      display: grid;
      gap: 1rem;
    }
    .total {
      font-size: 1.25rem;
      font-weight: 600;
      color: #28a745;
      text-align: right;
      opacity: 0;
      transition: opacity 0.5s;
    }
    .total.show { opacity: 1; }

    /* Reserve button */
    .btn-reserve {
      background-color: #fd821f;
      color: #fff;
      border: none;
      padding: 0.75rem;
      font-size: 1.1rem;
      border-radius: 8px;
      width: 100%;
      letter-spacing: 0.5px;
      transition: background-color 0.3s;
    }
    .btn-reserve:hover { background-color: #e06e00; }

    /* Remaining styles unchanged */
    .policy-section { /* ... */ }
    .accordion-item { /* ... */ }
    .accordion-button { /* ... */ }
    .accordion-body { /* ... */ }
    /* Animação de fade-in */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .carousel {
      box-shadow: 0 4px 10px rgba(255,255,255,0.3);
      background-color: #fff;
    }
    .carousel img { object-fit: cover; height: 400px; }
    @media (max-width: 768px) { .carousel img { height: 250px; } }

    .product-info {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      animation: fadeInUp 0.6s ease-out both;
    }
    
    /* DESKTOP */ 
    @media (min-width: 992px) {
        .policy-section{
        margin-top: -200px;
        }
    }
    /*MOBILE*/
    @media (max-width: 991.98px) {
       .product-info{
           margin-top: 10px;
       } 
    }
    .policy-section {
        
      background: linear-gradient(135deg, #fff 0%, #f0f8ff 100%);
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0,123,255,0.1);
      animation: fadeInUp 0.8s ease-out both;
      margin-bottom: 2rem;
    }
    .policy-section h4 {
      color: #007bff;
      margin-bottom: 1rem;
    }
    .accordion-item {
      border: none;
      border-radius: 8px;
      margin-bottom: 1rem;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      animation: fadeInUp 0.8s ease-out both;
    }
    .accordion-button {
      padding: 1rem;
      font-weight: 500;
      background-color: #fff;
      transition: background-color 0.3s;
    }
    .accordion-button:hover { background-color: #e9f7ff; }
    .accordion-button:not(.collapsed) { background-color: #d0ebff; }
    .accordion-body {
      padding: 1rem 1.5rem;
      background-color: #f8f9fa;
    }

    .price {
      font-size: 1.5rem;
      font-weight: bold;
      color: #fd821f;
    }
    .total {
      font-size: 1.25rem;
      font-weight: 600;
      color: #28a745;
      margin-top: 1rem;
      text-align: right;
      opacity: 0;
      transition: opacity 0.5s;
    }
    .total.show { opacity: 1; }

    .btn-reserve {
      background-color: #fd821f;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 1.2rem;
      width: 100%;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .btn-reserve:hover { background-color: #e06e00; }

    .form-group { margin-bottom: 20px; }
    .payment-methods { display: flex; justify-content: space-between; margin-top: 20px; }
    .payment-method { width: 30%; text-align: center; }
    .payment-method img { width: 50px; height: 50px; }
    .terms-link { text-align: center; display: block; margin-top: 20px; font-size: 0.9rem; }
    #phone-multicaixa { display: none; }
    .map-reservation { margin-top: 2rem; }
    
     @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    /* Popup overlay */
    .popup-overlay { position: fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); display:none; align-items:center; justify-content:center; z-index:1050; }
    .popup-overlay.show { display:flex; }
    .popup-content { background:#fff; padding:2rem; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,0.2); text-align:center; max-width:90%; animation:fadeInUp 0.5s ease-out; }
    .popup-content h5 { margin-bottom:1rem; color:#28a745; font-weight:600; }
    .popup-content button { margin-top:1rem; padding:0.5rem 1.5rem; border:none; border-radius:6px; background-color:#fd821f; color:#fff; cursor:pointer; transition:background-color 0.3s; }
    .popup-content button:hover { background-color:#e06e00; }
  </style>
</head>
<body>
    <style>
        .custom-navbar {
  background-color: #3b2a1d !important;
  padding-right: 0 !important;
}

.custom-navbar .navbar-nav {
  margin-right: 100px !important;
}

.custom-navbar .nav-link {
  color: #fff !important; /* Ajusta cor do texto para aparecer sobre fundo branco */
}
.navbar-brand {
  margin-left: 100px !important; /* ajuste como quiser */
}
    </style>
    <nav class="navbar navbar-expand-lg navbar-light ftco_navbar custom-navbar" id="ftco-navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img alt="logo" width="80px" src="images/logo.png" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
          aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>
    
        <div class="collapse navbar-collapse justify-content-end" id="ftco-nav">
          <ul class="navbar-nav mr-0 pr-0">
            <li class="nav-item active"><a href="index.php" class="nav-link">Página inicial</a></li>
            <li class="nav-item"><a href="https://wa.me/6281220131929" class="nav-link">Fale conosco</a></li>
          </ul>
        </div>
      </div>
    </nav>

 <!-- Popup Confirmation -->
  <div id="popup" class="popup-overlay">
    <div class="popup-content">
      <h5>Reserva efetuada com sucesso!</h5>
      <p>Obrigado por escolher a Ser JOB Rent-a-Car. Em breve entraremos em contato.</p>
      <button id="closePopupBtn">Fechar</button>
    </div>
  </div>
   <?php
  // Capturar o ID do carro da URL
  $car_id = $_GET['id'];

  // Consultar o banco de dados para obter os dados do carro
  $sql = "SELECT * FROM carros WHERE id = $car_id"; // Altere o nome da tabela para a que você está usando
  $result = $conn->query($sql);

  // Verificar se há um resultado
  if ($result->num_rows > 0) {
    // Pegar o primeiro (ou único) carro da consulta
    $row = $result->fetch_assoc();
  } else {
    // Caso não encontre nenhum carro
    echo "<p>Não há carros disponíveis no momento.</p>";
    exit; // Termina a execução do script
  }
  ?>
  <div class="container my-5">
    <div class="row">
      <div class="col-md-6">
        <div id="carouselCar" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active"><img src="<?php echo $row['imagem']; ?>" class="d-block w-100" alt="Baleno - Suzuki"></div>
            <div class="carousel-item"><img src="<?php echo $row['car1']; ?>" class="d-block w-100" alt="Carro B"></div>
            <div class="carousel-item"><img src="<?php echo $row['car2']; ?>" class="d-block w-100" alt="Carro C"></div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselCar" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselCar" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
        </div>
      </div>

     <!-- Modern product info -->
      <div class="col-md-6">
        <div class="product-info" data-price="50">
          <h2><?php echo $row['nome']; ?></h2>
          <p><?php echo $row['descricao']; ?></p>

          <!-- Features -->
          <div class="feature-list">
            <div class="feature-item"><i class="bi bi-people-fill"></i>5 passageiros</div>
            <div class="feature-item"><i class="bi bi-gear-fill"></i>Transmissão Manual</div>
            <div class="feature-item"><i class="bi bi-fuel-pump-fill"></i>Gasolina</div>
            <div class="feature-item"><i class="bi bi-snow"></i>Ar Condicionado</div>
          </div>

          <!-- Price box -->
          <div class="price-box"><?php echo $row['preco']; ?> Kz/dia</div>
          
            <!-- INPUT PARA CAPTURA DE PRECO/DIA  -->
            <input type="hidden" id="preco-dia" value="<?= $row['preco']; ?>">
            
          <!-- Date & total -->
          <div class="date-section">
            <div>
              <label for="start-datetime" class="form-label">Retirada:</label>
              <input type="datetime-local" class="form-control" id="start-datetime">
            </div>
            <div>
              <label for="end-datetime" class="form-label">Entrega:</label>
              <input type="datetime-local" class="form-control" id="end-datetime">
            </div>
            <!-- Input escondido para guardar o preço do carro -->
            <input type="hidden" id="precoPorDia" value="<?php echo $row['preco']; ?>">
            <div id="total" class="total">Total: 0 AOA</div>
          </div>

          <!-- Reserve button -->
          <button class="btn-reserve mt-3" id="reserve-btn" onclick="showForm()">Reservar Agora</button>
        </div>
      </div>
    </div>

    <div class="row collapse map-reservation" id="reserve-form">
     <div class="col-md-6">
        <div class="policy-section">
          <h4>Políticas de Arrendamento</h4>
          <div class="accordion" id="policyAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#policyOne" aria-expanded="false" aria-controls="policyOne">
                  <i class="bi bi-speedometer2 me-2"></i> Quilometragem Ilimitada
                </button>
              </h2>
              <div id="policyOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#policyAccordion">
                <div class="accordion-body">Quilometragem ilimitada durante o período de locação.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#policyTwo" aria-expanded="false" aria-controls="policyTwo">
                  <i class="bi bi-shield-check me-2"></i> Seguro Básico Incluído
                </button>
              </h2>
              <div id="policyTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#policyAccordion">
                <div class="accordion-body">Inclusão de seguro básico contra terceiros.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#policyThree" aria-expanded="false" aria-controls="policyThree">
                  <i class="bi bi-fuel-pump me-2"></i> Combustível
                </button>
              </h2>
              <div id="policyThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#policyAccordion">
                <div class="accordion-body">Veículo entregue com tanque cheio e deve ser devolvido da mesma forma.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#policyFour" aria-expanded="false" aria-controls="policyFour">
                  <i class="bi bi-exclamation-triangle me-2"></i> Multas e Infrações
                </button>
              </h2>
              <div id="policyFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#policyAccordion">
                <div class="accordion-body">Multas e infrações de trânsito são de responsabilidade do locatário.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#policyFive" aria-expanded="false" aria-controls="policyFive">
                  <i class="bi bi-x-octagon me-2"></i> Cancelamento Gratuito
                </button>
              </h2>
              <div id="policyFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#policyAccordion">
                <div class="accordion-body">Cancelamento gratuito até 24 horas antes do início da locação.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#policySix" aria-expanded="false" aria-controls="policySix">
                  <i class="bi bi-currency-exchange me-2"></i> Depósito Caução
                </button>
              </h2>
              <div id="policySix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#policyAccordion">
                <div class="accordion-body">Depósito caução reembolsável após inspeção do veículo.</div>
              </div>
            </div>
          </div>
        </div>
        <!-- Nova Seção Recebimento -->
        <div class="col-12">
          <div class="delivery-method">
            <h4>Método de Recebimento</h4>
            <p>Escolha como deseja receber o seu veículo:</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tipo_entrega" value="local" onchange="mostrarEndereco()">
              <label class="form-check-label" for="pickup">
                Buscar na Loja
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tipo_entrega" value="retirada" onchange="mostrarEndereco()">
              <label class="form-check-label" for="delivery">
                Entrega no Local (taxa adicional)
              </label>
              <div id="campo-endereco" style="display: none; margin-top: 10px;">
                 <input type="text" name="endereco_exato" placeholder="Digite o endereço exato" style="width: 100%; padding: 8px;">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="product-info">
          <h4>Preencha seus dados</h4>
          <form id="reservationForm" method="POST">
            <div class="form-group">
              <label for="name">Nome Completo</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="phone">Telefone</label>
              <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="payment-methods">
              <div class="payment-method">
                <label for="payment\paypal"><img src="img/pp.webp" alt="PayPal"></label>
                <input type="radio" id="payment-paypal" name="payment-method" value="paypal" required>
              </div>
              <div class="payment-method">
                <label for="payment-mastercard"><img src="img/mao.png" alt="MasterCard"></label>
                <input type="radio" id="payment-mastercard" name="payment-method" value="mastercard">
              </div>
              <div class="payment-method">
                <label for="payment-cash"><img src="img/express.webp" alt="Cash"></label>
                <input type="radio" id="payment-cash" name="payment-method" value="cash" onclick="showPhoneField()">
              </div>
            </div>
            <div id="phone-multicaixa">
              <label for="multicaixa-phone">Número de Telefone (Multicaixa Express)</label>
              <input type="tel" class="form-control" id="multicaixa-phone" name="multicaixa-phone">
            </div>
            <div class="terms-link">
              <a href="politica-arrendamento.php" target="_blank">Ver política completa</a>
            </div>
            <button type="submit" class="btn-reserve mt-3">Finalizar Reserva</button>
          </form>
        </div>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const startInput = document.getElementById('start-datetime');
    const endInput   = document.getElementById('end-datetime');
    const totalEl    = document.getElementById('total');
    const price = parseFloat(document.getElementById("preco-dia").value);

    function calculateTotal() {
      if (!startInput.value || !endInput.value) {
        totalEl.textContent = 'Total: 0 AOA'; totalEl.classList.remove('show'); return;
      }
      const start = new Date(startInput.value);
      const end   = new Date(endInput.value);
      const diffMs = end - start;
      if (diffMs <= 0) {
        totalEl.textContent = 'Total: 0 AOA'; totalEl.classList.remove('show'); return;
      }
      const msPerDay = 1000 * 60 * 60 * 24;
      const days = Math.ceil(diffMs / msPerDay);
      const total = price * days;
      totalEl.textContent = `Total: ${total.toFixed(2)} AOA`;
      totalEl.classList.add('show');
    }
    startInput.addEventListener('change', calculateTotal);
    endInput.addEventListener('change', calculateTotal);

    function showForm() { document.getElementById('reserve-btn').style.display = 'none'; document.getElementById('reserve-form').classList.add('show'); }
    function showPhoneField() { document.getElementById('phone-multicaixa').style.display = 'block'; }
  </script>
  <script>
    // Elements
    const popup = document.getElementById('popup');
    const closeBtn = document.getElementById('closePopupBtn');
    const form = document.getElementById('reservationForm');

    // Form submit shows popup
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      popup.classList.add('show');
      form.reset();
      // hide after 5s
      setTimeout(() => popup.classList.remove('show'), 5000);
    });

    // Close button handler
    closeBtn.addEventListener('click', function() {
      popup.classList.remove('show');
    });

    // Existing JS: calculateTotal, showForm, showPhoneField
    
    function mostrarEndereco() {
  const tipoEntrega = document.querySelector('input[name="tipo_entrega"]:checked').value;
  const campoEndereco = document.getElementById('campo-endereco');

  if (tipoEntrega != 'local') {
    campoEndereco.style.display = 'block';
  } else {
    campoEndereco.style.display = 'none';
  }
}
  </script>
</body>
</html>
