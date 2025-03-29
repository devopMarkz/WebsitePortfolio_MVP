<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Acesso negado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);

    $image = $_FILES['image'];
    $imageName = time() . "_" . basename($image['name']);
    move_uploaded_file($image['tmp_name'], "../assets/img/" . $imageName);

    $stmt = $conn->prepare("INSERT INTO portfolios (user_id, name, description, image) VALUES (:user_id, :name, :description, :image)");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $imageName);

    if ($stmt->execute()) {
        sleep(1); // Aguarda um tempo para garantir que o banco finalize a transação
        echo "<script>
                alert('Portfólio criado com sucesso!');
                window.location.href = '../users/index.php';
              </script>";
        exit();
    }    
    
}
?>