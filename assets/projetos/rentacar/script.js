document.addEventListener("DOMContentLoaded", () => {
  const carros = [
    { nome: "Toyota Corolla", preco: "25.000 Kz/dia" },
    { nome: "Hyundai i10", preco: "20.000 Kz/dia" },
    { nome: "Kia Sportage", preco: "30.000 Kz/dia" }
  ];
  const container = document.getElementById("carros");
  carros.forEach(carro => {
    const div = document.createElement("div");
    div.className = "col-md-4 mb-3";
    div.innerHTML = \`
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">\${carro.nome}</h5>
          <p class="card-text">Preço: \${carro.preco}</p>
          <a href="#reservar" class="btn btn-warning">Reservar</a>
        </div>
      </div>
    \`;
    container.appendChild(div);
  });
});
