<?php require_once('header.php'); ?>
<?php require_once('novo_css.php'); ?>
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




<!-- area do novo carrosel-->
<div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
    <!-- Indicadores -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Slides -->
    <div class="carousel-inner">
        <?php 
        $i=0;
        $statement = $pdo->prepare("SELECT * FROM tbl_slider");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
        ?>
        <?php  foreach ($result as $row):?>
        <div class="carousel-item <?php if($i==0) {echo 'active';} ?>">
            
            <img src="<?=ROOT?>assets/uploads/<?=$row['photo']?>" alt="Imagem 1">
            
        </div>
        <?php $i++; ?>
       <?php endforeach; ?>
    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Fim da Area do novo Carrosel-->


<?php if($home_service_on_off == 1): ?>
<div class="service bg-gray">
<div class="container">
<div class="row">
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_service");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
?>
<div class="col-md-4">
<div class="item">
<div class="photo"><img src="assets/uploads/<?php echo $row['photo']; ?>" width="150px" alt="<?php echo $row['title']; ?>"></div>
<h3><?php echo $row['title']; ?></h3>
<p>
<?php echo nl2br($row['content']); ?>
</p>
</div>
</div>
<?php
}
?>
</div>
</div>
</div>
<?php endif; ?>

<?php if($home_featured_product_on_off == 1): ?>
<div class="product">
<div class="container">

<div class="row">
<div class="col-md-12">
<div class="headline">
<h2><?php echo $featured_product_title; ?></h2>
<h3><?php echo $featured_product_subtitle; ?></h3>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<?php 
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? ORDER BY RAND() LIMIT ".$total_featured_product_home);
$statement->execute(array(1,1));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
if ( is_array($result)){
   
   require_once('carrosel_horizontal_feacture.php');
}

?>

</div>
</div>

</div>
</div>
<?php endif; ?>


<?php if($home_latest_product_on_off == 1): ?>
<div class="product bg-gray ">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="headline">
<h2><?php echo $latest_product_title; ?></h2>
<h3><?php echo $latest_product_subtitle; ?></h3>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<!-- aQUI VAI O COMPONENETE CARROSEL HORIZONTAL-->
<?php  
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY RAND() LIMIT ".$total_latest_product_home);
$statement->execute(array(1));
$result = $statement->fetchAll(PDO::FETCH_ASSOC); 

if (is_array($result)){
    require_once('carrosel_horizontal_latest.php');
}
?>
</div>
</div>
</div>
<?php endif; ?>


<?php if($home_popular_product_on_off == 1): ?>
<div class="product">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="headline">
<h2><?php echo $popular_product_title; ?></h2>
<h3><?php echo $popular_product_subtitle; ?></h3>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
   <?php 
        $statement = $pdo->prepare("SELECT * FROM tbl_product  WHERE p_is_active=? ORDER BY RAND() LIMIT ".$total_popular_product_home);
        $statement->execute(array(1));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(is_array(($result))){
            require_once('carrosel_horizontal_popular.php');
        }
        ?>


</div>
</div>
</div>
</div>
<?php endif; ?>
<!-- aqui vai aparecer uma div que vai carregar os produtos sem para -->
<div class="product">
<div class="container">
      <div class="row">
    <div class="col-md-12">
    <div class="headline">
    <h2>Todos os Produtos</h2>
    <h3>Lista de produtos disponível no stoke</h3>
    </div>
    </div>
    </div>
    
    <div id="product-list" class="container23">
        <!-- Os produtos serão carregados aqui via AJAX -->
        
    </div>
    <div class="loading">
        <p>Carregando...</p>
    </div>
</div>
</div>
  <!-- Fazendo a inclucao do arquivo novojs que vai lidar com o carrosel e a rolagem infinita -->
     <?php require_once('novo_js.php')  ?>
  
    <?php require_once('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>