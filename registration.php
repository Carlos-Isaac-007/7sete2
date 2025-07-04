<?php require_once('header.php'); ?>
<?php require_once('style_login.php'); ?>
<style>
  /* Estilo base da página */
  
/* style_register.css */
.form-register {
  max-width: 500px;
  margin: 0 auto;
  background-color: #fff;
  padding: 2rem 2rem 2.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.form-register h3 {
  text-align: center;
  margin-bottom: 1.5rem;
  font-weight: bold;
  color: #333;
}

.form-register .form-group {
  margin-bottom: 1.2rem;
}

.form-register label {
  display: block;
  margin-bottom: 0.4rem;
  font-weight: 500;
  color: #333;
}

.form-register input[type="text"],
.form-register input[type="email"],
.form-register input[type="password"],
.form-register input[type="tel"],
.form-register textarea,
.form-register select {
  width: 100%;
  padding: 0.7rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  transition: border 0.2s ease;
  font-size: 16px;
}

.form-register input:focus,
.form-register select:focus,
.form-register textarea:focus {
  border-color: #FF9900; /* cor do botão amazon */
  outline: none;
}

.form-register button[type="submit"] {
  width: 100%;
  padding: 0.75rem;
  background-color: #e55300;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 4px;
  transition: background-color 0.3s;
  font-size: 16px;
}

.form-register button[type="submit"]:hover {
  background-color: #e68a00;
}
.btn-secondary {
  width: 100%;
  margin-top: 0.8rem;
  padding: 0.75rem;
  background-color: #000c78 !important;
  color: #fff;
  font-weight: 500;
  border: none !important;
  border-radius: 4px !important;
  transition: background-color 0.3s;
  cursor: pointer;
  font-size: 16px;
}

.btn-secondary:hover {
  background-color:rgba(0, 12, 120, 0.86)!important;
}

.error,
.success {
  margin-bottom: 1rem;
  padding: 0.8rem;
  border-radius: 4px;
}

.error {
  background-color: #fdecea;
  color: #b94a48;
}

.success {
  background-color: #e6f9ed;
  color: #3c763d;
}

</style>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$banner_registration = $row['banner_registration'];
}
?>

<?php
if (isset($_POST['form1'])) {
    //echo "<pre>";
  // print_r($_POST);
  //  die;
$valid = 1;

if(empty($_POST['cust_name'])) {
$valid = 0;
$error_message .= LANG_VALUE_123."<br>";
}

if(empty($_POST['cust_email'])) {
$valid = 0;
$error_message .= LANG_VALUE_131."<br>";
} else {
if (filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL) === false) {
$valid = 0;
$error_message .= LANG_VALUE_134."<br>";
} else {
$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
$statement->execute(array($_POST['cust_email']));
$total = $statement->rowCount();                            
if($total) {
$valid = 0;
$error_message .= LANG_VALUE_147."<br>";
}
}
}

if(empty($_POST['cust_phone'])) {
$valid = 0;
$error_message .= LANG_VALUE_124."<br>";
} else{
$error_message .= validarTelefone($_POST['cust_phone']);
 if($error_message != null){
        $valid = 0;
    }
}

if( empty($_POST['cust_password']) || empty($_POST['cust_re_password']) ) {
$valid = 0;
$error_message .= LANG_VALUE_138."<br>";
} else{
$error_message .= validarSenha($_POST['cust_password']);
    if($error_message != null){
        $valid = 0;
    }
}

if( !empty($_POST['cust_password']) && !empty($_POST['cust_re_password']) ) {
if($_POST['cust_password'] != $_POST['cust_re_password']) {
$valid = 0;
$error_message .= LANG_VALUE_139."<br>";
}
}

if($valid == 1) {
    // variavel aleatoria para prechecr a mais tarde
$_POST['cust_cname'] = "none";
$_POST['cust_zip'] = "none";
$token = md5(time());
date_default_timezone_set('Africa/Luanda');
$cust_datetime = date('Y-m-d H:i:s');
$cust_timestamp = time();

// saving into the database
$statement = $pdo->prepare("INSERT INTO tbl_customer (
cust_name,
cust_cname,
cust_email,
cust_phone,
cust_zip,
cust_b_name,
cust_b_cname,
cust_b_phone,
cust_b_country,
cust_b_address,
cust_b_city,
cust_b_state,
cust_b_zip,
cust_s_name,
cust_s_cname,
cust_s_phone,
cust_s_country,
cust_s_address,
cust_s_city,
cust_s_state,
cust_s_zip,
cust_password,
cust_token,
cust_datetime,
cust_status,
cust_timestamp,
last_activity
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$statement->execute(array(
strip_tags($_POST['cust_name']),
strip_tags($_POST['cust_cname']),
strip_tags($_POST['cust_email']),
strip_tags($_POST['cust_phone']),
strip_tags($_POST['cust_zip']),
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
md5($_POST['cust_password']),
$token,
$cust_datetime,
0,
$cust_timestamp,
$cust_datetime
));

// Send email for confirmation of the account
if ($statement->rowCount()>0){
    $nome = $_POST['cust_name'];
    $email = $_POST['cust_email'];
    // Link de ativação no servidor
        $link_ativacao = "https://7setetech.com/login?token=$token&email=$email";

        // Assunto e mensagem do e-mail
        $assunto = "Confirme seu cadastro";
        $mensagem = "Olá $nome,\n\nClique no link para ativar sua conta:\n$link_ativacao";

        // Cabeçalhos do e-mail
        $headers = "From: no-reply@7setetech.com\r\n";
        $headers .= "Reply-To: suporte@7setetech.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Enviar e-mail
         $error_message .=  enviarEmail($email, $nome, $assunto, $mensagem);
}

unset($_POST['cust_name']);
unset($_POST['cust_cname']);
unset($_POST['cust_email']);
unset($_POST['cust_phone']);
unset($_POST['cust_address']);
unset($_POST['cust_city']);
unset($_POST['cust_state']);
unset($_POST['cust_zip']);

$success_message = LANG_VALUE_152;

}
}
?>

<div class="page-banner">
    <img src="assets/uploads/<?php echo $banner_registration; ?>" alt="">
<div class="inner">
<h1><?php echo LANG_VALUE_16; ?></h1>
</div>
</div>

<div class="page">
<div class="container">


<div class="form-register">
<h3><i class="fas fa-user-circle"></i> Formulário de Registro</h3>
<form action="" method="post">
<?php $csrf->echoInputField(); ?>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

<?php
if($error_message != '') {
echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$error_message."</div>";
}
if($success_message != '') {
echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$success_message."</div>";
}
?>

<div class="form-group">
<label for=""><?php echo LANG_VALUE_102; ?> </label>
<input type="text" class="form-control" name="cust_name" value="<?php if(isset($_POST['cust_name'])){echo $_POST['cust_name'];} ?>" placeholder="Digite o seu nome" required="True">
</div>

<div class="form-group">
<label for=""><?php echo LANG_VALUE_94; ?> </label>
<input type="email" class="form-control" name="cust_email" value="<?php if(isset($_POST['cust_email'])){echo $_POST['cust_email'];} ?>" placeholder="exemplo@gmail.com" required="True">
</div>
<div class="form-group">
<label for=""><?php echo LANG_VALUE_104; ?> </label>
<input type="tel" class="form-control" name="cust_phone" value="<?php if(isset($_POST['cust_phone'])){echo $_POST['cust_phone'];} ?>"   required="True">
</div>

<style>
  .field-icon {
    position: absolute;
    top: 28px;
    right: 15px;
    cursor: pointer;
    z-index: 2;
    color: #999;
    font-size: 12pt;
    margin: auto 0;
  }
</style>

<div class="form-group position-relative">
  <label for=""><?php echo LANG_VALUE_96; ?> *</label>
  <input type="password" class="form-control" name="cust_password" id="cust_password" placeholder="exemplo: 7Sete@" required>
  <span toggle="#cust_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</div>
<!-- Campo de Confirmar Senha -->
<div class="form-group position-relative">
  <label for="">Confirmar Senha </label>
  <input type="password" class="form-control" name="cust_re_password" id="cust_re_password" placeholder="Confirme a sua senha" required>
  <span toggle="#cust_re_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</div>

<button type="submit"  value="<?php echo LANG_VALUE_15; ?>" name="form1" required="True">Registrar</button>
<button type="button" onclick="window.location.href='https://7setetech.com/login.php'" class="btn-secondary">
    Já tenho uma conta
</button>

</form>
</div>
               
</div>
</div>
<script>
        function mostrarInput() {
            var opcaoSelecionada = document.getElementById('opcao').value;
            var campoInput = document.getElementById('custom_bairro_wrapper');
            
            if (opcaoSelecionada === 'outro') {
                campoInput.classList.remove('hidden');
            } else {
                campoInput.classList.add('hidden');
            }
        }
    </script>
    <script>
      document.querySelectorAll(".toggle-password").forEach(function (eyeIcon) {
        eyeIcon.addEventListener("click", function () {
          const input = document.querySelector(this.getAttribute("toggle"));
          const type = input.getAttribute("type") === "password" ? "text" : "password";
          input.setAttribute("type", type);
          this.classList.toggle("fa-eye");
          this.classList.toggle("fa-eye-slash");
        });
      });
</script>

<?php require_once('footer.php'); ?>