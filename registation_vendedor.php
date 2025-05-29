<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$banner_registration = $row['banner_registration'];
}
?>

<?php
// verificando se o usuario esta vindo do admin ou nao
$email = "";
if(isset($_GET['email'])){
    $email = $_GET['email'];
    $_POST['seller_email'] =  $email;

}

if (isset($_POST['form11'])) {

$valid = 1;

if(empty($_POST['seller_name'])) {
$valid = 0;
$error_message .= LANG_VALUE_123."<br>";
}
if(empty($_POST['seller_cname'])) {
$valid = 0;
$error_message .=" O nome da impresa nãp pode estar vazio<br>";
}

if(empty($_POST['seller_email'])) {
$valid = 0;
$error_message .= LANG_VALUE_131."<br>";
} 

if(empty($_POST['seller_phone'])) {
$valid = 0;
$error_message .= LANG_VALUE_124."<br>";
}

if(empty($_POST['seller_country'])) {
$valid = 0;
$error_message .= LANG_VALUE_126."<br>";
}

if(empty($_POST['seller_city'])) {
$valid = 0;
$error_message .= LANG_VALUE_127."<br>";
}

if(empty($_POST['seller_state'])) {
$valid = 0;
$error_message .= LANG_VALUE_128."<br>";
}

if($valid == 1) {
    // variavel aleatoria para prechecr a mais tarde

$token = md5(time());

// saving into the database
$statement = $pdo->prepare("UPDATE tbl_user SET full_name=?, phone=?,province=?,municipio=?,bairro=?,token=?,company_name=? WHERE email=?");
$statement->execute(array($_POST['seller_name'],$_POST['seller_phone'],$_POST['seller_country'],$_POST['seller_city'],$_POST['seller_state'],$token,$_POST['seller_cname'],$email));

// Send email for confirmation of the account
if ($statement->rowCount()>0){
    $nome = $_POST['seller_name'];
   
    // Link de ativação no servidor
        $link_ativacao = "https://7setetech.com/verify_seller.php?token=$token&email=$email";

        // Assunto e mensagem do e-mail
        $assunto = "Confirme seu cadastro";
        $mensagem = "Olá $nome,\n\nClique no link para ativar sua conta:\n$link_ativacao";

        // Enviar e-mail
        $error_message .=  enviarEmail($email, $nome, $assunto, $mensagem); 
}

unset($_POST['seller_name']);
unset($_POST['seller_cname']);
unset($_POST['seller_email']);
unset($_POST['seller_phone']);
unset($_POST['seller_city']);
unset($_POST['seller_state']);


$success_message = LANG_VALUE_152;

}
}
?>

<div class="page-banner" style="background-color:#444;background-image: url(assets/uploads/<?php echo $banner_registration; ?>);">
<div class="inner">
<h1><?php echo LANG_VALUE_164; ?></h1>
</div>
</div>

<div class="page">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="user-content">



<form action="" method="post">
<?php $csrf->echoInputField(); ?>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

<?php if (isset($_GET['email'])):?>
    <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Aviso!</strong> <?= $email ?> agora só falta preencher esses campos para tua conta estar completa 
</div>
<?php endif ?>

<?php
if($error_message != '') {
echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$error_message."</div>";
}
if($success_message != '') {
echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$success_message."</div>";
}
?>

<div class="col-md-6 form-group">
<label for=""><?php echo LANG_VALUE_102; ?> *</label>
<input type="text" class="form-control" name="seller_name" value="<?php if(isset($_POST['seller_name'])){echo $_POST['seller_name'];} ?>">
</div>

<div class="col-md-6 form-group">
<label for=""><?php echo LANG_VALUE_103; ?></label>
<input type="text" class="form-control" name="seller_cname" value="<?php if(isset($_POST['seller_cname'])){echo $_POST['seller_cname'];} ?>">
</div>

<div class="col-md-6 form-group">
<label for=""><?php echo LANG_VALUE_94; ?> *</label>
<input type="email" class="form-control" name="seller_email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>">
</div>
<div class="col-md-6 form-group">
<label for=""><?php echo LANG_VALUE_104; ?> *</label>
<input type="text" class="form-control" name="seller_phone" value="<?php if(isset($_POST['seller_phone'])){echo $_POST['seller_phone'];} ?>">
</div>
<!--
<div class="col-md-12 form-group">
<label for=""><?php echo LANG_VALUE_105; ?> *</label>
<textarea name="seller_address" class="form-control" cols="30" rows="10" style="height:70px;"><?php if(isset($_POST['seller_address'])){echo $_POST['seller_address'];} ?></textarea>
</div>
-->
<div class="col-md-6 form-group">
<label for=""><?php echo LANG_VALUE_106; ?> *</label>
<select name="seller_country" class="form-control select2">
<option value="">Seleciona a Provincia</option>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
?>
<option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
<?php
}
?>    
</select>                                    
</div>

<div class="col-md-6 form-group">
<label for=""><?php echo LANG_VALUE_107; ?> *</label>
<input type="text" class="form-control" name="seller_city" value="<?php if(isset($_POST['seller_city'])){echo $_POST['seller_city'];} ?>">
</div>
<div class="col-md-6 form-group">
<label for=""><?php echo LANG_VALUE_108; ?> *</label>
<input type="text" class="form-control" name="seller_state" value="<?php if(isset($_POST['seller_state'])){echo $_POST['seller_state'];} ?>">
</div>
<!---
<div class="col-md-6 form-group">
<label for=""><?php echo LANG_VALUE_109; ?> *</label>
<input type="text" class="form-control" name="seller_zip" value="<?php if(isset($_POST['seller_zip'])){echo $_POST['seller_zip'];} ?>">
</div>
<!-->

<div class="col-md-12   form-group">
<label for=""></label>
<input type="submit" class="btn btn-danger " value="<?php echo LANG_VALUE_15; ?>" name="form11">
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