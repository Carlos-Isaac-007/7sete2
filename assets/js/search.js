  // -----------------------------
  // Carrinho: Animação e contador
  // -----------------------------

$(document).ready(function () {
  const campos = [
    { input: "#InputPesquisarDesktop", resultado: "#resultadoBuscaDesktop" },
    { input: "#InputPesquisarMobile", resultado: "#resultadoBuscaMobile" }
  ];

  campos.forEach(({ input, resultado }) => {
    const $input = $(input);
    const $resultado = $(resultado);

    let debounceTimer;

    // Evento de digitação com debounce
    $input.on("keyup", function () {
      clearTimeout(debounceTimer);

      debounceTimer = setTimeout(() => {
        const termo = $(this).val().trim();
        console.log(termo);

        if (termo.length === 0) {
          $resultado.hide();
          return;
        }

        $.ajax({
          url: ROOT + "busca_ajax.php",
          method: "POST",
          data: { search_text: termo },
          dataType: "json",
          success: function (data) {
            let html = "<ul class='lista-resultados list-group'>";
            if (data.length > 0) {
              data.forEach(produto => {
                html += `
                  <li class="item-busca list-group-item">
                    <a href="${ROOT}search-result?search_text=${encodeURIComponent(produto.p_name)}"
                       class="text-decoration-none text-dark d-block">
                      ${produto.p_name}
                    </a>
                  </li>`;
              });
            } else {
              html += "<li class='item-busca list-group-item'>Nenhum produto encontrado</li>";
            }
            html += "</ul>";
            $resultado.html(html).fadeIn(100);
          },
          error: function (xhr, status, error) {
            console.error("Erro AJAX:", error);
            $resultado.hide();
          }
        });
      }, 300); // 300ms debounce
    });

    // Mostrar resultado ao focar no input (se tiver texto)
    $input.on("focus", function () {
      if ($(this).val().trim().length > 0) {
        $resultado.fadeIn(100);
      }
    });
  });

  // Esconde resultados ao clicar fora de qualquer campo
  $(document).on("click", function (e) {
    if (!$(e.target).closest(".custom-searchbar").length) {
      $("#resultadoBuscaDesktop, #resultadoBuscaMobile").fadeOut(100);
    }
  });

});
