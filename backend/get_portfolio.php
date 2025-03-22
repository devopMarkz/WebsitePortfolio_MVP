<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die(json_encode(["error" => "ID do portfólio não fornecido"]));
}

$portfolio_id = $_GET['id'];

// Buscar o portfólio pelo ID
$stmt = $conn->prepare("SELECT * FROM portfolios WHERE id = :id");
$stmt->bindParam(':id', $portfolio_id);
$stmt->execute();
$portfolio = $stmt->fetch(PDO::FETCH_ASSOC);

if ($portfolio) {
    echo json_encode($portfolio);
} else {
    echo json_encode(["error" => "Portfólio não encontrado"]);
}
?>