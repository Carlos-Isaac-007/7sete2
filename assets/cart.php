<?php require_once('header.php'); ?>
<!-- Google tag (gtag.js) event -->
<script>
  gtag('event', 'ads_conversion_Carrinho_de_compras_1', {
    // <event_parameters>
  });
</script>
<?php

require_once './requires/cart_css.php' 
?>


<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_cart; ?>)">
<div class="overlay"></div>
<div class="page-banner-inner">
<h1><?php echo LANG_VALUE_18; ?></h1>
</div>
</div>

<div class="page">
<div class="container">
<div class="row">
<div class="col-md-12">

<?php if(!isset($_SESSION['cart_p_id'])): ?>
<?php echo '<h2 class="text-center">O carrinho está vazio!!</h2></br>'; ?>
<?php echo '<h4 class="text-center">Adicione produtos ao carrinho para visualizá-lo aqui.</h4>'; ?>
<?php else: ?>
    <form action="" method="post" class="formmmmads">
    <?php $csrf->echoInputField(); ?>
    
    <div class="cart">
        <!-- Adicionando um wrapper responsivo -->


<div class="table-responsive">
    <table class="table cart-table">
        <thead>
            <tr>
                <th><?php echo LANG_VALUE_8; ?></th> <!-- Imagem -->
                <th class="product-name"><?php echo LANG_VALUE_47; ?></th> <!-- Nome do Produto -->
                <th><?php echo LANG_VALUE_55; ?></th> <!-- Quantidade -->
                <th class="text-right"><?php echo LANG_VALUE_82; ?></th> <!-- Preço Total -->
                <th class="text-center"><?php echo LANG_VALUE_83; ?></th> <!-- Ação -->
            </tr>
        </thead>
        <tbody>
            <?php
            $table_total_price = 0;
            $cart_items = [];

            if (!empty($_SESSION['cart_p_id'])) {
                foreach ($_SESSION['cart_p_id'] as $key => $value) {
                    $cart_items[] = [
                                 'id'            => $_SESSION['cart_p_id'][$key],
                            'size_id'       => $_SESSION['cart_size_id'][$key],
                            'size_name'     => $_SESSION['cart_size_name'][$key],
                            'color_id'      => $_SESSION['cart_color_id'][$key],
                            'color_name'    => $_SESSION['cart_color_name'][$key],
                            'quantity'      => $_SESSION['cart_p_qty'][$key],
                            'price'         => $_SESSION['cart_p_current_price'][$key],
                            'name'          => $_SESSION['cart_p_name'][$key],
                            'photo'         => $_SESSION['cart_p_featured_photo'][$key]
                    ];
                }
            }
            ?>

            <?php foreach ($cart_items as $item): ?>
                <?php
                $row_total_price = $item['price'] * $item['quantity'];
                $table_total_price += $row_total_price;
                ?>
                <tr>
                    <td>
                        <img src="<?= ROOT ?>assets/uploads/<?php echo htmlspecialchars($item['photo']); ?>" 
                             alt="Produto" class="cart-img">
                    </td>
                    <td class="product-name"><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>
                         <input type="hidden" name="product_id[]" value="<?php echo $item['id']; ?>">
                        <input type="hidden" name="product_name[]" value="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="qty-container">
                            <button class="qty-btn minus" data-id="<?php echo $item['id']; ?>">−</button>
                            <input type="number" class="qty-input no-arrows" step="1" min="1" 
                                   name="quantity[]" value="<?php echo $item['quantity']; ?>" 
                                   data-id="<?php echo $item['id']; ?>">
                            <button class="qty-btn plus" data-id="<?php echo $item['id']; ?>">+</button>
                        </div>
                    </td>
                    <td class="text-right" data-id="<?php echo $item['id']; ?>" data-price ="<?php echo   $row_total_price?>"><?php echo   $row_total_price . LANG_VALUE_1; ?></td>
                    <td class="text-center">
                       <a href="<?= ROOT ?>cart-item-delete?id=<?php echo $item['id']; ?>&size=<?php echo $item['size_id']; ?>&color=<?php echo $item['color_id']; ?>"
                       class="trash" onclick="confirmDelete(this, event)"><i class="fa fa-trash" style="color:red;"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>





       <!-- 📌 Resumo da compra -->
       <div class="col-12 mt-3">
              <div class="summary p-4 rounded">
                  <hr>
                  <div class="d-flex justify-content-between">
                      <p class="fs-5 fw-bold">Total:</p>
                      <p id="total" class="fs-5 fw-bold text-success"><?=$table_total_price?> KZ</p>
                  </div>
            <div><a href="<?= ROOT ?>checkout?v=<?= time(); ?>" class="btn btn-secondary rounded my-3" style="border-radius: 20px !important;"><?php echo LANG_VALUE_23; ?></a></div>
            <div><a href="<?= ROOT ?>home" class="btn-details"><?php echo LANG_VALUE_85; ?></a></div>
        

              </div>
        </div>

    </div>
</form>


<?php endif; ?>



</div>
</div>
</div>
</div>
<!-- Modal de carregamento -->
<?php include "loading.php"; ?>

<?php 
require_once('footer.php'); 
require_once 'requires/cart_js.php';
?>


