<style>
      /* Estiliza a imagem do produto para que fique bem ajustada */
/* Ajusta a imagem do produto dentro da tabela */
.cart-img {
    max-width: 50px;
    height: auto;
    display: block;
    margin: auto;
}

/* Faz a tabela ser rolável em telas pequenas */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

/* Melhora a legibilidade em telas pequenas */
@media (max-width: 768px) {
    .table th, .table td {
        font-size: 12px; /* Deixa o texto menor */
        white-space: nowrap; /* Evita quebra de linha */
    }

    .cart-buttons {
        flex-direction: column;
        gap: 10px;
    }

    .cart-buttons div {
        width: 100%;
    }
}

/* here everything can happen*/

/* Imagem do Produto */
.cart-img {
    width: 35px !important;
    height: auto !important;
    border-radius: 5px !important;
}

/* Nome do Produto - Mais compacto */
.product-name {
    max-width: 70px !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
    font-size: 13px !important;
}
/* Qunatidade do produto - Mais compacto */
.product-quantity{
    max-width: 40px !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
    font-size: 13px !important; 
}
/* Ajustes para telas maiores */
@media (min-width: 768px) {
    .cart-img {
        width: 50px;
    }

    .product-name {
        max-width: 130px;
        font-size: 15px;
    }

    .qty-btn {
        width: 26px;
        height: 26px;
        font-size: 14px;
    }

    .qty-input {
        width: 30px;
        font-size: 14px;
    }

   
}
/* tudo sobre modal */
/* Mobile First - Inicialmente ajustado para dispositivos móveis */
.modal-dialog {
    max-width: 90%;
}

.modal-content {
    border-radius: 8px;
    padding: 15px;
}

.modal-header {
    border-bottom: 1px solid #ddd;
    font-size: 1.2rem;
}

.modal-footer {
    border-top: 1px solid #ddd;
}

.modal-body p {
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Ajustes para telas maiores */
@media (min-width: 576px) {
    .modal-dialog {
        max-width: 500px;
    }
}

@media (min-width: 768px) {
    .modal-dialog {
        max-width: 600px;
    }
}

@media (min-width: 992px) {
    .modal-dialog {
        max-width: 700px;
    }
}

@media (min-width: 1200px) {
    .modal-dialog {
        max-width: 800px;
    }
}

/* Login container*/
       
        .login_container {
            background: #ffffff !important;
            padding: 20px !important;
            border-radius: 10px !important;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1) !important;
            text-align: center !important;
            width: 90%!important;
            max-width: 400px !important;
            margin: 0 auto !important;
            box-sizing: border-box !important;
            font-family: Arial, sans-serif !important;
           
                               }
        .login_container h2 {
            margin-bottom: 10px !important;
            color: #000c78 !important;
        }
        .login_container p {
            color: #606770 !important;
            margin-bottom: 20px !important;
            font-size: 16px !important;
        }
        .login_btn {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: #000c78 !important;
            color: white !important;
            padding: 10px !important;
            border: none !important;
            border-radius: 5px !important;
            cursor: pointer !important;
            width: 100% !important;
            font-size: 16px !important;
        }
        .login_btn i {
            margin-right: 10px !important;
        }
        .login_btn:hover {
            background: #165dc4 !important;
        }
        .cart_icon {
            font-size: 50px !important;
            color: #000c78 !important;
            margin-bottom: 15px !important;
        }
</style>