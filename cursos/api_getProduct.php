<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Exibe erros para debug (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui a conexão
require_once("inc/config.php");

// Verifica se recebeu o parâmetro ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['erro' => 'ID do curso não foi fornecido.']);
    exit;
}

// Sanitiza o ID recebido
$id = intval($_GET['id']);

// Consulta segura no banco
$query = "SELECT * FROM cursos WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou o curso
if ($result->num_rows > 0) {
    $curso = $result->fetch_assoc();

    // Se a imagem for um nome de arquivo, adicione o caminho completo
    $curso['imagem'] = "https://7setetech.com/cursos/" . $curso['imagem'];

    echo json_encode($curso);
} else {
    http_response_code(404);
    echo json_encode(['erro' => 'Curso não encontrado.']);
}
?>
