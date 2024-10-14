<?php
$host = 'localhost';
$dbname = 'site_roupas'; // Nome do banco de dados
$username = 'root';      // Nome de usuário do banco de dados
$password = '';          // Senha do banco de dados (deixe em branco se não houver senha)

try {
    // Cria a conexão com PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Define o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Finaliza o script e exibe o erro de conexão
    die("Erro na conexão: " . $e->getMessage());
}
?>

