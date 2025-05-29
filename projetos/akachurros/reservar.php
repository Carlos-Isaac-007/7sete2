<!DOCTYPE html>
<html lang="pt">
<head>
  <?php
  $title = 'Reservar';
  require_once('head.php') ?>
  <style>
    body {
      background-color: #fff8f2;
      font-family: 'Segoe UI', sans-serif;
    }
    .navbar {
      background-color: #4B1E00;
    }
    .navbar-brand img {
      height: 50px;
    }
    .btn-primary {
      background-color: #4B1E00;
      border-color: #4B1E00;
    }
    .btn-primary:hover {
      background-color: #371500;
      border-color: #371500;
    }
    .form-section {
      padding: 60px 15px;
    }
  </style>
</head>
<body>

<?php require_once('header.php') ?>

<!-- Formulário de Reserva -->
<section class="form-section">
  <div class="container">
    <h2 class="text-center mb-4">Faça sua Reserva</h2>

    <form id="reserva-form">
      <div class="row g-3">
        <div class="col-md-6">
          <label for="nome" class="form-label">Nome Completo</label>
          <input type="text" class="form-control" id="nome" required>
        </div>
        <div class="col-md-6">
          <label for="telefone" class="form-label">Telefone / WhatsApp</label>
          <input type="tel" class="form-control" id="telefone" required>
        </div>
        <div class="col-md-6">
          <label for="data" class="form-label">Data da Reserva</label>
          <input type="date" class="form-control" id="data" required>
        </div>
        <div class="col-md-6">
          <label for="hora" class="form-label">Horário</label>
          <input type="time" class="form-control" id="hora" required>
        </div>
        <div class="col-md-6">
          <label for="tipo" class="form-label">Tipo de Reserva</label>
          <select class="form-select" id="tipo" required>
            <option value="">Selecione</option>
            <option value="Evento">Evento</option>
            <option value="Entrega">Entrega</option>
            <option value="Retirada">Retirada</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="quantidade" class="form-label">Quantidade de Pessoas / Produtos</label>
          <input type="number" class="form-control" id="quantidade" required>
        </div>
        <div class="col-12">
          <label for="observacoes" class="form-label">Observações</label>
          <textarea class="form-control" id="observacoes" rows="3"></textarea>
        </div>
      </div>

      <div class="d-grid mt-4">
        <button type="button" class="btn btn-primary btn-lg" id="btnReservar">Reservar</button>
      </div>
      <div class="d-grid mt-2">
        <button type="submit" class="btn btn-outline-success btn-lg">Reservar via WhatsApp</button>
      </div>
    </form>
  </div>
</section>

<!-- Modal de Sucesso -->
<div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="modalSucessoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalSucessoLabel">Reserva efetuada!</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body text-center">
        Sua reserva foi feita com sucesso. Entraremos em contato o mais breve possível!
      </div>
    </div>
  </div>
</div>

<!-- JS do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS personalizado -->
<script>
  // Botão "Reservar" abre modal de sucesso
  document.getElementById("btnReservar").addEventListener("click", function () {
    const modal = new bootstrap.Modal(document.getElementById('modalSucesso'));
    modal.show();
  });

  // Botão "Reservar via WhatsApp" envia mensagem
  document.getElementById("reserva-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const nome = document.getElementById("nome").value;
    const telefone = document.getElementById("telefone").value;
    const data = document.getElementById("data").value;
    const hora = document.getElementById("hora").value;
    const tipo = document.getElementById("tipo").value;
    const quantidade = document.getElementById("quantidade").value;
    const observacoes = document.getElementById("observacoes").value;

    const mensagem = `Olá, gostaria de fazer uma reserva!\n
Nome: ${nome}
Telefone: ${telefone}
Data: ${data}
Hora: ${hora}
Tipo: ${tipo}
Quantidade: ${quantidade}
Observações: ${observacoes}`;

    const numeroWhatsApp = "244942243436"; // Substitua pelo número real
    const url = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagem)}`;
    window.open(url, '_blank');
  });
</script>

</body>
</html>
