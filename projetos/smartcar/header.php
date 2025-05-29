<!-- Font Awesome CDN para os ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  /* Popup de aluguel */
  .rent-popup {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #FF8C00; /* cor principal SMARTCAR ajustada */
    color: #2C2C2C;       /* texto escuro metálico */
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
    color: #2C2C2C; /* ícone em tom escuro */
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

  /* Header */
  header.text-center {
    background: url('img/banner.jpg') center center / cover no-repeat;
    color: white;
    padding: 0;
    position: relative;
    height: 250px;
    overflow: hidden;
  }

  .header-overlay {
    position: absolute;
    inset: 0;
    background: rgba(44, 44, 44, 0.9); /* tom metálico escuro */
    z-index: 0;
  }

  .header-content {
    position: relative;
    z-index: 1;
    height: 80%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0 30px;
  }

  .logo-container {
    height: 100%;
    width: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-top: 5px;
  }

  .logo-container img {
    height: 100%;
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
    color: #FF8C00; /* ícones com novo tom dourado */
  }

  /* Responsivo - telas pequenas */
  @media (max-width: 768px) {
    .rent-popup {
      display: none;
    }

    header.text-center {
      height: 200px;
    }

    .header-content {
      padding: 0 20px;
    }

    .info-container ul {
      gap: 10px;
    }

    .info-container li {
      font-size: 12px;
    }
  }

  /* Responsivo - telas muito pequenas */
  @media (max-width: 480px) {
    header.text-center {
      height: 180px;
    }

    .rent-popup {
      font-size: 12px;
      padding: 8px 12px;
      color: #2C2C2C;
    }

    .rent-popup i {
      font-size: 16px;
    }

    .popup-item {
      font-size: 12px;
    }

    .info-container ul {
      gap: 8px;
    }

    .info-container li {
      font-size: 10px;
    }
  }
</style>




<header class="text-center">
  <div class="header-overlay"></div>

  <div class="header-content">
    <!-- Logo centralizada -->
    <div class="logo-container">
      <img src="img/smartlogo4.png" alt="Logo Ser JOB">
    </div>
  </div>

 <!--  Informações com ícones, abaixo da logo -->
  <div class="info-container">
    <ul>
      <li><i class="fas fa-map-marker-alt"></i> Rua do Comércio, nº 123</li>
      <li><i class="fas fa-phone"></i> +244 922 000 000</li>
      <li><i class="fas fa-envelope"></i> contato@serjob.co.ao</li>
      <li><i class="fas fa-clock"></i> Seg - Sex: 8h às 17h</li>
    </ul>
  </div>
<!-- <div class="rent-popup">
  <span class="popup-item" id="icon"><i class="fas fa-car"></i></span>
  <span class="popup-item" id="word1">Aluguel</span>
  <span class="popup-item" id="word2">de</span>
  <span class="popup-item" id="word3">veículos</span>
  <span class="popup-item" id="word4">em</span>
  <span class="popup-item" id="word5">Benguela</span>
</div>-->
</header>
<!--<script>
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
</script>-->



