<script>
    // codigo para abrir o modal succes 
    function showSuccessModal(message = "Produto adicionado com sucesso!") {
    const modal = document.getElementById("successModal");
    const messageText = modal.querySelector(".modal-message");
    const closeButton = modal.querySelector(".close-btn");

    messageText.textContent = message; // Atualiza a mensagem
    modal.style.display = "flex"; // Exibe o modal

    // Fecha ao clicar no botão X
    closeButton.onclick = function () {
        modal.style.display = "none";
    };

    // Fecha automaticamente após 3 segundos
    setTimeout(() => {
        modal.style.display = "none";
    }, 3000);
}

// Exemplo: chamando a função quando necessário

// codigo java script para chamar o modal danger de alerta
function showDangerModal(message = "Este produto já foi adicionado!") {
    const modal = document.getElementById("dangerModal");
    const messageText = modal.querySelector(".modal-danger-message");
    const closeButton = modal.querySelector(".modal-danger-close");

    messageText.textContent = message; // Atualiza a mensagem
    modal.style.display = "flex"; // Exibe o modal

    // Fecha ao clicar no botão X
    closeButton.onclick = function () {
        modal.style.display = "none";
    };

    // Fecha automaticamente após 3 segundos
    setTimeout(() => {
        modal.style.display = "none";
    }, 8000);
}

// Exemplo: chamando a função quando necessário
// showDangerModal("Produto sem estoque!");


// codigo do adicionar ao carrinho com AJx
$(document).ready(function() {
    $("#add_to_cart_form").submit(function(event) {
        event.preventDefault(); // Evita o recarregamento da página

        $.ajax({
            url: "<?=ROOT?>ajax_add_to_cart.php",
            type: "POST",
            data: $(this).serialize(), // Envia os dados do formulário
            dataType: "json",
            success: function(response) {
                if (response.success) {
                     // mostrando modal de teste
                       showSuccessModal(response.message)
                    $("#cart-message").html('<div style="color: green;">' + response.message + '</div>');
                    $("#cart-badge").html(response.qt)
                     
                } else {
                      //mostar modal danger 
                      showDangerModal(response.message)
                    $("#cart-message").html('<div style="color: red;">' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", xhr.responseText);
                $("#cart-message").html('<div style="color: red;">Erro ao adicionar ao carrinho.</div>');
            }
        });
    });
});

// codigo para aumentar a quantida de com js 

document.addEventListener("DOMContentLoaded", function () {
    const minusBtn = document.querySelector(".minus");
    const plusBtn = document.querySelector(".plus");
    const qtyInput = document.querySelector(".qty");

    minusBtn.addEventListener("click", function () {
        event.preventDefault(); // Evita o recarregamento da página
        let currentValue = parseInt(qtyInput.value);
        if (currentValue > 1) {
            qtyInput.value = currentValue - 1;
        }
    });

    plusBtn.addEventListener("click", function () {
        event.preventDefault(); // Evita o recarregamento da página
        let currentValue = parseInt(qtyInput.value);
        qtyInput.value = currentValue + 1;
    });
});


</script>