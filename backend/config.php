<?php
$host = "localhost"; // Ou "127.0.0.1"
$port = "3307"; // Porta do MySQL no Docker
$dbname = "portfolio_db";
$username = "root";
$password = "123"; // Insira a senha correta se houver

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>