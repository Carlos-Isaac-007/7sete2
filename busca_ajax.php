<?php
// Host Name
$dbhost = '127.0.0.1:3306';

// Database Name
$dbname = 'u322980294_seteEcomerce';

// Database Username
$dbuser = 'u322980294_sete';

// Database Password
$dbpass = '7$Ete2@25';

// Conectar ao banco de dados
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Garante que o retorno seja sempre JSON
header("Content-Type: application/json");

if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
    $termo = "%" . $_POST['search_text'] . "%"; // Adiciona os '%' para LIKE

    // Usando prepared statement para segurança
    $query = "SELECT p_name FROM tbl_product WHERE p_name LIKE ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $termo);
    $stmt->execute();
    $result = $stmt->get_result();

    $dados = [];
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }

    echo json_encode($dados);
} else {
    echo json_encode([]);
}

$conn->close();
?>
