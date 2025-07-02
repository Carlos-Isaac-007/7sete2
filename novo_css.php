<style>
.btn-secondary {
  width: 100%;
  margin-top: 0.8rem;
  padding: 0.75rem;
  background-color: #e55300 !important;
  color: #fff;
  font-weight: 500;
  padding: 8px 12px !important;
  border-radius: 25px !important;
  transition: background-color 0.3s;
  cursor: pointer;
  font-size: 16px !important;
  border-color: #e68a00 !important;
}

.btn-secondary:hover {
  background-color:#e68a00 !important;
}
/* brand config */

/* tudo na tela home usa esse style */

/* Wrapper para centralizar tudo */
.produto_container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    justify-content: center;
    align-items: stretch;
    width: 100%;
    margin: 0 auto;
}

@media (min-width: 768px) {
    .produto_container {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 1024px) {
    .produto_container {
        grid-template-columns: repeat(5, 1fr);
    }
}

.product-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: center;
    min-height: 100%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.product-item img {
    width: 100%;
    max-width: 120px;
    height: 120px;
    border-radius: 5px;
    object-fit: contain;
}

.product-desc {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    
}
.product-desc h5{
    display: -webkit-box;
    -webkit-line-clamp: 2;         /* Número de linhas visíveis */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.2em;
    height: 2.4em; /* 1.2em x 2 linhas = 2.4em */
}

/* Preço */
.price {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 5px;
}

.current-price {
    font-size: 20px;
    font-weight: bold;
    color: #e55300 !important;
}

.old-price {
    font-size: 12px;
    color: red;
}

/* Marca (logo + nome em linha) */
.brand {
    display: flex;
    align-items: center;
    justify-content: center; /* Centraliza na horizontal */
    margin-top: auto;
}

.brand-logo {
    width: 50% !important;   /* Garante que a imagem ocupe 100% da largura definida no HTML */
    height: 50% !important;
    object-fit: cover;        /* Mantém a proporção da imagem, cortando as partes extras */
    border-radius: 5px;
}


/* Botão */
.btn-container {
    margin-top: auto;
    padding-top: 10px;
}



/* tudo que haver com a estetica da seccao categorias*/

/* Estilo do botão Detalhes */
.btn-details {
    display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        background: #000c78 !important; /* Azul cor da empresa */
        color: #fff !important;
        padding: 8px 12px !important;
        border-radius: 25px !important;
        transition: background 0.3s ease-in-out !important;
        border: none !important;
        box-shadow: 0 3px 6px rgba(0, 12, 120, 0.2); ; /* Destaque inicial */
        font-size: 16px !important;
}

.btn-details i {
    margin-right: 5px !important; /* Espaço entre o ícone e o texto */
}

.btn-details:hover {
    background: #155db2 !important; /* Tom mais escuro no hover */
}

/* Estilo geral da área de categorias */
.product-cat {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 10px !important;
    justify-content: center !important;
}

/* Estiliza cada item de categoria */
.item-product-cat {
    background: #fff !important;
    border-radius: 10px !important;
    overflow: hidden !important;
    transition: transform 0.3s ease-in-out !important;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1) !important;
}

.item-product-cat:hover {
    transform: translateY(-5px) !important;
}

/* Estiliza a imagem */
.item-product-cat .thumb {
    position: relative !important;
    width: 100% !important;
    height: 200px !important;
    background-size: cover !important;
    background-position: center !important;
    object-fit: contain !important;
}

/* Sobreposição escura para efeito */
.item-product-cat .overlay {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    background: rgba(0, 0, 0, 0.3) !important;
}

/* Texto do produto */
.item-product-cat .text {
    padding: 15px !important;
    text-align: center !important;
}

.text a{
    text-decoration: none;
}
.text h3 a:hover{
    color: #155db2 !important;
}

.item-product-cat h3 {
    font-size: 16px !important;
    font-weight: bold !important;
    color: #333 !important;
    margin-bottom: 5px !important;
}

.item-product-cat h4 {
    font-size: 14px !important;
    color: #666 !important;
}

/* Estilo do botão */
.item-product-cat p a {
    display: block !important;
    text-decoration: none !important;
    background: #000c78 !important; /* Azul do Facebook */
    color: #fff !important;
    padding: 8px !important;
    border-radius: 5px !important;
    transition: background 0.3s !important;
}

.item-product-cat p a:hover {
    background: #155db2 !important;
}

/* Layout Responsivo */

/* Em telas pequenas, dois produtos por linha */
@media (max-width: 768px) {
    .item-product-cat {
        width: 48% !important; /* Para caber dois produtos lado a lado */
    }
    .btn-warning {
              width: 30px !important;
              height: auto !important;
        }
        .btn-sm{
            font-size: 9pt !important;
        }
    
}

/* Em telas médias e grandes, três produtos por linha */
@media (min-width: 769px) {
    .item-product-cat {
        width: 30% !important;
    }
}

/*--------- termina aqui--------------------------*/

.product-item img{
    transition: transform 0.3s ease-in-out;
}
 .product-item:hover{
        transform: translateY(-10px);
       box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      }
   .product-item:hover img {
           transform: scale(1.2);
       }
.primary-color{
    background-color: #000c78;
}
/**-----------------------------------------------------------------------------------*/
.nav{
   background-color: #fff !important;
}

body {
    padding-top: 5px; /* Deve ser maior ou igual à altura do header */
}

.product-item {
    flex: 0 0 calc(50% - 5px) !important; /* Ajuste melhor o espaçamento */
}
@media (min-width: 900px) {
    .produto {
        width: 28%;
    }
}

/*-----------------------------------------------------------------------------------------*/
/* Ajuste do tamanho das imagens dos produtos */


        .carousel-container {
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }
        .carousel-container {
            scrollbar-width: none !important;         /* Firefox */
            -ms-overflow-style: none !important;      /* IE 10+ */
        }

        .carousel-container::-webkit-scrollbar {
            display: none !important;                 /* Chrome, Safari, Opera */
        }

        .product-item {
            flex: 0 0 20% !important; /* Mostra 3 produtos por vez */
            scroll-snap-align: start !important;
            border: 1px solid #ddd !important;
            border-radius: 5px !important;
            text-align: center !important;
            background: #fff !important;
            padding: 10px !important;
            transition: transform 0.3s ease !important;
        }

        .product-item img {
            width: 80px; /* Imagem menor no mobile */
            height: 80px;
            border-radius: 5px;
        }
        .product-item h5 a{
            text-decoration: none !important;
            color: gray !important;
        }
        .product-item p{
            font-weight: bold !important;
        }

        .product-desc h5 {
            font-size: 16px !important; /* Nome do produto menor */
            margin-top: 5px !important;
        }

        .product-desc p {
            font-size: 10px; /* Preço menor */
            margin-bottom: 5px;
        }

        .btn-warning {
            font-size: 10px !important; /* Botão menor */
            padding: 2px 3px !important;
            background-color: #000c78 !important;
            color: white !important;
            border-color: #000c78;
            border-color: rgb(50, 67, 218) !important
        }

  

        .prev-btn {
            left: 0;
        }

        .next-btn {
            right: 0;
        }
       

        /* Esconder os botões em telas pequenas */
        @media only screen and (max-width: 600px) {
            
             .product-item {
            flex: 0 0 47% !important; /* Mostra 2 produtos por vez */
            scroll-snap-align: start !important;
            border: 1px solid #ddd !important;
            border-radius: 10px !important;
            text-align: center !important;
            background: #fff !important;
            padding: 8px !important;
            transition: transform 0.3s ease !important;
            }
            
          
            
            .headline h2{
                font-size: 16pt !important;
            }
            .headline h3{
                font-size: 9pt !important;
            }
              .btn-warning {
              width: 40px !important;
              height: auto !important;
        }
        .btn-container a{
            font-size: 9pt !important;
        }
        
        }

        /* Ajustes para telas maiores */
        @media (min-width: 600px) {
            .product-item img {
                width: 100px;
            }

            .product-desc h5 {
                font-size: 14px;
            }

            .product-desc p {
                font-size: 12px;
            }

            .btn-warning {
                font-size: 12px !important;
                padding: 6px 10px !important;
                background-color: #000c78 !important;
                color: white !important;
                border-color: rgb(50, 67, 218) !important
            }
        }

        @media (min-width: 900px) {
            .product-item img {
                width: 120px;
            }

            .product-desc h5 {
                font-size: 16px;
            }

            .product-desc p {
                font-size: 14px;
            }

            .btn-warning {
                font-size: 14px !important;
                padding: 8px 12px !important;
                background-color: #000c78 !important;
                color: white !important;
                border-color: rgb(50, 67, 218) !important;
            }
        }

/* Ajusta a altura do carrossel */
/* Faz a imagem ocupar 100% da largura e mantém uma altura fixa */
        .carousel-item img {
            width: 100%;
            height: auto; /* Altura fixa */
            object-fit: contain; /* Evita distorção */
        }

        
  .loading {
            text-align: center;
            display: none;
        }
       
/* Tudo sobre produto com AJAX */



/* Container principal dos produtos */
/* Container principal dos produtos */
#product-list {
    display: flex;
    flex-direction: column;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    gap: 10px;
    scroll-behavior: smooth;
}
#product-list {
  scrollbar-width: none !important;         /* Firefox */
  -ms-overflow-style: none !important;      /* IE 10+ */
}

#product-list::-webkit-scrollbar {
  display: none !important;                 /* Chrome, Safari, Opera */
}

.produto {

    margin-bottom: 1rem;

}


.produto h4{
    font-weight: bold;
    font-size: 1opt;
}

.produto h3 {
    font-size: 12px;
    color: gray;
}

.produto p {
    font-size: 14px;
    color: #ff5733;
    font-weight: bold;
}

/* Efeito hover no desktop */
@media (hover: hover) {
    .produto:hover {
        transform: scale(1.05);
    }
}

/* Ajuste para tablets (3 produtos por linha) */
@media (min-width: 768px) {
    .produto {
        width: 32%;
    }
}

/* Ajuste para desktops (4 produtos por linha) */
@media (min-width: 1024px) {
    .produto {
        width: 24%;
    }
}

/* barra de pesquisa e menu categorias estilos*/
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
    .carousel{
            margin: 0 auto;
            -border: 1px solid black;
            width: 85%;
        }
     .carousel-item img {
            width: 100%;
            height: auto; /* Altura fixa */
            object-fit: contain; /* Evita distorção */
        }
    .carousel-inner{
        border-radios: 18px
    }
    .carousel-item img {
        border-radius: 18px;
    }
    .carousel-caption{
        border-radius: 18px;
        }
    .changeCart{
        font-size:  2.5rem;
    } 
}

/* tudo sobre o novo header*/

 
    /* Badge no ícone do carrinho */
    .badge {
      background: #ff6b01 !important;
      color: #fff !important;
      font-size: 12px !important;
      padding: 2px 6px !important;
      border-radius: 50% !important;
      position: absolute !important;
      top: -5px !important;
      right: -10px !important;
      border: 1px solid #fff;
    }
    /* Efeito de pulso no ícone do carrinho */
    .pulse {
      animation: pulse-animation 0.5s ease-in-out;
    }
    @keyframes pulse-animation {
      0% { transform: scale(1); }
      50% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }
   
    /* tudo que tem haver com aquela barra de pesquisa que so aparece quando o usuario comeca a digitar*/
 #resultadoBusca {
    display: block !important;
    background: white;
    border: 1px solid #ddd;
    position: absolute;
    width: 100%;
    max-width: 300px;
    z-index: 999;
}
.lista-resultados {
    list-style: none;
    padding: 0;
}
.lista-resultados a{
    text-decoration: none !important;
    color: gray !important;
    font-size: 8pt !important;
}
.item-busca {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    cursor: pointer;
}
.item-busca:hover {
    background: #f5f5f5;
}

</style>
