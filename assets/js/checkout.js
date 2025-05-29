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
 //-------------------------
 //+++++++++++++++++++++++
/**esse script ja estava no codigo escrito pelo tyler posso voltar aqui para entender algumas coisas*/
//+++++++++++++++++++++++++
//------------------------
     // codigo para abrir o modal succes 
    function showSuccessModal(message = "Produto adicionado com sucesso!") {
    const modal = document.getElementById("successModal");
    const messageText = modal.querySelector(".modal-message");
    const closeButton = modal.querySelector(".close-btn");

    messageText.textContent = message; // Atualiza a mensagem
    modal.style.display = "flex"; // Exibe o modal

    // Fecha ao clicar no botão X
    closeButton.onclick = function () {
        modal.style.display = "none";
    };

    // Fecha automaticamente após 3 segundos
    setTimeout(() => {
        modal.style.display = "none";
    }, 30000);
}
    
  $(document).ready(function() {
    $("#bank-form_go").submit(function(event) {
        event.preventDefault(); // Evita o recarregamento da página
        //Mostra Loader
        const loader = document.getElementById("cart-loading");
        loader.style.display = "flex";
        $.ajax({
            url: "ajax_bank_payment.php",
            type: "POST",
            data: $(this).serialize(), // Envia os dados do formulário
            dataType: "json",
            success: function(response) {
              //esconder o loader
                loader.style.display = "none";
                if (response.success) {
                     showSuccessModal(response.message)
                     $("#saida_idP").html( response.paymentid)

                     //ocultar a div apos sucesso
                     $('#bank-form_go').hide();
                     
                } else {
                      //mostar modal danger 
                      showDangerModal(response.message)
                    $("#cart-message").html('<div style="color: red;">' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
               //ocultar a div apos sucesso
                loader.style.display = "none";

                console.error("Erro AJAX:", xhr.responseText);
                $("#cart-message").html('<div style="color: red;">Erro ao adicionar ao carrinho.</div>');
            }
        });
    });
});  
    
}

{
      // Copiar IBAN
  document.getElementById("copiarIBAN").addEventListener("click", function () {
    const iban = "AO06004000007508009710153"; // ou pegue dinamicamente
    navigator.clipboard.writeText(iban).then(() => {
      if (!/mobile|android|iphone|ipad|ipod/i.test(navigator.userAgent)) {
        alert("IBAN copiado para a área de transferência!");
      }
    });
  });

  // Copiar Conta
  document.getElementById("copiarConta").addEventListener("click", function () {
    const conta = document.getElementById("conta").innerText.trim();
    navigator.clipboard.writeText(conta).then(() => {
      if (!/mobile|android|iphone|ipad|ipod/i.test(navigator.userAgent)) {
        alert("Número da conta copiado!");
      }
    });
  });

  // Link WhatsApp
  document.addEventListener("DOMContentLoaded", function () {
    const whatsappNumber = "244927606472";
    const message = "Olá, estou enviando o comprovativo da compra.";
    document.getElementById("whatsappButton").href =
      `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
  });

  // Mostrar/ocultar campo localização com base na opção
  document.getElementById("option_entrega").addEventListener("change", toggleLocationField);
  document.getElementById("option_loja").addEventListener("change", toggleLocationField);

  function toggleLocationField() {
    const isEntrega = document.getElementById("option_entrega").checked;
    document.getElementById("location_field").style.display = isEntrega ? "block" : "none";
  }

  // Executa ao carregar a página
  //toggleLocationField();
}

{
      //Reponsvel por marcar a opcao de receber/buscar
   function toggleEnderecoMoney(ativo) {
    const campo = document.getElementById('campoEndereco');
    const input = document.getElementById('location_now_money');
    if (ativo) {
      campo.classList.remove('hidden');
      input.required = true;
      input.value = '';
    } else {
      campo.classList.add('hidden');
      input.required = false;
      input.value = 'Retirada na loja Bosque';
    }
  }

      //Reponsvel por marcar a opcao de receber/buscar
   function toggleEndereco(ativo) {

    const campoTransf = document.getElementById('option_entrega');
    const inputTransf = document.getElementById('location_now');
    if (ativo) {
      campoTransf.classList.remove('hidden');
      inputTransf.required = true;
      inputTransf.value = '';
    } else {
      campoTransf.classList.add('hidden');
      inputTransf.required = false;
      inputTransf.value = 'Retirada na loja Bosque';
    }
  }

 document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('optLoja').checked) {
      toggleEndereco(false);
    }
    
    if (document.getElementById('option_loja').checked) {
      toggleEndereco(false);
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