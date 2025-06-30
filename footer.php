<?php


// Verifica se o conteúdo gerado é diferente do cache antes de sobrescrever
//$cached_content = ob_get_contents();
//if (!file_exists($cache_file) || $cached_content !== file_get_contents($cache_file)) {
    // Armazena a saída gerada no arquivo de cache
    //file_put_contents($cache_file, $cached_content);
//}

// Exibe o conteúdo gerado
//ob_end_flush();



$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);


foreach ($result as $row)
{
$footer_about = $row['footer_about'];
$contact_email = $row['contact_email'];
$contact_phone = $row['contact_phone'];
$contact_address = $row['contact_address'];
$footer_copyright = $row['footer_copyright'];
$total_recent_post_footer = $row['total_recent_post_footer'];
$total_popular_post_footer = $row['total_popular_post_footer'];
$newsletter_on_off = $row['newsletter_on_off'];
$before_body = $row['before_body'];
}


?>


<?php if($newsletter_on_off == 1): ?>
<section class="home-newsletter">
<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div class="single">
<?php
if(isset($_POST['form_subscribe']))
{

if(empty($_POST['email_subscribe'])) 
{
$valid = 0;
$error_message1 .= LANG_VALUE_131;
}
else
{
if (filter_var($_POST['email_subscribe'], FILTER_VALIDATE_EMAIL) === false)
{
$valid = 0;
$error_message1 .= LANG_VALUE_134;
}
else
{
$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_email=?");
$statement->execute(array($_POST['email_subscribe']));
$total = $statement->rowCount();							
if($total)
{
$valid = 0;
$error_message1 .= LANG_VALUE_147;
}
else
{
// Sending email to the requested subscriber for email confirmation
// Getting activation key to send via email. also it will be saved to database until user click on the activation link.
$key = md5(uniqid(rand(), true));

// Getting current date
$current_date = date('Y-m-d');

// Getting current date and time
$current_date_time = date('Y-m-d H:i:s');

// Inserting data into the database
$statement = $pdo->prepare("INSERT INTO tbl_subscriber (subs_email,subs_date,subs_date_time,subs_hash,subs_active) VALUES (?,?,?,?,?)");
$statement->execute(array($_POST['email_subscribe'],$current_date,$current_date_time,$key,0));

// Sending Confirmation Email
$to = $_POST['email_subscribe'];
$subject = 'Confirmação de e-mail do assinante';

// Getting the url of the verification link
$verification_url = BASE_URL.'verify.php?email='.$to.'&key='.$key;

$message = '
Obrigado pelo seu interesse em assinar nossa newsletter!<br><br>
Por favor, clique neste link para confirmar sua assinatura:
'.$verification_url.'<br><br>
Este link ficará ativo apenas por 24 horas.
';

$headers = 'From: ' . $contact_email . "\r\n" .
'Reply-To: ' . $contact_email . "\r\n" .
'X-Mailer: PHP/' . phpversion() . "\r\n" . 
"MIME-Version: 1.0\r\n" . 
"Content-Type: text/html; charset=ISO-8859-1\r\n";

// Sending the email
mail($to, $subject, $message, $headers);

// tenho que voltar aqui depois
$success_message1 = LANG_VALUE_136;

}
}
}
}
if($error_message1 != '') {
echo "<script>alert('".$error_message1."')</script>";
}
if($success_message1 != '') {
echo "<script>alert('".$success_message1."')</script>";
}
?>
<form action="" method="post">
<?php $csrf->echoInputField(); ?>
<h2><?php echo LANG_VALUE_93; ?></h2>
<div class="input-group">
<input type="email" class="form-control" placeholder="<?php echo LANG_VALUE_95; ?>" name="email_subscribe">
<span class="input-group-btn">
<button class="btn btn-theme" type="submit" name="form_subscribe"><?php echo LANG_VALUE_92; ?></button>
</span>
</div>
</div>
</form>
</div>
</div>
</div>
</section>
<?php endif; ?>




<div class="footer-bottom">
<div class="container">
<div class="row">
<div class="col-md-12 copyright">
<?php echo $footer_copyright; ?>
</div>
</div>
</div>
</div>


<a href="#" class="scrollup">
<i class="fa fa-angle-up"></i>
</a>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$stripe_public_key = $row['stripe_public_key'];
$stripe_secret_key = $row['stripe_secret_key'];
}
?>
<script src="assets/js/add-cart.js?v=<?= time(); ?>"></script>
<script src="assets/js/search.js?v=<?= time(); ?>"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>  AOS.init();</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="<?=ROOT?>assets/js/megamenu.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/owl.animate.js"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/rating.js"></script>
<script src="assets/js/jquery.touchSwipe.min.js"></script>
<script src="assets/js/bootstrap-touch-slider.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
 // converter em kz real com js
 function formatarKZ(valorTexto) {
    const valorNumerico = parseFloat(valorTexto.replace(/[^\d]/g, ''));
    return new Intl.NumberFormat('pt-AO', { 
        style: 'currency', 
        currency: 'AOA' 
    }).format(valorNumerico);
}

/// Essa vai diconverter
function reverterKZ(valorFormatado) {
    // Remove "Kz" e qualquer outra coisa não numérica (como ponto ou vírgula)
    const numero = parseFloat(valorFormatado.replace(/[^\d,-]/g, '').replace(',', '.'));
    return numero;
}

 
function confirmDelete(linkElement, event) {
  event.preventDefault(); // Impede o redirecionamento imediato

  Swal.fire({
    title: 'Tem certeza?',
    text: 'Você deseja excluir este item?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sim, excluir!',
    cancelButtonText: 'Não, cancelar!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Agora sim, redireciona para o link original
      window.location.href = linkElement.href;
    }
  });
}

$(document).ready(function () {
advFieldsStatus = $('#advFieldsStatus').val();

$('#paypal_form').hide();
$('#stripe_form').hide();
$('#bank_form').hide();

$('#advFieldsStatus').on('change',function() {
advFieldsStatus = $('#advFieldsStatus').val();
if ( advFieldsStatus == '' ) {
$('#paypal_form').hide();
$('#stripe_form').hide();
$('#bank_form').hide();
} else if ( advFieldsStatus == 'PayPal' ) {
$('#paypal_form').show();
$('#stripe_form').hide();
$('#bank_form').hide();
} else if ( advFieldsStatus == 'Stripe' ) {
$('#paypal_form').hide();
$('#stripe_form').show();
$('#bank_form').hide();
} else if ( advFieldsStatus == 'Bank Deposit' ) {
$('#paypal_form').hide();
$('#stripe_form').hide();
$('#bank_form').show();
}
});
});


$(document).on('submit', '#stripe_form', function () {
// createToken returns immediately - the supplied callback submits the form if there are no errors
$('#submit-button').prop("disabled", true);
$("#msg-container").hide();
Stripe.card.createToken({
number: $('.card-number').val(),
cvc: $('.card-cvc').val(),
exp_month: $('.card-expiry-month').val(),
exp_year: $('.card-expiry-year').val()
// name: $('.card-holder-name').val()
}, stripeResponseHandler);
return false;
});
Stripe.setPublishableKey('<?php echo $stripe_public_key; ?>');
function stripeResponseHandler(status, response) {
if (response.error) {
$('#submit-button').prop("disabled", false);
$("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
$("#msg-container").show();
} else {
var form$ = $("#stripe_form");
var token = response['id'];
form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
form$.get(0).submit();
}
}



</script>
<?php echo $before_body; ?>
</body>
</html>

