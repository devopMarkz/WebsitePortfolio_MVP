<?php
include '../backend/config.php';
include '../backend/auth.php';

$user_id = $_SESSION['user_id'];

// Query corrigida para garantir que os dados corretos sejam buscados
$stmt = $conn->prepare("SELECT id, name, description, image FROM portfolios WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$portfolios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Portfólios</title>
    <link rel="stylesheet" href="../assets/css/users.css">
</head>
<body>

    <?php include '../includes/navbar.php'; ?>
    <link rel="stylesheet" href="../assets/css/navbar.css">

    <main>
        <h3>Seus Portfólios</h3>

        <div class="button-container">
            <a href="create_portfolio.php" class="button button-criacao">Criar Novo Portfólio</a>
        </div>

        <!-- Adicionando um delay para evitar sumiço rápido dos portfólios -->
        <div id="portfolioGallery" style="display: none;">
            <?php if (empty($portfolios)): ?>
                <p class="no-portfolios">Você ainda não criou nenhum portfólio. Clique no botão acima para adicionar um novo!</p>
            <?php else: ?>
                <?php foreach ($portfolios as $portfolio): ?>
                    <div class="portfolio-item">
                        <img src="../assets/img/<?= htmlspecialchars($portfolio['image']); ?>" alt="<?= htmlspecialchars($portfolio['name']); ?>">
                        <h4><?= htmlspecialchars($portfolio['name']); ?></h4>
                        <p><?= htmlspecialchars($portfolio['description']); ?></p>
                        <a href="../portfolio.php?id=<?= $portfolio['id']; ?>" class="button">Ver Portfólio</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <script>
        // Aguarda 500ms antes de exibir a galeria de portfólios para evitar o sumiço rápido
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                document.getElementById("portfolioGallery").style.display = "block";
            }, 500);
        });
    </script>
</body>
</html>
