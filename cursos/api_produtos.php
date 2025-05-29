<?php
header('Content-Type: application/json');

// CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once("inc/config.php");

$base_url = "https://7setetech.com/cursos/";
$produtos = [];

try {
    $result = $conn->query("SELECT * FROM cursos");

    if (!$result) {
        http_response_code(500);
        echo json_encode(['erro' => 'Erro na consulta ao banco de dados']);
        exit;
    }

    while ($row = $result->fetch_assoc()) {
        $row['imagem'] = $base_url . $row['imagem'];
        $produtos[] = $row;
    }

    echo json_encode($produtos);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro interno', 'detalhes' => $e->getMessage()]);
}
?>
