<style>
   nav.navbar {
    background: #fff;
    border-bottom: 1px solid #ddd;
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 100;
    padding: 0.5rem 1rem;
  }

  .container-fluid {
    
  
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
  }

  .btn{
    border-color: #fd821f;
  }
  .btn-outline-primary{
      color: #fd821f;
  }
  .btn-outline-primary:hover{
      background-color: #fd821f;
      border-color: #fd821f;
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
    color: #333;
  }

  .navbar-nav a:hover {
    color: #007bff;
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
        <img src="img/logo2.png" alt="Ser JOB Rent-a-Car" class="logo-navbar me-2" />
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
