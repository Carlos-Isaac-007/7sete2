<?php require_once('header.php'); ?>
<?php require_once("assets/css/customer_form.php");?>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$contact_title = $row['contact_title'];
$contact_banner = $row['contact_banner'];
}
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$contact_map_iframe = $row['contact_map_iframe'];
$contact_email = $row['contact_email'];
$contact_phone = $row['contact_phone'];
$contact_address = $row['contact_address'];
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $contact_banner; ?>);">
<div class="inner">
<h1><?php echo $contact_title; ?></h1>
</div>
</div>

<div class="page">
<div class="container">
<div class="row">            
<div class="col-md-12">
<h3><i class="fa-solid fa-headset"></i> Formalario de Contacto</h3>
<div class="row cform">
<div class="col-md-8">
<div class="well well-sm">

<?php
// After form submit checking everything for email sending
if(isset($_POST['form_contact']))
{
$error_message = '';
$success_message = '';
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) 
{
$receive_email = $row['receive_email'];
$receive_email_subject = $row['receive_email_subject'];
$receive_email_thank_you_message = $row['receive_email_thank_you_message'];
}

$valid = 1;

if(empty($_POST['visitor_name']))
{
$valid = 0;
$error_message .= 'Digite o teu nome.\n';
}

if(empty($_POST['visitor_phone']))
{
$valid = 0;
$error_message .= 'Digite o numero de telefone.\n';
}


if(empty($_POST['visitor_email']))
{
$valid = 0;
$error_message .= 'Digite o teu email.\n';
}
else
{
// Email validation check
if(!filter_var($_POST['visitor_email'], FILTER_VALIDATE_EMAIL))
{
$valid = 0;
$error_message .= 'Digite um eamil valido.n';
}
}

if(empty($_POST['visitor_message']))
{
$valid = 0;
$error_message .= 'Digite a tua mensagem.\n';
}

if($valid == 1)
{

$visitor_name = strip_tags($_POST['visitor_name']);
$visitor_email = strip_tags($_POST['visitor_email']);
$visitor_phone = strip_tags($_POST['visitor_phone']);
$visitor_message = strip_tags($_POST['visitor_message']);

// sending email
$to_admin =  $receive_email;
$subject = $receive_email_subject;
$message = '
<html><body>
<table>
<tr>
<td>Name</td>
<td>'.$visitor_name.'</td>
</tr>
<tr>
<td>Email</td>
<td>'.$visitor_email.'</td>
</tr>
<tr>
<td>Phone</td>
<td>'.$visitor_phone.'</td>
</tr>
<tr>
<td>Comment</td>
<td>'.nl2br($visitor_message).'</td>
</tr>
</table>
</body></html>
';


$nome = $visitor_name;
// Sending email to admin                  
$success_message .= enviarEmail($to_admin, $nome, $subject, $message);

$success_message = $receive_email_thank_you_message;

}
}
?>


<?php
if($error_message != '') {
echo '<div class="alert alert-warning">
  <strong>Alerta!</strong> '.$error_message.'.
</div>';
}
if($success_message != '') {
echo '<div class="alert alert-success">
  <strong>Success!</strong> '.$success_message.'.
</div>';
}
?>



<form action="" method="post">
<?php $csrf->echoInputField(); ?>
<div class="row">
    
<div class="col-md-6">
<div class="form-group">
<label for="name">Nome</label>
<input type="text" class="form-control" name="visitor_name" placeholder="Digite o nome">
</div>
<div class="form-group">
<label for="email">Email </label>
<input type="email" class="form-control" name="visitor_email" placeholder="Digite o Email">
</div>
<div class="form-group">
<label for="email">Número de telefone</label>
<input type="text" class="form-control" name="visitor_phone" placeholder="Digite o numero de telefone">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="name">Mensagem</label>
<textarea name="visitor_message" class="form-control" rows="9" cols="25" placeholder="Digite a Mensagem"></textarea>
</div>
</div>
<div class="col-md-12">
<input type="submit" value="Enviar mensagem" class="btn btn-primary pull-right" name="form_contact">
</div>
</div>
</form>
</div>
</div>
<div class="col-md-4">
<legend><span class="glyphicon glyphicon-globe"></span> Nosso Escritório</legend>
<address>
<?php echo nl2br($contact_address); ?>
</address>
<address>
<strong>Telefone:</strong><br>
<span><?php echo $contact_phone; ?></span>
</address>
<address>
<strong>Email:</strong><br>
<a href="mailto:<?php echo $contact_email; ?>"><span><?php echo $contact_email; ?></span></a>
</address>
</div>
</div>

<!-- <h3>Nos Econtra no Mapa </h3>-->
<?php //echo $contact_map_iframe; ?>

</div>
</div>
</div>
</div>

<?php require_once('footer.php'); ?>