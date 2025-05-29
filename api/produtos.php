<?php 
require_once('database.php');// ou seu caminho correto de conexão ao PDO

// Arquivo de conexão com o banco de dados
// Arquivo de conexão com o banco de dados

header("Content-Type: application/json"); // Define resposta como JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");


$statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
$statement->execute();
$topCategories = $statement->fetchAll(PDO::FETCH_ASSOC);


