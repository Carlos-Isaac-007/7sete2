<style>
.product-cat .col-md-2 {
  
  
}
.product-cat .col-md-2 {
    flex: 0 0 16%; /* ou 24%, dependendo da margem/padding */
    
   
    box-sizing: border-box;
}
    .product-cat .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: start; /* melhor para alinhamento natural */
    }

    .col-md-2 {
        padding: 10px;
        box-sizing: border-box;
        transition: transform 0.3s ease;
    }

    .card-produto {
        border: 1px solid #ddd;
        padding: 30px;
        border-radius: 12px;
        background-color: #fff;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .card-produto:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .card-produto > .produto-img {
        max-width: 100% !important;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .card-produto:hover img {
        transform: scale(1.1);
    }

    .produto-nome {
        font-size: 16px !important;
        font-weight: 600;
        margin: 10px 0;
        color: #333;
        transition: color 0.3s ease;
        
        display: -webkit-box;
        -webkit-line-clamp: 2;         /* Número de linhas visíveis */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        
        line-height: 1.2em;
        height: 2.4em; /* 1.2em x 2 linhas = 2.4em */
        
    }

    .card-produto:hover .produto-nome {
        color: #000c78;
    }

    .preco {
        font-size: 18px;
        font-weight: bold;
        color: #e55300;
        margin-bottom: 15px;
    }

    .brand-wrapper {
        min-height: 60px; /* Garantir espaço mínimo */
        max-height: 70px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0px;
        overflow: hidden; /* Prevenir que imagens maiores estourem */
        padding: 5px;
    }

    .brand-logo {
        height: 20px !important;
        object-fit: contain !important;
        display: block !important;
        margin: 0 auto !important;
    }

    .btn-primary {
        background-color: #000c78;
        border: none;
        color: #fff;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 25px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #085117;
    }

    /* Responsividade */
    @media (max-width: 1199px) {
        .col-md-2 {
            width: 30%; /* 3 por linha */
        }
    }

    @media (max-width: 767px) {
        .col-md-2 {
            width: 48%; /* 2 por linha */
            margin: 0 auto;
        }
        
        .produto-nome{
            font-size: 10px;
        }
        .preco{
            font-size: 14px;
        }
        .btn-primary{
            margin: 0 auto;
            font-size: 12px;
            padding: 4px 8px;
        }
        
        .brand-wrapper {
            margin: -20px 0 !important; /* reduz a margem vertical */
            padding: 2px !important;  /* reduz o padding interno */
        }

    .brand-logo {
        height: 20px !important; /* menor altura */
    }
    
    .preco {
        margin: 5px !important; /* reduz a margem abaixo do preço */
        font-size: 14px !important;    /* ajusta o tamanho da fonte se necessário */
    }
}
    
</style>
