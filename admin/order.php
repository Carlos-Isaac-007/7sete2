
<?php require_once('header.php'); ?>

<?php
// pegando email do cliente logado para trocar ideia


$error_message = '';
// codigo php que vai enviar email assim que clicar em pedido em processamento
if (isset($_POST['Processar_p'])){
  
    $email = $_POST["current_customer_email"];
    $nome = $_POST["current_customer_name"];
    $current_payment_id = $_POST['current_payment_id'];
    $current_payment_method = $_POST['current_payment_method'];
    $fase = "processamento";
    $NOME_EMPRESA = NOME_EMPRESA;

    if (empty($email)) {
        echo "❌ Erro: E-mail não recebido.";
        exit;
    }

    $link_ativacao = URL."ver_produto_statu?fase=$fase";
    $assunto = " Estamos processando o seu pedido!";
    $mensagem = "Olá, $nome. Recebemos o seu pedido e já estamos a prepará-lo com todo o cuidado. Nossa equipa está a garantir que tudo esteja perfeito para o envio. \n\n Aqui estão os detalhes do seu pedido: \n\n Id Produto: [$current_payment_id]  \n\n  Forma de Pagamento: [$current_payment_method ] : \n\n Assim que o seu pedido for enviado, avisaremos imediatamente! \n\n Se tiver alguma dúvida, estamos à disposição. \n\n Obrigado por escolher a [$NOME_EMPRESA]";

    $error_message .=  enviarEmail($email, $nome, $assunto, $mensagem); 
}
// codigo php prara enviar email assim que o usuario clicar em produto a caminho
if (isset($_POST['caminho_p'])){
  
    $email = $_POST["current_customer_email"];
    $nome = $_POST["current_customer_name"];
     $current_payment_id = $_POST['current_payment_id'];
     $current_payment_method = $_POST['current_payment_method'];
    $fase = "caminho";
     $NOME_EMPRESA = NOME_EMPRESA;

    if (empty($email)) {
        echo "❌ Erro: E-mail não recebido.";
        exit;
    }

    $link_ativacao = URL."ver_produto_statu?fase=$fase";
    $assunto = "O seu pedido está a caminho!!";
    $mensagem = "Olá, $nome. Boas notícias! O seu pedido já saiu para entrega e logo estará nas suas mãos. \n\n Aqui estão os detalhes do seu pedido: \n\n Id Produto: [$current_payment_id]  \n\n Forma de Pagamento: [$current_payment_method ] : \n\n Pode acompanhar o status do seu pedido clicando no link abaixo: \n$link_ativacao \n\n Prepare-se para receber o seu produto em breve! \n\n Se precisar de algo, conte connosco. \n\n Obrigado por confiar na [$NOME_EMPRESA]\n ";

    $error_message .=  enviarEmail($email, $nome, $assunto, $mensagem); 
    
}


?>

<?php
    // Enviar ebook
if (isset($_POST['send_ebook'])) {
    $email     = $_POST['current_customer_email'] ?? '';
    $nome      = $_POST['current_customer_name'] ?? '';
    $paymentId = $_POST['current_payment_id'] ?? '';

    if (empty($email)) {
        $error_message .= "❌ E-mail do cliente não encontrado.";
    } else {
        // Monte aqui a URL de download do seu ebook. Pode ser dinâmica:
        $ebookUrl = URL . "assets/uploads/ebooks/619362293_1746879036.pdf";

        $assunto  = "📚 Seu Ebook está disponível!";
        $mensagem = "Olá, $nome!\n\n"
                  . "Obrigado pela sua compra. Você pode baixar seu ebook clicando no link abaixo:\n"
                  . "$ebookUrl\n\n"
                  . "Se tiver dúvidas, estamos à disposição.\n\n"
                  . "– " . NOME_EMPRESA;

        $ret = enviarEmail($email, $nome, $assunto, $mensagem);
        if ($ret === true) {
            $success_message .= "✅ Ebook enviado para $email com sucesso!";
        } else {
            $error_message .= "❌ Erro ao enviar ebook: $ret";
        }
    }
}

?>
<section class="content-header">

<div class="content-header-left">
<h1>Ver pedidos</h1>
</div>


</section>

<?php if($error_message != ''):?>
 <div class="alert alert-warning text-center">
 <b  style="color: black;" id="resultado"><?=$error_message?></b>
</div>
<?php endif?>

<?php if($success_message != ''):?>
 <div class="alert alert-warning text-center">
 <b  style="color: black;" id="resultado"><?=$success_message?></b>
</div>
   
<?php endif?>

<section class="content">

<div class="row">
<div class="col-md-12">


<div class="box box-info">

<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th>#</th>
<th>Cliente</th>
<th>Detalhes do produto</th>
<th>
Informações de pagamento
</th>
<th>Valor pago</th>
<th>Status de pagamento</th>
<th>Status de envio</th>
<th>Ação</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$statement = $pdo->prepare("SELECT * FROM tbl_payment INNER JOIN tbl_customer ON tbl_payment.customer_id = tbl_customer.cust_id ORDER by tbl_payment.id DESC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
						
foreach ($result as $row) {
$i++;
?>
<tr class="<?php if($row['payment_status']=='Pending'){echo 'bg-r';}else{echo 'bg-g';} ?>">
<td><?php echo $i; ?></td>
<td>

<b>Nome:</b> <?php echo $row['customer_name']; ?><br>
<b>Email:</b> <?php echo $row['customer_email']; ?><br>
<b>Telefone:</b> <?php echo $row['cust_phone']; ?><br>

<b>Municipio:</b> <?php echo $row['cust_b_city']; ?><br>
<b>Bairro:</b> <?php echo $row['cust_b_state']; ?><br>
<b>Endereço:</b> <?php echo $row['cust_b_address']; ?><br>
<b>Localização Atual:</b> <span class="text-danger" ><b><?php echo ucfirst($row['bank_transaction_info']); ?></b></span><br><br>
<?php if($row['payment_status']=='Completed'):?>

 <?php else:?>
<form action="" method="post">
<input type="hidden" name="current_customer_email" value="<?= $row['customer_email']?>">
<input type="hidden" name="current_customer_name" value="<?php echo $row['customer_name']; ?>">
<input type="hidden" name="current_payment_id" value="<?php echo $row['payment_id']; ?>">

<input type="hidden" name="current_payment_method" value="<?php echo $row['payment_method']; ?>">

<button type="submit" name="Processar_p" class="btn btn-info btn-xs " style="width:100%;margin-bottom:8px;color:black;">Produto em Processamento</button>

<button type="submit" name="caminho_p" class="btn btn-warning btn-xs " style="width:100%;margin-bottom:8px;">Produto a caminho</button>

</form>
 <?php endif?>   

</td>
<td >
<?php


$statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
$statement1->execute(array($row['payment_id']));
$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
foreach ($result1 as $row1) {
echo '<b>Producto:</b> '.$row1['product_name'];
echo '<br>(<b>Tamanho:</b> '.$row1['size'];
echo ', <b>Cor:</b> '.$row1['color'].')';
echo '<br>(<b>Quantidade:</b> '.$row1['quantity'];
echo ', <b>Preço Unitário:</b> '.$row1['unit_price'].')';
echo '<br><br>';

}

?>
</td>
<td>
<?php if($row['payment_method'] == 'Dinheiro'): ?>

<b>Metodo de Pagamento:</b> <?php echo '<span style="color:red;"><b>'.$row['payment_method'].'</b></span>'; ?><br>
<b>ID de pagamento:</b> <?php echo $row['payment_id']; ?><br>
<b>Data:</b> <?php echo $row['payment_date']; ?><br>
<b>Enviado á:</b> <?php echo timeAgo($row['payment_date']); ?><br>

<?php elseif($row['payment_method'] == 'Transferência'): ?>

<b>Metodo de Pagamento:</b> <?php echo '<span style="color:red;"><b>'.$row['payment_method'].'</b></span>'; ?><br>
<b>ID de pagamento:</b> <?php echo $row['payment_id']; ?><br>
<b>Data:</b> <?php echo $row['payment_date']; ?><br>
<b>Enviado á:</b> <?php echo timeAgo($row['payment_date']); ?><br>

<b>Informações de transação:</b> <br><?php echo $row['bank_transaction_info']; ?><br>
<?php endif; ?>
</td>
<td><?php echo $row['paid_amount']; ?>KZ</td>
<td>
<?php echo $row['payment_status']; ?>
<br><br>
<?php
if($row['payment_status']=='Pending'){
?>

<a href="order-change-status.php?id=<?php echo $row['id']; ?>&task=Completed&current_email=<?=$row['customer_email']?>&current_name=<?=$row['customer_name']?>&paymentid=<?=$row['payment_id']?>&productid=<?=$row1['product_id']?>&cust_id=<?=$row['cust_id']?>" class="btn btn-success btn-xs" style="width:100%;margin-bottom:8px;">Marcar como concluído</a>
<form method="post" style="margin-bottom:4px;">
  <input type="hidden" name="current_customer_email" value="<?= htmlspecialchars($row['customer_email']) ?>">
  <input type="hidden" name="current_customer_name"  value="<?= htmlspecialchars($row['customer_name']) ?>">
  <input type="hidden" name="current_payment_id"     value="<?= htmlspecialchars($row['payment_id']) ?>">
  <button type="submit" name="send_ebook" class="btn btn-primary btn-xs" style="width:100%;">
    Enviar Ebook
  </button>
</form>
<?php
}

?>
</td>
<td>
<?php echo $row['shipping_status']; ?>
<br><br>
<?php
if($row['payment_status']=='Completed') {
if($row['shipping_status']=='Pending'){
?>
<a href="shipping-change-status.php?id=<?php echo $row['id']; ?>&task=Completed" class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">Marcar como concluído</a>
<form method="post" style="margin-bottom:4px;">
  <input type="hidden" name="current_customer_email" value="<?= htmlspecialchars($row['customer_email']) ?>">
  <input type="hidden" name="current_customer_name"  value="<?= htmlspecialchars($row['customer_name']) ?>">
  <input type="hidden" name="current_payment_id"     value="<?= htmlspecialchars($row['payment_id']) ?>">
  <button type="submit" name="send_ebook" class="btn btn-primary btn-xs" style="width:100%;">
    Enviar Ebook
  </button>
</form>
<?php
}
}
?>
</td>
<td>
<a href="#" class="btn btn-danger btn-xs" data-href="order-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete" style="width:100%;">Apagar</a>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>


</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Confirmar o Apagamento</h4>
</div>
<div class="modal-body">
Tem certeza de que deseja excluir este item?
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
<a class="btn btn-danger btn-ok">Apagar</a>
</div>
</div>
</div>
</div>




<?php require_once('footer.php'); ?>