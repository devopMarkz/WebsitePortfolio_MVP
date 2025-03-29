<?php
include '../backend/config.php';
include '../backend/auth.php';

$user_id = $_SESSION['user_id'];

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
    <title>Meus Projetos</title>
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/users.css">
</head>
<body>

    <?php include '../includes/navbar.php'; ?>

    <main>
        <h1 class="dashboard-title">Seus Projetos</h1>

        <?php if (empty($portfolios)): ?>
            <p class="no-portfolios">Você ainda não criou nenhum projeto. Clique em "Criar Portfólio" para começar.</p>
        <?php else: ?>
            <div id="portfolioGallery">
                <?php foreach ($portfolios as $portfolio): ?>
                    <div class="portfolio-item">
                        <img src="../assets/img/<?= htmlspecialchars($portfolio['image']); ?>" alt="<?= htmlspecialchars($portfolio['name']); ?>">
                        <h3><?= htmlspecialchars($portfolio['name']); ?></h3>
                        <p><?= htmlspecialchars($portfolio['description']); ?></p>
                        <a href="../portfolio.php?id=<?= $portfolio['id']; ?>" class="button">Ver Projeto</a>
                        <a href="edit_portfolio.php?id=<?= $portfolio['id']; ?>" class="button">Editar</a>
                        <form action="../backend/delete_portfolio.php" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $portfolio['id']; ?>">
                            <button type="submit" class="button" style="background-color: #e74c3c; border-radius: 5px; color: white;">Deletar</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                document.getElementById("portfolioGallery").style.display = "flex";
            }, 300);
        });
    </script>
</body>
</html>
