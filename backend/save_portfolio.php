<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Acesso negado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);

    // Upload da imagem
    $image = $_FILES['image'];
    $imageName = time() . "_" . basename($image['name']);
    move_uploaded_file($image['tmp_name'], "../assets/img/" . $imageName);

    // Inserir no banco de dados
    $stmt = $conn->prepare("INSERT INTO portfolios (user_id, name, description, image) VALUES (:user_id, :name, :description, :image)");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $imageName);

    if ($stmt->execute()) {
        echo "Portfólio criado com sucesso!";
    } else {
        echo "Erro ao criar portfólio.";
    }
}
?>