<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../admin/inc/vendor/autoload.php';
require_once('../admin/inc/config.php');

// Funções auxiliares
function sanitize($input) {
    return strip_tags(trim($input));
}

function enviarEmail($destinatario, $nomeDestinatario, $assunto, $mensagem) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'suporte@7setetech.com';
        $mail->Password   = 'Cliente7!';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->setFrom('suporte@7setetech.com', '7SeteTech');
        $mail->addAddress($destinatario, $nomeDestinatario);
        $mail->addReplyTo('suporte@7setetech.com', 'Suporte');
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = nl2br($mensagem);
        $mail->AltBody = strip_tags($mensagem);
        $mail->send();
        return "✅ E-mail enviado para $destinatario!";
    } catch (Exception $e) {
        return "❌ Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}

// Recebe dados JSON
$data = json_decode(file_get_contents('php://input'), true);
$valid = 1;
$error_message = '';

// Validações básicas
if (empty($data['nome'])) {
    $valid = 0;
    $error_message .= 'Nome é obrigatório.';
}
if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $valid = 0;
    $error_message .= 'E-mail inválido.';
} else {
    $stmt = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email = ?");
    $stmt->execute([sanitize($data['email'])]);
    if ($stmt->rowCount() > 0) {
        $valid = 0;
        $error_message .= 'Este e-mail já está em uso.';
    }
}
if (empty($data['telefone'])) {
    $valid = 0;
    $error_message .= 'Telefone é obrigatório.';
}

if (empty($data['senha']) || strlen($data['senha']) < 4) {
    $valid = 0;
    $error_message .= 'A senha deve ter pelo menos 4 caracteres.';
}
if (!isset($data['confirmarSenha']) || $data['senha'] !== $data['confirmarSenha']) {
    $valid = 0;
    $error_message .= 'As senhas não coincidem.';
}

if ($valid === 1) {
    try {

        $token = md5(time());
        $cust_datetime = date('Y-m-d H:i:s');
        $cust_timestamp = time();

        // Prepara e executa inserção
        $stmt = $pdo->prepare("INSERT INTO tbl_customer (
            cust_name, cust_email, cust_phone, cust_password, cust_token,
            cust_datetime, cust_timestamp, cust_status, last_activity
        ) VALUES (?,?,?,?,?,?,?,?,?)");

        $stmt->execute([
            sanitize($data['nome']), sanitize($data['email']), sanitize($data['telefone']),
            md5($data['senha']), $token, $cust_datetime, $cust_timestamp, 0, $cust_datetime
        ]);

        // Envia e-mail de ativação
        if ($stmt->rowCount() > 0) {
            $link_ativacao = "https://7setetech.com/verify?token=$token&email={$data['email']}";
            $assunto = "Confirme seu cadastro";
            $mensagem = "Olá {$data['nome']},\n\nClique no link para ativar sua conta:\n$link_ativacao";

            $envio = enviarEmail($data['email'], $data['nome'], $assunto, $mensagem);

            echo json_encode([
                'status' => 'success',
                'message' => "Conta criada com sucesso. Email de ativação enviado.",
                'email_status' => $envio
            ]);
            exit;
        } else {
            throw new Exception("Erro ao salvar dados no banco.");
        }

    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao processar o cadastro: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => $error_message
    ]);
}
