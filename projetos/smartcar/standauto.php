<!DOCTYPE html>
<html lang="pt">
<?php 
    $title = "Stand Auto";
    require_once('head.php');
?>
  <style>
    body {
      background-color: #f8f9fa;
      color: #333;
    }
    .btn-laranja {
      background-color: #FF8C00;
      color: white;
    }
    .btn-laranja:hover {
      background-color: #e67600;
    }
    .car-card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .car-card:hover {
      transform: scale(1.02);
    }
    .filtro-label {
      font-weight: bold;
      color: #FF8C00;
    }
  </style>
<body>
<?= require_once('nav.php'); ?>
<div class="container py-5" id="catalogo">
  <h2 class="text-center text-uppercase fw-bold mb-4" style="color:#FF8C00;">Viaturas à Venda</h2>

  <!-- Filtros -->
  <form class="row g-3 mb-4" id="filtroForm">
    <div class="col-md-3">
      <label class="filtro-label">Marca</label>
      <select class="form-select" name="marca">
        <option>Todas</option>
        <option>Toyota</option>
        <option>Hyundai</option>
        <option>Kia</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="filtro-label">Modelo</label>
      <input type="text" class="form-control" name="modelo" placeholder="Ex: Hilux">
    </div>
    <div class="col-md-2">
      <label class="filtro-label">Ano</label>
      <input type="number" class="form-control" name="ano" placeholder="2020">
    </div>
    <div class="col-md-2">
      <label class="filtro-label">Combustível</label>
      <select class="form-select" name="combustivel">
        <option>Todos</option>
        <option>Gasolina</option>
        <option>Diesel</option>
      </select>
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <button type="submit" class="btn btn-laranja w-100">Filtrar</button>
    </div>
  </form>

  <!-- Lista de Viaturas -->
  <div class="row" id="listaViaturas">
    <!-- Card de Viatura -->
    <div class="col-md-4 mb-4">
      <div class="card car-card">
        <img src="img/car1.jpg" class="card-img-top" alt="Viatura 1">
        <div class="card-body">
          <h5 class="card-title">Toyota Hilux</h5>
          <p class="card-text">Ano: 2021<br>Combustível: Diesel<br>Preço: 15.000.000 AKZ</p>
          <div class="d-grid gap-2">
            <a href="https://wa.me/244900000000" target="_blank" class="btn btn-laranja">Solicitar Proposta</a>
            <button class="btn btn-outline-secondary" onclick="abrirFormulario('Toyota Hilux')">Entrar em Contato</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Outros cards virão aqui -->
  </div>
</div>

<!-- Modal Formulário de Contato -->
<div class="modal fade" id="formularioModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contato sobre <span id="modeloSelecionado"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control mb-2" placeholder="Seu nome" required>
        <input type="email" class="form-control mb-2" placeholder="Seu email" required>
        <input type="tel" class="form-control mb-2" placeholder="Telefone ou WhatsApp">
        <textarea class="form-control mb-2" rows="3" placeholder="Sua mensagem..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-laranja">Enviar</button>
      </div>
    </form>
  </div>
</div>

<script>
  function abrirFormulario(modelo) {
    document.getElementById('modeloSelecionado').textContent = modelo;
    new bootstrap.Modal(document.getElementById('formularioModal')).show();
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
