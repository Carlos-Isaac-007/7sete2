<!-- Navbar Estilizada -->
<style>
  .navbar {
    background-color: #4B1E00;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }
  .navbar .nav-link {
    color: #fff8f2;
    margin: 0 10px;
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
  }
  .navbar .nav-link::after {
    content: '';
    display: block;
    width: 0%;
    height: 2px;
    background: #ffcc99;
    transition: width 0.3s;
    position: absolute;
    bottom: -5px;
    left: 0;
  }
  .navbar .nav-link:hover {
    color: #ffcc99;
  }
  .navbar .nav-link:hover::after {
    width: 100%;
  }
  .navbar .btn-dark {
    background-color: #ffcc99;
    color: #4B1E00;
    border: none;
    padding: 6px 16px;
    font-weight: 600;
    border-radius: 20px;
    transition: background 0.3s ease;
  }
  .navbar .btn-dark:hover {
    background-color: #e6b87a;
  }
  .navbar .bi-bag {
    font-size: 1.2rem;
    position: relative;
  }
  #cart-count {
    position: absolute;
    top: -5px;
    right: -10px;
    font-size: 0.7rem;
  }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="assets/img/logo.png" alt="AKA Churros" height="50">
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link" href="index.php#menu">Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#gallery">Galeria</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#contato">Contato</a></li>
        <li class="nav-item">
          <a class="btn btn-dark btn-sm me-2" href="reservar.php">Reservar</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link position-relative" data-bs-toggle="modal" data-bs-target="#cartModal">
            <i class="bi bi-bag"></i>
            <span class="badge bg-danger" id="cart-count">0</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
