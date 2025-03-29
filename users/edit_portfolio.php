<?php
include '../backend/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Acesso negado.");
}

$portfolio_id = $_GET['id'] ?? null;

// Verificar se o ID foi passado
if (!$portfolio_id) {
    die("ID do portfólio inválido.");
}

// Buscar os dados do portfólio
$stmt = $conn->prepare("SELECT * FROM portfolios WHERE id = :id AND user_id = :user_id");
$stmt->bindParam(':id', $portfolio_id);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$portfolio = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$portfolio) {
    die("Portfólio não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Projeto</title>
    <link rel="stylesheet" href="../assets/css/edit_portfolio.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <link rel="stylesheet" href="../assets/css/navbar.css">

    <main>
        <h1>Editar Projeto</h1>
        <form action="../backend/edit_portfolio.php" method="POST" enctype="multipart/form-data">
            <label for="name">Nome do Projeto:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($portfolio['name']) ?>" required>

            <label for="description">Descrição:</label>
            <textarea id="description" name="description" required><?= htmlspecialchars($portfolio['description']) ?></textarea>

            <label for="image">Imagem do Projeto:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <input type="hidden" name="id" value="<?= $portfolio['id'] ?>">

            <button type="submit">Salvar Alterações</button>
        </form>
    </main>
</body>
</html>
