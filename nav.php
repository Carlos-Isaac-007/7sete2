
  <style>
    :root {
      --principal: #000c78;
      --text-gray: #333;
      --bg-gray: #f3f4f6;
    }
    
    
    * {
  box-sizing: border-box;
}

.area-nav {
  margin: 0;
  padding: 0;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji",
    "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  background-color: var(--bg-gray);
  display: flex;
  line-height: 1.5; /* similar ao Tailwind's leading-normal */
  font-size: 1rem;   /* 16px */
  font-weight: 400;  /* normal */
  color: var(--text-gray);
}

    /* Sidebar */
    #sidebar {
      width: 18rem;
      min-height: 100vh;
      background-color: #fff;
      color: var(--text-gray);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 1.5rem;
      position: fixed;
      top: 0;
      left: 0;
      transition: transform 0.3s ease;
      transform: translateX(0);
    }

    #sidebar.hidden {
      transform: translateX(-100%);
    }

    h2 {
      font-size: 1.25rem;
      font-weight: bold;
      color: var(--principal);
      margin-bottom: 1.5rem;
    }

    nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    nav ul li {
      margin-bottom: 0.75rem;
    }

    .menu-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      cursor: pointer;
      color: var(--principal);
      transition: background-color 0.3s;
    }

    .menu-item:hover {
      background-color: var(--principal);
      color: #fff;
    }

    .menu-item:hover i {
      color: #fff;
    }

    .submenu {
      position: relative;
    }

    .submenu-items {
      position: absolute;
      top: 0;
      left: 100%;
      margin-left: 0.5rem;
      width: 14rem;
      background-color: #fff;
      border-radius: 0.25rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      visibility: hidden;
      opacity: 0;
      transition: opacity 0.3s ease;
      z-index: 10;
    }

    .submenu:hover .submenu-items {
      visibility: visible;
      opacity: 1;
    }

    .submenu-items li a {
      display: block;
      padding: 0.5rem 1rem;
      color: var(--text-gray);
      text-decoration: none;
    }

    .submenu-items li a:hover {
      background-color: var(--principal);
      color: #fff;
    }

    .simple-item a {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      color: var(--principal);
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .simple-item a:hover {
      background-color: var(--principal);
      color: #fff;
    }

    .menu-icon-text {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .menu-icon-text i {
      color: var(--principal);
      transition: color 0.3s ease;
    }

    /* Botão mobile */
    .mobile-toggle {
      display: none;
      position: absolute;
      top: 1rem;
      left: 1rem;
      padding: 0.5rem 1rem;
      background-color: var(--principal);
      color: #fff;
      border: none;
      border-radius: 0.25rem;
      cursor: pointer;
      z-index: 20;
    }

    @media (max-width: 1024px) {
      #sidebar {
        transform: translateX(-100%);
      }

      #sidebar.visible {
        transform: translateX(0);
      }

      .mobile-toggle {
        display: block;
      }
    }
  </style>

<section class="area-nav" style="z-index=9999">

  <!-- Botão mobile -->
  <button class="mobile-toggle" onclick="document.getElementById('sidebar').classList.toggle('visible')">
    <i class="bi bi-list"></i>
  </button>

  <!-- Menu lateral -->
  <aside id="sidebar">
    <h2>Categorias</h2>
    <nav>
      <ul>

        <li class="submenu">
          <div class="menu-item">
            <div class="menu-icon-text">
              <i class="bi bi-bag-fill"></i>
              Moda e Acessórios
            </div>
            <i class="bi bi-chevron-down"></i>
          </div>
          <ul class="submenu-items">
            <li><a href="#">Masculino</a></li>
            <li><a href="#">Feminino</a></li>
            <li><a href="#">Acessórios</a></li>
          </ul>
        </li>

        <li class="simple-item">
          <a href="#"><i class="bi bi-heart-pulse-fill"></i> Beleza e Saúde</a>
        </li>

        <li class="submenu">
          <div class="menu-item">
            <div class="menu-icon-text">
              <i class="bi bi-house-door-fill"></i>
              Casa e Escritório
            </div>
            <i class="bi bi-chevron-down"></i>
          </div>
          <ul class="submenu-items">
            <li><a href="#">Móveis</a></li>
            <li><a href="#">Decoração</a></li>
          </ul>
        </li>

        <li class="simple-item">
          <a href="#"><i class="bi bi-car-front-fill"></i> Veículos e Acessórios</a>
        </li>

        <li class="simple-item">
          <a href="#"><i class="bi bi-book-fill"></i> Livros, Papelaria e Entretenimento</a>
        </li>

        <li class="simple-item">
          <a href="#"><i class="fa-solid fa-paw"></i> Ração e Produtos para Animais</a>
        </li>

        <li class="simple-item">
          <a href="#"><i class="bi bi-cpu-fill"></i> Tecnologia e Eletrônicos</a>
        </li>

        <li class="simple-item">
          <a href="#"><i class="bi bi-trophy-fill"></i> Desporto</a>
        </li>

        <li class="simple-item">
          <a href="#"><i class="bi bi-cup-straw"></i> Bebidas</a>
        </li>

      </ul>
    </nav>
  </aside>

</section>

