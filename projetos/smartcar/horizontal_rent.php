 <style>
 
 .card {
  box-shadow: 0 4px 10px rgba(44, 44, 44, 0.2);
  background-color: #FFFFFF;
}
     .card {
  height: 350px;
  display: flex;
  flex-direction: column;
  position: relative;
  overflow: hidden;
}

.card-body {
  flex-grow: 1;
}

.card-img-top {
  object-fit: cover;
  height: 200px;
}

.card-overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.3s ease;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1;
}

.card:hover .card-overlay {
  opacity: 1;
}

.card-overlay span {
  font-size: 1.1rem;
  padding: 10px 20px;
  color: white;
  background-color: #FF8C00; /* Acento metálico */
  border-radius: 5px;
}

 </style>
 <?php 
    require_once("../cursos/inc/config.php");
    // Consultar os carros
$sql = "SELECT * FROM carros"; // Altere o nome da tabela para a que você está usando
$result = $conn->query($sql);
?>
    <section id="catalogo" class="mb-5" data-aos="zoom-in-down">
      <h3 class="section-subtitle">Catálogo de Carros</h3>
      <div class="row" id="carros">
        <?php
        // Verificar se existem resultados
        if ($result->num_rows > 0) {
          // Exibir cada carro como um card
          while($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 mb-4">
                    <a href="detalhes.php?id=' . $row['id'] . '" class="text-decoration-none text-dark">
                      <div class="card">
                        <img src="' . $row['imagem'] . '" class="card-img-top" alt="' . $row['nome'] . '">
                        <div class="card-body">
                          <h5 class="card-title">' . $row['nome'] . '</h5>
                          <p class="card-text">' . $row['descricao'] . '</p>
                        </div>
                        <div class="card-overlay">
                          <span>Ver detalhes</span>
                        </div>
                      </div>
                    </a>
                  </div>';
          }
        } else {
          echo "<p>Não há carros disponíveis no momento.</p>";
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
        ?>
      </div>
    </section>
  </main>