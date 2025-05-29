<?php

header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('database.php'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../admin/inc/vendor/autoload.php';
// funcao que vai enviar o email com php mailer

function enviarEmail($destinatario, $nomeDestinatario, $assunto, $mensagem)
 {
    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Servidor SMTP da Hostinger
        $mail->SMTPAuth   = true;
        $mail->Username   = 'suporte@7setetech.com'; // Seu e-mail profissional
        $mail->Password   = 'Cliente7!'; // Sua senha de e-mail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
        $mail->Port       = 465; // Porta SMTP (SSL: 465, TLS: 587)
        // Definições de Codificação
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        // Configuração do e-mail
        $mail->setFrom('suporte@7setetech.com', '7SeteTech');
        $mail->addAddress($destinatario, $nomeDestinatario);
        $mail->addReplyTo('suporte@7setetech.com', 'Suporte');

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = nl2br($mensagem);
        $mail->AltBody = strip_tags($mensagem); // Texto alternativo sem HTML

        // Enviar e-mail
        $mail->send();
        return "✅ E-mail enviado para $destinatario!";
    } catch (Exception $e) {
        return "❌ Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}
$feedback = ["success" => false, "message" => "", "paymentid" => ""];

// Lê o corpo JSON da requisição
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $customer_id = $data['cust_id'] ?? '';
    $customer_name = $data['cust_name'] ?? '';
    $customer_email = $data['cust_email'] ?? '';
    $transaction_info = $data['location_now'] ?? '';
    $final_total = $data['final_total'] ?? '0';
    $cart = $data['cart'] ?? [];
  
    if (!$customer_id || !$customer_name || !$customer_email || !$transaction_info || !$final_total || empty($cart)) {
        $feedback['message'] = "Dados incompletos para processar o pedido.";
        echo json_encode($feedback);
        exit;
    }

    try {
        $payment_date = date('Y-m-d H:i:s');
        $payment_id = time();

        // Inserir pagamento
        $stmt = $pdo->prepare("INSERT INTO tbl_payment (
            customer_id, customer_name, customer_email, payment_date,
            txnid, paid_amount, card_number, card_cvv, card_month, card_year,
            bank_transaction_info, payment_method, payment_status, shipping_status, payment_id
        ) VALUES (?, ?, ?, ?, '', ?, '', '', '', '', ?, 'Transferência', 'Pending', 'Pending', ?)");

        $stmt->execute([
            $customer_id,
            $customer_name,
            $customer_email,
            $payment_date,
            $final_total,
            $transaction_info,
            $payment_id
        ]);

        // Inserir pedidos (itens do carrinho)
        foreach ($cart as $item) {
            $stmt = $pdo->prepare("INSERT INTO tbl_order (
                product_id, product_name, size, color, quantity, unit_price, payment_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $item['id'],               // product_id
                $item['name'],             // product_name
                $item['selectedSize'] ?? '', // size
                $item['selectedColor'] ?? '', // color
                $item['quantity'],         // quantity
                $item['price'],            // unit_price
                $payment_id
            ]);

            // Atualiza o estoque
            $stmt = $pdo->prepare("UPDATE tbl_product SET p_qty = p_qty - ? WHERE p_id = ?");
            $stmt->execute([$item['quantity'], $item['id']]);
        }

        // Notificação no admin
        $mensagem = "Novo pedido recebido! Verifique os detalhes.";
        $stmt = $pdo->prepare("INSERT INTO notificacoes (mensagem) VALUES (:mensagem)");
        $stmt->execute(['mensagem' => $mensagem]);

        // E-mail
     
        $fase = "processamento";
        $link_ativacao = "https://7setetech.com/ver_produto_statu?fase=$fase";
        $assunto = "Estamos processando o seu pedido!";
        $mensagemEmail = "Olá, $customer_name. Recebemos o seu pedido!\n\n"
            . "Id do Pedido: [$payment_id]\n\n"
            . "Acompanhe aqui: $link_ativacao";

        enviarEmail($customer_email, $customer_name, $assunto, $mensagemEmail);

        $feedback['success'] = true;
        $feedback['message'] = "Olá $customer_name, seu pedido foi recebido com sucesso!";
        $feedback['paymentid'] = $payment_id;

    } catch (Exception $e) {
        $feedback['message'] = "Erro ao processar: " . $e->getMessage();
    }
} else {
    $feedback['message'] = "Dados inválidos.";
}

echo json_encode($feedback);
