<?php require_once('header.php'); ?>
<?php require_once "verify.php" ?>
<?php require_once('style_login.php'); ?>
<?php require_once("assets/css/customer_form.php");?>
<style>
    .btn-success{
        background-color: #ff6a00 !important;
    }
    .btn{
        font-weight: bold;
        color: #fff !important;
    }
    .btn-info{
        background-color: #000c78 !important;
    }
    .span {
    position: relative !important;
    font-weight: bold !important;
    top: -4px !important; /* valor padrão para telas móveis */
}

/* Ajuste para telas maiores (desktop) */
@media (min-width: 1024px) {
    .span {
        top: 5px !important; /* valor para telas de desktop */
    }
}

</style>
<!-- fetching row banner login -->
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$banner_login = $row['banner_login'];
}
?>
<!-- login form -->
<?php
if(isset($_POST['form1'])) {
 

if(empty($_POST['cust_email']) || empty($_POST['cust_password'])) {
$error_message = LANG_VALUE_132.'<br>';
} else {

$cust_email = strip_tags($_POST['cust_email']);
$cust_password = strip_tags($_POST['cust_password']);

$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
$statement->execute(array($cust_email));
$total = $statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row) {
$cust_status = $row['cust_status'];
$row_password = $row['cust_password'];
}

if($total==0) {
$error_message .= LANG_VALUE_133.'<br>';
} else {
//using MD5 form
if( $row_password != md5($cust_password) ) {
$error_message .= LANG_VALUE_139.'<br>';
} else {
if($cust_status == 0) {
$error_message .= LANG_VALUE_148.'<br>';
} else {
    
$_SESSION['customer'] = $row;
// Redireciona para onde o usuário queria ir
    if (isset($_SESSION['redirect_after_login'])) {
        $destino = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']); // limpar depois de usar
        header("Location: $destino");
        exit;
    } else {
        // Caso contrário, vai para o painel
        header("location: ".URL."dashboard");
        exit;
    }
}
}

}
}
}
?>

<div class="page-banner">
    <img src="assets/uploads/<?php echo $banner_login; ?>" alt="">
<div class="inner">
<h1><?php echo LANG_VALUE_10; ?></h1>
</div>
</div>

<div class="page-login">
    <i class="fas fa-sign-in-alt"></i>
</div>
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="user-content">
<div class="login-icon">
<form action="" method="post">
<?php $csrf->echoInputField(); ?>                  
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<?php
if($error_message != '') {
echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$error_message."</div>";
}
if($success_message != '') {
echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$success_message."</div>";
}
?>

<div class="form-group">
<label for=""><?php echo LANG_VALUE_94; ?> *</label>
<input type="email" class="form-control" name="cust_email" required="True">
</div>
<div class="form-group">
<label for=""><?php echo LANG_VALUE_96; ?> *</label>
<input type="password" class="form-control" name="cust_password" required="True">
</div>
<div class="form-group">
<label for=""></label>
<input type="submit" class="btn btn-success col-md-12" value="Entrar" name="form1">
</div>
<span class="span">OU</span>
<div>
    <a href="<?=ROOT?>registration" class="btn btn-info btn-sm col-md-12 my-3" role="button">Criar Conta</a>
</div>

<div>
    <a href="<?=ROOT?>forget-password" class="my-3" style="color:#ff6a00; font-weight: bold;"><?php echo LANG_VALUE_97; ?>?</a>
</div>

</div>
</div>                        
</form>
</div>                
</div>
</div>
</div>
</div>

<?php require_once('footer.php'); ?>