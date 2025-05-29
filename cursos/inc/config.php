<?php
$host = '127.0.0.1:3306'; // ou o IP do seu servidor MySQL
$db   = 'u322980294_seteCursos'; // nome do banco de dados
$user = 'u322980294_7sete'; // seu usuário do MySQL
$pass = '7sEtEcursos@'; // sua senha do MySQL

// Criando a conexão
$conn = new mysqli($host, $user, $pass, $db);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
