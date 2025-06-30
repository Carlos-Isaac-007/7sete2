<?php require_once('header.php'); ?>
<?php require_once('home-styles.php'); ?>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
$cta_title = $row['cta_title'];
$cta_content = $row['cta_content'];
$cta_read_more_text = $row['cta_read_more_text'];
$cta_read_more_url = $row['cta_read_more_url'];
$cta_photo = $row['cta_photo'];
$featured_product_title = $row['featured_product_title'];
$featured_product_subtitle = $row['featured_product_subtitle'];
$latest_product_title = $row['latest_product_title'];
$latest_product_subtitle = $row['latest_product_subtitle'];
$popular_product_title = $row['popular_product_title'];
$popular_product_subtitle = $row['popular_product_subtitle'];
$total_featured_product_home = $row['total_featured_product_home'];
$total_latest_product_home = $row['total_latest_product_home'];
$total_popular_product_home = $row['total_popular_product_home'];
$home_service_on_off = $row['home_service_on_off'];
$home_welcome_on_off = $row['home_welcome_on_off'];
$home_featured_product_on_off = $row['home_featured_product_on_off'];
$home_latest_product_on_off = $row['home_latest_product_on_off'];
$home_popular_product_on_off = $row['home_popular_product_on_off'];

}


?>

<div class="home-todo" id="home_box" style="border-radius: 18px; overflow: hidden; box-shadow: 0 2px 16px rgba(0,0,0,0.06); margin-bottom: 40px; background: #000c78;">
    <!-- Carrossel Moderno com botões de paginação -->
    <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel" style="margin-bottom: 40px;">
        <!-- Indicadores circulares personalizados -->
        <div class="carousel-indicators">
            <?php 
                $statement = $pdo->prepare("SELECT * FROM tbl_slider");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
                $slideCount = count($result);
                for($j = 0; $j < $slideCount; $j++): 
            ?>
                <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="<?=$j?>" class="<?php if($j == 0) echo 'active'; ?>" aria-current="<?php if($j == 0) echo 'true'; ?>" aria-label="Slide <?=$j+1?>" style="background-color: #000c78; width: 14px; height: 14px; border-radius: 50%; border: none; margin: 0 6px;"></button>
            <?php endfor; ?>
        </div>
        <div class="carousel-inner rounded-4 shadow-sm">
            <?php 
                $i = 0;
                $colors = ['#0166ff', '#fe6a00', '#ffba04'];
            ?>
            <?php foreach ($result as $row): ?>
                <div class="carousel-item <?php if($i == 0) echo 'active'; ?>">
                    <img 
                        src="<?=ROOT?>assets/uploads/<?=$row['photo']?>" 
                        alt="Imagem <?=$i+1?>" 
                        data-color="<?= $colors[$i % count($colors)] ?>"
                        class="d-block w-100"
                        style="border-radius: 18px;"
                    >
                    <?php if(!empty($row['caption'])): ?>
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
                            <h5 style="font-weight:700;"><?=htmlspecialchars($row['caption'])?></h5>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Fim do Carrossel -->

    <?php if($home_service_on_off == 1): ?>
    <div class="service py-4" style="border-radius: 18px; margin-bottom: 32px; background: #fff;">
        <div class="container">
            <div class="row g-4">
                <?php
                $statement = $pdo->prepare("SELECT * FROM tbl_service");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                foreach ($result as $row) {
                    $icon = 'bi-gear-fill';
                    if (stripos($row['title'], 'Entrega') !== false) $icon = 'bi-truck';
                    if (stripos($row['title'], 'Suporte') !== false) $icon = 'bi-headset';
                    if (stripos($row['title'], 'Pagamento') !== false) $icon = 'bi-credit-card-2-front-fill';
                ?>
                <div class="col-md-4">
                    <div class="item text-center p-4 shadow-sm rounded-4 h-100" style="background: #f8fafc;">
                        <div class="mb-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="background: #e0e7ff; width: 64px; height: 64px;">
                                <i class="bi <?=$icon?>" style="font-size: 2rem; color: #4F8A8B;"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-2" style="font-size: 1.2rem;"><?php echo $row['title']; ?></h3>
                        <p class="text-muted" style="font-size: 1rem;">
                            <?php echo nl2br($row['content']); ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($home_featured_product_on_off == 1): ?>
    <div class="product mb-4">
        <div class="container" style="background: linear-gradient(90deg, #fff 60%, #e0e7ff 100%); border-radius: 18px; padding-top: 25px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline d-flex align-items-center mb-3 fire-icon">
                        <span class="me-2" style="font-size: 2.2rem; color: #ff4b6e;">
                            <i class="bi bi-fire"></i>
                        </span>
                        <h2 class="titulo-com-linha gradiente-brilho" style="margin: 0; font-weight: 700; font-size: 1.5rem; color: #222;">
                            <?php echo $featured_product_title; ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">
                    <?php 
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? ORDER BY RAND() LIMIT ".$total_featured_product_home);
                    $statement->execute(array(1,1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if (is_array($result)){
                        require('componentes/carrosel_horizontal_cards.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($home_latest_product_on_off == 1): ?>
    <div class="product mb-4" style="background: linear-gradient(90deg, #f8fafc 60%, #e0e7ff 100%); border-radius: 18px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline d-flex align-items-center mb-3">
                        <span class="me-2" style="font-size: 2.2rem; color: #4F8A8B;">
                            <i class="bi bi-stars"></i>
                        </span>
                        <h2 class="gradiente-brilho" style="margin: 0; font-weight: 700; font-size: 1.5rem; color: #222;">
                            <?php echo $latest_product_title; ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -20px">
                <div class="col-md-12">
                    <?php  
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY RAND() LIMIT ".$total_latest_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
                    if (is_array($result)){
                        require('componentes/carrosel_horizontal_cards.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if($home_popular_product_on_off == 1): ?>
<div class="product" style="background: linear-gradient(90deg, #f8fafc 60%, #ffe5ec 100%); border-radius: 18px; margin-bottom: 40px; box-shadow: 0 2px 16px rgba(255, 105, 135, 0.08);">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center mb-2">
                <span class="me-2" style="font-size: 2.2rem; color: #ff4b6e;">
                    <i class="bi bi-heart-fill"></i>
                </span>
                <div class="headline mb-0">
                    <h2 class="gradiente-brilho" style="margin: 0; font-weight: 700; font-size: 1.7rem; color: #222;">
                        <?php echo $popular_product_title; ?>
                    </h2>
                    <!--<h3 class="text-muted" style="font-size: 1rem;"><?php echo $popular_product_subtitle; ?></h3>-->
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: -20px;">
            <div class="col-md-12">
                <?php 
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY RAND() LIMIT ".$total_popular_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if(is_array($result)){
                        require('componentes/carrosel_horizontal_cards.php');
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- aqui vai aparecer uma div que vai carregar os produtos sem para -->
<div class="product bg-gray" style="padding-bottom: 40px;">
    <div class="container">
        <div class="row align-items-center" style="margin-bottom: 20px;">
            <div class="col-md-12 d-flex align-items-center">
                <span class="me-2" style="font-size: 2rem; color: #4F8A8B;">
                    <i class="bi bi-box-seam-fill"></i>
                </span>
                <div class="headline mb-0">
                    <h2 style="margin: 0; font-weight: 700; font-size: 1.7rem; color: #222;">
                        Todos os Produtos
                    </h2>
                    <!--<h3 class="text-muted" style="font-size: 1rem;">Lista de produtos disponível no estoque</h3>-->
                </div>
            </div>
        </div>
        
        <div id="product-list" class="row g-3" style="min-height: 120px;">
            <!-- Produtos serão carregados aqui via AJAX -->
        </div>
        <div class="loading d-flex justify-content-center align-items-center" style="height: 60px; display: none;">
            <div class="spinner-border text-primary me-2" role="status"></div>
            <span style="font-size: 1.1rem; color: #555;">Carregando...</span>
        </div>
    </div>
</div>
</div>

<?php require_once 'modal_success.php';  ?>
<?php require_once 'modal_danger.php';  ?>
<!-- Fazendo a inclucao do arquivo novojs que vai lidar com o carrosel e a rolagem infinita -->
<?php require_once('novo_js.php')  ?>

<script>
const carousel = document.querySelector('#newsCarousel');
const homeBox = document.querySelector('#home_box');

function updateBackgroundColor() {
    const activeItem = carousel.querySelector('.carousel-item.active img');
    if (activeItem) {
        const imgSrc = activeItem.getAttribute('src');
        const bgColor = activeItem.getAttribute('data-color') || '#ffffff'; // cor padrão

        console.log('Imagem ativa:', imgSrc);
        console.log('Cor associada:', bgColor);

        // Aplica o background-color e remove imagem de fundo (opcional)
        homeBox.style.backgroundColor = bgColor;
        homeBox.style.backgroundImage = 'none'; // opcional: remove a imagem de fundo se houver
        homeBox.style.transition = 'background-color 0.5s ease';
    } else {
        console.log('Nenhuma imagem ativa encontrada.');
    }
}

document.addEventListener('DOMContentLoaded', updateBackgroundColor);
carousel.addEventListener('slid.bs.carousel', updateBackgroundColor);

</script>

</script>
<script>
      // 1. Observer para títulos com underline animado
      const observerUnderline = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('aparecer');
          }
        });
      });
      observerUnderline.observe(document.querySelector('.titulo-com-linha'));
    
     
     
        document.querySelectorAll('.letra-animada').forEach(titulo => {
          observerLetra.observe(titulo);
        });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once('footer.php'); ?>