<?php
include '../backend/config.php';
include '../backend/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Portfólio</title>
    <link rel="stylesheet" href="../assets/css/create_portfolio.css">
</head>
<body>
    <header>
        <h2>Criar Novo Portfólio</h2>
        <a href="index.php">Voltar</a>
    </header>

    <main>
        <form action="../backend/save_portfolio.php" method="POST" enctype="multipart/form-data">
            <label for="name">Nome do Portfólio:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Descrição:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image">Imagem do Portfólio:</label>
            <input type="file" id="image" name="image" required>

            <button type="submit">Salvar Portfólio</button>
        </form>
    </main>
</body>
</html>