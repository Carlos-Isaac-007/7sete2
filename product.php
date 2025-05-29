<?php require_once('header.php'); ?>
<style>
  body {
    background-color: #f8f9fa !important;
    color: #333 !important;
  }
  .tab-content{
    font-size: 10pt;
  }
  .nav-tabs{
    font-size: 10pt;
  }
  .breadcrumb ul {
    list-style: none !important;
    padding: 0 !important;
    display: flex !important;
    gap: 6px !important;
    flex-wrap: wrap !important;
    font-size: 14px !important;
  }

  .breadcrumb ul li {
    color: #6c757d !important;
  }

  .breadcrumb ul li a {
    color: #007bff !important;
    text-decoration: none !important;
  }

  .breadcrumb ul li a:hover {
    text-decoration: underline !important;
  }

  .product {
    background-color: #fff !important;
    padding: 30px !important;
    border-radius: 12px !important;
    box-shadow: 0 0 15px rgba(0,0,0,0.05) !important;
  }

  .p-title h2 {
    font-size: 28px !important;
    margin-bottom: 20px !important;
    color: #222 !important;
  }

  .p-short-des p {
    font-size: 18px !important;
    line-height: 1.6 !important;
    color: #555 !important;
  }

  .prod-slider, #prod-pager {
    display: flex !important;
    overflow-x: auto !important;
    gap: 12px !important;
  }

  .prod-slider li, .prod-pager-thumb {
    border-radius: 10px !important;
  }

  .prod-pager-thumb {
    width: 80px !important;
    height: 80px !important;
    border: 2px solid #ddd !important;
    border-radius: 6px !important;
    cursor: pointer !important;
  }

  .p-price {
    font-size: 24px !important;
    margin-top: 20px !important;
  }

  .current-price2 {
    font-size: 28px !important;
    font-weight: bold !important;
    color: #e55300 !important;
  }

  .qty-container {
    display: flex !important;
    gap: 8px !important;
    text-align: center !important;
  }

  .qty-btn {
    border: none !important;
    padding: 6px 12px !important;
    font-size: 18px !important;
    border-radius: 5px !important;
    cursor: pointer !important;
  }

  .qty-btn:hover {
    background-color: #ccc !important;
  }

  .input-text.qty {
    width: 60px !important;
    text-align: center !important;
    padding: 5px !important;
  }

  .btn-details2 {
    background-color: #000c78 !important;
    color: white;
    padding: 12px 24px !important;
    font-size: 16px !important;
    border: none !important;
    border-radius: 8px !important;
    transition: background-color 0.3s ease !important;
    margin-top: 15px !important;
  }

  .btn-details2:hover {
    background-color: #000a66 !important;
  }

  .etiqueta {
    margin-top: 10px !important;
    font-size: 15px !important;
    color: #444 !important;
    display: flex !important;
    gap: 8px !important;
    align-items: center !important;
  }

  .etiqueta .icon {
    color: #28a745 !important;
  }

  .form-control.select2 {
    max-width: 250px !important;
  }

  @media (max-width: 768px) {
    .prod-slider li {
      height: 250px !important;
    }

    .product {
      padding: 20px !important;
    }

    .p-title h2 {
      font-size: 22px !important;
    }

    .current-price {
      font-size: 20px !important;
    }

    .btn-details2 {
      width: 100% !important;
    }

    .prod-pager-thumb {
      width: 60px !important;
      height: 60px !important;
    }
  }
</style>

<!-- Google tag (gtag.js) event -->
<script>
  gtag('event', 'ads_conversion_Compra_1', {
    // <event_parameters>
  });
</script>

<?php
// funcao que vai convert os valor em kz de verdade
function formatarKZ($valor){
    $numero = preg_replace('/[^\d]/','',$valor);
    $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($numero, 'AOA');
}

?>
<?php 
require_once './requires/product_files.php';
?>


<div class="page">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb mb_30">
<ul>
<li><a href="<?php echo URL; ?>">Pagina Principal</a></li>
<li>></li>
<li><a href="<?php echo URL.'product-category?id='.$tcat_id.'&type=top-category' ?>"><?php echo $tcat_name; ?></a></li>
<li>></li>
<li><a href="<?php echo URL.'product-categoryid='.$mcat_id.'&type=mid-category' ?>"><?php echo $mcat_name; ?></a></li>
<li>></li>
<li><a href="<?php echo URL.'product-category?id='.$ecat_id.'&type=end-category' ?>"><?php echo $ecat_name; ?></a></li>
<li>></li>
<li><?php echo $p_name; ?></li>
</ul>
</div>

<?php if($temp_msg != ""):?>

<div class="alert alert-danger text-dark">
  <h5>
      <strong>Aviso!</strong><?=$temp_msg?>.
  </h5>

</div>

<?php endif; ?>


<div class="product">
<div class="row">
<div class="col-md-5">
<ul class="prod-slider">

<li style="background-image: url(assets/uploads/<?php echo $p_featured_photo; ?>);">
<a class="popup" href="assets/uploads/<?php echo $p_featured_photo; ?>"></a>
</li>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
?>
<li style="background-image: url(assets/uploads/product_photos/<?php echo $row['photo']; ?>);">
<a class="popup" href="assets/uploads/product_photos/<?php echo $row['photo']; ?>"></a>
</li>
<?php
}
?>
</ul>
<div id="prod-pager">
<a data-slide-index="0" href=""><div class="prod-pager-thumb" style="background-image: url(assets/uploads/<?php echo $p_featured_photo; ?>"></div></a>
<?php
$i=1;
$statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
?>
<a data-slide-index="<?php echo $i; ?>" href=""><div class="prod-pager-thumb" style="background-image: url(assets/uploads/product_photos/<?php echo $row['photo']; ?>"></div></a>
<?php
$i++;
}
?>
</div>
</div>
<div class="col-md-7">
<div class="p-title"><h2><?php echo $p_name; ?></h2></div>
<div class="p-review">


</div>
<div class="p-short-des">
<p>
<?php echo $p_short_description; ?>
</p>
</div>
<form id="add_to_cart_form" class="formm">
    <div class="p-quantity">
        <div class="row">
            <?php if(isset($size)): ?>
            <div class="col-md-12 mb_20">
                <?php echo LANG_VALUE_52; ?> <br>
                <select name="size_id" class="form-control select2" style="width:auto;">
                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_size");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        if(in_array($row['size_id'],$size)) {
                            ?>
                            <option value="<?php echo $row['size_id']; ?>"><?php echo $row['size_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <?php endif; ?>

            <?php if(isset($color)): ?>
            <div class="col-md-12">
                <?php echo LANG_VALUE_53; ?> <br>
                <select name="color_id" class="form-control select2" style="width:auto;">
                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_color");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        if(in_array($row['color_id'],$color)) {
                            ?>
                            <option value="<?php echo $row['color_id']; ?>"><?php echo $row['color_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <?php endif; ?>
        </div>
    </div>
<style>
  .product-pricing-card {
  border: 1.5px solid #e0e0e0;
  padding: 20px;
  border-radius: 12px;
  background-color: #fff;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  max-width: 100%;
  font-family: 'Segoe UI', sans-serif;
  color: #333;
  margin-bottom: 2rem;
}

.current-price2 del {
  color: #aaa;
  font-size: 1rem;
  margin-right: 8px;
}

.current-price2 strong {
  font-size: 24px;
}

.shipping-info {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  font-size: 18px;
  color: #444;
  gap: 10px;
}

.shipping-info i {
  font-size: 18px;
  color: #000c78;
}

.shipping-select {
  margin-top: 1rem;
}

.shipping-select label {
  font-weight: 600;
  font-size: 12px;
  margin-bottom: 0.5rem;
  display: block;
}

.shipping-select select {
  width: 100%;
  padding: 10px;
  border: 1.5px solid #ccc;
  border-radius: 6px;
  font-size: 1rem;
  background-color: #f9f9f9;
}

</style>
<div class="product-pricing-card">
  <div class="current-price2">
    <i class="fas fa-tag"></i>
    <?php if($p_old_price!=''): ?>
      <del><?php echo $p_old_price; ?> KZ</del>
    <?php endif; ?>
    <strong><?php echo $p_current_price; ?> KZ</strong>
  </div>

<?php  
  require_once './requires/product_css.php';
?>

<!-- Estrutura corrigida e dinâmica -->
<?php
$estimativa = calcularEstimativa();
?>
  <?php if(!strpos($final_ebook_name, '.pdf')): ?>
  <div class="shipping-info">
    <i class="fas fa-shipping-fast"></i>
    <span><?= $estimativa ?> <i class="fas fa-clock"></i></span>
  </div>
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

<div class="shipping-info">
  <i class="fas fa-hand-holding-dollar"></i>
  <span id="custoEnvio">0 <i class="fas fa-money-bill-wave"></i></span>
</div>

<div class="shipping-select">
  <label for="municipioSelect">Município:</label>
  <select name="municipio" id="municipioSelect" class="form-select">
    <option value="">-- Escolha uma opção --</option>
  </select>
</div>

<div class="shipping-select">
  <label for="bairroInput">Selecione o bairro/rua para calcular o custo de envio:</label>
  <input autocomplete="off" id="bairroInput" name="bairro" class="form-control awesomplete" placeholder="Digite ou selecione" disabled>
</div>


  <!-- container que só aparece se o usuário escolher "Outro bairro..." -->
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

  <?php endif; ?>
</div>


    <input type="hidden" name="p_current_price"value="<?php echo $p_current_price; ?>">
    <input type="hidden" name="p_name" value="<?php echo $p_name; ?>">
    <input type="hidden" name="p_featured_photo" value="<?php echo $p_featured_photo; ?>">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"> <!-- ID do produto vindo da URL -->


    <div class="p-quantity">
    <label><?php echo LANG_VALUE_55; ?></label>
    <div class="qty-container">
        <?php if(!strpos($final_ebook_name, '.pdf')): ?>
        <button class="qty-btn minus">−</button>
        <input type="number" class="input-text qty" step="1" min="1" name="p_qty" value="1">
        <button class="qty-btn plus">+</button>
        <?php endif; ?>
        <?php if(strpos($final_ebook_name, '.pdf')): ?>
        <input type="hidden" class="input-text qty" step="1" min="1" max="1" name="p_qty" value="1">
        <?php endif; ?>
    </div>
   </div>

   
    <?php if(!strpos($final_ebook_name, '.pdf')): ?>
    <div class="btn-cart btn-cart1">
        <button type="submit" id="Add_To_Cart" class="btn-details2"><?php echo LANG_VALUE_154; ?></button>
    </div>
    <?php endif; ?>
    
    <div class="btn-cart btn-cart1">
      <button type="button" class="btn-details2" onclick="pagarAgora()">Pagar Agora</button>
    </div>
    


    
        <!-- Estilo do botão -->
<style>
  .btn-read-ebook {
    background-color: #000c78;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background-color 0.3s ease;
  }

  .btn-read-ebook:hover {
    background-color: #000a66;
    text-decoration: none;
    color: white;
  }
 </style>
<?php

  if(strpos($final_ebook_name, '.pdf') !== false and $p_current_price < 1){
      echo'
  <div>
        <!-- Botão personalizado -->
        <div>
        <a href="#" class="btn btn-read-ebook" onclick="mostrarPDF()">📖 Ler</a>

<div id="leitura" style="display:none; margin-top:20px;">
  <a onclick="fecharPDF()" class="btn btn-secondary mb-2">❌Fechar Leitura</a>
    <iframe 
    src="https://docs.google.com/gview?url=https://7setetech.com/assets/uploads/ebooks/'.$final_ebook_name.'&embedded=true" 
    style="width:100%; height:600px;" 
    frameborder="0">
  </iframe>
</div>


        </div>
    </div>
    
    <div id="ebook-container" style="display:none; margin-top: 20px;">
        <iframe id="ebook-viewer" width="100%" height="600px" style="border: 1px solid #ccc;"></iframe>
    </div>
    ';}
?>
<script>
  function mostrarPDF() {
    document.getElementById('leitura').style.display = 'block';
  }

  function fecharPDF() {
    document.getElementById('leitura').style.display = 'none';
  }
</script>
<!-- Área para exibir mensagens -->
<div id="cart-message"></div>

<div class="share">
<?php echo LANG_VALUE_58; ?> <br>
<div class="sharethis-inline-share-buttons"></div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab"><?php echo LANG_VALUE_59; ?></a></li>
<li role="presentation"><a href="#feature" aria-controls="feature" role="tab" data-toggle="tab"><?php echo LANG_VALUE_60; ?></a></li>
<li role="presentation"><a href="#condition" aria-controls="condition" role="tab" data-toggle="tab"><?php echo LANG_VALUE_61; ?></a></li>
<li role="presentation"><a href="#return_policy" aria-controls="return_policy" role="tab" data-toggle="tab"><?php echo LANG_VALUE_62; ?></a></li>
<!-- <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab"><?php echo LANG_VALUE_63; ?></a></li> -->
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="description" style="margin-top: -30px;">
<p>
<?php
if($p_description == '') {
echo LANG_VALUE_70;
} else {
echo $p_description;
}
?>
</p>
</div>
<div role="tabpanel" class="tab-pane" id="feature" style="margin-top: -30px;">
<p>
<?php
if($p_feature == '') {
echo LANG_VALUE_71;
} else {
echo $p_feature;
}
?>
</p>
</div>
<div role="tabpanel" class="tab-pane" id="condition" style="margin-top: -30px;">
<p>
<?php
if($p_condition == '') {
echo LANG_VALUE_72;
} else {
echo $p_condition;
}
?>
</p>
</div>
<div role="tabpanel" class="tab-pane" id="return_policy" style="margin-top: -30px;">
<p>
<?php
if($p_return_policy == '') {
echo LANG_VALUE_73;
} else {
echo $p_return_policy;
}
?>
</p>
</div>
<div role="tabpanel" class="tab-pane" id="review" style="margin-top: -30px;">

<div class="review-form">
<?php
$statement = $pdo->prepare("SELECT * 
FROM tbl_rating t1 
JOIN tbl_customer t2 
ON t1.cust_id = t2.cust_id 
WHERE t1.p_id=?");
$statement->execute(array($_REQUEST['id']));
$total = $statement->rowCount();
?>
<h2><?php echo LANG_VALUE_63; ?> (<?php echo $total; ?>)</h2>
<?php
if($total) {
$j=0;
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
$j++;
?>
<div class="mb_10"><b><u><?php echo LANG_VALUE_64; ?> <?php echo $j; ?></u></b></div>
<table class="table table-bordered">
<tr>
<th style="width:170px;"><?php echo LANG_VALUE_75; ?></th>
<td><?php echo $row['cust_name']; ?></td>
</tr>
<tr>
<th><?php echo LANG_VALUE_76; ?></th>
<td><?php echo $row['comment']; ?></td>
</tr>
<tr>
<th><?php echo LANG_VALUE_78; ?></th>
<td>
<div class="rating">
<?php
for($i=1;$i<=5;$i++) {
?>
<?php if($i>$row['rating']): ?>
<i class="fa fa-star-o"></i>
<?php else: ?>
<i class="fa fa-star"></i>
<?php endif; ?>
<?php
}
?>
</div>
</td>
</tr>
</table>
<?php
}
} else {
echo LANG_VALUE_74;
}
?>

<h2><?php echo LANG_VALUE_65; ?></h2>
<?php
if($error_message != '') {
echo "<script>alert('".$error_message."')</script>";
}
if($success_message != '') {
echo "<script>alert('".$success_message."')</script>";
}
?>
<?php if(isset($_SESSION['customer'])): ?>

<?php
$statement = $pdo->prepare("SELECT * 
FROM tbl_rating
WHERE p_id=? AND cust_id=?");
$statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id']));
$total = $statement->rowCount();

$total = 0;
?>
<?php if($total==0): ?>
<form action="" method="post">
<div class="rating-section">
<input type="radio" name="rating" class="rating" value="1" checked>
<input type="radio" name="rating" class="rating" value="2" checked>
<input type="radio" name="rating" class="rating" value="3" checked>
<input type="radio" name="rating" class="rating" value="4" checked>
<input type="radio" name="rating" class="rating" value="5" checked>
</div>                                            
<div class="form-group">
<textarea name="comment" class="form-control" cols="30" rows="10" placeholder="Write your comment (optional)" style="height:100px;"></textarea>
</div>
<input type="submit" class="btn btn-default" name="form_review" value="<?php echo LANG_VALUE_67; ?>">
</form>
<?php else: ?>
<span style="color:red;"><?php echo LANG_VALUE_68; ?></span>
<?php endif; ?>


<?php else: ?>
<p class="error">
<?php echo LANG_VALUE_69; ?> <br>
<a href="login.php" style="color:red;text-decoration: underline;"><?php echo LANG_VALUE_9; ?></a>
</p>
<?php endif; ?>                         
</div>

</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</div>

<div class="product bg-gray pt_70 pb_70">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="headline">
<h2><?php echo LANG_VALUE_155; ?></h2>
<h3><?php echo LANG_VALUE_156; ?></h3>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">

<div class="produto-wrapper" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
  <div class="produto_container" id="product-carousel">
    <!-- aqui vão entrando os <div class="product-item"> via AJAX -->
  </div>
</div>
<div id="loading">Carregando…</div>

<script src="assets/js/custo_de_envio.js"></script>
<script>
let page = 0;
let loading = false;
const ecat_id    = "<?= $ecat_id ?>";
const exclude_id = "<?= $_REQUEST['id'] ?>";

function carregarMais() {
  if (loading) return;
  loading = true;

  fetch(`api/busca_produtos_relacionados.php?page=${page}&ecat_id=${ecat_id}&exclude_id=${exclude_id}`)
    .then(r => r.text())
    .then(html => {
      html = html.trim();
      if (!html) {
        document.getElementById('loading').innerText = 'Fim dos produtos.';
        return;
      }
      document
        .getElementById('product-carousel')
        .insertAdjacentHTML('beforeend', html);
      page++;
      loading = false;
    });
}

// dispara a primeira carga
carregarMais();

// scroll infinito
window.addEventListener('scroll', () => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
    carregarMais();
  }
});

</script>
<script>
    function pagarAgora() {
      // Obtenha os dados do formulário
      const form = document.getElementById('add_to_cart_form');
      const formData = new FormData(form);
    
      fetch("<?=ROOT?>ajax_add_to_cart.php", {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        // Você pode mostrar uma mensagem se quiser
        if (data.success) {
          // Redireciona para o checkout
          window.location.href = 'checkout.php';
        } else {
          alert("Erro ao adicionar ao carrinho.");
        }
      })
      .catch(error => {
        console.error("Erro:", error);
        alert("Erro na requisição.");
      });
    }
</script>
<?php require_once('footer.php'); ?>
<?php require_once 'modal_success.php';  ?>
<?php require_once 'modal_danger.php';  ?>
<?php require_once './requires/product_js.php' ?>
