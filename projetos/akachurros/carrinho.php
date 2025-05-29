<style>
  #cart-step,
  #payment-step {
    transition: opacity 0.5s ease;
  }

  .step-hidden {
    opacity: 0;
    visibility: hidden;
    height: 0;
    overflow: hidden;
    pointer-events: none;
    position: absolute;
    width: 100%;
  }

  .step-visible {
    opacity: 1;
    visibility: visible;
    height: auto;
    pointer-events: auto;
    position: relative;
    width: 100%;
  }

  .btn-outline-secondary {
    border-color: #4B1E00;
    color: #4B1E00;
  }

  .btn-outline-secondary:hover {
    background-color: #4B1E00;
    color: white;
  }

  .modal-header.bg-warning {
    background-color: #4B1E00 !important;
    color: white;
  }

  .btn-success {
    background-color: #4B1E00;
    border-color: #4B1E00;
  }

  .btn-success:hover {
    background-color: #371500;
    border-color: #371500;
  }
</style>

<!-- Carrinho Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-end">
    <div class="modal-content border-0 rounded-start-4 shadow-lg">
      <div class="modal-header" style="background-color: #4B1E00; color: white;">
        <h5 class="modal-title d-flex align-items-center" id="cartModalLabel">
          <i class="bi bi-cart-fill me-2"></i> Seu Carrinho
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
        <!-- Etapa 1: Carrinho -->
        <div id="cart-step" class="step-visible">
          <ul class="list-group mb-3" id="cart-items">
            <!-- Itens do carrinho serão inseridos aqui -->
          </ul>
          <h5 class="text-end">Total: <span id="cart-total" class="fw-bold">0.00</span> AKZ</h5>

          <div class="d-grid gap-2 mt-3">
            <a href="#" class="btn text-white fw-semibold" id="checkout-btn" style="background-color: #4B1E00;" target="_blank">
              Finalizar Pedido via WhatsApp
            </a>
            <button class="btn btn-outline-dark" id="pay-direct-btn">Pagar com Multicaixa Express</button>
          </div>
        </div>

        <!-- Etapa 2: Pagamento -->
        <div id="payment-step" class="step-hidden mt-2">
          <h5 class="mb-3 text-center">Pagamento com Multicaixa Express</h5>
          <form id="payment-form">
            <div class="mb-2">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" id="nome" class="form-control" required>
            </div>
            <div class="mb-2">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" class="form-control" required>
            </div>
            <div class="mb-2">
              <label for="telefone" class="form-label">Telefone</label>
              <input type="tel" id="telefone" class="form-control" required>
            </div>
            <div class="mb-2">
              <label for="telefone" class="form-label">*Onde Receber</label>
              <input type="text-area" id="telefone" class="form-control" required>
            </div>
            <div class="mb-2">
              <label for="multicaixa" class="form-label">Nº Multicaixa Express</label>
              <input type="tel" id="multicaixa" class="form-control" required>
            </div>

            <div class="d-grid gap-2 mt-3">
              <button type="submit" class="btn text-white fw-semibold" style="background-color: #4B1E00;">
                Finalizar Compra
              </button>
              <button type="button" class="btn btn-secondary" id="voltar-carrinho">Voltar ao Carrinho</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  const cartStep = document.getElementById('cart-step');
  const paymentStep = document.getElementById('payment-step');
  const payDirectBtn = document.getElementById('pay-direct-btn');
  const voltarBtn = document.getElementById('voltar-carrinho');
  const paymentForm = document.getElementById('payment-form');

  payDirectBtn.addEventListener('click', () => {
    cartStep.classList.remove('step-visible');
    cartStep.classList.add('step-hidden');
    paymentStep.classList.remove('step-hidden');
    paymentStep.classList.add('step-visible');
  });

  voltarBtn.addEventListener('click', () => {
    paymentStep.classList.remove('step-visible');
    paymentStep.classList.add('step-hidden');
    cartStep.classList.remove('step-hidden');
    cartStep.classList.add('step-visible');
  });

  paymentForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const telefone = document.getElementById('telefone').value;
    const multicaixa = document.getElementById('multicaixa').value;

    alert(`Pagamento enviado com sucesso!\nNome: ${nome}\nMulticaixa: ${multicaixa}`);
    // Aqui você pode fazer a integração com backend ou API
  });
</script>
