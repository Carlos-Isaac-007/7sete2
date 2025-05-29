<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once('../admin/inc/config.php');

try {
    // Verifique se os parâmetros provincia_id e municipio_id foram passados na URL
    if (isset($_GET['provincia_id']) && isset($_GET['municipio_id'])) {
        $provincia_id = $_GET['provincia_id'];
        $municipio_id = $_GET['municipio_id'];  // Captura o valor de municipio_id

        // Prepare a consulta SQL com os parâmetros
        $stmt = $pdo->prepare("SELECT * FROM tbl_bairro WHERE province_id = :provincia_id AND municipio_id = :municipio_id;");

        // Bind os parâmetros com os valores
        $stmt->bindParam(':provincia_id', $provincia_id, PDO::PARAM_INT);  // Vincula o parametro provincia_id
        $stmt->bindParam(':municipio_id', $municipio_id, PDO::PARAM_INT);  // Vincula o parametro municipio_id

        // Execute a consulta
        $stmt->execute();

        // Obtenha os resultados
        $bairros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorne os resultados como JSON
        echo json_encode($bairros);
    } else {
        // Caso os parâmetros não tenham sido fornecidos
        echo json_encode(['error' => 'Parâmetros provincia_id e municipio_id não fornecidos']);
    }
} catch (Exception $e) {
    // Caso ocorra algum erro
    echo json_encode(['error' => 'Erro ao buscar bairros: ' . $e->getMessage()]);
}
