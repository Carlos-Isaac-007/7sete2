<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Loja de Cursos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { font-family: Arial, sans-serif; background-color: #f0f2f5; }
    .header { background: white; padding: 10px 15px; box-shadow: 0 1px 5px rgba(0,0,0,0.1); }
    .logo { font-size: 1.5rem; font-weight: bold; }
    .category-list { overflow-x: auto; white-space: nowrap; padding: 10px 0; }
    .category-item { display: inline-block; margin-right: 10px; }
    .category-item a { text-decoration: none; color: #333; padding: 8px 12px; border-radius: 20px; background: #e4e6eb; }
    .category-item a:hover { background-color: #d8dadf; }
    .footer { background: white; text-align: center; padding: 15px; margin-top: 30px; border-top: 1px solid #ccc; }
    @media (min-width: 768px) {
      .category-list { justify-content: center; display: flex; flex-wrap: wrap; }
      .category-item { margin-bottom: 10px; }
    }
  </style>
  <?php require_once("inc/config.php") ?>
</head>
<body>

<header class="header d-flex justify-content-between align-items-center">
  <div class="logo text-primary"><i class="bi bi-mortarboard-fill"></i> Cursos Online</div>
  <div class="d-flex gap-3">
    <a href="#" class="text-dark"><i class="bi bi-search"></i></a>
    <a href="#" class="text-dark"><i class="bi bi-cart"></i></a>
    <a href="#" class="text-dark"><i class="bi bi-person-circle"></i></a>
  </div>
</header>

<main class="container mt-4">
  <section class="category-list mb-3">
    <div class="category-item"><a href="#">Todos</a></div>
    <div class="category-item"><a href="#">Vídeos</a></div>
    <div class="category-item"><a href="#">E-books</a></div>
    <div class="category-item"><a href="#">Tecnologia</a></div>
    <div class="category-item"><a href="#">Negócios</a></div>
    <div class="category-item"><a href="#">Design</a></div>
    <div class="category-item"><a href="#">Idiomas</a></div>
  </section>

  <section class="row g-3">
    <?php
    $sql = "SELECT * FROM cursos ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0):
      while ($curso = $result->fetch_assoc()):
    ?>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card h-100">
        <img src="<?= $curso['imagem'] ?>" class="card-img-top" alt="<?= $curso['titulo'] ?>">
        <div class="card-body d-flex flex-column">
          <h6 class="card-title"><?= $curso['titulo'] ?></h6>
          <p class="text-muted mb-1">Kz <?= number_format($curso['preco'], 2, ',', '.') ?></p>
          <a href="checkout.php?id=<?= $curso['id'] ?>" class="btn btn-sm btn-primary mt-auto">Ver mais</a>
        </div>
      </div>
    </div>
    <?php
      endwhile;
    else:
      echo "<p class='text-center'>Nenhum curso disponível no momento.</p>";
    endif;

    $conn->close();
    ?>
  </section>
</main>

<footer class="footer">
  <small>&copy; <?= date('Y') ?> Loja de Cursos. Todos os direitos reservados.</small>
</footer>

</body>
</html>
