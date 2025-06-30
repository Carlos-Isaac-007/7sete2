
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';
$password =  '';
$database = '7sete';

function formatarKZ($valorTexto) {
    $numero = preg_replace('/[^\d]/', '', $valorTexto);
    $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($numero, 'AOA');

}
try {
    // Conectar ao banco de dados com PDO
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se foi enviado um termo de busca
    if (!empty($_POST['search_text'])) {
        $search_text = '%' . trim($_POST['search_text']) . '%'; // Adiciona os curingas para o LIKE
    } else {
        die("Erro: Nenhum termo de busca foi fornecido.");
    }

    // Definir limite e início para paginação
    $limit = isset($_POST["limit"]) ? (int)$_POST["limit"] : 5;
    $start = isset($_POST["start"]) ? (int)$_POST["start"] : 0;

    // Preparar a consulta SQL com segurança
    $query = "SELECT * FROM tbl_product WHERE p_name LIKE :search_text LIMIT :start, :limit";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':search_text', $search_text, PDO::PARAM_STR);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    
    // Executar a consulta
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se há resultados antes de incluir o arquivo
    if (!empty($result)) {
        require_once('lista_produto.php');
    } else {
        echo "<p>Nenhum produto encontrado.</p>";
    }

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
