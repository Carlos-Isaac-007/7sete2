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

$response = [];

foreach ($topCategories as $top) {
    $topCat = [
        "id" => $top['tcat_id'],
        "name" => $top['tcat_name'],
        "children" => []
    ];

    $statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
    $statement1->execute([$top['tcat_id']]);
    $midCategories = $statement1->fetchAll(PDO::FETCH_ASSOC);

    foreach ($midCategories as $mid) {
        $midCat = [
            "id" => $mid['mcat_id'],
            "name" => $mid['mcat_name'],
            "children" => []
        ];

        $statement2 = $pdo->prepare("SELECT * FROM tbl_end_category WHERE mcat_id=?");
        $statement2->execute([$mid['mcat_id']]);
        $endCategories = $statement2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($endCategories as $end) {
            $midCat["children"][] = [
                "id" => $end['ecat_id'],
                "name" => $end['ecat_name']
            ];
        }

        $topCat["children"][] = $midCat;
    }

    $response[] = $topCat;
}

echo json_encode($response);
