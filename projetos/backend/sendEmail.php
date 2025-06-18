<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Tratamento para requisição OPTIONS (CORS pré-flight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    http_response_code(204);
    exit;
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Carregar variáveis do .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Criar instância do PHPMailer
$mail = new PHPMailer(true);

try {
    
     //captura os dados enviados pelo formulário
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Verifica se todos os campos foram enviados
    if (!isset($data['name'], $data['email'], $data['message'])) {
        echo json_encode(['success' => false, 'error' => 'Campos incompletos']);
        exit;
    }
   
    $name = $data['name'];
    $destinatario = $data['email'];
    $message = $data['message'];

    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USERNAME'];
    $mail->Password = $_ENV['SMTP_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $_ENV['SMTP_PORT'];

    // Remetente e destinatário
    $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
    $mail->addAddress($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']); // Destinatário (pode ser o mesmo do remetente)

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->isHTML(true);
    $mail->Subject = 'Nova mensagem de contacto do site';

    $mail->Body = "
        <h2>Nova mensagem recebida</h2>
        <p><strong>Nome:</strong> {$name}</p>
        <p><strong>Email:</strong> {$destinatario}</p>
        <p><strong>Mensagem:</strong><br>{$message}</p>
    ";

    $mail->AltBody = "Nova mensagem recebida\n\nNome: {$name}\nEmail: {$destinatario}\nMensagem:\n{$message}";

    $mail->send();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false]);
}
