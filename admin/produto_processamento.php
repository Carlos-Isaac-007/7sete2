<?php require_once('header.php'); ?>
<?php

if($_GET["current_email"]) {
  
   
    $email = $_GET["current_email"];
    $fase = $_GET['fase'];

    if (empty($email)) {
        echo "❌ Erro: E-mail não recebido.";
        exit;
    }

   
        $link_ativacao = "https://7setetech.com/verify.php?email=$email";

        // Assunto e mensagem do e-mail
        $assunto = "Confirme seu cadastro";
        $mensagem = "Olá $email,\n\nClique no link para ativar sua conta:\n$link_ativacao";

        // Cabeçalhos do e-mail
        $headers = "From: no-reply@7setetech.com\r\n";
        $headers .= "Reply-To: suporte@7setetech.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Enviar e-mail
        if (mail($email, $assunto, $mensagem, $headers)) {
            echo  "Registro bem-sucedido! Verifique seu e-mail.";
            die;
        } else {
            echo  "Erro ao enviar e-mail!";
            error_log("Erro ao enviar e-mail para: $email");
            die;
        }
    
} else {
    echo "Acesso negado.";
}
?>

