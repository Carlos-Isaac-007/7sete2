<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("inc/config.php");

$id = $_GET['id'] ?? 1;

$stmt = $conn->prepare("SELECT * FROM cursos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $curso = $result->fetch_assoc();
} else {
    die("Curso não encontrado.");
}

$stmt->close();
$conn->close();
?>
<?php require_once('header.php') ?>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .curso-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .curso-img {
      max-height: 250px;
      object-fit: cover;
      width: 100%;
    }
    .section-title {
      font-weight: 600;
      margin-bottom: 20px;
    }
    .bank-info {
      background: #e9f7ef;
      border-left: 5px solid #28a745;
      padding: 15px;
      border-radius: 6px;
    }
    .whatsapp-btn {
      font-size: 1.2rem;
    }
    .video-embed {
      position: relative;
      padding-bottom: 56.25%; /* Aspect ratio 16:9 */
      height: 0;
      overflow: hidden;
      max-width: 100%;
      background: #000;
      margin-bottom: 20px;
    }
    .video-embed iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
    .video {
        display: none !important;
    }
    
  </style>
<div class="container py-5">
  <div class="row g-4">
    <!-- Detalhes do Curso -->
    <div class="col-md-6">
      <div class="curso-card">
        <img src="<?= htmlspecialchars($curso['imagem']) ?>" class="curso-img" alt="<?= htmlspecialchars($curso['titulo']) ?>">

        <!-- Área de visualização do vídeo do Instagram -->
        <div class="video-embed video">
          <iframe src="https://www.instagram.com/reel/DCgMw9WOSj_/embed" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <div class="p-4">
          <h3><?= htmlspecialchars($curso['titulo']) ?></h3>
          <p class="text-muted"><?= htmlspecialchars($curso['descricao']) ?></p>
          <h5 class="text-primary">Preço: Kz <?= number_format($curso['preco'], 2, ',', '.') ?></h5>
        </div>
      </div>
    </div>

    <!-- Pagamento e Instruções -->
    <div class="col-md-6">
      <div>
        <h4 class="section-title"><i class="bi bi-credit-card-2-front-fill text-primary"></i> Instruções de Pagamento</h4>
        <div class="bank-info mb-4">
          <p><strong>Banco:</strong> BAI</p>
          <p><strong>IBAN:</strong> AO06 0006 0000 1234 5678 9101</p>
          <p><strong>Titular:</strong>Eco Empresarial</p>
        </div>
        <p class="mb-4">Após efetuar a transferência, envie o comprovativo clicando no botão abaixo. Nós confirmaremos e liberaremos o curso assim que possível.</p>
        <a href="https://wa.me/244912345678?text=Olá, fiz o pagamento do curso <?= urlencode($curso['titulo']) ?>. Segue o comprovativo em anexo." class="btn btn-success btn-lg w-100 whatsapp-btn" target="_blank">
          <i class="bi bi-whatsapp"></i> Enviar Comprovativo via WhatsApp
        </a>
      </div>
    </div>
  </div>
</div>

<?php require_once('footer.php') ?>
