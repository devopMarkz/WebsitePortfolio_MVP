<?php
include '../backend/config.php';
include '../backend/auth.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM portfolios WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$portfolios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meus Portfólios</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h2>Bem-vindo, <?= $_SESSION['username']; ?></h2>
        <a href="../backend/logout.php">Sair</a>
    </header>

    <h3>Seus Portfólios</h3>
    <a href="../index.html">Criar Novo Portfólio</a>

    <div id="userPortfolioGallery">
        <?php foreach ($portfolios as $portfolio): ?>
            <div class="portfolio-item">
                <img src="../assets/img/<?= htmlspecialchars($portfolio['image']); ?>" alt="<?= htmlspecialchars($portfolio['name']); ?>" width="100%">
                <h4><?= htmlspecialchars($portfolio['name']); ?></h4>
                <p><?= htmlspecialchars($portfolio['description']); ?></p>

                <!-- Link para a página individual do portfólio -->
                <a href="../portfolio.php?id=<?= $portfolio['id']; ?>">Ver Portfólio</a>

                <!-- Formulário para edição -->
                <form action="../backend/edit_portfolio.php" method="POST">
                    <input type="hidden" name="id" value="<?= $portfolio['id']; ?>">
                    <input type="text" name="name" value="<?= $portfolio['name']; ?>">
                    <textarea name="description"><?= $portfolio['description']; ?></textarea>
                    <button type="submit">Editar</button>
                </form>

                <!-- Formulário para exclusão -->
                <form action="../backend/delete_portfolio.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este portfólio?');">
                    <input type="hidden" name="id" value="<?= $portfolio['id']; ?>">
                    <button type="submit">Excluir</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
