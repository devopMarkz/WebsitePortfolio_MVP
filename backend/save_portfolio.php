<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);

    $image = $_FILES['image'];
    $imageName = time() . "_" . basename($image['name']);
    move_uploaded_file($image['tmp_name'], "../assets/img/" . $imageName);

    $stmt = $conn->prepare("INSERT INTO portfolios (name, description, image) VALUES (:name, :description, :image)");
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