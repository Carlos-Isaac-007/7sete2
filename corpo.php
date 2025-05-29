<?php
error_reporting(E_ALL); // Relata todos os tipos de erro
ini_set('display_errors', 1); // Exibe os erros na tela
?>

<?php require_once('heade.php') ?>

<body style="border: 1px solid black;">

<?php echo $after_body; ?>
<!--
<div id="preloader">
<div id="status"></div>
</div>-->

<!-- top bar -->

<header class="header_new" style="background-color: #d1d1e0;">
  <div class="container">
    <div class="container-header_new">
      <!-- Logo sempre à esquerda -->
    <div>
          <a href="https://7setetech.com/" class="logo">
        <img src="assets/uploads/<?php echo $logo; ?>">
      </a>
    </div>
      <?php
      // bacando a quantidade de produtos que o usuario adicionou
       $qt = 0;
       if(isset($_SESSION['cart_p_qty'])){
        $qt_check = $_SESSION['cart_p_qty'];
          foreach($qt_check as $row){
            $qt = $qt + 1;
          }
       }
       
       
      ?>
      
      <!-- Barra de Pesquisa (overlay) -->
     <div class="container">
      <div class="search-bar">
          
       <form class="search-box"  action="<?=ROOT?>search-result" method="get">


    <input type="text" class="campo-busca"  placeholder=" <?php echo LANG_VALUE_2; ?>" name="search_text" id="IputPesquisar" required="">
    
    
    <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
    
    </form>
    <div id="resultadoBusca"></div> <!-- Div para exibir os resultados -->
          </div>
        </div>
  
      
      <!-- Ícones: busca (toggle) e demais -->
      <div class="icons">
        <!-- <a href="#" id="search-toggle"><i class="fas fa-search btn-details"></i></a> -->
        <?php 
       
        ?>
        <?php if(isset($_SESSION['customer'])):?>
          <a href="<?=ROOT?>dashboard"><i class="fas fa-user btn-details"></i></a>
          <?php else:?>
            <a href="<?=ROOT?>login"><i class="fas fa-sign-in-alt btn-details"></i></a>
          <?php endif ;?>
        

        <a href="<?=ROOT?>cart" id="cart-icon">
          <i class="fas fa-shopping-cart btn-details"></i>
          <!-- Badge: inicialmente oculto -->
          <span id="cart-badge" class="badge "><?=$qt?></span>
        </a>
      </div>
    </div>
  </div>
  
</header>

<!-- Inicio da nova nav -->

<!--fim nave-->
<script>
    
    // quando o usuario pesquisar , faz uma pesquisa sem refresh
        $(document).ready(function() {
    $("#IputPesquisar").on("keyup", function() {
        let termo = $(this).val().trim();

            $.ajax({
              url: "<?=ROOT?>busca_ajax.php",
                method: "POST",
                data: { search_text: termo },
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(data) {
                    //console.log("Dados recebidos:", data); // Teste para ver se os dados chegam no AJAX

                    let html = "<ul class='lista-resultados'>"; // Adiciona uma classe para estilização
                    if (data.length > 0) {
                        data.forEach(produto => {
                            html += `<a href="<?=ROOT?>search-result?search_text=${produto.p_name}">
                              <li class="item-busca">${produto.p_name}</li>
                            <a/>`;
                        });
                    } else {
                        html += "<li class='item-busca'>Nenhum produto encontrado</li>";
                    }
                    html += "</ul>";

                    $("#resultadoBusca").html(html).show(); // Exibe os resultados
                },
                error: function(xhr, status, error) {
                    console.error("Erro AJAX:", status, error);
                }
            });
       
    });
});
    
  // Toggle da visibilidade da barra de pesquisa
  document.getElementById('search-toggle').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('.search-bar-overlay').classList.toggle('d-none');
  });

  // Variáveis do carrinho
  let cartCount = 0;

  // Atualiza o badge do carrinho
  function updateCartBadge() {
    const badge = document.getElementById('cart-badge');
    if (cartCount > 0) {
      badge.textContent = cartCount;
      badge.classList.remove('d-none');
    } else {
      badge.classList.add('d-none');
    }
  }

  // Animação de pulso no ícone do carrinho
  function animateCart() {
    const cartIcon = document.getElementById('cart-icon');
    cartIcon.classList.add('pulse');
    setTimeout(() => {
      cartIcon.classList.remove('pulse');
    }, 500);
  }

  // Evento para adicionar um produto
  document.getElementById('add-product').addEventListener('click', function() {
    cartCount++;
    updateCartBadge();
    animateCart();
  });
</script>

