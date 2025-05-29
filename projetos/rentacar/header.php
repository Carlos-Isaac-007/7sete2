<!-- Font Awesome CDN para os ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  .rent-popup {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #ff902e;
    color: white;
    padding: 12px 20px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: fadeInUp 1s ease forwards;
    cursor: default;
  }

  .rent-popup i {
    font-size: 20px;
  }

  .popup-item {
    display: inline-block;
    transform: scale(1);
    transition: transform 0.4s ease-in-out;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  header.text-center {
    background-image: url('img/banner.jpg');
    background-size: cover;
    background-position: center center;
    color: white;
    padding: 0;
    position: relative;
    height: 250px;
    overflow: hidden;
  }

  .header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(52, 58, 64, 0.85);
    z-index: 0;
  }

  .header-content {
    position: relative;
    z-index: 1;
    height: 80%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 30px;
    flex-direction: column;
  }

  .logo-container {
    height: 100%;
    width: auto;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 5px 0 0 0;
  }

  .logo-container img {
    height: 100%;
    margin: 0;
    padding: 0;
    display: block;
  }

  .info-container {
    position: relative;
    z-index: 1;
    height: 20%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .info-container ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
  }

  .info-container li {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    color: white;
  }

  .info-container i {
    color: #ff902e;
  }

  /* Responsividade para telas pequenas */
  @media (max-width: 768px) {
      .rent-popup{
          display: none;
      }
    header.text-center {
      height: 200px; /* Diminuindo a altura do header */
    }

    .rent-popup {
      top: 15px;
      right: 15px;
      font-size: 14px;
      padding: 10px 15px;
    }

    .rent-popup i {
      font-size: 18px;
    }

    .popup-item {
      font-size: 14px; /* Ajustando o tamanho da fonte */
    }

    .header-content {
      padding: 0 20px;
    }

    .info-container ul {
      gap: 10px;
    }

    .info-container li {
      font-size: 12px; /* Font menor para dispositivos móveis */
    }
  }

  /* Responsividade para telas muito pequenas */
  @media (max-width: 480px) {
    header.text-center {
      height: 180px; /* Menor altura para smartphones em retrato */
    }

    .rent-popup {
      font-size: 12px;
      padding: 8px 12px;
    }

    .rent-popup i {
      font-size: 16px;
    }

    .popup-item {
      font-size: 12px; /* Font ainda menor para telas pequenas */
    }

    .info-container ul {
      gap: 8px;
    }

    .info-container li {
      font-size: 10px; /* Font ainda menor para smartphones muito pequenos */
    }
  }
</style>

<header class="text-center">
  <div class="header-overlay"></div>

  <div class="header-content">
    <!-- Logo centralizada -->
    <div class="logo-container">
      <img src="img/logo2.png" alt="Logo Ser JOB">
    </div>
  </div>

  <!-- Informações com ícones, abaixo da logo -->
  <div class="info-container">
    <ul>
      <li><i class="fas fa-map-marker-alt"></i> Rua do Comércio, nº 123</li>
      <li><i class="fas fa-phone"></i> +244 922 000 000</li>
      <li><i class="fas fa-envelope"></i> contato@serjob.co.ao</li>
      <li><i class="fas fa-clock"></i> Seg - Sex: 8h às 17h</li>
    </ul>
  </div>
 <div class="rent-popup">
  <span class="popup-item" id="icon"><i class="fas fa-car"></i></span>
  <span class="popup-item" id="word1">Aluguel</span>
  <span class="popup-item" id="word2">de</span>
  <span class="popup-item" id="word3">veículos</span>
  <span class="popup-item" id="word4">em</span>
  <span class="popup-item" id="word5">Benguela</span>
</div>
</header>
<script>
  let currentIndex = 0;  // Índice do item atualmente em animação

  // Função para aplicar a animação
  function animateItems() {
    const items = document.querySelectorAll('.popup-item');
    // Resetar todas as palavras para o estado inicial (não ampliadas)
    items.forEach(item => {
      item.style.transform = 'scale(1)';
    });

    // Aplicar a animação ao item atual
    const currentItem = items[currentIndex];
    currentItem.style.transform = 'scale(1.4)'; // Ampliar

    // Após a animação, voltar ao normal
    setTimeout(() => {
      currentItem.style.transform = 'scale(1)';
      currentIndex = (currentIndex + 1) % items.length; // Avança para o próximo item, e volta ao 0 se atingir o final
    }, 400); // Tempo da animação (0.4 segundos)

  }

  // Função para iniciar o ciclo contínuo
  function startAnimationLoop() {
    animateItems();  // Inicia o ciclo
    setInterval(animateItems, 1000); // Reinicia o ciclo a cada 1 segundo (1000ms)
  }

  // Iniciar a animação ao carregar a página
  window.onload = startAnimationLoop;
</script>



