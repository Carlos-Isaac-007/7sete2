<section id="reservar" class="mb-5">
      <h2 class="section-title">Reservar Veículo</h2>
      <form id="formReservar" class="row g-3">
        <div class="col-md-6">
          <label for="veiculo" class="form-label">Veículo</label>
          <select id="veiculo" class="form-select">
            <option selected>Escolha...</option>
            <option value="Carro A">Carro A</option>
            <option value="Carro B">Carro B</option>
            <option value="Carro C">Carro C</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="data" class="form-label">Data da Reserva</label>
          <input type="date" id="data" class="form-control"/>
        </div>
        <div class="col-md-6">
          <label for="entrega" class="form-label">Entrega</label>
          <select id="entrega" class="form-select">
            <option value="local">Buscar no local</option>
            <option value="cliente">Entrega no endereço</option>
          </select>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
        </div>
      </form>
    </section>