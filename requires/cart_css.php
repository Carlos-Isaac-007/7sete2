<style>
    /* Estiliza a imagem do produto para que fique bem ajustada */
.cart-img {
    max-width: 50px; /* Limita o tamanho da imagem */
    height: auto;
    display: block;
}

/* Faz a tabela ficar responsiva */
.table-responsive {
    overflow-x: auto; /* Adiciona rolagem horizontal caso necessário */
    -webkit-overflow-scrolling: touch; /* Suaviza a rolagem no iOS */
}

/* Melhora a aparência em telas pequenas */
@media (max-width: 768px) {
    .cart-buttons {
        flex-direction: column;
        gap: 10px;
    }
    
    .cart-buttons div {
        width: 100%;
    }
}
/* estilo da tabela de compras ou sei la o que */ 
/* Estilos da Tabela */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
}

.cart-table th, .cart-table td {
    padding: 6px;
    text-align: center;
    border: 1px solid #ddd;
}

/* Imagem do Produto */
.cart-img {
    width: 35px;
    height: auto;
    border-radius: 5px;
}

/* Nome do Produto - Mais compacto */
.product-name {
    max-width: 80px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 13px;
}

/* Quantidade - Mais compacto */
.qty-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 2px;
}

/* Botões de Aumentar/Diminuir */
.qty-btn {
    background-color: #000c78;
    color: white;
    border: none;
    font-size: 12px;
    width: 22px;
    height: 22px;
    border-radius: 3px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.qty-btn:hover {
    background-color: #000c78;
}

/* Input de Quantidade */
.qty-input {
    width: 25px;
    text-align: center;
    font-size: 9px;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 0px;
    
}

/* Remove as setas do input number */
.no-arrows::-webkit-inner-spin-button,
.no-arrows::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.no-arrows {
    -moz-appearance: textfield;
}

/* Ícone de lixeira */
.trash i {
    font-size: 16px;
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

    .trash i {
        font-size: 18px;
    }
}



</style>