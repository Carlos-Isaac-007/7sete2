$(document).ready(function() {
  $("#IputPesquisar").on("keyup", function() {
    let termo = $(this).val().trim();
    if (termo.length === 0) {
      $("#resultadoBusca").hide();
      return;
    }
    $.ajax({
      url: "<?=ROOT?>busca_ajax.php",
      method: "POST",
      data: { search_text: termo },
      dataType: "json",
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      success: function(data) {
        let html = "<ul>";
        if (data.length > 0) {
          data.forEach(produto => {
            html += `<li class="item-busca"><a href="<?=ROOT?>search-result?search_text=${encodeURIComponent(produto.p_name)}" class="text-decoration-none text-dark d-block">${produto.p_name}</a></li>`;
          });
        } else {
          html += "<li class='item-busca'>Nenhum produto encontrado</li>";
        }
        html += "</ul>";
        $("#resultadoBusca").html(html).fadeIn(100);
      },
      error: function(xhr, status, error) {
        $("#resultadoBusca").hide();
      }
    });
  });

  // Esconde resultados ao clicar fora
  $(document).on('click', function(e) {
    if (!$(e.target).closest('.custom-searchbar').length) {
      $("#resultadoBusca").fadeOut(100);
    }
  });
  // Mostra resultados ao focar no input se houver texto
  $("#IputPesquisar").on('focus', function() {
    if ($(this).val().trim().length > 0) {
      $("#resultadoBusca").fadeIn(100);
    }
  });
});

{
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
}