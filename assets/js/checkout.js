const ps = document.querySelector('#paymentSection');

// Criamos um objeto com a propriedade que queremos monitorar
let dados = {
  control: 0
};

// Criamos o proxy que "vigia" qualquer mudança no objeto
const monitor = new Proxy(dados, {
  set(obj, prop, value) {
    if (prop === 'control' && obj[prop] !== value) {
      console.log(`Valor alterado de ${obj[prop]} para ${value}`);
      
      ps.style.display = 'block'; // mostrar seção
    }

    // Atualiza o valor normalmente
    obj[prop] = value;
    return true;
  }
});

/*Esse script aqui e responsavel por buscar o custo de envio que foi salvo no lacalStorage
la no produtct.php e fazer o preenchimento da tabela de checkout com os seus respectivos valores
de total dos produtos e total mas custo de envio caso tenha ou nao*/
const bairroStr = localStorage.getItem('endereco.bairro');
const bairro = bairroStr ? JSON.parse(bairroStr) : null;  
const custoEnvioEl = document.getElementById('custoEnvio');
const th = document.querySelector('th[data-totalCart]');
const texto = th.dataset.totalcart;
const valorTotal = parseFloat(texto.replace(/\D/g, ''));
const thS = document.querySelector('#totalWithShipping')
const cp = true;
 let totalComEnvio;
{
  ;
  console.log(thS);
  let custo = bairro && !isNaN(parseFloat(bairro.custo)) ? parseFloat(bairro.custo) : null;

  function atualizarTotais(custoAtual) {
    if (isNaN(custoAtual) || custoAtual === null) {
      thS.textContent = valorTotal.toLocaleString('pt-AO', {
        style: 'currency',
        currency: 'AOA'
      });
      custoEnvioEl.textContent = 'A calcular...';
      totalComEnvio = valorTotal;
    } else {
      totalComEnvio = valorTotal + custoAtual;
      monitor.control = 1;
      console.log('custo atual: ', totalComEnvio);
      thS.textContent = totalComEnvio.toLocaleString('pt-AO', {
        style: 'currency',
        currency: 'AOA'
      });
      custoEnvioEl.textContent = `${custoAtual.toLocaleString('pt-AO', { minimumFractionDigits: 2 })} KZ`;
    }
  }

  if (custo !== null) {
    // Se já tem custo válido no localStorage
    atualizarTotais(custo);
    console.log('Custo de envio do localStorage:', custo);
  } else if (bairro && bairro.id) {
    // Se não tem custo válido, busca no backend
    fetch(`api/get_custo_envio.php?id_bairro=${bairro.id}`)
      .then(res => res.json())
      .then(data => {
        if (data.custo !== undefined && !isNaN(parseFloat(data.custo))) {
          custo = parseFloat(data.custo);

          // Atualiza o localStorage com o novo custo
          localStorage.setItem('endereco.bairro', JSON.stringify({
            ...bairro,
            custo: custo
          }));

          atualizarTotais(custo);
          console.log('Custo de envio carregado do backend:', custo);
        } else {
          atualizarTotais(null);
          console.warn('Custo inválido recebido do backend.');
        }
      })
      .catch(err => {
        console.error('Erro ao buscar o custo de envio:', err);
        atualizarTotais(null);
      });
  } else {
    // Nenhum bairro selecionado
    atualizarTotais(null);
    console.warn('Nenhum bairro encontrado no localStorage.');
  }
}
  
  

{
        //Reponsvel por marcar a opcao de receber/buscar
    function toggleEnderecoMoney(ativo) {
      const campo = document.getElementById('campoEnderecoMoney');
      console.log('Campo ', campo);
      const input = document.getElementById('location_now_money');
      if (ativo) {
        campo.classList.remove('d-none');
        input.required = true;
        input.value = '';
      } else {
        campo.classList.add('d-none');
        input.required = false;
        input.value = 'Retirada na loja Bosque';
      }
    }

  document.addEventListener('DOMContentLoaded', () => {
      if (document.getElementById('optLoja').checked) {
        toggleEnderecoMoney(false);
      }
  });

}  


{
  //aqui e adicionado nas variaveis do formulario os valores de localzacao para ser enviado em init
   // 1. Obter o dado bruto do localStorage
const municipioStr = localStorage.getItem('endereco.municipio');
// 2. Verificar se o dado existe
if (municipioStr && bairroStr) {
  // 3. Converter de string para objeto
  const municipioObj = JSON.parse(municipioStr);
  const bairroObj = JSON.parse(bairroStr);

  // 4. Atribuir o valor ao input hidden (se existir o campo)
  const valorMunicipio = municipioObj.nome;
  const valorBairro = bairroObj.nome;

const valorM = document.querySelectorAll('.municipio');
valorM.forEach(valorM => {
    valorM.value = valorMunicipio; // Altera o value
  });

const valorB = document.querySelectorAll('.bairro');
valorB.forEach(valorB => {
    valorB.value = valorBairro; // Altera o value
  });
} else {
  console.log('Nada encontrado no localStorage com a chave endereco.municipio');
}

//aqui e adicionado nas variaveis do formulario os valores total para ser enviado em init
const valorT = document.querySelectorAll('.final_total');
valorT.forEach(valorT => {
    valorT.value = valorTotal; // Altera o value
  });


const valorTC = document.querySelectorAll('.final_total_custo');
valorTC.forEach(valorTC => {
    valorTC.value = totalComEnvio; // Altera o value
  });
}