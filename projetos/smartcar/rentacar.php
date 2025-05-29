<!-- rentacar.php -->
<!DOCTYPE html>
<html lang="pt">
<?php 
    $title = "Stand Auto";
    require_once('head.php');
?>
<body>
<style>
  #rentacar h2 {
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  #rentacar .form-control,
  #rentacar .btn-warning {
    border-radius: 8px;
  }

  #rentacar select.form-control {
    background-color: #fff;
  }

  #rentacar .card {
    transition: transform 0.2s ease, box-shadow 0.3s ease;
    border: none;
    border-radius: 12px;
  }

  #rentacar .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
  }

  #rentacar .card-title {
    color: #FF8C00;
    font-weight: bold;
  }

  #rentacar .btn-warning {
    background-color: #FF8C00;
    border: none;
    font-weight: bold;
    transition: background-color 0.2s ease;
  }

  #rentacar .btn-warning:hover {
    background-color: #e57b00;
  }

  #modalReserva .modal-content {
    border-radius: 12px;
    padding: 10px;
  }

  #modalReserva .modal-header {
    background-color: #FF8C00;
    color: white;
    border-bottom: none;
  }

  #modalReserva .btn-close {
    background: transparent;
    border: none;
    filter: brightness(0) invert(1);
  }

  #modalReserva label {
    font-weight: bold;
    color: #333;
  }
</style>
<?= require_once('nav.php'); ?>
<section class="container my-5" id="rentacar">
  <h2 class="text-center mb-4" style="color:#FF8C00;">Aluguer de Viaturas</h2>

  <!-- Filtros -->
  <div class="row mb-4">
    <div class="col-md-3">
      <select class="form-control" id="filtroMarca">
        <option value="">Marca</option>
        <option>Toyota</option>
        <option>Hyundai</option>
        <option>Kia</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-control" id="filtroTipo">
        <option value="">Tipo</option>
        <option>SUV</option>
        <option>Sedan</option>
        <option>Pickup</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-control" id="filtroPreco">
        <option value="">Preço (máx)</option>
        <option value="10000">10.000 AKZ</option>
        <option value="20000">20.000 AKZ</option>
        <option value="30000">30.000 AKZ</option>
      </select>
    </div>
    <div class="col-md-3">
      <button class="btn btn-warning w-100" onclick="filtrarViaturas()">Filtrar</button>
    </div>
  </div>

  <!-- Lista de viaturas disponíveis -->
  <div class="row" id="listaViaturas">
    <!-- Cards de viaturas serão inseridos aqui dinamicamente via PHP -->
    <?php
    // Simulação visual de viaturas
    $viaturas = [
      ['nome' => 'Toyota RAV4', 'tipo' => 'SUV', 'preco' => 20000, 'img' => 'img_viaturas/rav4.jpg'],
      ['nome' => 'Hyundai i10', 'tipo' => 'Hatch', 'preco' => 10000, 'img' => 'img_viaturas/i10.jpg'],
    ];
    foreach ($viaturas as $v) {
      echo "
        <div class='col-md-4 mb-4'>
          <div class='card h-100 shadow-sm'>
            <img src='{$v['img']}' class='card-img-top' alt='{$v['nome']}'>
            <div class='card-body'>
              <h5 class='card-title'>{$v['nome']}</h5>
              <p class='card-text'>Tipo: {$v['tipo']}<br>Preço: {$v['preco']} AKZ/dia</p>
              <button class='btn btn-warning w-100' onclick='abrirModalReserva(\"{$v['nome']}\", {$v['preco']})'>Reservar</button>
            </div>
          </div>
        </div>
      ";
    }
    ?>
  </div>
</section>

<!-- Modal de reserva -->
<div class="modal fade" id="modalReserva" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" id="formReserva">
      <div class="modal-header">
        <h5 class="modal-title">Reservar Viatura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="viaturaSelecionada" name="viatura">
        <div class="mb-3">
          <label>Nome:</label>
          <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Data Início:</label>
          <input type="date" name="data_inicio" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Data Fim:</label>
          <input type="date" name="data_fim" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Local de Entrega:</label>
          <input type="text" name="local" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tipo de Seguro:</label>
          <select name="seguro" class="form-control" required>
            <option>Normal</option>
            <option>Completo</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Gerar Contrato</button>
      </div>
    </form>
  </div>
</div>

<script>
function abrirModalReserva(nome, preco) {
  document.getElementById('viaturaSelecionada').value = nome;
  new bootstrap.Modal(document.getElementById('modalReserva')).show();
}

document.getElementById('formReserva').addEventListener('submit', function(e) {
  e.preventDefault();
  alert("Contrato gerado! (simulado)");
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>
