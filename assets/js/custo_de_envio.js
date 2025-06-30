  let bairroNaoEncontradoExibido = false;

  function carregarBairros(municipioId) {
  const input = document.getElementById('bairroInput');
  const ce = document.getElementById('custoEnvio');

  input.value = '';
  //ce.textContent = '';
  resetOtherBairro();
  input.disabled = !municipioId;

  if (!municipioId) return;

  fetch(`api/busca_bairros.php?provincia_id=2&municipio_id=${municipioId}`)
    .then(r => r.json())
    .then(bairros => {
      window.bairrosDisponiveis = bairros;
          // Limpa Awesomplete anterior
    if (input.awesomplete) {
      input.awesomplete.list = []; // limpa a lista anterior
    }
      // Cria nova instância ou atualiza
    const aw = new Awesomplete(input, {
      list: bairros.map(b => b.nome_bairro),
      minChars: 1,
      autoFirst: true
    });
    input.awesomplete = aw;

          // Solução para garantir busca do custo após seleção:
    input.addEventListener('awesomplete-selectcomplete', function() {
    input.dispatchEvent(new Event('input'));
    });

      const bairroSalvo = JSON.parse(localStorage.getItem('endereco.bairro'));
      if (bairroSalvo && bairroSalvo.id) {
        //document.getElementById('bairroInput').value = bairroSalvo.nome;
        input.dispatchEvent(new Event('input'));
      }
    })
    .catch(err => console.error('Erro bairros:', err));
}

  // Função auxiliar: limpa e esconde o container de "Outro bairro"
  function resetOtherBairro() {
    document.getElementById('otherBairroContainer').style.display = 'none';
    document.getElementById('otherBairroInput').value = '';
  }

  // 1) Carregar municípios (igual antes)
  fetch('api/busca_municipios.php?provincia_id=2')
    .then(r => r.json())
    .then(munList => {
      const ms = document.getElementById('municipioSelect');
      const municipioSalvo = JSON.parse(localStorage.getItem('endereco.municipio'));
      munList.forEach(m => {
        const opt = document.createElement('option');
        opt.value = m.municipio_id;
        opt.textContent = m.nome;
        if (municipioSalvo && Number(municipioSalvo.id) === Number(m.municipio_id)){
          opt.selected = true;
        }
        ms.appendChild(opt);
      });
      // Se havia município salvo, forçar o disparo do evento para carregar os bairros
    if (municipioSalvo) {
      document.getElementById('municipioSelect').dispatchEvent(new Event('change'));
    }
    })
    .catch(err => console.error('Erro municípios:', err));

  // 2) Ao mudar município, recarregar bairros e resetar tudo
  document.getElementById('municipioSelect').addEventListener('change', function() {
    const municipioId = this.value;
    const input = document.getElementById('bairroInput');
    const ce = document.getElementById('custoEnvio');
    const municipioNome = this.options[this.selectedIndex].text;
    localStorage.setItem('endereco.municipio', JSON.stringify({
    id: municipioId,
    nome: municipioNome
    }));
    
   carregarBairros(municipioId);
  });

  // 3) Ao digitar/selecionar o bairro
document.getElementById('bairroInput').addEventListener('input', function () {
  const nomeDigitado = this.value.trim();
  const ce = document.getElementById('custoEnvio');

  if (!nomeDigitado) {
    resetOtherBairro();
    bairroNaoEncontradoExibido = false; // Resetar controle
    return;
  }

  function normalizar(str) {
    return str.trim().normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
  }

  const nomeNormalizado = normalizar(nomeDigitado);

  const bairroExato = (window.bairrosDisponiveis || []).find(b => normalizar(b.nome_bairro) === nomeNormalizado);
  const correspondenciaParcial = (window.bairrosDisponiveis || []).some(b => normalizar(b.nome_bairro).includes(nomeNormalizado));

  if (bairroExato) {
    resetOtherBairro();
    bairroNaoEncontradoExibido = false; // Resetar controle
    fetch(`api/get_custo_envio.php?id_bairro=${bairroExato.bairro_id}`)
      .then(r => r.json())
      .then(data => {
        if (data.custo !== undefined) {
          if (typeof cp !== "undefined") {
            atualizarTotais(parseFloat(data.custo));
          } else {
            ce.textContent = 'Custo de envio: ' + data.custo + ' KZ';
          }
        } else if (data.erro) {
          ce.textContent = 'Erro: ' + (data.erro === 'Custo de envio não encontrado.' ? 'Entraremos em contacto para informar o custo de envio. Pode proceguir com a compra.' : data.erro);
          if (typeof cp !== "undefined") {
            atualizarTotais(NaN);
          }
        } else {
          ce.textContent = 'Custo de envio indisponível.';
        }

        localStorage.setItem('endereco.bairro', JSON.stringify({
          id: bairroExato.bairro_id,
          nome: bairroExato.nome_bairro,
          custo: data.custo
        }));
      })
      .catch(() => {
        ce.textContent = 'Erro ao buscar o custo.';
      });
  } else if (!correspondenciaParcial) {
    // Só mostra o alerta se ainda não mostramos
    if (!bairroNaoEncontradoExibido) {
      // Atualiza valor de outro campo ANTES de mostrar o modal
      const otherInput = document.getElementById('otherBairroInput');
      otherInput.value = nomeDigitado;
      otherInput.dataset.original = nomeDigitado; // guarda a versão original (opcional para comparação futura)

      document.getElementById('otherBairroContainer').style.display = 'block';


      Swal.fire({
        icon: 'info',
        title: 'Bairro não encontrado',
        text: 'Não encontramos este bairro. Clique em "Enviar" para calcular o Custo de Envio.',
        confirmButtonText: 'Entendi'
      }).then(() => {
    // 🔽 Foca no campo após o alerta ser fechado
        setTimeout(() => {
          otherInput.focus();
        }, 100);
      });

      if (typeof cp !== "undefined") {
        atualizarTotais(NaN);
      } else {
        ce.textContent = 'Entraremos em contacto para informar o custo de envio. Pode proceguir com a compra.';
      }

      bairroNaoEncontradoExibido = true; // Marca como exibido
    }
  } else {
    resetOtherBairro();
    bairroNaoEncontradoExibido = false; // Resetar controle se encontrar algo parcialmente
  }
});


  // 4) Quando o usuário digitar e clicar em “Enviar” para adicionar novo bairro
document.getElementById('otherBairroSubmit').addEventListener('click', async function(event) {
  event.preventDefault();
  event.stopPropagation();

  const municipioId = document.getElementById('municipioSelect').value;
  const bairroDigitadoAtual = document.getElementById('bairroInput').value.trim();
  document.getElementById('otherBairroInput').value = bairroDigitadoAtual; // força atualização
  const nomeNovo = bairroDigitadoAtual;

  const ce = document.getElementById('custoEnvio');

  if (!nomeNovo) {
    Swal.fire({
      icon: 'warning',
      title: 'Campo vazio',
      text: 'Por favor, digite o nome do bairro/Rua.'
    });
    return;
  }

  function normalizar(str) {
    return str.trim().normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
  }

  const nomeNormalizado = normalizar(nomeNovo);
  const jaExiste = (window.bairrosDisponiveis || []).some(
    b => normalizar(b.nome_bairro) === nomeNormalizado
  );

  if (jaExiste) {
    Swal.fire({
      icon: 'info',
      title: 'Já existe',
      text: 'Este bairro já está na lista. Por favor, selecione diretamente.'
    });
    resetOtherBairro();
    return;
  }

  // Mostrar loading
  Swal.fire({
    title: 'Enviando...',
    text: 'Aguarde enquanto adicionamos o bairro.',
    allowOutsideClick: false,
    allowEscapeKey: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });

  try {
    const response = await fetch('api/insert_bairro.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({
        municipio_id: municipioId,
        nome_bairro: nomeNovo,
        provincia_id: 2
      })
    });
    const res = await response.json();

    if (res.success && res.bairro_id) {
      // Atualiza dados locais e esconde o input
      ce.textContent = 'Entraremos em contacto para informar o custo de envio.';
      localStorage.setItem('endereco.bairro', JSON.stringify({
        id: res.bairro_id,
        nome: nomeNovo,
        custo: "pendente"
      }));
      resetOtherBairro();
      // Recarregar bairros
      carregarBairros(municipioId);

      // Opcional: preencher o campo com o nome recém-digitado
      document.getElementById('bairroInput').value = nomeNovo;
      // Atualiza a lista local e Awesomplete
      if (!window.bairrosDisponiveis) window.bairrosDisponiveis = [];
      window.bairrosDisponiveis.push({ bairro_id: res.bairro_id, nome_bairro: nomeNovo });

      new Awesomplete(document.getElementById('bairroInput'), {
        list: window.bairrosDisponiveis.map(b => b.nome_bairro),
        minChars: 1,
        autoFirst: true
      });

      Swal.fire({
        icon: 'success',
        title: 'Bairro adicionado!',
        text: 'Obrigado. Entraremos em contacto para informar o custo de Envio.'
      });
    } else {
      throw new Error('Erro no retorno da API');
    }

  } catch (err) {
    console.error('Erro insert_bairro:', err);
    Swal.fire({
      icon: 'error',
      title: 'Erro ao adicionar',
      text: 'Houve um erro ao adicionar o bairro. Tente novamente mais tarde.'
    });
  }
});
