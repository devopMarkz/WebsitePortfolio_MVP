<?php
include 'backend/config.php';

if (!isset($_GET['id'])) {
    die("Portfólio não encontrado.");
}

$portfolio_id = $_GET['id'];

// Buscar o portfólio pelo ID
$stmt = $conn->prepare("SELECT * FROM portfolios WHERE id = :id");
$stmt->bindParam(':id', $portfolio_id);
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
    <title><?= htmlspecialchars($portfolio['name']) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($portfolio['name']) ?></h1>
    </header>

    <main>
        <img src="assets/img/<?= htmlspecialchars($portfolio['image']) ?>" alt="Imagem do Projeto" width="100%">
        <p><?= nl2br(htmlspecialchars($portfolio['description'])) ?></p>

        <!-- Botões de compartilhamento -->
        <h3>Compartilhar:</h3>
        <a href="https://api.whatsapp.com/send?text=Veja este portfólio: http://localhost/portfolio-website/portfolio.php?id=<?= $portfolio['id']; ?>" target="_blank">
            Compartilhar no WhatsApp
        </a>
        <br>
        <a href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/portfolio-website/portfolio.php?id=<?= $portfolio['id']; ?>" target="_blank">
            Compartilhar no Facebook
        </a>
        <br>
        <a href="https://twitter.com/intent/tweet?text=Veja este portfólio: http://localhost/portfolio-website/portfolio.php?id=<?= $portfolio['id']; ?>" target="_blank">
            Compartilhar no Twitter
        </a>
    </main>
</body>
</html>
