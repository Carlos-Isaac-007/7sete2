<?php require_once('header.php'); ?>


<?php 

$payment_id = 0;
$name = null;
$payment_result[0]['payment_method'] = null;
$payment_result[0]['paid_amount'] = null;
$payment_result[0]['bank_transaction_info'] = null;
$payment_result[0]['payment_id'] = null;

if (isset($_GET['paymentid'])) {
    $payment_id = $_GET['paymentid'];
}

if (isset($_SESSION['customer']) && !empty($_SESSION['customer'])) {
    
    $name = $_SESSION['customer']['cust_name'];

    // Recupera dados de pagamento
    $statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_id=?");
    $statement->execute([$payment_id]);
    $payment_result = $statement->fetchAll(PDO::FETCH_ASSOC); 
}

// Recupera os dados de contato da empresa
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$settings_result = $statement->fetchAll(PDO::FETCH_ASSOC); 

foreach ($settings_result as $row) {
    $contact_map_iframe = $row['contact_map_iframe'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
    $contact_address = $row['contact_address'];
}

?>

<style>
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    color: #444;
}

h3, h4 {
    font-family: 'Helvetica', sans-serif;
    font-weight: bold;
}

.info .lead {
    font-size: 1.2em;
    color: #555;
    line-height: 1.6;
}

.info .text-dark {
    font-weight: bold;
    color: #333;
}

.card-footer .btn-details {
    background-color: #FF7F00 !important;  /* Laranja escuro */
    color: white !important;
    border-radius: 5px !important;
    padding: 10px 25px !important;
    font-size: 1em !important;
    text-decoration: none !important;
    display: inline-block !important;
    margin-top: 15px !important;
    transition: background-color 0.3s ease !important;
}

.card-footer .btn-details:hover {
    background-color: #E86A00 !important;  /* Laranja mais escuro */
}

    .page {
        background-color: #f4f6f9;
        font-family: 'Arial', sans-serif;
        padding: 20px;
    }

   .container_payment {
    background-color: white;
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}


    .info {
        margin-top: 20px;
        text-align: center;
    }

    .info h3 {
        color: #333;
        font-size: 1.6em;
        line-height: 1.5;
    }

    .btn-success {
        background-color: #25D366;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1em;
        display: inline-block;
        margin-top: 20px;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #128C7E;
    }

    .card {
        margin-top: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f1f1f1;
        padding: 15px;
        border-radius: 8px 8px 0 0;
        font-weight: bold;
        color: #333;
    }

    .card-body {
        padding: 20px;
    }

    .card-body h4 {
        font-size: 1.2em;
        color: #333;
        margin-bottom: 12px;
        font-weight: bold;
        padding: 8px;
        background-color: #f9f9f9;
        border-radius: 4px;
        margin-bottom: 15px;
        border: 1px solid #eee;
    }
    
    .card-body h4, .card-footer h4{
        margin-bottom: 10px;    
    }
    
    .card-body h4 span{
        font-weight: normal;
        color: #777;
    }
    .card-footer {
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 0 0 8px 8px;
    }

    .card-footer h4 {
        font-size: 1.1em;
        color: #555;
    }

    .card-footer span {
        color: #333;
        font-weight: normal;
    }
    .lead{
        text-align: justify;
    }
    
    @media (max-width: 767px) {
    .container_payment {
        padding: 20px;
    }

    .card-body h4 {
        font-size: 1em;
    }

    .btn-details {
        width: 100%;
        padding: 12px;
        font-size: 1.1em;
        text-align: center;
    }
}

</style>

<div class="page">
    <div class="container_payment">
        <div class="row">            
            <div class="col-md-12 info">
                <p class="lead text-muted">
                    Olá, <span class="text-dark"><?=$name?> !</span> Muito obrigado por escolher a nossa loja. Seu pedido foi recebido com sucesso e está sendo processado. Fique tranquilo, em breve você receberá um e-mail com todas as informações para acompanhar sua entrega. Agradecemos pela confiança!
                </p>
              
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados do Pedido
                    </div>
                    
                    <div class="card-body">
                        <h4><i class="fa fa-credit-card"></i> Método de pagamento: <span><?= htmlspecialchars($payment_result[0]['payment_method']) ?></span></h4>
                        <h4><i class="fas fa-money-bill-wave"></i> Valor a ser pago: <span><?= htmlspecialchars($payment_result[0]['paid_amount']) ?></span></h4>
                        <h4><i class="fa-solid fa-location-dot"></i> Localização atual: <span><?= htmlspecialchars($payment_result[0]['bank_transaction_info']) ?></span></h4>
                        <h4><i class="fa-solid fa-id-card"></i> ID do pagamento: <span><?= htmlspecialchars($payment_result[0]['payment_id']) ?></span></h4>
                        
                        <strong>Dados da Empresa</strong>
                        <h4><i class="fa-solid fa-envelope"></i> Email: <span><?= htmlspecialchars($contact_email) ?></span></h4>
                        <h4><i class="fa-solid fa-phone-volume"></i> Número de Telefone: <span><?= htmlspecialchars($contact_phone) ?></span></h4>
                        <h4><i class="fa-solid fa-location-dot"></i> Localização: <span><?= htmlspecialchars($contact_address) ?></span></h4>
                        
                    </div>
                    
                    <div class="card-footer">
                         <strong>Politica de entrega</strong>
                         <h4 class="text-info fs-5">Com base a essas informações chegaremos até você dentro de :</h4>
                         
                           <a href="<?=ROOT?>home" class="btn-details">Continuar comprando</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
