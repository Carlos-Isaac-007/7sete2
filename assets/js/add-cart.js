    
    function updateCartBadge(qt) {
    const badge = document.getElementById('cart-badge');
    if (qt > 0) {
        badge.textContent = qt;
        badge.classList.remove('d-none');
    } else {
        badge.classList.add('d-none');
    }
    console.log("element após click: ", badge);
}

    function animateCart() {
        const cartIcon = document.getElementById('cart-icon');
        cartIcon.classList.add('pulse');
        setTimeout(() => {
            cartIcon.classList.remove('pulse');
        }, 500);
    }

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


    document.addEventListener('submit', async function(e) {
    if (e.target.matches('.add-cart')) {
        e.preventDefault();

        const form = e.target;
        const dados = new FormData(form);

        try {
            const resposta = await fetch(`${ROOT}ajax_add_to_cart.php`, {
                method: 'POST',
                body: dados
            });

            const texto = await resposta.text();
            console.log('Resposta bruta:', texto);

            if (texto) {
                const resultado = JSON.parse(texto);
                if (resultado.success) {
                    showSuccessModal(resultado.message);
                    updateCartBadge(resultado.qt);
                    animateCart();
                } else {
                    showDangerModal(resultado.message);
                }
                console.log(resultado);
            } else {
                console.warn('Resposta vazia do servidor');
            }

        } catch (erro) {
            console.error('Erro ao adicionar ao carrinho:', erro);
        }
    }
});

