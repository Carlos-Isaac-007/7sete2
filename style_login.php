<style>
.page-login i {
    font-size: 60pt; /* Ajuste para o tamanho desejado */
}

/* Estilização do banner */
.page-banner {
    text-align: center;
    color: #fff;
    background-size: cover;
    background-position: center;
}

.page-banner img {
    width: 83%;  /* Mantém a largura total */
    height: 310px; /* Define a altura fixa */
    object-fit: cover; /* Impede distorção e mantém a proporção */
}

/* Container do login */
.page-login {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: auto;
}

/* Estilização do formulário */
.user-content {
    background: #fff;
    border-radius: 10px;
    max-width: 100%;
    width: 100% !important;
    text-align: center;
    box-sizing: border-box;
    margin: 0 auto;
    margin-bottom: 30px;
}

/* Campos do formulário */
.user-content .form-group {
    margin-bottom: 20px;
    text-align: left;
}

.user-content label {
    font-weight: bold;
    font-size: 14px;
    color: #333;
}

.user-content input {
    width: 100% !important;
    padding: 10px;
    border-radius: 5px;
    transition: 0.3s;
}

.user-content input:focus {
    border-color: #007bff;
    box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
    outline: none;
}

/* Botões */
.user-content .btn {
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    transition: 0.3s;
}

.user-content .btn-success {
    background: #28a745;
    border: none;
}

.user-content .btn-success:hover {
    background: #218838;
}

.user-content .btn-info {
    background: #17a2b8;
    border: none;
}

.user-content .btn-info:hover {
    background: #138496;
}

/* Link de recuperação */
.user-content a {
    display: block;
    margin-top: 10px;
    font-size: 14px;
    text-decoration: none;
    transition: 0.3s;
}

.user-content a:hover {
    text-decoration: underline;
    color: #c82333;
}

/* Mensagens de erro e sucesso */
.error, .success {
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
}

.error {
    background: #f8d7da;
    color: #721c24;
}

.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Responsividade */
@media (max-width: 768px) {
    .page-banner img {
        height: auto; /* Reduz a altura em telas pequenas */
        width: 100%;
    }

    .page-login {
        padding: 10px;
    }
    
    .user-content {
        width: 90%;
        padding: 20px;
    }
}

</style>