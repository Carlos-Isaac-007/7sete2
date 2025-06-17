<?php require_once('header.php');
if (!isset($_SESSION['customer']['cust_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI']; // ou $_SERVER['REQUEST_URI'] se quiser o caminho exato
}

?>

<!-- Google tag (gtag.js) event -->
<script>
  gtag('event', 'ads_conversion_Iniciar_pagamento_1', {
    // <event_parameters>
  });
</script>
<?php

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$banner_checkout = $row['banner_checkout'];
}
?>

<?php
if(!isset($_SESSION['cart_p_id'])) {
header('location:'.ROOT.'cart');
exit;
}
?>

<?php 
require_once './requires/checkout_css.php';
require_once 'assets/css/checkout.php';
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_checkout; ?>)">
<div class="overlay"></div>
<div class="page-banner-inner">
<h1><?php echo LANG_VALUE_22; ?></h1>
</div>
</div>

<div class="page">
<div class="container">
<div class="row">
<div class="col-md-12">

<?php if(!isset($_SESSION['customer'])): ?>

    <div class="login_container">
        <i class="fas fa-shopping-cart cart_icon"></i>
        <h2>Inicie Sessão</h2>
        <p>Você precisa iniciar sessão para continuar com a compra.</p></a>
        <a href="<?=ROOT?>login" style="text-decoration: none !important;"><button class="login_btn">
            <i class="fas fa-sign-in-alt"></i> Entrar com sua conta
        </button></a>
    </div>
<?php else: ?>

<h3 class="special"><?php echo LANG_VALUE_26; ?></h3>
<div class="cart">
  <!-- Wrapper responsivo para rolagem horizontal -->
  <div class="table-responsive">
    <table class="table table-hover table-bordered modern-cart-table">
      <thead class="bg-primary text-white">
        <tr>
          <th><i class="fas fa-image"></i></th>
          <th class="product-name"><i class="fas fa-box"></i> <?php echo LANG_VALUE_47; ?></th>
          <th class="product-quantity"><i class="fas fa-sort-numeric-up"></i> <?php echo LANG_VALUE_55; ?></th>
          <th><i class="fas fa-tag"></i> <?php echo LANG_VALUE_159; ?></th>
          <th class="text-right"><i class="fas fa-money-bill-wave"></i> <?php echo LANG_VALUE_82; ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $table_total_price = 0;
        $cart_items = [];

        if (!empty($_SESSION['cart_p_id'])) {
            foreach ($_SESSION['cart_p_id'] as $key => $value) {
                $cart_items[] = [
                    'id'        => $_SESSION['cart_p_id'][$key],
                    'quantity'  => $_SESSION['cart_p_qty'][$key],
                    'price'     => $_SESSION['cart_p_current_price'][$key],
                    'name'      => $_SESSION['cart_p_name'][$key],
                    'photo'     => $_SESSION['cart_p_featured_photo'][$key]
                ];
            }
        }
        ?>

        <?php foreach ($cart_items as $index => $item): ?>
          <?php
          $row_total_price = $item['price'] * $item['quantity'];
          $table_total_price += $row_total_price;
          ?>
          <tr>
            <td>
              <div class="cart-img-wrapper">
                <img src="<?= ROOT ?>assets/uploads/<?php echo htmlspecialchars($item['photo']); ?>" alt="Produto" class="cart-img rounded shadow-sm">
              </div>
            </td>
            <td class="product-name align-middle">
              <span class="fw-semibold"><?php echo htmlspecialchars($item['name']); ?></span>
            </td>
            <td class="product-quantity align-middle">
              <!-- Removido badge, agora só número centralizado -->
              <span style="display:inline-block; min-width:32px; text-align:center; font-size:1.1rem; font-weight:600; color:#000c78; background:#f3f5ff; border-radius:6px; padding:4px 10px;">
                <?php echo $item['quantity']; ?>
              </span>
            </td>
            <td class="align-middle">
              <span class="text-success fw-bold"><?php echo $item['price'] . LANG_VALUE_1; ?></span>
            </td>
            <td class="text-right align-middle">
              <span class="fw-bold text-dark"><?php echo $row_total_price . LANG_VALUE_1; ?></span>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr class="bg-light">
          <th colspan="4" class="total-text text-end"><?php echo LANG_VALUE_81; ?></th>
          <th class="total-amount" data-totalCart="<?php echo $table_total_price . LANG_VALUE_1; ?>">
            <i class="fas fa-coins text-warning"></i> <?php echo $table_total_price . LANG_VALUE_1; ?>
          </th>
        </tr>
        <tr>
          <td colspan="4" class="total-text text-end">
            <i class="fas fa-shipping-fast text-info"></i> <?php echo LANG_VALUE_84; ?>
          </td>
          <td class="total-amount" id="custoEnvio"></td>
        </tr>
        <tr class="bg-primary text-white">
          <th colspan="4" class="total-text text-end">
            <i class="fas fa-cash-register"></i> <?php echo LANG_VALUE_82; ?>
          </th>
          <th class="total-amount" id="totalWithShipping">Aqui vai aprecer o total</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<style>
.modern-cart-table {
  border-radius: 1rem;
  overflow: hidden;
  box-shadow: 0 2px 12px #000c7822;
  margin-bottom: 1.5rem;
}
.modern-cart-table th, .modern-cart-table td {
  vertical-align: middle !important;
  font-size: 1.05rem;
}
.modern-cart-table thead th {
  background: linear-gradient(90deg, #000c78 60%, #3b3b98 100%) !important;
  color: #fff !important;
  border: none;
  font-weight: 600;
  font-size: 1.08rem;
  letter-spacing: 0.01em;
}
.modern-cart-table tfoot th, .modern-cart-table tfoot td {
  font-size: 1.1rem;
  font-weight: 600;
  border-top: 2px solid #ccc;
}
.cart-img-wrapper {
  width: 56px;
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f3f5ff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 1px 4px #000c7822;
}
.cart-img {
  width: 48px;
  height: 48px;
  object-fit: cover;
  border-radius: 8px;
}
.total-text {
  font-weight: 600;
  font-size: 1.05rem;
  color: #000c78;
}
.total-amount {
  font-size: 1.15rem;
  font-weight: 700;
  color: #23235a;
}
@media (max-width: 576px) {
  .modern-cart-table th, .modern-cart-table td {
    font-size: 0.98rem;
    padding: 0.5rem;
  }
  .cart-img-wrapper {
    width: 40px;
    height: 40px;
  }
  .cart-img {
    width: 36px;
    height: 36px;
  }
}
</style>

<style>
  /* Switch estilo alavanca */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 28px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* A parte visível do switch */
.slider {
  position: absolute;
  cursor: pointer;
  background-color: #ccc;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  transition: .4s;
  border-radius: 34px;
}

.slider::before {
  position: absolute;
  content: "";
  height: 22px;
  width: 22px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

/* Quando marcado */
input:checked + .slider {
  background-color: #000c78;
}

input:checked + .slider::before {
  transform: translateX(22px);
}

/* Estilo arredondado */
.slider.round {
  border-radius: 34px;
}

.slider.round::before {
  border-radius: 50%;
}

</style>
  <style>
  .shipping-info {
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: #f3f5ff;
    border-left: 5px solid #000c78;
    padding: 12px 16px;
    border-radius: 10px;
    font-family: 'Segoe UI', sans-serif;
    font-size: 16px;
    font-weight: 500;
    color: #000c78;
    margin-bottom: 15px;
  }

  .shipping-info i {
    font-size: 20px;
    color: #000c78;
  }

  .shipping-select {
    margin-bottom: 15px;
    font-family: 'Segoe UI', sans-serif;
  }

  .shipping-select label {
    display: block;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #333;
  }

  .form-select,
  .form-control {
    width: 100%;
    padding: 10px 14px;
    font-size: 15px;
    border: 2px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    font-family: 'Segoe UI', sans-serif;
  }

  .form-select:focus,
  .form-control:focus {
    border-color: #000c78;
    box-shadow: 0 0 0 3px rgba(0, 12, 120, 0.15);
    outline: none;
  }

  .form-control[disabled] {
    background-color: #f0f0f0;
    color: #999;
  }

  @media (max-width: 480px) {
    .shipping-info {
      font-size: 14px;
      flex-direction: column;
      align-items: flex-start;
    }

    .shipping-select label {
      font-size: 14px;
    }

    .form-select,
    .form-control {
      font-size: 14px;
    }
  }
</style>

<!-- Alavanca: Alterar localização -->
<div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 12px;">
  <label class="switch">
    <input type="checkbox" id="toggleEntrega">
    <span class="slider round"></span>
  </label>
  <span style="font-weight: 600; font-size:16px;">Alterar localização de entrega</span>
</div>

<!-- Container que será exibido quando o switch estiver ativado -->
<div id="localizacaoEntrega" style="display: none;">
    <style>
    .shipping-info {
      display: flex;
      align-items: center;
      gap: 10px;
      background-color: #f3f5ff;
      border-left: 5px solid #000c78;
      padding: 12px 16px;
      border-radius: 10px;
      font-family: 'Segoe UI', sans-serif;
      font-size: 16px;
      font-weight: 500;
      color: #000c78;
      margin-bottom: 15px;
    }

    .shipping-info i {
      font-size: 20px;
      color: #000c78;
    }

    .shipping-select {
      margin-bottom: 15px;
      font-family: 'Segoe UI', sans-serif;
    }

    .shipping-select label {
      display: block;
      font-size: 15px;
      font-weight: 600;
      margin-bottom: 6px;
      color: #333;
    }

    .form-select,
    .form-control {
      width: 100%;
      padding: 10px 14px;
      font-size: 15px;
      border: 2px solid #ccc;
      border-radius: 8px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      font-family: 'Segoe UI', sans-serif;
    }

    .form-select:focus,
    .form-control:focus {
      border-color: #000c78;
      box-shadow: 0 0 0 3px rgba(0, 12, 120, 0.15);
      outline: none;
    }

    .form-control[disabled] {
      background-color: #f0f0f0;
      color: #999;
    }

    /* Estilo para alinhar input e botão na mesma linha */
    #bairroInputGroup {
      display: flex;
      gap: 8px;
      align-items: center;
      width: 100%;
    }
    #bairroInput {
      flex: 1 1 auto;
      min-width: 0;
    }
    #otherBairroContainer {
      display: flex;
      align-items: center;
      margin: 0;
      padding: 0;
      background: none;
      box-shadow: none;
      border-radius: 0;
      gap: 0;
    }
    #otherBairroSubmit {
      background-color: #000c78;
      color: #fff;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s ease;
      margin-left: 0;
      height: 42px;
      /* Ajuste para alinhar com o input */
    }
    #otherBairroSubmit:hover {
      background-color: #000a5e;
    }

    @media (max-width: 480px) {
      .shipping-info {
        font-size: 14px;
        flex-direction: row !important;
        align-items: center !important;
        gap: 8px;
            }
            .shipping-select label {
        font-size: 14px;
            }
            .form-select,
            .form-control {
        font-size: 14px;
            }
            #bairroInputGroup {
        flex-direction: row;
        gap: 6px;
        align-items: stretch;
            }
            #bairroInput {
        width: 100%;
        flex: 1 1 0%;
            }
            #otherBairroSubmit {
        width: 100%;
        height: 40px;
        max-width: 120px;
            }
          }
        </style>

       
        <!-- Seleção de município -->
        <div class="shipping-select" style="margin-bottom: 12px;">
          <label for="municipioSelect"><i class="fas fa-map-marker-alt" ></i> Município:</label>
          <select name="municipio" id="municipioSelect" class="form-select" style="width: 30%;">
            <option value="">-- Escolha uma opção --</option>
          </select>
        </div>

        <!-- Seleção de bairro/rua -->
        <div class="shipping-select" style="margin-bottom: 18px;">
          <label for="bairroInput"><i class="fas fa-road"></i> Bairro/Rua para calcular o custo de envio:</label>
          <div id="bairroInputGroup">
            <input autocomplete="off" id="bairroInput" name="bairro" class="form-control awesomplete" placeholder="Digite ou selecione" disabled>
            <span id="otherBairroContainer">
        <button type="button" id="otherBairroSubmit">
          Enviar
        </button>
            </span>
          </div>
          <input type="hidden" id="otherBairroInput" />
        </div>
</div>
<script>
  // Alternar visibilidade do bloco de localização com o switch
document.getElementById('toggleEntrega').addEventListener('change', function () {
  const localEntrega = document.getElementById('localizacaoEntrega');
  if (this.checked) {
    localEntrega.style.display = 'block';
  } else {
    localEntrega.style.display = 'none';
  }
});

</script>
<div class="cart-buttons">
  <div>
    <a href="<?=ROOT?>cart" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> <?php echo LANG_VALUE_21; ?>
    </a>
  </div>
</div>

<!--<div class="clear"></div>
<h3 class="special"><?php echo LANG_VALUE_33; ?></h3>-->
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12 form-group" id="paymentSection">
        <label for="" class="fw-bold" style="font-size:1.1rem;">
          <i class="fas fa-credit-card text-primary"></i> <?php echo LANG_VALUE_34; ?> *
        </label>
        <div class="d-flex flex-wrap gap-3 p-3 justify-content-between align-items-center" style="background: #f3f5ff; border-radius: 1rem; box-shadow: 0 2px 12px #000c7822;">
          <?php if($_SESSION['cart_p_name'][1] != "Alice de Almeida - Técnicas Infalíveis de Estudo, Memorização e Aprendizagem – Do Jeito que Funciona pra Você"): ?>   
            <button type="button" class="btn btn-lg btn-light border border-primary d-flex align-items-center gap-2 shadow-sm"
              data-bs-toggle="modal" data-bs-target="#moneykModal" style="border-radius: 0.75rem; font-weight:600;">
              <i class="fas fa-money-bill-wave fa-lg text-success"></i>
              <span>Pagar em dinheiro</span>
            </button>
          <?php endif; ?>
          <!-- Botão para abrir o Modal bank -->
          <button type="button" class="btn btn-lg btn-light border border-primary d-flex align-items-center gap-2 shadow-sm"
            data-bs-toggle="modal" data-bs-target="#bankModal" style="border-radius: 0.75rem; font-weight:600;">
            <i class="fas fa-university fa-lg text-primary"></i>
            <span>Transferência Bancária</span>
          </button>
        </div>
        <div class="mt-2 small text-muted mb-4">
          <i class="fas fa-info-circle"></i> Escolha a forma de pagamento preferida para finalizar sua compra.
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</div>

<style>
  .step {
  transition: opacity 0.3s ease-in-out;
}

/* Botão base */
.btn-custom {
  padding: 0.6rem 1.5rem;
  font-weight: 600;
  font-size: 1rem;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

/* Botão primário: azul escuro */
.btn-primary-custom {
  background-color: #000c78;
  color: white;
}

.btn-primary-custom:hover {
  background-color: #000a66;
}

.btn-primary-custom:disabled {
  background-color: #ccc;
  color: #777;
  cursor: not-allowed;
}

/* Botão secundário: branco com borda azul */
.btn-secondary-custom {
  background-color: white;
  color: #000c78;
  border: 2px solid #000c78;
}

.btn-secondary-custom:hover {
  background-color: #000c78;
  color: white;
}

.btn-secondary-custom:disabled {
  background-color: #f3f3f3;
  border-color: #ccc;
  color: #999;
  cursor: not-allowed;
}

</style>
<!-- Modal Moderno e Atrativo -->
<div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 shadow border-0" style="overflow:hidden;">
      <div class="modal-header border-0 bg-primary text-white rounded-top-4" style="background: linear-gradient(90deg, #000c78 60%, #3b3b98 100%);">
        <div class="d-flex align-items-center gap-2">
          <i class="fas fa-university fa-lg"></i>
          <h5 class="modal-title fw-bold mb-0" id="bankModalLabel">Pagamento por Transferência Bancária</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <div class="modal-body p-4" style="background: #f8faff;">
        <div id="stepper">
          <!-- Etapa 1: Dados Bancários -->
          <div class="step" data-step="1">
            <div class="mb-4 text-center">
              <span class="badge rounded-pill bg-primary fs-5 px-4 py-2 mb-2"><i class="fas fa-money-check-alt me-2"></i>1. Transfira o valor</span>
              <p class="mb-0 text-muted" style="margin-top: 10px;">Escolha uma das contas abaixo para realizar a transferência:</p>
            </div>
            <div class="row g-3 justify-content-center">
              <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      <img src="uploads/bpc.webp" alt="BPC" style="height:32px;width:auto;" class="me-2">
                      <span class="fw-bold fs-6">BPC</span>
                    </div>
                    <div class="mb-2">
                      <i class="fas fa-hashtag text-primary"></i>
                      <span class="text-monospace">0455X01688011</span>
                      <button class="btn btn-sm btn-outline-primary ms-2" onclick="copiarTexto('0455X01688011')"><i class="fas fa-copy"></i></button>
                    </div>
                    <div>
                      <i class="fas fa-barcode text-secondary"></i>
                      <span class="text-monospace">AO06001004550330168801152</span>
                      <button class="btn btn-sm btn-outline-primary ms-2" onclick="copiarTexto('001004550330168801152')"><i class="fas fa-copy"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      <img src="uploads/BAI.webp" alt="BAI" style="height:32px;width:auto;" class="me-2">
                      <span class="fw-bold fs-6">BAI</span>
                    </div>
                    <div class="mb-2">
                      <i class="fas fa-hashtag text-primary"></i>
                      <span class="text-monospace">245080097</span>
                      <button class="btn btn-sm btn-outline-primary ms-2" onclick="copiarTexto('245080097')"><i class="fas fa-copy"></i></button>
                    </div>
                    <div>
                      <i class="fas fa-barcode text-secondary"></i>
                      <span class="text-monospace">AO06004000007508009710153</span>
                      <button class="btn btn-sm btn-outline-primary ms-2" onclick="copiarTexto('004000007508009710153')"><i class="fas fa-copy"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="alert alert-info mt-4 d-flex align-items-center" style="font-size: 1rem;">
              <i class="fas fa-info-circle me-2"></i>
              Após transferir, avance para informar a entrega.
            </div>
          </div>

          <!-- Etapa 2: Escolha de Entrega -->
          <div class="step d-none" data-step="2">
            <div class="mb-4 text-center">
              <span class="badge rounded-pill bg-primary fs-5 px-4 py-2 mb-2"><i class="fas fa-truck me-2"></i>2. Como deseja receber?</span>
              <p class="mb-0 text-muted"  style="margin-top: 10px;">Escolha a forma de entrega do seu pedido:</p>
            </div>
            <form id="deliveryForm">
              <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                  <div class="form-check p-3 rounded-3 border border-primary-subtle bg-light h-100">
                    <input class="form-check-input" type="radio" name="delivery_option" id="opt_entrega" value="entrega" checked>
                    <label class="form-check-label fw-semibold" for="opt_entrega">
                      <i class="fas fa-home me-1 text-primary"></i> Entregar no meu endereço
                    </label>
                    <div class="small text-muted ms-4">Receba em casa, escritório ou outro local.</div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-check p-3 rounded-3 border border-success-subtle bg-light h-100">
                    <input class="form-check-input" type="radio" name="delivery_option" id="opt_loja" value="loja">
                    <label class="form-check-label fw-semibold" for="opt_loja">
                      <i class="fas fa-store me-1 text-success"></i> Retirar na loja
                    </label>
                    <div class="small text-muted ms-4">Sem custo de envio. Retire pessoalmente.</div>
                  </div>
                </div>
              </div>
              <div class="mb-3" id="campoEndereco">
                <label for="endereco" class="form-label fw-semibold">
                  <i class="fas fa-map-marker-alt text-danger"></i> Descreva sua localização
                </label>
                <textarea id="endereco" class="form-control rounded-3 shadow-sm" rows="3" name="location_now" placeholder="Ex: Perto do mercado municipal, ao lado das bombas de combustível"></textarea>
                <div class="form-text text-muted mt-1">
                  Seja o mais detalhado possível para facilitar a entrega.
                </div>
              </div>
              <input type="hidden" name="customer_province" value="Benguela" class="provincia">
              <input type="hidden" name="customer_municipio" value="" class="municipio">
              <input type="hidden" name="customer_bairro" value="" class="bairro">
              <input type="hidden" name="final_total" value="" class="final_total">
              <input type="hidden" name="final_total_custo" value="" class="final_total_custo">
            </form>
          </div>

          <!-- Etapa 3: Enviar Comprovativo -->
          <div class="step d-none" data-step="3">
            <div class="mb-4 text-center">
              <span class="badge rounded-pill bg-primary fs-5 px-4 py-2 mb-2"><i class="fas fa-paperclip me-2"></i>3. Envie o comprovativo</span>
              <p class="mb-0 text-muted"  style="margin-top: 10px;">Finalize enviando o comprovativo da transferência:</p>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center">
              <a id="whatsappBtn" target="_blank" class="btn btn-success btn-lg d-flex align-items-center gap-2 px-4 py-2 mb-3 shadow-sm" style="font-size:1.15rem;">
                <i class="fab fa-whatsapp fa-lg"></i> Mandar Comprovativo
              </a>
              <div class="alert alert-success d-flex align-items-center" style="font-size: 1rem;">
                <i class="fas fa-check-circle me-2"></i>
                Pronto! Após o envio, aguarde nossa confirmação.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Botões do Rodapé -->
      <div class="modal-footer border-0 d-flex justify-content-between bg-light rounded-bottom-4">
        <button class="btn-custom btn-secondary-custom" id="btnAnterior" disabled>
          <i class="fas fa-arrow-left me-1"></i> Anterior
        </button>
        <button class="btn-custom btn-primary-custom" id="btnProximo">
          Próximo <i class="fas fa-arrow-right ms-1"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<style>
#bankModal .modal-content {
  border-radius: 1.5rem;
  border: none;
  overflow: hidden;
}
#bankModal .modal-header {
  border-bottom: none;
  padding-bottom: 1rem;
}
#bankModal .modal-title {
  font-size: 1.25rem;
  letter-spacing: 0.01em;
}
#bankModal .form-check-input:checked {
  background-color: #000c78;
  border-color: #000c78;
}
#bankModal .form-check {
  cursor: pointer;
  transition: box-shadow 0.2s;
}
#bankModal .form-check:hover {
  box-shadow: 0 0 0 2px #000c7833;
}
#bankModal .btn-primary-custom {
  background: linear-gradient(90deg, #000c78 60%, #3b3b98 100%);
  border: none;
  font-weight: 600;
  font-size: 1.1rem;
  border-radius: 0.75rem;
  box-shadow: 0 2px 8px #000c7822;
}
#bankModal .btn-primary-custom:hover {
  background: linear-gradient(90deg, #000a66 60%, #23235a 100%);
}
#bankModal .btn-secondary-custom {
  background: #fff;
  color: #000c78;
  border: 2px solid #000c78;
  font-weight: 600;
  font-size: 1.1rem;
  border-radius: 0.75rem;
}
#bankModal .btn-secondary-custom:hover {
  background: #000c78;
  color: #fff;
}
#bankModal .badge {
  font-size: 1rem;
  letter-spacing: 0.02em;
}
#bankModal .card {
  border-radius: 1rem;
  border: none;
  background: #fff;
}
#bankModal .card-body {
  padding: 1.2rem 1rem;
}
#bankModal .alert-info, #bankModal .alert-success {
  border-radius: 0.75rem;
  font-size: 1rem;
}
@media (max-width: 576px) {
  #bankModal .modal-dialog {
    margin: 1rem;
  }
  #bankModal .modal-content {
    border-radius: 1rem;
  }
  #bankModal .card-body {
    padding: 1rem 0.5rem;
  }
}
</style>
<script>
let data = null;
let etapaAtual = 1;
const totalEtapas = 3;
let bloquearRetorno = false; // Flag para impedir o retorno ao Step 2

const btnProximo = document.getElementById('btnProximo');
const btnAnterior = document.getElementById('btnAnterior');

const atualizarEtapa = () => {
  document.querySelectorAll('.step').forEach(el => {
    el.classList.add('d-none');
    if (parseInt(el.dataset.step) === etapaAtual) {
      el.classList.remove('d-none');
    }
  });

  btnAnterior.disabled = etapaAtual === 1 || (etapaAtual === 3 && bloquearRetorno);
  btnProximo.innerHTML = etapaAtual === totalEtapas ? 'Fechar' : 'Próximo';
};

// Copiar número
function copiarTexto(texto) {
  navigator.clipboard.writeText(texto).then(() => {
    alert("Copiado!");
  });
}

// Mostrar ou ocultar campo de endereço
document.querySelectorAll('input[name="delivery_option"]').forEach(radio => {
  radio.addEventListener('change', () => {
    const campo = document.getElementById('campoEndereco');
    campo.style.display = (radio.value === 'entrega') ? 'block' : 'none';
  });
});

btnProximo.addEventListener('click', async () => {
  if (etapaAtual === 2) {
    const opcao = document.querySelector('input[name="delivery_option"]:checked').value;
    const endereco = document.getElementById('endereco').value.trim();

    const form = document.getElementById('deliveryForm');
    const formData = new FormData(form);
    const jsonData = Object.fromEntries(formData.entries());

    jsonData.tipo = opcao;

    if (opcao === 'entrega' && endereco === '') {
      alert('Por favor, preencha sua localização antes de continuar.');
      return;
    }

    const url = (opcao === 'entrega') ? 'ajax_bank_payment.php' : 'ajax_bank_payment.php';

    // Animação de carregamento
    const textoOriginal = btnProximo.innerHTML;
    btnProximo.disabled = true;
    btnProximo.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Enviando...`;

    console.log('Enviando dados:', jsonData);

    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(jsonData)
      });

      if (!response.ok) throw new Error('Erro no servidor');

      data = await response.json();
      console.log(data);

      // Exibe alerta de sucesso
      swal.fire({
        icon: 'success',
        title: 'Pedido enviado',
        text: data.message
      });

      const mensagem = `Olá, segue em anexo o comprovativo de pagamento do meu pedido com o id:${data.paymentid}. Obrigado, ${data.name}!`;
      const whatsappurl = `https://api.whatsapp.com/send?phone=244927606472&text=${encodeURIComponent(mensagem)}`;
      document.getElementById('whatsappBtn').href = whatsappurl;
      etapaAtual++;
      bloquearRetorno = true; // impede voltar do step 3
      atualizarEtapa();

    } catch (error) {
      console.error('Erro ao enviar:', error);
      alert('Ocorreu um erro ao enviar. Tente novamente.');
    } finally {
      btnProximo.disabled = false;
      btnProximo.innerHTML = etapaAtual === totalEtapas ? 'Fechar' : 'Próximo';
    }

    return;
  }

  if (etapaAtual < totalEtapas) {
    etapaAtual++;
    atualizarEtapa();
  } else {
    const modal = bootstrap.Modal.getInstance(document.getElementById('bankModal'));
    modal.hide();

    // Aguarda um pequeno tempo para o modal desaparecer antes do redirecionamento
  setTimeout(() => {
    window.location.href = 'http://localhost/7sete/home'; // <-- Altere o caminho se necessário
  }, 300);
  }
});

btnAnterior.addEventListener('click', () => {
  if (etapaAtual === 3 && bloquearRetorno) return; // impede voltar para o step 2
  if (etapaAtual > 1) {
    etapaAtual--;
    atualizarEtapa();
  }
});

</script>




<!-- Modal money -->
<!-- Modal Moderno para Pagamento em Dinheiro/Express -->
<div class="modal fade" id="moneykModal" tabindex="-1" aria-labelledby="moneyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-0 bg-primary text-white rounded-top-4" style="background: linear-gradient(90deg, #000c78 60%, #3b3b98 100%);">
        <div class="d-flex align-items-center gap-2">
          <i class="fas fa-money-bill-wave fa-lg"></i>
          <h5 class="modal-title fw-bold mb-0" id="moneyModalLabel">Pagamento no Local ou Express</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body p-4">
        <form action="<?=ROOT?>payment/money/init.php" method="post" id="money-form">
          <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
              <i class="fas fa-truck fa-lg text-primary"></i>
              <span class="fw-semibold" style="font-size: 1.1rem;">Como deseja receber seu pedido?</span>
            </div>
            <div class="row g-2">
              <div class="col-12 col-md-6">
                <div class="form-check p-3 rounded-3 border border-primary-subtle bg-light h-100">
                  <input class="form-check-input" type="radio" name="tipo_entrega" value="endereco" id="optEndereco" checked onclick="toggleEnderecoMoney(true)">
                  <label class="form-check-label fw-semibold" for="optEndereco">
                    <i class="fas fa-home me-1 text-primary"></i> Entregar no meu endereço
                  </label>
                  <div class="small text-muted ms-4">Receba em casa, escritório ou outro local.</div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-check p-3 rounded-3 border border-success-subtle bg-light h-100">
                  <input class="form-check-input" type="radio" name="tipo_entrega" value="loja" id="optLoja" onclick="toggleEnderecoMoney(false)">
                  <label class="form-check-label fw-semibold" for="optLoja">
                    <i class="fas fa-store me-1 text-success"></i> Retirar na loja
                  </label>
                  <div class="small text-muted ms-4">Sem custo de envio. Retire pessoalmente.</div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4" id="campoEnderecoMoney">
            <label class="form-label fw-semibold" for="location_now_money">
              <i class="fas fa-map-marker-alt text-danger"></i> Onde deseja receber?
            </label>
            <textarea class="form-control rounded-3 shadow-sm" name="location_now" required id="location_now_money" rows="3"
              placeholder="Ex: Perto do mercado municipal, ao lado das bombas de combustível"></textarea>
            <div class="form-text text-muted mt-1">
              Seja o mais detalhado possível para facilitar a entrega.
            </div>
          </div>
          <input type="hidden" name="customer_province" value="Benguela" class="provincia">
          <input type="hidden" name="customer_municipio" value="" class="municipio">
          <input type="hidden" name="customer_bairro" value="" class="bairro">
          <input type="hidden" name="final_total" value="" class="final_total">
          <input type="hidden" name="final_total_custo" value="" class="final_total_custo">
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-lg px-4 d-flex align-items-center gap-2" name="form1">
              <i class="fas fa-paper-plane"></i> Enviar pedido
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function toggleEnderecoMoney(show) {
  document.getElementById('campoEnderecoMoney').style.display = show ? 'block' : 'none';
}
</script>
<style>
#moneykModal .modal-content {
  border-radius: 1.5rem;
  border: none;
}
#moneykModal .modal-header {
  border-bottom: none;
  padding-bottom: 1rem;
}
#moneykModal .modal-title {
  font-size: 1.25rem;
  letter-spacing: 0.01em;
}
#moneykModal .form-check-input:checked {
  background-color: #000c78;
  border-color: #000c78;
}
#moneykModal .form-check {
  cursor: pointer;
  transition: box-shadow 0.2s;
}
#moneykModal .form-check:hover {
  box-shadow: 0 0 0 2px #000c7833;
}
#moneykModal .btn-primary {
  background: linear-gradient(90deg, #000c78 60%, #3b3b98 100%);
  border: none;
  font-weight: 600;
  font-size: 1.1rem;
  border-radius: 0.75rem;
  box-shadow: 0 2px 8px #000c7822;
}
#moneykModal .btn-primary:hover {
  background: linear-gradient(90deg, #000a66 60%, #23235a 100%);
}
@media (max-width: 576px) {
  #moneykModal .modal-dialog {
    margin: 1rem;
  }
  #moneykModal .modal-content {
    border-radius: 1rem;
  }
}
</style>


<?php 
/*session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';*/
?>

<!--Esse script aqui e responsavel por buscar o custo de envio que foi salvo no lacalStorage
la no produtct.php e fazer o preenchimento da tabela de checkout com os seus respectivos valores
de total dos produtos e total+custo de envio caso tenha ou nao-->
<script src='assets/js/checkout.js?v=<?= time(); ?>'></script>
<script src="assets/js/custo_de_envio.js"></script>
<script>
document.getElementById('meuFormulario').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Aqui você pode fazer qualquer validação ou processamento (ex: enviar via AJAX)

    // Redireciona para outra página após o envio
    window.location.href = 'checkout'; // Altere para o link desejado
});
</script>
<script>

// Verifica inicialmente se está com valor 0
if (monitor.control === 0 && bairro == null) {
  ps.style.display = 'none';
  Swal.fire({
    icon: 'info',
    title: 'Localização de entrega',
    text: 'Altere a Localização de entrega para calcular o custo de envio'
  });
}
</script>

<?php include "loading.php"; ?>
<?php require_once('footer.php'); ?>
<?php require_once 'modal_success.php';  ?>


