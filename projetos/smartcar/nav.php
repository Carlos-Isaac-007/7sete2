<style>
.logo-navbar {
  max-width: 40px;
  height: auto;
  background-color: transparent;
}

.navbar-nav .nav-link {
  color: #B0B0B0; /* Prata claro */
  font-size: 1.2rem;
  transition: transform 0.2s ease, color 0.2s ease;
}

.navbar-nav .nav-link:hover {
  color: #FF8C00; /* Acento metálico */
  transform: scale(1.2);
}

.navbar-nav .nav-link.active {
  color: #FF8C00;
}
  nav.navbar {
    border-bottom: 1px solid #D9D9D9;
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 100;
    padding: 0.5rem 1rem;
    background-color: #1A1A1A !important; /* Destaque escuro */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .container-fluid {
    /* manter vazio ou estilizar com padding/margin se necessário */
  }

  .navbar-row {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
    justify-content: space-between;
    width: 100%;
  }

  .navbar-brand {
    white-space: nowrap;
    flex-shrink: 0;
  }

  .search-form {
    margin: 0 auto !important;
    width: 100%;
    max-width: 700px;
    flex-shrink: 1;
  }

  .search-form input {
    background-color: #fff;
    border: 1px solid #B0B0B0;
    color: #2C2C2C;
  }

  .btn {
    border-color: #FF8C00;
  }

  .btn-outline-primary {
    color: #FF8C00;
    border-color: #FF8C00;
  }

  .btn-outline-primary:hover {
    background-color: #FF8C00;
    border-color: #FF8C00;
    color: #2C2C2C;
  }

  .navbar-icons {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 1rem;
    flex-wrap: nowrap;
    width: auto;
    max-width: 100%;
    flex-shrink: 0;
  }

  .navbar-nav {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-end;
    flex-wrap: nowrap;
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .navbar-nav li {
    display: inline-block;
    margin: 0 0.5rem;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .navbar-nav a {
    text-decoration: none;
    font-size: 1.4rem;
    color: #2C2C2C;
    transition: color 0.2s ease;
  }

  .navbar-nav a:hover {
    color: #FF8C00;
  }

  /* Mobile */
  @media (max-width: 991.98px) {
    .navbar-icons {
      justify-content: center !important;
      margin-top: 0.75rem;
    }

    .navbar-nav {
      flex-wrap: nowrap;
    }
  }

  /* Desktop */
  @media (min-width: 992px) {
    .container-fluid {
      width: 83%;
    }

    .navbar-row {
      flex-wrap: nowrap !important;
    }

    .search-form {
      margin-left: 1rem;
      margin-right: 1rem;
    }

    .navbar-icons {
      margin-top: 0 !important;
    }
  }
</style>



<nav class="navbar navbar-light sticky-top bg-white">
  <div class="container-fluid d-flex flex-column flex-lg-row navbar-row">

    <!-- LOGO + BUSCA -->
    <div class="d-flex w-100 align-items-center">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center me-2" href="index.php">
        <img src="img/smartlogo4.png" alt="Ser JOB Rent-a-Car" class="logo-navbar me-2" />
      </a>

      <!-- Barra de busca -->
      <form class="d-flex search-form" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>

    <!-- ÍCONES -->
    <div class="d-flex navbar-icons mt-2 mt-lg-0">
      <ul class="navbar-nav flex-row flex-nowrap">
        <li class="nav-item mx-2">
          <a class="nav-link active" href="#home" title="Home"><i class="bi bi-house-door"></i></a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#catalogo" title="Catálogo"><i class="bi bi-car-front"></i></a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#reservar" title="Reservar"><i class="bi bi-calendar-check"></i></a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="oficina.php" title="Oficina"><i class="bi bi-tools"></i></a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#pagamento" title="Pagamento"><i class="bi bi-credit-card"></i></a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#endereco" title="Endereço"><i class="bi bi-geo-alt"></i></a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#contato" title="Contato"><i class="bi bi-telephone"></i></a>
        </li>
      </ul>
    </div>

  </div>
</nav>
