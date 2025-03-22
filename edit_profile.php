<?php
include 'backend/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Buscar os dados do usuário
$stmt = $conn->prepare("SELECT username, bio, profile_pic FROM users WHERE id = :id");
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Editar Perfil</h1>
    </header>

    <main>
        <form action="backend/update_profile.php" method="POST" enctype="multipart/form-data">
            <label for="username">Nome:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

            <label for="bio">Sobre mim:</label>
            <textarea id="bio" name="bio"><?= htmlspecialchars($user['bio']) ?></textarea>

            <label for="profile_pic">Foto de Perfil:</label>
            <input type="file" id="profile_pic" name="profile_pic" accept="image/*">

            <button type="submit">Salvar Alterações</button>
        </form>
    </main>
</body>
</html>