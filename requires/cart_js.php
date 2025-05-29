<script>
document.addEventListener("DOMContentLoaded", function () {
    const minusButtons = document.querySelectorAll(".qty-btn.minus");
    const plusButtons = document.querySelectorAll(".qty-btn.plus");

    minusButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const input = this.nextElementSibling;
            let currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateCart(input.dataset.id, input.value);
            }
        });
    });

    plusButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const input = this.previousElementSibling;
            let currentValue = parseInt(input.value);
            input.value = currentValue + 1;
            updateCart(input.dataset.id, input.value);
        });
    });

  function updateCart(productId, quantity) {
    const loader = document.getElementById("cart-loading");
    loader.style.display = "flex";

    fetch("<?= ROOT ?>updatecartAjax.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${productId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        console.log("Atualizado:", data);
        if (data.status === "success") {
            // Em vez de recarregar a página, atualize os valores desejados via JavaScript
            const td = document.querySelector(`td.text-right[data-id="${productId}"]`);

            if (td) {
                 td.textContent = `${data.price} KZ`;
                 td.setAttribute("data-price", data.price); // ATUALIZA O VALOR PARA updateCartTotal
            }

            // Aqui você pode atualizar o total geral também, somando todos os totais individuais
            updateCartTotal();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("Erro:", error);
        alert("Erro ao atualizar o carrinho.");
    })
    .finally(() => {
        loader.style.display = "none";
    });
}

function updateCartTotal() {
    let total = 0;
    document.querySelectorAll("[data-price]").forEach(el => {
        const valor = parseFloat(el.getAttribute("data-price"));
        if (!isNaN(valor)) {
            total += valor;
        }
    });
    console.log(total);
    document.getElementById("total").textContent = "Total: Kz " + total.toFixed(2);
}


});
</script>
