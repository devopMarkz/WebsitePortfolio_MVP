<?php
$host = "localhost";
$port = "3307"; // Porta do MySQL rodando no Docker
$dbname = "portfolio_db";
$username = "root";
$password = "123"; // Se houver senha, substitua aqui

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
