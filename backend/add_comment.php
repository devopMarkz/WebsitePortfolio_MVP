<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die(json_encode(["error" => "Usuário não autenticado"]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $portfolio_id = $_POST['portfolio_id'];
    $user_id = $_SESSION['user_id'];
    $comment = htmlspecialchars($_POST['comment']);

    if (empty($comment)) {
        die(json_encode(["error" => "O comentário não pode estar vazio"]));
    }

    $stmt = $conn->prepare("INSERT INTO comments (portfolio_id, user_id, comment) VALUES (:portfolio_id, :user_id, :comment)");
    $stmt->bindParam(':portfolio_id', $portfolio_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':comment', $comment);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Comentário adicionado com sucesso"]);
    } else {
        echo json_encode(["error" => "Erro ao salvar o comentário"]);
    }
}
?>