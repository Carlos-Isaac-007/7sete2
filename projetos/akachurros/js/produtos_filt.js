  const urlParams = new URLSearchParams(window.location.search);
    const categoriaInicial = urlParams.get('categoria');
    
    let todosProdutos = [];
    
    //carrega todos os produtos sem filtrar
    fetch('api/busca_produto.php')
    .then(response => response.json())
    .then(data =>{
        todosProdutos = data;
        renderizarProdutos(data);
        
        
        //Exibindo os produtos filtrados
        if (categoriaInicial){
            aplicarFiltro(categoriaInicial);
        }
    }).catch(error => console.error('erro ao carregar produtos:', error));
    
    //Funcao para renderizar os produtos no html
    function renderizarProdutos(produto){
        const container = document.getElementById('product-list');
        container.innerHTML = ''; //limpa antes de renderizarProdutos
        
        produto.forEach(produto => {
            const item = `
             <div class="col product-item ${produto.categoria}">
            <div class="product-card h-100">
              <img src="assets/img/${produto.img}" class="product-img" alt="${produto.nome}">
              <div class="p-3 d-flex flex-column">
                <h5 class="fw-bold">${produto.nome}</h5>
                <p class="small text-muted mb-2">${produto.descricao}</p>
                <p class="fw-bold text-primary mb-3">${produto.preco}</p>
                <a href="#"class="btn btn-aka mt-auto add-to-cart" data-id="${produto.id}"
                data-nome="${produto.nome}"data-preco="${produto.preco}">
                    Adicionar ao Carrinho
                </a>
              </div>
            </div>
      </div>`;
      container.innerHTML += item;
        });
    }
    
    //Funcao para aplicar o filtro visual
    function aplicarFiltro(filtro){
        document.querySelectorAll('.product-item').forEach(item => {
            item.style.display = (filtro === 'all' || item.classList.contains(filtro)) ? 'block' : 'none';
        });
    }
    
    //Botoes de filtro
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        // Remove a classe ativa de todos os botões
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active-filter'));
    
        // Adiciona a classe ativa ao botão clicado
        btn.classList.add('active-filter');
    
        // Aplica o filtro
        const filtro = btn.getAttribute('data-filter');
        aplicarFiltro(filtro);
      });
    });
    