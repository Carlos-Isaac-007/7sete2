<style>
/* Modal overlay */
.modalS {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Conteúdo do Modal */
.mc {
    background: #fff;
    color: #333;
    padding: 30px 25px;
    text-align: center;
    border-radius: 16px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
    font-family: 'Segoe UI', sans-serif;
}

/* Ícone */
.modal-icon {
    font-size: 40px;
    color: #000c78;
    background: #e5e8ff;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 15px auto;
}

/* Mensagem */
.modal-message {
    font-size: 18px;
    font-weight: 600;
    color: #000c78;
    margin: 0;
}

/* Botão de Fechar */
.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 22px;
    font-weight: bold;
    cursor: pointer;
    color: #999;
    transition: color 0.2s ease;
}

.close-btn:hover {
    color: #000;
}

/* Animação */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>


<!-- Modal de Sucesso -->
<div id="successModal" class="modalS">
    <div class="modal-content mc">
        <span class="close-btn">&times;</span>
        <div class="modal-icon">✔</div>
        <p class="modal-message">Produto adicionado com sucesso!</p>
        <a href="<?=ROOT?>cart" class="go-cart-btn">Ir para o carrinho</a>
    </div>
</div>
<style>
.go-cart-btn {
    display: inline-block;
    margin-top: 18px;
    padding: 12px 28px;
    background: linear-gradient(90deg, #000c78 0%, #3b4cca 100%);
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(59, 76, 202, 0.10);
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s, transform 0.1s;
}
.go-cart-btn:hover, .go-cart-btn:focus {
    background: linear-gradient(90deg, #3b4cca 0%, #000c78 100%);
    transform: translateY(-2px) scale(1.03);
    color: #fff;
    text-decoration: none;
}
</style>
