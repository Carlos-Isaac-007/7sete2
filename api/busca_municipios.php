<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
header('Content-Type: application/json');
require_once('../admin/inc/config.php');

try {
    // Verifique se o parâmetro provincia_id foi passado na URL
    if (isset($_GET['provincia_id'])) {
        $provincia_id = $_GET['provincia_id'];

        // Prepare a consulta SQL com o parâmetro
        $stmt = $pdo->prepare("SELECT * FROM tbl_municipio WHERE province_id = :provincia_id;");
        
        // Vincule o parâmetro 'provincia_id' com o valor enviado pela requisição
        $stmt->bindParam(':provincia_id', $provincia_id, PDO::PARAM_INT);
        
        // Execute a consulta
        $stmt->execute();

        // Obtenha os resultados
        $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Retorne os resultados como JSON
        echo json_encode($municipios);
    } else {
        // Caso o parâmetro 'provincia_id' não tenha sido fornecido
        echo json_encode(['error' => 'Parâmetro provincia_id não fornecido']);
    }
} catch (Exception $e) {
    // Caso ocorra algum erro
    echo json_encode(['error' => 'Erro ao buscar municipios: ' . $e->getMessage()]);
}
