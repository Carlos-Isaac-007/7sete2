<?php require_once('header.php'); ?>

<?php
if( !isset($_GET['id']) || !isset($_GET['task']) ) {
   
	header('location: logout.php');
	exit;
} else {
	
	$email = $_GET["current_email"];
    $nome = $_GET["current_name"];
    $current_payment_id = $_GET['paymentid'];
    $cliente_id = $_GET['cust_id'];
    $product_id = $_GET['productid'];
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
		$link_ativacao = URL."ver_produto_statu?fase=$fase&cliente_id=$cliente_id&product_id=$product_id";
		$assunto = "O seu pedido foi entregue!";
		$mensagem = "Olá, $nome. O seu pedido foi entregue com sucesso! Esperamos que goste da sua compra..\n\n Aqui estão os detalhes do seu pedido: \n\n Id Produto: [$current_payment_id] \n\n Se tiver alguma dúvida ou precisar de suporte, estamos aqui para ajudar. Além disso, adoraríamos saber a sua opinião sobre a sua experiência. Deixe-nos um feedback clicando no link abaixo \n\n Clique no link para avaliação: \n$link_ativacao";
	
		 enviarEmail($email, $nome, $assunto, $mensagem);
	}

	header('location: order.php');
	exit;
	
?>