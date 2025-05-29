<?php
ob_start();
 require_once 'header.php'; 
 ob_end_clean();


header("Content-Type: application/json"); // Define a resposta como JSON
date_default_timezone_set("Africa/Luanda");
$data_avaliacao = date("Y-m-d H:i:s");

$feedback = array("success" => false, "message" => "");

if (!empty($_POST)) {
    // Obtendo valores do POST com verificação
    $nota = $_POST['nota'] ?? null;
    $comentario = $_POST['comentario'] ?? null;
    $cliente_id = $_POST['cliente_id'] ?? null;
    $produto_id = $_POST['product_id'] ?? null; // Corrigido nome da variável para ficar consistente

    // Verifica se todos os campos obrigatórios foram preenchidos
    if ($nota && $comentario && $cliente_id && $produto_id) {
        try {
            // Insere no banco de dados
            $statement = $pdo->prepare("INSERT INTO avaliacoes (cliente_id, produto_id, nota, comentario, data_avaliacao) 
                                        VALUES (?, ?, ?, ?, ?)");
            $statement->execute([$cliente_id, $produto_id, $nota, $comentario, $data_avaliacao]);

            // Retorno JSON de sucesso
            $feedback['success'] = true;
            $feedback['message'] = "Obrigado pela sua avaliação!";
        } catch (PDOException $e) {
            $feedback['message'] = "Erro ao salvar a avaliação: " . $e->getMessage();
        }
    } else {
        $feedback['message'] = "Preencha todos os campos obrigatórios.";
    }
} else {
    $feedback['message'] = "Nenhum dado enviado.";
}

// Enviar resposta em JSON
echo json_encode($feedback);