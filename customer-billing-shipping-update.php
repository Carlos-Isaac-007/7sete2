<?php require_once('header.php'); ?>
<?php require_once("assets/css/customer_form.php");?>
<?php
// Check if the customer is logged in or not
if(!isset($_SESSION['customer'])) {
header('location: '.URL.'logout');
exit;
} else {
// If customer is logged in, but admin make him inactive, then force logout this user.
$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?");
$statement->execute(array($_SESSION['customer']['cust_id'],0));
$total = $statement->rowCount();
if($total) {
header('location: '.URL.'logout');
exit;
}
}
?>

<?php
if (isset($_POST['form1'])) {
// essas sao as variavel que retirei do formulario
// nome da empresa, codigo do pais CEP
//echo "<pre>";
//print_r($_POST);
//die;

$_POST['cust_b_cname'] = "none";
$_POST['cust_b_zip'] = "none";
$_POST['cust_s_cname'] = "none";
$_POST['cust_s_zip'] = "none";
$cust_adress = $_POST['cust_b_address'];

if (!isset($_SESSION['customer']['cust_id'])) {
    die("Erro: ID do cliente não encontrado na sessão.");
}
$id = $_SESSION['customer']['cust_id'];
// update data into the database
$statement = $pdo->prepare("UPDATE tbl_customer SET 
cust_b_name=?, 
cust_b_cname=?, 
cust_b_phone=?, 
cust_b_country=?,
cust_country=?,
cust_city=?,
cust_b_address=?, 
cust_b_city=?, 
cust_b_state=?,
cust_state=?,
cust_address=? 
WHERE cust_id=?");
$statement->execute(array(
trim(strip_tags($_POST['cust_b_name'])),
trim(strip_tags($_POST['cust_b_cname'])),
trim(strip_tags($_POST['cust_b_phone'])),
trim(strip_tags($_POST['provincia'])),
trim(strip_tags($_POST['provincia'])),
trim(strip_tags($_POST['municipio'])),
trim(strip_tags($_POST['cust_b_address'])),
trim(strip_tags($_POST['municipio'])),
trim(strip_tags($_POST['bairro'])),
trim(strip_tags($_POST['bairro'])),
trim(strip_tags($cust_adress)),
$id
));  

$success_message = LANG_VALUE_122 . "Clica nesse link para continuar a compra <br>";
$success_message .= '<a name="compra" id="compra" class="btn btn-primary" href="checkout" role="button">Finalizar Compra</a>';
//echo "<pre>";
//print_r($_SESSION['customer']);
//die;
$_SESSION['customer']['cust_b_name'] = strip_tags($_POST['cust_b_name']);
$_SESSION['customer']['cust_b_cname'] = strip_tags($_POST['cust_b_cname']);
$_SESSION['customer']['cust_b_phone'] = strip_tags($_POST['cust_b_phone']);
//$_SESSION['customer']['cust_b_country'] = strip_tags($_POST['cust_b_country']);
$_SESSION['customer']['cust_b_address'] = strip_tags($_POST['cust_b_address']);
$_SESSION['customer']['cust_b_city'] = strip_tags($_POST['provincia']);
$_SESSION['customer']['cust_b_state'] = strip_tags($_POST['bairro']);
$_SESSION['customer']['cust_state'] = strip_tags($_POST['bairro']);
//$_SESSION['customer']['cust_b_zip'] = strip_tags($_POST['cust_b_zip']);

}



?>

<div class="page">
<div class="container">
<div class="row">            
<div class="col-md-12"> 
</div>
<div class="col-md-12">
<div class="user-content">
<?php
if($error_message != '') {
echo "<div class='error'>".$error_message."</div>";
}
if($success_message != '') {
echo "<div class='success'>".$success_message."</div>";
}
?>
<form action="" method="post" id="meuFormulario">
<?php $csrf->echoInputField(); ?>
<div class="row">
<div class="col-md-6 col-lg-12">
<h3><i class="fas fa-credit-card"></i> <?php echo LANG_VALUE_86; ?></h3>
<div class="form-group">
<label for=""><?php echo LANG_VALUE_102; ?></label>
<input type="text" class="form-control" name="cust_b_name" value="<?php echo $_SESSION['customer']['cust_name']; ?>">
</div>
<!--
<div class="form-group">
<label for=""><?php echo LANG_VALUE_103; ?></label>
<input type="text" class="form-control" name="cust_b_cname" value="<?php echo $_SESSION['customer']['cust_b_cname']; ?>">
</div>
<!-->
<div class="form-group">
<label for=""><?php echo LANG_VALUE_104; ?></label>
<input type="text" class="form-control" name="cust_b_phone" value="<?php echo $_SESSION['customer']['cust_phone']; ?>">
</div>
<div class="form-group">
<label for=""><?php echo LANG_VALUE_106; ?></label>
<select name="provincia" class="form-control">
 <option value="" disabled selected>Selecione sua Provincia</option>    
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

<div class="form-group">
<label for=""><?php echo LANG_VALUE_105; ?></label>
<textarea name="cust_b_address" class="form-control" cols="30" rows="10" style="height:100px;" placeholder="exemplo: 2 rua da Massanglara, perto ao viveiro"><?php echo $_SESSION['customer']['cust_b_address']; ?></textarea>
</div>

<div class="form-group">
<label for=""><?php echo LANG_VALUE_107; ?></label>
<select name="municipio" class="form-control">
<option value="" disabled selected>Selecione seu municipio</option>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_municipio ORDER BY nome ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
?>
<option value="<?php echo $row['municipio_id']; ?>"> <?php echo $row['nome']; ?> </option>
<?php
}
?>
</select>
</div>
<div class="form-group">
<label for=""><?php echo LANG_VALUE_108; ?></label>
<select name="bairro" class="form-control">
     <option value="" disabled selected>Selecione seu bairro</option>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_bairro ORDER BY nome_bairro ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
?>
<option value="<?php echo $row['nome_bairro']; ?>"> <?php echo $row['nome_bairro']; ?> </option>
<?php
}
?>
</select>
</div>
<!--
<div class="form-group">
<label for=""><?php echo LANG_VALUE_109; ?></label>
<input type="text" class="form-control" name="cust_b_zip" value="<?php echo $_SESSION['customer']['cust_b_zip']; ?>">
</div>
<!-->
</div>

</div>
<input type="submit" class="btn btn-primary" value="<?php echo LANG_VALUE_5; ?>" name="form1">
</form>
</div>                
</div>
</div>
</div>
</div>

<script>
document.getElementById('meuFormulario').addEventListener('submit', function(event) {

    // Aqui você pode fazer qualquer validação ou processamento (ex: enviar via AJAX)

    // Redireciona para outra página após o envio
    window.location.href = 'checkout'; // Altere para o link desejado
});
</script>
<?php require_once('footer.php'); ?>