let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

// Adiciona produto ao carrinho
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('add-to-cart')) {
    e.preventDefault();
    const id = e.target.dataset.id;
    const nome = e.target.dataset.nome;
    const preco = parseFloat(e.target.dataset.preco);
    
    const itemExistente = carrinho.find(p => p.id === id);
    if (itemExistente) {
      itemExistente.qtd += 1;
    } else {
      carrinho.push({ id, nome, preco, qtd: 1 });
    }

    atualizarCarrinho();
    mostrarMensagemProdutoAdicionado(); // Exibe a mensagem de produto adicionado
    salvarCarrinho();
  }
});

// Função para mostrar a mensagem "Produto Adicionado"
function mostrarMensagemProdutoAdicionado() {
  const mensagem = document.createElement('div');
  mensagem.classList.add('alert', 'alert-success', 'fixed-bottom', 'mb-3', 'd-flex', 'justify-content-center');
  mensagem.textContent = 'Produto adicionado ao carrinho!';
  document.body.appendChild(mensagem);

  setTimeout(() => {
    mensagem.remove();
  }, 3000); // Mensagem desaparece após 3 segundos
}

function atualizarCarrinho() {
  const lista = document.getElementById('cart-items');
  const total = document.getElementById('cart-total');
  lista.innerHTML = '';
  let soma = 0;

  carrinho.forEach((item, index) => {
    const subtotal = item.qtd * item.preco;
    soma += subtotal;

    lista.innerHTML += `
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div class="flex-grow-1">
          <strong>${item.nome}</strong><br>
          <div class="d-flex align-items-center gap-2 mt-1">
            <button class="btn btn-sm btn-outline-secondary" onclick="alterarQtd(${index}, -1)">-</button>
            <span>${item.qtd}</span>
            <button class="btn btn-sm btn-outline-secondary" onclick="alterarQtd(${index}, 1)">+</button>
          </div>
          <small>${subtotal.toFixed(2)} AKZ</small>
        </div>
        <button class="btn btn-sm btn-danger ms-2" onclick="removerItem(${index})">&times;</button>
      </li>`;
  });

  total.textContent = soma.toFixed(2);
  atualizarWhatsApp();
  document.getElementById('cart-count').textContent = carrinho.reduce((sum, p) => sum + p.qtd, 0);
}

function alterarQtd(index, delta) {
  if (!carrinho[index]) return;

  carrinho[index].qtd += delta;
  if (carrinho[index].qtd <= 0) {
    carrinho.splice(index, 1);
  }

  atualizarCarrinho();
  salvarCarrinho();
}

function removerItem(index) {
  carrinho.splice(index, 1);
  atualizarCarrinho();
  salvarCarrinho();
}

function salvarCarrinho() {
  localStorage.setItem('carrinho', JSON.stringify(carrinho));
}

function atualizarWhatsApp() {
  const btn = document.getElementById('checkout-btn');
  if (carrinho.length === 0) {
    btn.href = '#';
    return;
  }

  let mensagem = 'Olá! Gostaria de fazer o seguinte pedido:%0A';
  carrinho.forEach(item => {
    mensagem += `- ${item.nome} (x${item.qtd}) - ${(item.qtd * item.preco).toFixed(2)} AKZ%0A`;
  });

  let total = carrinho.reduce((acc, item) => acc + item.qtd * item.preco, 0);
  mensagem += `%0ATotal: ${total.toFixed(2)} AKZ`;

  const telefone = '244XXXXXXXX'; // Coloque o número com código do país
  btn.href = `https://wa.me/${telefone}?text=${mensagem}`;
}

// Inicializa o carrinho ao carregar a página
atualizarCarrinho();

// Abre o modal apenas quando o ícone do carrinho for clicado
document.getElementById('cart-icon').addEventListener('click', function() {
  new bootstrap.Modal(document.getElementById('cartModal')).show();
});
