<?php
require_once('admin/inc/config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$session_id = session_id();
$ip = $_SERVER['REMOTE_ADDR'];
$agora = date("Y-m-d H:i:s");

// Atualiza ou insere o acesso
$stmt = $pdo->prepare("SELECT id FROM usuarios_online WHERE session_id = ?");
$stmt->execute([$session_id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $stmt = $pdo->prepare("UPDATE usuarios_online SET ultimo_acesso = ? WHERE session_id = ?");
    $stmt->execute([$agora, $session_id]);
} else {
    $stmt = $pdo->prepare("INSERT INTO usuarios_online (session_id, ip, ultimo_acesso) VALUES (?, ?, ?)");
    $stmt->execute([$session_id, $ip, $agora]);
}
