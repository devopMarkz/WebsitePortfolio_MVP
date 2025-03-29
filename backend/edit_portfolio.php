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

    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = time() . "_" . basename($image['name']);
        $imagePath = $imageName;  
        move_uploaded_file($image['tmp_name'], "../assets/img/" . $imageName);
    } else {
        
        $stmt = $conn->prepare("SELECT image FROM portfolios WHERE id = :id");
        $stmt->bindParam(':id', $portfolio_id, PDO::PARAM_INT);
        $stmt->execute();
        $portfolio = $stmt->fetch(PDO::FETCH_ASSOC);
        $imagePath = $portfolio['image'];  
    }

    $stmt = $conn->prepare("UPDATE portfolios SET name=:name, description=:description, image=:image WHERE id=:id AND user_id=:user_id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $imagePath);
    $stmt->bindParam(':id', $portfolio_id);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);

    if ($stmt->execute()) {
        sleep(1); 
        echo "<script>
                alert('Portfólio atualizado com sucesso!');
                window.location.href = '../users/index.php';
              </script>";
        exit();
    } else {
        echo "Erro ao atualizar.";
    }
}
?>
