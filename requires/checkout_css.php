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
/* ---------- Modal Responsivo e Moderno ---------- */

.modal-dialog {
  width: 100%;
  max-width: 90%;
  margin: 1.5rem auto;
  transition: all 0.3s ease-in-out;
}

.modal-content {
  border-radius: 16px;
  border: none;
  padding: 0;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
  background-color: #ffffff;
  overflow: hidden;
}

/* ---------- Cabeçalho ---------- */
.modal-header {
  background-color: #000c78;
  color: #fff;
  padding: 1.25rem 1.5rem;
  border-bottom: none;
}

.modal-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0;
}

/* ---------- Corpo ---------- */
.modal-body {
  padding: 2rem 1.5rem;
}

.modal-body p,
.modal-body label,
.modal-body h6 {
  font-size: 1.05rem;
  color: #333;
  line-height: 1.6;
}

.modal-body p strong {
  color: #000c78;
}

/* ---------- Rodapé ---------- */
.modal-footer {
  padding: 1.25rem 1.5rem;
  border-top: none;
  background-color: #f8f9fa;
  display: flex;
  justify-content: space-between;
  gap: 0.75rem;
  flex-wrap: wrap;
}

/* ---------- Responsividade por Breakpoint ---------- */
@media (min-width: 576px) {
  .modal-dialog {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .modal-dialog {
    max-width: 640px;
  }
}

@media (min-width: 992px) {
  .modal-dialog {
    max-width: 720px;
  }
}

@media (min-width: 1200px) {
  .modal-dialog {
    max-width: 800px;
  }
}

/* ---------- Melhorias Visuais Gerais ---------- */

.text-monospace {
  color: #000c78;
  font-weight: 500;
}

textarea.form-control {
  font-size: 1rem;
  line-height: 1.5;
  padding: 0.75rem;
  border-radius: 8px;
  border: 1px solid #ced4da;
}

/* Remove o foco azul feio do Bootstrap */
textarea:focus,
input:focus,
button:focus {
  box-shadow: none;
  outline: 2px solid #000c78;
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