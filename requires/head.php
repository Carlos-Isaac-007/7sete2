
<?php

include('cookies.php');
ob_start();
session_start();
include("admin/inc/config.php");
include("admin/inc/functions.php");
include("admin/inc/CSRF_Protect.php");
include('usuarios_online.php');

$csrf = new CSRF_Protect();
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';
// atualizando o last activity do usuario
// Setting up the time zone
date_default_timezone_set('Africa/Luanda');
$data_hora = date('Y-m-d H:i:s'); // Formato: Ano-Mês-Dia Hora:Minuto:Segundo


if(isset($_SESSION['customer'])){
    
$cust_id = $_SESSION['customer']['cust_id'];

$query = $pdo->prepare("UPDATE tbl_customer SET last_activity = '$data_hora' WHERE cust_id = ? ");
$query->execute([$cust_id]);   





}


// Getting all language variables into array as global variable
$i=1;
$statement = $pdo->prepare("SELECT * FROM tbl_language");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
define('LANG_VALUE_'.$i,$row['lang_value']);
$i++;
}

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
$logo = $row['logo'];
$favicon = $row['favicon'];
$contact_email = $row['contact_email'];
$contact_phone = $row['contact_phone'];
$meta_title_home = $row['meta_title_home'];
$meta_keyword_home = $row['meta_keyword_home'];
$meta_description_home = $row['meta_description_home'];
$before_head = $row['before_head'];
$after_body = $row['after_body'];
}

// Checking the order table and removing the pending transaction that are 24 hours+ old. Very important
$current_date_time = date('Y-m-d H:i:s');
$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status=?");
$statement->execute(array('Pending'));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
$ts1 = strtotime($row['payment_date']);
$ts2 = strtotime($current_date_time);     
$diff = $ts2 - $ts1;
$time = $diff/(3600);
if($time>24) {

// Return back the stock amount
$statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
$statement1->execute(array($row['payment_id']));
$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
foreach ($result1 as $row1) {
$statement2 = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
$statement2->execute(array($row1['product_id']));
$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result2 as $row2) {
$p_qty = $row2['p_qty'];
}
$final = $p_qty+$row1['quantity'];

$statement = $pdo->prepare("UPDATE tbl_product SET p_qty=? WHERE p_id=?");
$statement->execute(array($final,$row1['product_id']));
}

// Deleting data from table
$statement1 = $pdo->prepare("DELETE FROM tbl_order WHERE payment_id=?");
$statement1->execute(array($row['payment_id']));

$statement1 = $pdo->prepare("DELETE FROM tbl_payment WHERE id=?");
$statement1->execute(array($row['id']));
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16955701964"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-16955701964');
</script>


<?php require_once('novo_css.php'); ?>
<!-- Meta Tags -->

<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="assets/img/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.js"></script>

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="assets/img/favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- font Awesome loink-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<!-- Última versão do Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
<link rel="stylesheet" href="assets/css/jquery.bxslider.min.css">
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<link rel="stylesheet" href="assets/css/rating.css">
<link rel="stylesheet" href="assets/css/spacing.css">
<link rel="stylesheet" href="assets/css/bootstrap-touch-slider.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/tree-menu.css">
<link rel="stylesheet" href="assets/css/select2.min.css">
<link rel="stylesheet" href="assets/css/main.css?v=<?= filemtime('assets/css/main.css') ?>">
<link rel="stylesheet" href="assets/css/styles-cards.css?v=<?= filemtime('assets/css/styles-cards.css') ?>">
<link rel="stylesheet" href="assets/css/responsive.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- Link do bootstra 5 caso der algum erro olhar aqui-->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


<?php

$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
$about_meta_title = $row['about_meta_title'];
$about_meta_keyword = $row['about_meta_keyword'];
$about_meta_description = $row['about_meta_description'];
$faq_meta_title = $row['faq_meta_title'];
$faq_meta_keyword = $row['faq_meta_keyword'];
$faq_meta_description = $row['faq_meta_description'];
$blog_meta_title = $row['blog_meta_title'];
$blog_meta_keyword = $row['blog_meta_keyword'];
$blog_meta_description = $row['blog_meta_description'];
$contact_meta_title = $row['contact_meta_title'];
$contact_meta_keyword = $row['contact_meta_keyword'];
$contact_meta_description = $row['contact_meta_description'];
$pgallery_meta_title = $row['pgallery_meta_title'];
$pgallery_meta_keyword = $row['pgallery_meta_keyword'];
$pgallery_meta_description = $row['pgallery_meta_description'];
$vgallery_meta_title = $row['vgallery_meta_title'];
$vgallery_meta_keyword = $row['vgallery_meta_keyword'];
$vgallery_meta_description = $row['vgallery_meta_description'];
}

$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

if($cur_page == ROOT.'home' || $cur_page == ROOT.'login' || $cur_page == ROOT.'registration' || $cur_page == ROOT.'cart' || $cur_page == ROOT.'checkout' || $cur_page == ROOT.'forget-password' || $cur_page == ROOT.'reset-password' || $cur_page == ROOT.'product-category' || $cur_page == ROOT.'product') {
?>
<title><?php echo $meta_title_home; ?></title>
<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
<meta name="description" content="<?php echo $meta_description_home; ?>">
<?php
}

if($cur_page == ROOT.'about') {
?>
<title><?php echo $about_meta_title; ?></title>
<meta name="keywords" content="<?php echo $about_meta_keyword; ?>">
<meta name="description" content="<?php echo $about_meta_description; ?>">
<?php
}
if($cur_page == ROOT.'faq') {
?>
<title><?php echo $faq_meta_title; ?></title>
<meta name="keywords" content="<?php echo $faq_meta_keyword; ?>">
<meta name="description" content="<?php echo $faq_meta_description; ?>">
<?php
}
if($cur_page == ROOT.'contact') {
?>
<title><?php echo $contact_meta_title; ?></title>
<meta name="keywords" content="<?php echo $contact_meta_keyword; ?>">
<meta name="description" content="<?php echo $contact_meta_description; ?>">
<?php
}
if($cur_page == ROOT.'product')
{
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
$og_photo = $row['p_featured_photo'];
$og_title = $row['p_name'];
$og_slug = 'product.php?id='.$_REQUEST['id'];
$og_description = substr(strip_tags($row['p_description']),0,200).'...';
}
}

if($cur_page == ROOT.'dashboard') {
?>
<title>Painel <?php echo $meta_title_home; ?></title>
<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
<meta name="description" content="<?php echo $meta_description_home; ?>">
<?php
}
if($cur_page == ROOT.'customer-profile-update') {
?>
<title>Atualizar perfil - <?php echo $meta_title_home; ?></title>
<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
<meta name="description" content="<?php echo $meta_description_home; ?>">
<?php
}
if($cur_page == ROOT.'customer-billing-shipping-update') {
?>
<title>Atualizar informações de faturação e envio <?php echo $meta_title_home; ?></title>
<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
<meta name="description" content="<?php echo $meta_description_home; ?>">
<?php
}
if($cur_page == ROOT.'customer-password-update') {
?>
<title>Atualizar palavra-passe <?php echo $meta_title_home; ?></title>
<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
<meta name="description" content="<?php echo $meta_description_home; ?>">
<?php
}
if($cur_page == ROOT.'customer-order') {
?>
<title>Pedidos - <?php echo $meta_title_home; ?></title>
<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
<meta name="description" content="<?php echo $meta_description_home; ?>">
<?php
}
?>

<?php if($cur_page == ROOT.'blog-single'): ?>
<meta property="og:title" content="<?php echo $og_title; ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo BASE_URL.$og_slug; ?>">
<meta property="og:description" content="<?php echo $og_description; ?>">
<meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
<?php endif; ?>

<?php if($cur_page == ROOT.'product'): ?>
<meta property="og:title" content="<?php echo $og_title; ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo BASE_URL.$og_slug; ?>">
<meta property="og:description" content="<?php echo $og_description; ?>">
<meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=683987fbbfa7c90013226f7e&product=sop' async='async'></script>

<?php echo $before_head; ?>

</head>

<?php echo $after_body; ?>
 <?php
  // Quantidade de produtos no carrinho
   $qt = 0;
   if(isset($_SESSION['cart_p_qty'])){
    $qt = array_sum($_SESSION['cart_p_qty']);
   }
?>
