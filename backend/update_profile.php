<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Acesso negado.");
}

$user_id = $_SESSION['user_id'];
$username = htmlspecialchars($_POST['username']);
$bio = htmlspecialchars($_POST['bio']);

// Lógica para upload de imagem
if (!empty($_FILES['profile_pic']['name'])) {
    $image = $_FILES['profile_pic'];
    $imageName = time() . "_" . basename($image['name']);
    move_uploaded_file($image['tmp_name'], "../assets/img/" . $imageName);
} else {
    $stmt = $conn->prepare("SELECT profile_pic FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $imageName = $stmt->fetchColumn();
}

// Atualizar o perfil no banco de dados
$stmt = $conn->prepare("UPDATE users SET username = :username, bio = :bio, profile_pic = :profile_pic WHERE id = :id");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':bio', $bio);
$stmt->bindParam(':profile_pic', $imageName);
$stmt->bindParam(':id', $user_id);

if ($stmt->execute()) {
    header("Location: ../profile.php");
    exit();
} else {
    echo "Erro ao atualizar perfil.";
}
?>