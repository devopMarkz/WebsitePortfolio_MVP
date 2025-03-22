<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Acesso negado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $portfolio_id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);

    // Atualiza os dados do portfólio
    $stmt = $conn->prepare("UPDATE portfolios SET name=:name, description=:description WHERE id=:id AND user_id=:user_id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $portfolio_id);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo "Portfólio atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar.";
    }
}
?>