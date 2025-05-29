<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../admin/inc/config.php');

// Limpa sessões com mais de 1 minuto de inatividade
$tempo_limite = date("Y-m-d H:i:s", strtotime("-1 minute"));
$stmt = $pdo->prepare("DELETE FROM usuarios_online WHERE ultimo_acesso < ?");
$stmt->execute([$tempo_limite]);

// Retorna a contagem
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuarios_online");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo $row['total'];
