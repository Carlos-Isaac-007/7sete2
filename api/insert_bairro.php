<?php
// insert_bairro.php
// Recebe JSON com provincia_id, municipio_id e nome_bairro e insere na tabela `tbl_bairros` usando PDO

// Exibir erros apenas em desenvolvimento (remover em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

try {
    // Receber e decodificar o JSON enviado pelo fetch()
    $input = json_decode(file_get_contents('php://input'), true);

    // Validar os dados recebidos
    if (!isset($input['provincia_id'], $input['municipio_id'], $input['nome_bairro'])
        || empty($input['provincia_id'])
        || empty($input['municipio_id'])
        || trim($input['nome_bairro']) === '') {
        echo json_encode(['success' => false, 'error' => 'Dados inválidos']);
        exit;
    }

    // Sanitização mínima
    $provincia_id = (int) $input['provincia_id'];
    $municipio_id = (int) $input['municipio_id'];
    $nome_bairro  = trim($input['nome_bairro']);

    // Conectar ao banco usando PDO
    require_once('../admin/inc/config.php'); // verifique o caminho correto
    // espera-se que config.php crie uma variável $pdo do tipo PDO

    // Preparar e executar o INSERT
    $sql = 'INSERT INTO tbl_bairro (province_id, municipio_id, nome_bairro) VALUES (:provincia_id, :municipio_id, :nome_bairro)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':provincia_id', $provincia_id, PDO::PARAM_INT);
    $stmt->bindParam(':municipio_id', $municipio_id, PDO::PARAM_INT);
    $stmt->bindParam(':nome_bairro',  $nome_bairro,  PDO::PARAM_STR);
    $stmt->execute();

     // Obter o ID do registro inserido
    $bairro_id = $pdo->lastInsertId();

    // Preparar e executar o INSERT para notificar o admin da insercacao de um novo bairro
    $mensagem = 'Novo bairro Adicionado! Adicione o custo de envio.';
    $sql = 'INSERT INTO notificacoes (mensagem) VALUES (:mensagem)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':mensagem',  $mensagem,  PDO::PARAM_STR);
    $stmt->execute();

    // Retornar resposta JSON de sucesso
    echo json_encode(['success' => true, 'bairro_id' => $bairro_id]);

}  catch (Throwable $e) {
    file_put_contents(__DIR__ . '/error.log', date('c') . " - " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Erro interno, confira error.log']);
}
