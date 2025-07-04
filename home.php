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

<div class="home-todo" id="home_box" style="border-radius: 1px; box-shadow: 0 2px 16px rgba(0,0,0,0.06); background: #000c78;">
    <!-- Carrossel Heroico e Interativo para E-commerce -->
    <div id="newsCarousel" class="carousel slide position-relative" data-bs-ride="carousel" style="margin-bottom: 25px;">
        <!-- Indicadores circulares personalizados -->
        <div class="carousel-indicators mb-0" style="bottom: 18px;">
            <?php 
                $statement = $pdo->prepare("SELECT * FROM tbl_slider");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
                $slideCount = count($result);
                for($j = 0; $j < $slideCount; $j++): 
            ?>
                <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="<?=$j?>" class="<?php if($j == 0) echo 'active'; ?>" aria-current="<?php if($j == 0) echo 'true'; ?>" aria-label="Slide <?=$j+1?>" style="background: linear-gradient(135deg, #0166ff 0%, #ff4b6e 100%); width: 16px; height: 16px; border-radius: 50%; border: none; margin: 0 7px; opacity: 0.7; transition: opacity 0.3s;"></button>
            <?php endfor; ?>
        </div>
        <div class="carousel-inner shadow-lg">
            <?php 
                $i = 0;
                $colors = ['#000c78', '#d0752f', '#b37071', '#ff4b6e', '#4F8A8B'];
            ?>
            <?php foreach ($result as $row): ?>
                <div class="carousel-item <?php if($i == 0) echo 'active'; ?>">
                    <div class="position-relative" style="min-height: 340px;">
                        <img 
                            src="uploads/<?=$row['photo']?>" 
                            alt="Imagem <?=$i+1?>" 
                            data-color="<?= $colors[$i % count($colors)] ?>"
                            class="d-block w-100"
                            style="object-fit: cover; height: 340px; filter: brightness(0.75) blur(0.5px);"
                        >
                        <!-- Overlay com CTA -->
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-start h-100 w-100 px-4" style="left:0; right:0; top:0; bottom:0; background: linear-gradient(90deg, rgba(0,12,120,0.85) 0%, rgba(0,0,0,0.15) 80%);">
                            <h2 class="fw-bold mb-2 animate__animated animate__fadeInDown" style="font-size: 2.2rem; color: #fff; text-shadow: 0 2px 12px #000c78;">
                                <?=!empty($row['caption']) ? htmlspecialchars($row['caption']) : 'Bem-vindo à nossa loja!'?>
                            </h2>
                            <?php if(!empty($row['description'])): ?>
                                <p class="lead mb-3 animate__animated animate__fadeInLeft" style="color: #f8fafc; max-width: 500px; text-shadow: 0 1px 8px #000;">
                                    <?=htmlspecialchars($row['description'])?>
                                </p>
                            <?php endif; ?>
                            <a href="<?=!empty($row['cta_url']) ? htmlspecialchars($row['cta_url']) : '#produtos';?>" class="btn btn-lg btn-gradient-primary shadow animate__animated animate__pulse animate__delay-1s" style="background: linear-gradient(90deg, #ff4b6e 0%, #0166ff 100%); color: #fff; border: none; font-weight: 700; border-radius: 32px; padding: 12px 36px; font-size: 1.2rem; letter-spacing: 1px;">
                                <?=!empty($row['cta_text']) ? htmlspecialchars($row['cta_text']) : 'Ver Ofertas'?>
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <?php if(!empty($row['promo_badge'])): ?>
                                 <span class="promo-badge-modern position-absolute top-0 end-0 m-2 d-flex align-items-center gap-1">
                                    <svg width="18" height="18" fill="none" viewBox="0 0 20 20">
                                        <circle cx="10" cy="10" r="10" fill="#ff3366"/>
                                        <path d="M7 10.5l2 2 4-4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="promo-badge-text"><?= $row['promo_badge'] ?></span>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>
        </div>
        <!-- Botões de navegação customizados -->
        <button class="carousel-control-prev d-none" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev" style="width: 56px;">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: linear-gradient(135deg, #0166ff 0%, #ff4b6e 100%); border-radius: 50%; width: 44px; height: 44px; box-shadow: 0 2px 8px #000c78;"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next d-none" type="button" data-bs-target="#newsCarousel" data-bs-slide="next" style="width: 56px;">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: linear-gradient(135deg, #ff4b6e 0%, #0166ff 100%); border-radius: 50%; width: 44px; height: 44px; box-shadow: 0 2px 8px #000c78;"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
    <!-- Fim do Carrossel Heroico -->

    <!-- Animações Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .btn-gradient-primary:hover, .btn-gradient-primary:focus {
            background: linear-gradient(90deg, #0166ff 0%, #ff4b6e 100%) !important;
            color: #fff !important;
            transform: scale(1.05);
            box-shadow: 0 4px 16px #0166ff44;
        }
        .carousel-indicators [data-bs-target].active {
            opacity: 1 !important;
            box-shadow: 0 0 0 4px #fff, 0 2px 8px #0166ff55;
        }
    </style>

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
    <!-- Seções Promocionais e Destaque lado a lado no desktop, em bloco no mobile -->
    <div class="container-fluid mb-4" style="padding-left: 0; padding-right: 0;">
        <div class="row g-4 flex-lg-nowrap">
            <!-- Seção de Produtos Promocionais -->
            <div class="col-12 col-lg-6 d-flex">
                <div class="product flex-fill w-100 h-100" style="background: linear-gradient(90deg, #fff 60%, #ffe5ec 100%); border-radius: 18px; box-shadow: 0 2px 16px rgba(255, 105, 135, 0.08);">
                    <div class="py-4 px-3 px-lg-4">
                        <div class="d-flex align-items-center mb-2 headline">
                            <span class="me-2" style="font-size: 2.2rem; color: #ff4b6e;">
                                <i class="bi bi-percent"></i>
                            </span>
                            <div class="mb-0">
                                <h2 class="gradiente-brilho" style="margin: 0; font-weight: 700; font-size: 1.5rem; color: #222;">
                                    Produtos em Promoção
                                </h2>
                                <h3 class="text-muted" style="font-size: 1rem;">Ofertas imperdíveis para você economizar!</h3>
                            </div>
                        </div>
                        <div style="margin-top: -20px;">
                            <?php 
                           $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_current_price < p_old_price AND p_is_active=? ORDER BY RAND() LIMIT ".$total_featured_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if (is_array($result)){
                        require('componentes/carrosel_horizontal_cards_promo.php');
                    } else {
                                echo '<div class="alert alert-info text-center">Nenhum produto promocional no momento.</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Seção de Produtos em Destaque -->
            <div class="col-12 col-lg-6 d-flex">
                <div class="product flex-fill w-100 h-100" style="background: linear-gradient(90deg, #f8fafc 60%, #e0e7ff 100%); border-radius: 18px; box-shadow: 0 2px 16px rgba(1, 102, 255, 0.08);">
                    <div class="py-4 px-3 px-lg-4">
                        <div class="d-flex align-items-center mb-2 headline fire-icon">
                            <span class="me-2" style="font-size: 2.2rem; color: #ff4b6e;">
                            <i class="bi bi-fire"></i>
                            </span>
                            <div class="mb-0">
                                <h2 class="gradiente-brilho" style="margin: 0; font-weight: 700; font-size: 1.5rem; color: #222;">
                                    <?php echo $featured_product_title; ?>
                                </h2>
                                <?php if(!empty($featured_product_subtitle)): ?>
                                <h3 class="text-muted" style="font-size: 1rem;"><?php echo $featured_product_subtitle; ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div style="margin-top: -20px;">
                            <?php 
                           $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_current_price >= p_old_price AND p_is_featured=? AND p_is_active=? ORDER BY RAND() LIMIT ".$total_featured_product_home);
                    $statement->execute(array(1,1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if (is_array($result)){
                        require('componentes/carrosel_horizontal_cards_promo.php');
                    } else {
                                echo '<div class="alert alert-info text-center">Nenhum produto em destaque no momento.</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* UI/UX Moderno para cards e carrossel */
         .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .product .headline .gradiente-brilho {
            background: linear-gradient(90deg, #ff4b6e 0%, #0166ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        @media (max-width: 991.98px) {
            .product .headline h2 {
                font-size: 1.1rem !important;
            }
            .product .headline h3 {
                font-size: 0.95rem !important;
            }
        }
        .product .headline {
            align-items: center;
            gap: 10px;
        }
        .product .headline span {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @media (min-width: 992px) {
            .product {
                min-height: 420px;
            }
            /* Remove container padding for full width */
        .container-fluid {
            padding-left: 10 !important;
            padding-right: 10 !important;
        }
        }
        
    </style>
    <?php endif; ?>

    <?php if($home_latest_product_on_off == 1): ?>
    <div class="product" style="background: linear-gradient(90deg, #f8fafc 60%, #e0e7ff 100%); border-radius: 18px 18px 0 0;">
        <div class="container pt-3">
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
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT ".$total_latest_product_home);
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
<div class="product" style="background: linear-gradient(90deg, #f8fafc 60%, #ffe5ec 100%); border-radius: 0px 0px 0 0; box-shadow: 0 2px 16px rgba(255, 105, 135, 0.08);">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center mb-2">
                <span class="me-2" style="font-size: 2.2rem; color: #ff4b6e;">
                    <i class="bi bi-heart-fill"></i>
                </span>
                <div class="headline mb-3">
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
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE  p_current_price >= p_old_price AND p_is_active=? ORDER BY RAND() LIMIT ".$total_popular_product_home);
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
    <div class="container pt-3">
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