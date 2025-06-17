<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Carrossel Contínuo de Logos</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<!-- Modal Moderno -->
<div class="" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Pagamento por Transferência</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <div class="modal-body p-4">
        <div id="stepper">
          <!-- Etapa 1: Dados Bancários -->
          <div class="step" data-step="1">
            <h6 class="mb-3">1. Transfira o valor para uma das contas</h6>

            <div class="mb-3">
              <p><strong>BPC</strong><br>
              Conta: <span class="text-monospace">0455X01688011</span> <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copiarTexto('0455X01688011')">Copiar</button><br>
              IBAN: <span class="text-monospace">AO06001004550330168801152</span> <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copiarTexto('AO06001004550330168801152')">Copiar</button></p>
            </div>

            <div class="mb-3">
              <p><strong>BAI</strong><br>
              Conta: <span class="text-monospace">245080097</span> <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copiarTexto('245080097')">Copiar</button><br>
              IBAN: <span class="text-monospace">AO06004000007508009710153</span> <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copiarTexto('AO06004000007508009710153')">Copiar</button></p>
            </div>

            <p class="text-muted">Use o número do pedido como referência da transferência.</p>
          </div>

          <!-- Etapa 2: Escolha de Entrega -->
          <div class="step d-none" data-step="2">
            <h6 class="mb-3">2. Como deseja receber o produto?</h6>
            <form id="deliveryForm">
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="delivery_option" id="opt_entrega" value="entrega" checked>
                <label class="form-check-label" for="opt_entrega">Entregar no meu endereço</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="delivery_option" id="opt_loja" value="loja">
                <label class="form-check-label" for="opt_loja">Vou buscar na loja</label>
              </div>
              <div class="mb-3" id="campoEndereco">
                <label for="endereco" class="form-label">Descreva sua localização</label>
                <textarea id="endereco" class="form-control" rows="3" placeholder="Ex: Estou próximo às bombas do mercado."></textarea>
              </div>
            </form>
          </div>

          <!-- Etapa 3: Enviar Comprovativo -->
          <div class="step d-none" data-step="3">
            <h6 class="mb-3">3. Envie o comprovativo da transferência</h6>
            <p>Use o botão abaixo para nos mandar o comprovativo via WhatsApp. Inclua o ID do produto/pedido: <strong id="idPedido">#12345</strong></p>
            <a href="#" target="_blank" class="btn btn-success d-flex align-items-center gap-2">
              <i class="fa fa-whatsapp"></i> Mandar Comprovativo
            </a>
          </div>
        </div>
      </div>

      <!-- Botões do Rodapé -->
      <div class="modal-footer border-0 d-flex justify-content-between">
        <button class="btn btn-secondary" id="btnAnterior" disabled>Anterior</button>
        <button class="btn btn-primary" id="btnProximo">Próximo</button>
      </div>
    </div>
  </div>
</div>
<script>
let etapaAtual = 1;
const totalEtapas = 3;

const atualizarEtapa = () => {
  document.querySelectorAll('.step').forEach(el => {
    el.classList.add('d-none');
    if (parseInt(el.dataset.step) === etapaAtual) {
      el.classList.remove('d-none');
    }
  });

  document.getElementById('btnAnterior').disabled = etapaAtual === 1;
  document.getElementById('btnProximo').textContent = etapaAtual === totalEtapas ? 'Fechar' : 'Próximo';
};

document.getElementById('btnProximo').addEventListener('click', () => {
  if (etapaAtual < totalEtapas) {
    etapaAtual++;
    atualizarEtapa();
  } else {
    // Aqui você pode enviar o formulário ou apenas fechar o modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('bankModal'));
    modal.hide();
  }
});

document.getElementById('btnAnterior').addEventListener('click', () => {
  if (etapaAtual > 1) {
    etapaAtual--;
    atualizarEtapa();
  }
});

function copiarTexto(texto) {
  navigator.clipboard.writeText(texto).then(() => {
    alert("Copiado!");
  });
}

// Alternar exibição do campo de endereço
document.querySelectorAll('input[name="delivery_option"]').forEach(radio => {
  radio.addEventListener('change', () => {
    const campo = document.getElementById('campoEndereco');
    campo.style.display = (radio.value === 'entrega') ? 'block' : 'none';
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
