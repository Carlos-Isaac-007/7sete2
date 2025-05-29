<!-- oficina.php -->
<!DOCTYPE html>
<html lang="pt">
<head>
<?php 
$title ="oficina";
require_once('head.php');
?>
<style>
 body {
  position: relative;
  background-image: url('img/bgOfic.webp'); /* Caminho da sua imagem */
  background-size: cover;
  background-position: center;
  color: #4a3b20;
  font-family: 'Segoe UI', sans-serif;
  z-index: 0;
  min-height: 100vh;
}

body::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(26, 26, 26, 0.7); /* fundo preto com 70% opacidade */
  z-index: -1;
}



.card-custom {
  background-color: #2a2a2a;
  border: 1px solid #FF8C00;
  color: #FF8C00;
  border-radius: 15px;
}

.form-control,
.form-select {
  background-color: #1A1A1A;
  color: #FF8C00;
  border: 1px solid #FF8C00;
}

.form-control::placeholder {
  color: #a08850;
}

.btn-custom {
  background-color: #FF8C00;
  color: #1A1A1A;
  border-radius: 8px;
  font-weight: 600;
}

.btn-custom:hover {
  background-color: #e07c00;
}

.section-title {
  color: #FF8C00;
  font-weight: bold;
  margin-bottom: 20px;
  text-align: center;
}

@media (max-width: 767px) {
  h1 {
    font-size: 1.8rem;
  }
}
</style>

<body>

 <?php require_once('nav.php'); ?>

  <!-- Conteúdo -->
  <div class="container py-4">
    <h1 class="section-title">Gestão de Serviços de Oficina</h1>

    <div class="row g-4">
      <!-- Agendamento -->
      <div class="col-lg-6">
        <div class="card card-custom p-4 shadow">
          <h5 class="mb-3"><i class="bi bi-calendar-check-fill me-2"></i>Agendar Serviço</h5>
          <form>
            <div class="mb-3">
              <label for="viatura" class="form-label">Tipo de Viatura</label>
              <select class="form-select" id="viatura">
                <option selected>Escolha...</option>
                <option value="1">Carro</option>
                <option value="2">Motociclo</option>
                <option value="3">Camião</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="problema" class="form-label">Problema Relatado</label>
              <textarea class="form-control" id="problema" rows="3" placeholder="Descreva o problema..."></textarea>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="data" class="form-label">Data Desejada</label>
                <input type="date" class="form-control" id="data">
              </div>
              <div class="col-md-6 mb-3">
                <label for="hora" class="form-label">Hora Desejada</label>
                <input type="time" class="form-control" id="hora">
              </div>
            </div>
            <button type="submit" class="btn btn-custom w-100 mt-2">Enviar Agendamento</button>
          </form>
        </div>
      </div>

      <!-- Acompanhar Status -->
      <div class="col-lg-6">
        <div class="card card-custom p-4 shadow">
          <h5 class="mb-3"><i class="bi bi-search me-2"></i>Acompanhar Status</h5>
          <form>
            <div class="mb-3">
              <label for="codigo" class="form-label">Código do Serviço</label>
              <input type="text" class="form-control" id="codigo" placeholder="Digite o código de rastreio">
            </div>
            <button type="submit" class="btn btn-custom w-100">Consultar</button>
          </form>
          <!-- Status Simulado -->
          <div class="mt-4">
            <div class="alert alert-warning p-2 text-dark">
              <i class="bi bi-info-circle-fill me-2"></i>
              Status atual: <strong>Em análise</strong>
            </div>
            <!-- Você pode mudar para: Reparação iniciada, Concluído, etc -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once('footer.php'); ?>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
