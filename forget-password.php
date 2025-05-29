<?php require_once('header.php'); ?>
<?php require_once('style_login.php'); ?>
<?php require_once("assets/css/customer_form.php");?>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$banner_forget_password = $row['banner_forget_password'];
}
?>

<?php
if(isset($_POST['form1'])) {

$valid = 1;

if(empty($_POST['cust_email'])) {
$valid = 0;
$error_message .= LANG_VALUE_131."\\n";
} else {
if (filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL) === false) {
$valid = 0;
$error_message .= LANG_VALUE_134."\\n";
} else {
$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
$statement->execute(array($_POST['cust_email']));
$total = $statement->rowCount();                        
if(!$total) {
$valid = 0;
$error_message .= LANG_VALUE_135."\\n";
}
}
}

if($valid == 1) {
$email = $_POST['cust_email'];

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);  

foreach ($result as $row) {
$forget_password_message = $row['forget_password_message'];
}

$token = md5(rand());
$now = time();

$statement = $pdo->prepare("UPDATE tbl_customer SET cust_token=?,cust_timestamp=? WHERE cust_email=?");
$statement->execute(array($token,$now,strip_tags($_POST['cust_email'])));

$mensagem = '<p>'.LANG_VALUE_142.'<br> <a href="'.ROOT.'reset-password?email='.$_POST['cust_email'].'&token='.$token.'">Clica Aqui</a>';
$nome = "Usuario_7setetech.com";
$to      = $_POST['cust_email'];
$assunto = LANG_VALUE_143;


$error_message .=  enviarEmail($email, $nome, $assunto, $mensagem);



$success_message = $forget_password_message;
}
}
?>

<div class="page-banner">
    <img src="assets/uploads/<?php echo $banner_forget_password; ?>" alt="">
<div class="inner">
<h1><?php echo LANG_VALUE_97; ?></h1>
</div>
</div>

<div class="page">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="user-content">
<?php
if($error_message != '') {
echo '<div class="alert alert-warning">
  <strong>Aviso!</strong> '.$error_message.'
</div>';
}
if($success_message != '') {
echo '<div class="alert alert-success">
  <strong>Sucesso!</strong> '.$success_message.'
</div>';
}
?>

<h1 style="font-size: 40pt !important;"><i class="fa-solid fa-unlock-keyhole"></i></h1>
<form action="" method="post">
<?php $csrf->echoInputField(); ?>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="form-group">
<label for=""><?php echo LANG_VALUE_94; ?> *</label>
<input type="email" class="form-control" name="cust_email">
</div>
<div class="form-group">
<label for=""></label>
<input type="submit" class="btn btn-primary" value="<?php echo LANG_VALUE_4; ?>" name="form1">
</div>
<a href="<?=ROOT?>login" style="color:#e4144d;"><?php echo LANG_VALUE_12; ?></a>
</div>
</div>                        
</form>
</div>                
</div>
</div>
</div>
</div>

<?php require_once('footer.php'); ?>