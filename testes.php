<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Carrossel Contínuo de Logos</title>
  <style>
    body {
      background: #111;
      color: #fff;
      font-family: sans-serif;
      padding: 40px;
    }

    .logo-carousel-wrapper {
      overflow: hidden;
      width: 100%;
      background: #222;
      border: 2px solid #444;
      padding: 10px 0;
    }

    .logo-carousel {
      display: flex;
      width: fit-content;
      animation: scroll 20s linear infinite;
    }

    .logo-item {
      flex: 0 0 auto;
      width: 150px;
      height: 100px;
      margin: 0 20px;
      background: white;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000;
      font-weight: bold;
      font-size: 24px;
    }

    @keyframes scroll {
      0% {
        transform: translateX(0%);
      }
      100% {
        transform: translateX(-50%);
      }
    }
  </style>
</head>
<body>

<h2>Carrossel Contínuo de Apoios</h2>

<div class="logo-carousel-wrapper">
  <div class="logo-carousel" id="logos">
    <div class="logo-item">Logo 1</div>
    <div class="logo-item">Logo 2</div>
    <div class="logo-item">Logo 3</div>
    <div class="logo-item">Logo 4</div>
    <div class="logo-item">Logo 5</div>
    <!-- Clonados manualmente -->
    <div class="logo-item">Logo 1</div>
    <div class="logo-item">Logo 2</div>
    <div class="logo-item">Logo 3</div>
    <div class="logo-item">Logo 4</div>
    <div class="logo-item">Logo 5</div>
  </div>
</div>

</body>
</html>
