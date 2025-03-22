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
        <a href="../backend/logout.php" class="button">Sair</a>
    </header>

    <h3>Seus Portfólios</h3>
    <a href="../index.html" class="button">Criar Novo Portfólio</a>

    <div id="portfolioGallery">
        <?php foreach ($portfolios as $portfolio): ?>
            <div class="portfolio-item">
                <img src="../assets/img/<?= htmlspecialchars($portfolio['image']); ?>" alt="<?= htmlspecialchars($portfolio['name']); ?>">
                <h4><?= htmlspecialchars($portfolio['name']); ?></h4>
                <p><?= htmlspecialchars($portfolio['description']); ?></p>
                <a href="../portfolio.php?id=<?= $portfolio['id']; ?>" class="button">Ver Portfólio</a>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="../assets/js/animations.js"></script>
</body>
</html>
