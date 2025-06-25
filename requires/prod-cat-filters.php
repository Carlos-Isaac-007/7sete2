<!-- Sidebar Filters Only -->
<div class="card shadow-sm border-0 mb-3 custom-filter-card">
    <div class="card-body">
        <!-- Título do filtro -->
        <h5 class="fw-bold mb-3" style="color:#000c78;">Filtrar</h5>
        
        <!-- Filtro de Preço -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Faixa de Preço</label>
            <div class="d-flex align-items-center gap-2">
                <!-- Campo para valor mínimo -->
                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="Mín" min="0">
                <span class="mx-1">-</span>
                <!-- Campo para valor máximo -->
                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="Máx" min="0">
            </div>
        </div>
        
        <!-- Filtro de Tamanhos/Variantes -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Tamanhos</label>
            <div class="d-flex flex-wrap gap-2">
                <?php 
                // Gera botões para cada tamanho disponível
                foreach (['PP','P','M','G','GG','XG'] as $size): ?>
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill custom-size-btn"><?php echo $size; ?></button>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Filtro de Marcas -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Marcas</label>
            <select class="form-select form-select-sm rounded-pill">
                <option value="">Todas</option>
                <?php 
                // Lista todas as marcas disponíveis
                foreach ($brands as $brand): ?>
                    <option value="<?php echo htmlspecialchars($brand['brand_id']); ?>">
                        <?php echo htmlspecialchars($brand['brand_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Filtro de Classificação (Estrelas) -->
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
        </div>
        
        <!-- Filtro de Promoções -->
        <div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="promoOnly">
                <label class="form-check-label fw-semibold" for="promoOnly">
                    Apenas Promoções
                </label>
            </div>
        </div>
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
