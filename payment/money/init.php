<?php
ob_start();
session_start();

include("../../admin/inc/config.php");

include("../../admin/inc/functions.php");
// Getting all language variables into array as global variable
$customer_province = $_POST['customer_province'];
$customer_municipio = $_POST['customer_municipio'];
$customer_bairro = $_POST['customer_bairro'];
$customer_id = $_SESSION['customer']['cust_id'];

if(isset($_POST['tipo_entrega']) and $_POST['tipo_entrega'] == 'loja'){
    $final_total = $_POST['final_total'];
    $_POST['location_now'] = $_POST['location_now'];
} else{
    $final_total = $_POST['final_total_custo'];
}

$_SESSION['customer']['cust_b_country'] = $customer_province;
$_SESSION['customer']['cust_b_city'] = $customer_municipio;
$_SESSION['customer']['cust_b_state'] = $customer_bairro;

$stmt = $pdo -> prepare("UPDATE tbl_customer SET cust_b_country = :provincia, cust_b_city = :municipio, cust_b_state = :bairro WHERE cust_id = :id");
$stmt -> bindParam(':provincia', $customer_province);
$stmt -> bindParam(':municipio', $customer_municipio);
$stmt -> bindParam(':bairro', $customer_bairro);
$stmt -> bindParam(':id', $customer_id);

if ($stmt->execute()) {
    echo "Cliente atualizado com sucesso.";
} else {
    echo "Erro ao atualizar cliente.";
}

$i=1;
$statement = $pdo->prepare("SELECT * FROM tbl_language");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
define('LANG_VALUE_'.$i,$row['lang_value']);
$i++;
}
?>
<?php
if(!isset($_REQUEST['msg']) ) {

$_POST['transaction_info'] = $_POST['location_now'];
$payment_date = date('Y-m-d H:i:s');
$payment_id = time();

$statement = $pdo->prepare("INSERT INTO tbl_payment (   
customer_id,
customer_name,
customer_email,
payment_date,
txnid, 
paid_amount,
card_number,
card_cvv,
card_month,
card_year,
bank_transaction_info,
payment_method,
payment_status,
shipping_status,
payment_id
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$statement->execute(array(
$_SESSION['customer']['cust_id'],
$_SESSION['customer']['cust_name'],
$_SESSION['customer']['cust_email'],
$payment_date,
'',
$final_total,
'', 
'',
'', 
'',
$_POST['transaction_info'],
'Dinheiro',
'Pending',
'Pending',
$payment_id
));

$i=0;
foreach($_SESSION['cart_p_id'] as $key => $value) 
{
$i++;
$arr_cart_p_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_name'] as $key => $value) 
{
$i++;
$arr_cart_p_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_size_name'] as $key => $value) 
{
$i++;
$arr_cart_size_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_color_name'] as $key => $value) 
{
$i++;
$arr_cart_color_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_qty'] as $key => $value) 
{
$i++;
$arr_cart_p_qty[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_current_price'] as $key => $value) 
{
$i++;
$arr_cart_p_current_price[$i] = $value;
}

$i=0;
$statement = $pdo->prepare("SELECT * FROM tbl_product");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
$i++;
$arr_p_id[$i] = $row['p_id'];
$arr_p_qty[$i] = $row['p_qty'];
}

for($i=1;$i<=count($arr_cart_p_name);$i++) {
$statement = $pdo->prepare("INSERT INTO tbl_order (
product_id,
product_name,
size, 
color,
quantity, 
unit_price, 
payment_id
) 
VALUES (?,?,?,?,?,?,?)");
$sql = $statement->execute(array(
$arr_cart_p_id[$i],
$arr_cart_p_name[$i],
$arr_cart_size_name[$i],
$arr_cart_color_name[$i],
$arr_cart_p_qty[$i],
$arr_cart_p_current_price[$i],
$payment_id
));

// Update the stock
for($j=1;$j<=count($arr_p_id);$j++)
{
if($arr_p_id[$j] == $arr_cart_p_id[$i]) 
{
$current_qty = $arr_p_qty[$j];
break;
}
}
$final_quantity = $current_qty - $arr_cart_p_qty[$i];
$statement = $pdo->prepare("UPDATE tbl_product SET p_qty=? WHERE p_id=?");
$statement->execute(array($final_quantity,$arr_cart_p_id[$i]));

}
unset($_SESSION['cart_p_id']);
unset($_SESSION['cart_size_id']);
unset($_SESSION['cart_size_name']);
unset($_SESSION['cart_color_id']);
unset($_SESSION['cart_color_name']);
unset($_SESSION['cart_p_qty']);
unset($_SESSION['cart_p_current_price']);
unset($_SESSION['cart_p_name']);
unset($_SESSION['cart_p_featured_photo']);

// enviando notificaoes no admin
$mensagem = "Novo pedido recebido! Verifique os detalhes.";
$sql = "INSERT INTO notificacoes (mensagem) VALUES (:mensagem)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['mensagem' => $mensagem]);


// enviando aquele email bonito
$fase = "processamento";
$email = $_SESSION['customer']['cust_email'];
$nome = $_SESSION['customer']['cust_name'];
$link_ativacao = URL."ver_produto_statu?fase=$fase";

$assunto = " Estamos processando o seu pedido!";
$mensagem = "Olá, $nome. Recebemos o seu pedido e já estamos a prepará-lo com todo o cuidado. Nossa equipa está a garantir que tudo esteja perfeito para o envio. \n\n Aqui estão os detalhes do seu pedido: \n\n Id Produto: [$payment_id]  \n\n Clique no link para acompanhar: \n$link_ativacao";
    
$foi = enviarEmail($email, $nome, $assunto, $mensagem);


header('location:'.URL.'payment_success?paymentid='.$payment_id);

}
?>