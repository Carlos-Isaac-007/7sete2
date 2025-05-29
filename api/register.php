<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../admin/inc/vendor/autoload.php';

require_once('database.php'); // Seu arquivo de conexão PDO

$data = json_decode(file_get_contents('php://input'), true);

$valid = 1;
$error_message = '';

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
// Função auxiliar para limpar dados
function sanitize($input) {
    return strip_tags(trim($input));
}

// Validações
if (empty($data['nome'])) {
    $valid = 0;
    $error_message .= 'Nome é obrigatório.<br>';
}

if (empty($data['email'])) {
    $valid = 0;
    $error_message .= 'E-mail é obrigatório.<br>';
} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $valid = 0;
    $error_message .= 'E-mail inválido.<br>';
} else {
    $stmt = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email = ?");
    $stmt->execute([sanitize($data['email'])]);
    if ($stmt->rowCount() > 0) {
        $valid = 0;
        $error_message .= 'Este e-mail já está em uso.<br>';
    }
}

if (empty($data['telefone'])) {
    $valid = 0;
    $error_message .= 'Telefone é obrigatório.<br>';
}

if (empty($data['provincia'])) {
    $valid = 0;
    $error_message .= 'Província é obrigatória.<br>';
}

if (empty($data['municipio'])) {
    $valid = 0;
    $error_message .= 'Município é obrigatório.<br>';
}

if (empty($data['bairro'])) {
    $valid = 0;
    $error_message .= 'Bairro é obrigatório.<br>';
}

if (empty($data['senha'])) {
    $valid = 0;
    $error_message .= 'Senha é obrigatória.<br>';
} elseif (strlen($data['senha']) < 6) {
    $valid = 0;
    $error_message .= 'A senha deve ter pelo menos 6 caracteres.<br>';
}

if (!isset($data['confirmarSenha']) || $data['senha'] !== $data['confirmarSenha']) {
    $valid = 0;
    $error_message .= 'As senhas não coincidem.<br>';
}

if ($valid === 1) {
    try {
        // Valores padrões
        $data['cust_cname'] = "none";
        $data['cust_zip'] = "none";

        if ($data['bairro'] == 'Outro') {
            $data['cust_state'] = $data['outroBairro'];
            $data['cust_address'] = $data['provincia'] . "," . $data['outroBairro'] . "," . $data['municipio'];

            // Inserção do novo bairro
            $stmt = $pdo->prepare("INSERT INTO tbl_bairro (province_id, municipio_id, nome_bairro) VALUES (?, ?, ?)");
            $stmt->execute([sanitize($data['provincia']), sanitize($data['municipio']), sanitize($data['outroBairro'])]);

            // Notificação
            $mensagem = "Novo bairro Adicionado! Adicione o custo de envio.";
            $stmt = $pdo->prepare("INSERT INTO notificacoes (mensagem) VALUES (:mensagem)");
            $stmt->execute(['mensagem' => $mensagem]);
        } else {
            $data['cust_state'] = $data['bairro'];
            $data['cust_address'] = $data['provincia'] . "," . $data['bairro'] . "," . $data['municipio'];
        }

        $token = md5(time());
        $cust_datetime = date('Y-m-d H:i:s');
        $cust_timestamp = time();

        $stmt = $pdo->prepare("INSERT INTO tbl_customer (
            cust_name, cust_cname, cust_email, cust_phone, cust_country, cust_address, cust_city,
            cust_state, cust_zip, cust_b_name, cust_b_cname, cust_b_phone, cust_b_country, cust_b_address,
            cust_b_city, cust_b_state, cust_b_zip, cust_s_name, cust_s_cname, cust_s_phone, cust_s_country,
            cust_s_address, cust_s_city, cust_s_state, cust_s_zip, cust_password, cust_token, cust_datetime,
            cust_timestamp, cust_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->execute([
            sanitize($data['nome']), sanitize($data['cust_cname']), sanitize($data['email']), sanitize($data['telefone']),
            sanitize($data['provincia']), sanitize($data['cust_address']), sanitize($data['municipio']), sanitize($data['cust_state']),
            sanitize($data['cust_zip']), '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
            md5($data['senha']), // Dica: use password_hash em vez de md5 para mais segurança
            $token, $cust_datetime, $cust_timestamp, 1
        ]);
        
        if ($stmt->rowCount()>0){
            $nome = $data['nome'];
            $email = $data['email'];
            // Link de ativação no servidor
                $link_ativacao = "https://7setetech.com/verify?token=$token&email=$email";
        
                // Assunto e mensagem do e-mail
                $assunto = "Confirme seu cadastro";
                $mensagem = "Olá $nome,\n\nClique no link para ativar sua conta:\n$link_ativacao";
        
                // Cabeçalhos do e-mail
                $headers = "From: no-reply@7setetech.com\r\n";
                $headers .= "Reply-To: suporte@7setetech.com\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
                // Enviar e-mail
                 $error_message .=  enviarEmail($email, $nome, $assunto, $mensagem);
        }
       
        echo json_encode([
            'status' => 'success',
            'message' => "Conta criada com sucesso!\nEmail de Ativacao enviado para {$data['email']}"
        ]);
        
        unset($data['nome']);
        unset($data['provincia']);
        unset($data['municipio']);
        unset($data['cust_state']);
        unset($data['telefone']);
        unset($data['email']);
        unset($data['senha']);
        unset($data['cust_zip']);
        
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao salvar dados: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => $error_message
    ]);
}
