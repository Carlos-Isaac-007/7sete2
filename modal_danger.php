<style>
/* Modal de Erro (Danger) */
.modal-danger {
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

.modal-danger-content {
    background: #fff;
    color: #333;
    padding: 30px 25px;
    text-align: center;
    border-radius: 16px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    position: relative;
    animation: modal-danger-fadeIn 0.3s ease-in-out;
    font-family: 'Segoe UI', sans-serif;
    border-top: 5px solid #dc3545;
}

/* Ícone */
.modal-danger-icon {
    font-size: 38px;
    color: #dc3545;
    background: #fce4e7;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 15px auto;
}

/* Mensagem */
.modal-danger-message {
    font-size: 18px;
    font-weight: 600;
    color: #000c78;
    margin: 0;
}

/* Botão de Fechar */
.modal-danger-close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 22px;
    font-weight: bold;
    cursor: pointer;
    color: #aaa;
    transition: color 0.2s ease;
}

.modal-danger-close:hover {
    color: #000;
}

/* Animação específica */
@keyframes modal-danger-fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

/* Responsividade */
@media (min-width: 768px) {
    .modal-danger-content {
        width: 350px;
    }
}
</style>

<!-- Modal de Erro -->
<div id="dangerModal" class="modal-danger">
    <div class="modal-danger-content">
        <span class="modal-danger-close">&times;</span>
        <div class="modal-danger-icon">✖</div>
        <p class="modal-danger-message">Este produto já foi adicionado!</p>
    </div>
</div>
