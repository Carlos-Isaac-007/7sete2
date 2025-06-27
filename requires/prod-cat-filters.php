<!-- Sidebar Filters Only -->
<div class="card shadow-sm border-0 mb-3 custom-filter-card ">
    <div class="card-body">
        <!-- Título do filtro -->
        <h5 class="fw-bold mb-3" style="color:#000c78;">Filtrar</h5>
        
        <!-- Filtro de Categoria Média -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Categoria Média</label>
            <select class="form-select form-select-sm rounded-pill mid-cat" id="mid-category-filter" data-table="tbl_mid_category"
                data-select="mcat_id, mcat_name" data-id="<?=$_GET['id']?>" data-where_field="tcat_id" name="mid_category">
                <option value="all">Todas</option>
            </select>
        </div>

        <!-- Filtro de Categoria Final -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Categoria Final</label>
            <select class="form-select form-select-sm rounded-pill end-cat" id="end-category-filter" name="end_category">
                <option value="all">Todas</option>
            </select>
        </div>

        <!-- Filtro de Preço 
        <div class="mb-4">
            <label class="form-label fw-semibold">Faixa de Preço</label>
            <div class="d-flex align-items-center gap-2">
                 Campo para valor mínimo 
                <input type="number" id="preco-min" class="form-control form-control-sm rounded-pill" placeholder="Mín" min="0">
                <span class="mx-1">-</span>
                 Campo para valor máximo 
                <input type="number" id="preco-max" class="form-control form-control-sm rounded-pill" placeholder="Máx" min="0">
            </div>
        </div>-->
        
        <!-- Filtro de Tamanhos/Variantes 
        <div class="mb-4">
            <label class="form-label fw-semibold">Tamanhos</label>
            <div class="d-flex flex-wrap gap-2">
                <?php 
                // Gera botões para cada tamanho disponível
                foreach (['PP','P','M','G','GG','XG'] as $size): ?>
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill custom-size-btn"><?php echo $size; ?></button>
                <?php endforeach; ?>
            </div>
        </div>-->
        
        <!-- Filtro de Marcas 
        <div class="mb-4">
            <label class="form-label fw-semibold">Marcas</label>
            <select class="form-select form-select-sm rounded-pill" >
                <option value="">Todas</option>
                <?php 
                // Lista todas as marcas disponíveis
                foreach ($brands as $brand): ?>
                    <option value="<?php echo htmlspecialchars($brand['brand_id']); ?>">
                        <?php echo htmlspecialchars($brand['brand_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>-->
        
        <!--Filtro de Classificação (Estrelas) 
        <div class="mb-4">
            <label class="form-label fw-semibold">Classificação</label>
            <div>
                <?php 
                // Gera checkboxes para cada nível de estrelas (5 a 1)
                for ($i = 5; $i >= 1; $i--): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="star<?php echo $i; ?>">
                        <label class="form-check-label" for="star<?php echo $i; ?>">
                            <?php 
                            // Exibe as estrelas preenchidas de acordo com o nível
                            for ($j = 1; $j <= $i; $j++): ?>
                                <i class="bi bi-star-fill text-warning"></i>
                            <?php endfor; ?>
                        </label>
                    </div>
                <?php endfor; ?>
            </div>
        </div>-->
        
        <!-- Filtro de Promoções 
        <div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="promoOnly">
                <label class="form-check-label fw-semibold" for="promoOnly">
                    Apenas Promoções
                </label>
            </div>
        </div>-->
    </div>
</div>

<!-- Estilos customizados para o formulário de filtros -->
<style>
    .custom-filter-card {
        border-radius: 1.2rem; /* Borda arredondada */
        background: #f8f9fa;   /* Cor de fundo clara */
    }
    .custom-size-btn {
        min-width: 38px;           /* Largura mínima dos botões de tamanho */
        border-color: #000c78;     /* Cor da borda */
        color: #000c78;            /* Cor do texto */
        font-weight: 500;          /* Peso da fonte */
        transition: background 0.2s, color 0.2s; /* Transição suave */
    }
    .custom-size-btn.active,
    .custom-size-btn:focus,
    .custom-size-btn:hover {
        background: #000c78; /* Cor de fundo ao passar o mouse ou ativo */
        color: #fff;         /* Cor do texto ao passar o mouse ou ativo */
    }
    
</style>


<script>
    document.addEventListener('DOMContentLoaded', () => {
    const midCats = document.querySelectorAll('.mid-cat');
    const endCats = document.querySelectorAll('.end-cat');

    if (midCats.length !== endCats.length) {
        console.warn('Quantidade diferente de .mid-cat e .end-cat. Pares inconsistentes.');
        return;
    }

    midCats.forEach((midCat, index) => {
        const endCat = endCats[index];

        if (!midCat || !endCat) return;

        // Função para carregar categorias finais
        async function carregarCategoriasFinais(midCatId) {
        while (endCat.options.length > 1) {
            endCat.remove(1);
        }

        if (!midCatId) return;

        try {
            const apiUrl = `api/product_category/busca_categorias.php?table=tbl_end_category&select=ecat_id,ecat_name&id=${encodeURIComponent(midCatId)}&where_field=mcat_id`;
            const response = await fetch(apiUrl);
            if (!response.ok) throw new Error('Erro na resposta da API');

            const data = await response.json();

            data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.ecat_id;
            option.textContent = item.ecat_name;
            endCat.appendChild(option);
            });
        } catch (error) {
            console.error('Erro ao carregar categorias finais:', error);
        }
        }

        // Carregar categorias médias no carregamento da página
        (async () => {
        const apiUrl = `api/product_category/busca_categorias.php?table=${encodeURIComponent(midCat.dataset.table)}&select=${encodeURIComponent(midCat.dataset.select)}&id=${encodeURIComponent(midCat.dataset.id)}&where_field=${encodeURIComponent(midCat.dataset.where_field)}`;

        try {
            const response = await fetch(apiUrl);
            if (!response.ok) throw new Error('Erro na resposta da API');

            const data = await response.json();

            while (midCat.options.length > 1) {
            midCat.remove(1);
            }

            data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.mcat_id;
            option.textContent = item.mcat_name;
            midCat.appendChild(option);
            });
        } catch (error) {
            console.error('Erro ao carregar categorias médias:', error);
        }
        })();

        // Evento ao mudar a categoria média
        midCat.addEventListener('change', () => {
        carregarCategoriasFinais(midCat.value);
        });
    });
    });
</script>


<script>
function getFiltros() {
    return {
        // preco_min: document.getElementById('preco-min').value,
        // preco_max: document.getElementById('preco-max').value,
        // tamanho: document.querySelector('.custom-size-btn.active')?.textContent || '',
        // marca: document.getElementById('brand-select').value,
        // promocao: document.getElementById('promoOnly').checked ? 1 : 0,
        mid_cat: Array.from(document.querySelectorAll('.mid-cat')).map(el => el.value),
        end_cat: Array.from(document.querySelectorAll('.end-cat')).map(el => el.value)
    };
}

// Evento para filtro de Categoria Média (mid-cat)
document.querySelectorAll('.mid-cat').forEach(select => {
    select.addEventListener('change', filtrarProdutos);
});
// Evento para filtro de Categoria final (end-cat)
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('end-cat')) {
        filtrarProdutos();
    }
});


function filtrarProdutos() {
    const filtros = getFiltros();
    const formData = new FormData();

    // mid_cat pode ser um array — precisamos iterar
    if (Array.isArray(filtros.mid_cat)) {
        filtros.mid_cat.forEach(id => {
            if (id) formData.append('mid_cat[]', id); // importante usar []
        });
    }
    // end_cat pode ser um array — precisamos iterar
    if (Array.isArray(filtros.end_cat)) {
        filtros.end_cat.forEach(id => {
            if (id) formData.append('end_cat[]', id); // importante usar []
        });
    }

    const defaultIds = document.querySelector('.end-ids')?.dataset.final_ecat_ids;

    if (defaultIds) {
        // Adiciona também os IDs reais, que o back-end vai usar 
        defaultIds.split(',').forEach(id => {
            formData.append('final_ecat_ids[]', id.trim());
        });
    }

    console.log('o que é enviado: ', [...formData.entries()]); // para debug


    fetch('api/product_category/filtrar_produtos.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(html => {
        document.querySelector('.col-lg-9').innerHTML = html;
    })

}
</script>

