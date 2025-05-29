<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once('../admin/inc/config.php');

try {
        // Prepare a consulta SQL com os parâmetros
        $stmt = $pdo->prepare("SELECT * FROM tbl_bairro");
        // Execute a consulta
        $stmt->execute();

        // Obtenha os resultados
        $bairros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorne os resultados como JSON
        echo json_encode($bairros);
} catch (Exception $e) {
    // Caso ocorra algum erro
    echo json_encode(['error' => 'Erro ao buscar bairros: ' . $e->getMessage()]);
}
