<style>
    /* Estilo base para a etiqueta */
    .etiqueta {
        display: flex;
        width: auto;
        overflow: hidden;
        color: #fff;
        position: relative;
        margin-bottom: 10px;
        
    }
    
    .t1, .t2 {
        display: flex;
        align-items: center;
        padding: 3px 6px;
        white-space: nowrap; /* Mantém o conteúdo em uma única linha */
        
    }

    .t1 {
        background-color: rgba(120, 120, 120, 0.9);
        position: relative;
        z-index: 1; /* Mantém abaixo da t2 */
        font-size: 6pt !important;
    }

    .t2 {
        background-color: rgba(0, 12, 120, 0.9);
        position: relative;
        z-index: 2; /* Traz t2 para frente */
        box-shadow: -4px 0px 8px rgba(0, 0, 0, 0.3);
        font-size: 8pt !important;
    }

    /* Espaço entre texto e ícone */
    .t2 i {
        margin-left: 5px;
    }
    
       .p-quantity {
    text-align: start;
    font-family: Arial, sans-serif;
    margin-top: 10px;
}

.qty-container {
    display: flex;
    align-items: start;
    justify-content: start;
    gap: 5px;
    margin-top: 5px;
}

.qty-btn {
    background-color: #000c78;
    color: white;
    border: none;
    font-size: 18px;
    width: 30px;
    height: 30px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.qty-btn:hover {
    background-color: #0056b3;
}

.input-text.qty {
    width: 40x;
    text-align: center;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
}

/* Para telas maiores */
@media (min-width: 768px) {
    .qty-btn {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }
    .input-text.qty {
        width: 60px;
        font-size: 18px;
    }
}
    
</style>