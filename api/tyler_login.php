<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Apenas para testes! Em produção, restrinja.
require_once('database.php');

$feedback = array("success" => false, "message" => "");

if (empty($_POST['cust_email']) || empty($_POST['cust_password'])) {
    $feedback['message'] = "Digite o teu email e a palavra passe";
    echo json_encode($feedback);
    exit;
}

$cust_email = strip_tags($_POST['cust_email']);
$cust_password = strip_tags($_POST['cust_password']);

$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
$statement->execute([$cust_email]);
$total = $statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($total == 0) {
    $feedback['message'] = "Email não encontrado.";
} else {
    $row = $result[0];
    if ($row['cust_password'] != md5($cust_password)) {
        $feedback['message'] = "Senha incorreta.";
    } elseif ($row['cust_status'] == 0) {
        $feedback['message'] = "Conta desativada.";
    } else {
        $_SESSION['customer'] = $row;
        $feedback['success'] = true;
        $feedback['message'] = $_SESSION['customer'];
    }
}

echo json_encode($feedback);
