<?php
$id = $_GET['id'] ?? 1;
$cursos = json_decode(file_get_contents("data/cursos.json"), true);
$curso = array_filter($cursos, fn($c) => $c['id'] == $id);
$curso = array_values($curso)[0];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $curso['titulo'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1><?= $curso['titulo'] ?></h1>
    <img src="<?= $curso['imagem'] ?>" class="img-fluid mb-3" alt="<?= $curso['titulo'] ?>">
    <p><?= $curso['descricao'] ?></p>
    <p><strong>Preço:</strong> <?= $curso['preco'] ?></p>
    <a href="checkout.php?id=<?= $curso['id'] ?>" class="btn btn-success">Comprar</a>
</div>
</body>
</html>
