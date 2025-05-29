<?php require_once('header.php'); ?>
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
    <table class="table table-hover table-bordered">
        <tr>
            <th><?php echo LANG_VALUE_8; ?></th>
            <th  class="product-name"><?php echo LANG_VALUE_47; ?></th>
            <th class="product-quantity" ><?php echo LANG_VALUE_55; ?></th>
            <th><?php echo LANG_VALUE_159; ?></th>
            <th class="text-right"><?php echo LANG_VALUE_82; ?></th>
        </tr>

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
                    <img src="<?= ROOT ?>assets/uploads/<?php echo htmlspecialchars($item['photo']); ?>" alt="Produto" class="cart-img" >
                </td>
                <td class="product-name"><?php echo htmlspecialchars($item['name']); ?></td>
                <td class="product-quantity"><?php echo $item['quantity']; ?></td>
                <td ><?php echo $item['price'] . LANG_VALUE_1; ?></td>
                <td class="text-right" ><?php echo $row_total_price . LANG_VALUE_1; ?></td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <th colspan="4" class="total-text"><?php echo LANG_VALUE_81; ?></th>
            <th class="total-amount" data-totalCart="<?php echo $table_total_price . LANG_VALUE_1; ?>"><?php echo $table_total_price . LANG_VALUE_1; ?></th>
        </tr>

       

        <tr>
            <td colspan="4" class="total-text"><?php echo LANG_VALUE_84; ?></td>
            
            <td class="total-amount" id="custoEnvio"></td>
        </tr>
        <tr>
            <th colspan="4" class="total-text"><?php echo LANG_VALUE_82; ?></th>
            <th class="total-amount" id="totalWithShipping">Aqui vai aprecer o total</th>
        </tr>
    </table>
</div>

</div>

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
  <div class="shipping-select">
    <label for="municipioSelect">Município:</label>
    <select name="municipio" id="municipioSelect" class="form-select" style="width: 30%;">
      <option value="">-- Escolha uma opção --</option>
    </select>
  </div>

  <div class="shipping-select">
    <label for="bairroInput">Selecione o bairro/rua para calcular o custo de envio:</label>
    <input autocomplete="off" id="bairroInput" name="bairro" class="form-control awesomplete" placeholder="Digite ou selecione" disabled>
  </div>
  
  <style>
  #otherBairroContainer {
    display: none;
    margin-top: 12px;
    background-color: #f9f9f9;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    margin-left: -15px;
  }

  #otherBairroInput {
    flex: 1;
    padding: 10px 14px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  #otherBairroInput:focus {
    border-color: #000c78;
    box-shadow: 0 0 0 3px rgba(0, 12, 120, 0.15);
    outline: none;
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
  }

  #otherBairroSubmit:hover {
    background-color: #000a5e;
  }

  @media (max-width: 480px) {
    #otherBairroContainer {
      flex-direction: column;
      align-items: stretch;
    }

    #otherBairroSubmit {
      width: 100%;
    }
  }
</style>

<div id="otherBairroContainer">
  <input
    type="text"
    id="otherBairroInput"
    placeholder="Não achou? Digite aqui"
  />
  <button type="button" id="otherBairroSubmit">
    Enviar
  </button>
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

<div><a href="<?=ROOT?>cart" class="btn btn-secondary"><?php echo LANG_VALUE_21; ?></a></div>

</div>

<div class="clear"></div>
<h3 class="special"><?php echo LANG_VALUE_33; ?></h3>
<div class="row">

<div class="col-md-12">

<div class="row">

<div class="col-md-12 form-group" id="paymentSection">
<label for=""><?php echo LANG_VALUE_34; ?> *</label>

<div class="d-flex p-3 justify-content-between align-item-center">
<?php if($_SESSION['cart_p_name'][1] != "Alice de Almeida - Técnicas Infalíveis de Estudo, Memorização e Aprendizagem – Do Jeito que Funciona pra Você"): ?>   
<button type="button" class="btn-details" data-toggle="modal" data-target="#moneykModal" >Pagar em dinheiro</button>
<?php endif; ?>
<!-- Botão para abrir o Modal bank -->
<button type="button" class="btn-details" data-toggle="modal" data-target="#bankModal">
    Transferência Bancária
</button>
</div>

<!-- Div pagamento bancario -->
</div>


</div>
<?php endif; ?>

</div>



</div>
</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="bankModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bankModalLabel">Transferência Bancária</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <h6><strong>&lt;&lt;Dados para a Transferência&gt;&gt;</strong></h6>
        <p><strong>Banco:</strong> Banco de Poupança e Crédito (BPC)</p>
        <p><strong>Número de conta:</strong> <span>0455X01688011</span></p>
        <p><strong>IBAN:</strong> AO06001004550330168801152</p>
        <p><strong>Usuário:</strong> SETE7 TECNOLOGIA COMERCIO & SERVICO(SU) LDA</p>
        <br>
        <p><strong>Banco:</strong> Banco Angolano de Investimentos (BAI)</p>
        <p><strong>Número de conta:</strong> <span id="conta">245080097</span></p>
        <p><strong>IBAN:</strong> AO06004000007508009710153</p>
        <p><strong>Observação:</strong> Use o seu número de pedido como referência.</p>
        <h6>ID do Produto: <strong id="saida_idP"></strong> (Copie e mande junto com o comprovativo)</h6>

        <?php
        $pedido_enviado = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['BankBtnGo'])) {
            $pedido_enviado = true;
        }
        ?>

        <form action="#" method="post" id="bank-form_go" class="w-100 mt-3">

          <!-- Opção de entrega ou retirar -->
          <div class="form-group">
            <label><strong>Como deseja receber?</strong></label><br>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="delivery_option" id="option_entrega" value="entrega" checked onclick="toggleEndereco(true)">
              <label class="form-check-label" for="option_entrega">Entregar em minha localização</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="delivery_option" id="option_loja" value="loja" onclick="toggleEndereco(false)">
              <label class="form-check-label" for="option_loja">Vou buscar na loja</label>
            </div>
          </div>

          <!-- Campo de localização (visível apenas se for entrega) -->
          <div class="form-group" id="location_field">
            <label for="location_now">Diz-nos onde tu estás agora?</label>
            <textarea class="form-control" name="location_now" required id="location_now" rows="5"
              placeholder="Ex: Estou no mercado municipal ao lado das bombas de combustível."></textarea>
          </div>

            <input type="hidden" name="customer_province" value="Benguela" class="provincia">
            <input type="hidden" name="customer_municipio" value="" class="municipio">
            <input type="hidden" name="customer_bairro" value="" class="bairro">
            <input type="hidden" name="final_total" value="" class="final_total">
            <input type="hidden" name="final_total_custo" value="" class="final_total_custo">
            
          <!-- Botão de envio -->
          <div class="d-flex justify-content-start">
            <input type="submit" class="btn-details mb-3" value="Enviar pedido" name="BankBtnGo">
          </div>
        </form>

        <?php if ($pedido_enviado): ?>
          <p style="color: green; font-weight: bold;">Pedido enviado com sucesso!</p>
        <?php endif; ?>
      </div>

      <div class="modal-footer d-flex justify-content-between">
        <button id="copiarIBAN" class="btn btn-primary">Copiar IBAN</button>
        <button class="btn" style="background-color: #e67e22; color: white;" id="copiarConta">Copiar Conta</button>
        <a id="whatsappButton" href="#" target="_blank" class="btn btn-success d-flex align-items-center gap-2">
          <i class="fa fa-whatsapp"></i> Mandar Comprovativo
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Modal money -->
<div class="modal fade" id="moneykModal" tabindex="-1" role="dialog" aria-labelledby="moneyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="moneyModalLabel">Pagamento no local ou transferência via Express</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="<?=ROOT?>payment/money/init.php" method="post" id="money-form">

          <div class="form-group">
            <label class="form-label">Diga-nos onde pretende receber o produto:</label>

            <div class="radio-option">
              <input type="radio" name="tipo_entrega" value="endereco" id="optEndereco" checked onclick="toggleEnderecoMoney(true)">
              <label for="optEndereco">Entregar no meu endereço</label>
            </div>

            <div class="radio-option">
              <input type="radio" name="tipo_entrega" value="loja" id="optLoja" onclick="toggleEnderecoMoney(false)">
              <label for="optLoja">Levantar na loja(Sem Custo de Envio)</label>
            </div>
          </div>

          <div class="form-group" id="campoEndereco">
            <textarea class="form-control" name="location_now" required="" id="location_now_money" rows="3" placeholder="Ex: Perto do mercado municipal, ao lado das bombas de combustível"></textarea>
          </div>
            <input type="hidden" name="customer_province" value="Benguela" class="provincia">
            <input type="hidden" name="customer_municipio" value="" class="municipio">
            <input type="hidden" name="customer_bairro" value="" class="bairro">
            <input type="hidden" name="final_total" value="" class="final_total">
            <input type="hidden" name="final_total_custo" value="" class="final_total_custo">

          <div class="text-right">
            <input type="submit" class="btn-details" value="Enviar pedido" name="form1">
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

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


