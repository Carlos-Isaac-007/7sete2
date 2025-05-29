<?php require_once('header.php'); ?>

<?php
if( !isset($_GET['id']) || !isset($_GET['task']) ) {
	header('location: logout.php');
	exit;
} else {
	
	$email = $_GET["current_email"];
    $nome = $_GET["current_name"];
    $fase = "concluido";
	
	if (empty($email)) {
        echo "❌ Erro: E-mail não recebido.";
        exit;
    }
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE id=?");
	$statement->execute(array($_GET['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
// marcar produto como concluido

	$statement = $pdo->prepare("UPDATE tbl_payment SET payment_status=? WHERE id=?");
	$statement->execute(array($_GET['task'],$_GET['id']));

    if ($statement->rowCount() > 0 ){
		// enviar email de oncluido no cliente
		$link_ativacao = URL."ver_produto_statu.php?fase=$fase";
		$assunto = "Seu pedido foi concluido com sucesso!";
		$mensagem = "Olá, $nome. Seu pedido foi concluido com sucesso, obrigado por nos solicitar, volta sempre.\n\nClique no link para acompanhar: \n$link_ativacao";
	
		 enviarEmail($email, $nome, $assunto, $mensagem);
	}

	header('location: order.php');
	exit;
	
?>