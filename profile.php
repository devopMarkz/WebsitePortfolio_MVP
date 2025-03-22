<?php
include 'backend/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Buscar os dados do usuário
$stmt = $conn->prepare("SELECT username, email, profile_pic, bio FROM users WHERE id = :id");
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
    <header>
        <h1>Meu Perfil</h1>
        <a href="edit_profile.php">Editar Perfil</a>
        <a href="backend/logout.php">Sair</a>
    </header>

    <main>
        <img src="assets/img/<?= htmlspecialchars($user['profile_pic']) ?>" alt="Foto de Perfil" width="150" style="border-radius: 50%;">
        <h2><?= htmlspecialchars($user['username']) ?></h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Sobre mim:</strong> <?= nl2br(htmlspecialchars($user['bio'])) ?></p>
    </main>
</body>
</html>