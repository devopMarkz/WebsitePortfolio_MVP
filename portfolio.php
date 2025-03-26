<?php
include 'backend/config.php';
session_start();

$portfolio_id = $_GET['id'] ?? null;

if (!$portfolio_id) {
    die("Projeto não encontrado.");
}

$stmt = $conn->prepare("SELECT p.*, u.username FROM portfolios p JOIN users u ON p.user_id = u.id WHERE p.id = :id");
$stmt->bindParam(':id', $portfolio_id, PDO::PARAM_INT);
$stmt->execute();
$portfolio = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$portfolio) {
    die("Projeto não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($portfolio['name']) ?></title>
    <link rel="stylesheet" href="assets/css/portfolio.css">
</head>
<body>
    <main class="portfolio-container">
        <h1 class="portfolio-title"><?= htmlspecialchars($portfolio['name']) ?></h1>
        <p class="portfolio-author">por <strong><?= htmlspecialchars($portfolio['username']) ?></strong></p>

        <img src="assets/img/<?= htmlspecialchars($portfolio['image']) ?>" alt="Imagem do Projeto" class="portfolio-img">
        <p class="portfolio-description"><?= nl2br(htmlspecialchars($portfolio['description'])) ?></p>

        <!-- Compartilhamento -->
        <div class="share-box">
            <h3>Compartilhar Projeto</h3>
            <input type="text" id="shareLink" value="http://localhost/portfolio-website/portfolio.php?id=<?= $portfolio_id; ?>" readonly>
            <button onclick="copyLink()">Copiar Link</button>
        </div>

        <!-- Comentários -->
        <section class="comments-section">
            <h3>Comentários</h3>

            <?php if (isset($_SESSION['user_id'])): ?>
                <form id="commentForm">
                    <textarea name="comment" id="commentText" required placeholder="Escreva seu comentário..."></textarea>
                    <input type="hidden" name="portfolio_id" value="<?= $portfolio_id ?>">
                    <button type="submit">Enviar Comentário</button>
                </form>
            <?php else: ?>
                <p class="login-comment-hint"><a href="login.html">Faça login</a> para comentar.</p>
            <?php endif; ?>

            <div id="commentsList"></div>
        </section>
    </main>

    <script>
        const portfolioId = <?= $portfolio_id ?>;

        function loadComments() {
            fetch(`backend/get_comments.php?portfolio_id=${portfolioId}`)
                .then(res => res.json())
                .then(data => {
                    const commentsDiv = document.getElementById("commentsList");
                    commentsDiv.innerHTML = "";
                    data.forEach(comment => {
                        commentsDiv.innerHTML += `
                            <div class="comment-box">
                                <p><strong>${comment.username}</strong>: ${comment.comment}</p>
                                <small>${comment.created_at}</small>
                            </div>`;
                    });
                });
        }

        loadComments();

        document.getElementById("commentForm")?.addEventListener("submit", function (e) {
            e.preventDefault();
            const commentText = document.getElementById("commentText").value;

            fetch("backend/add_comment.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `portfolio_id=${portfolioId}&comment=${encodeURIComponent(commentText)}`
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    document.getElementById("commentText").value = "";
                    loadComments();
                } else {
                    alert(result.error);
                }
            });
        });

        function copyLink() {
            const copyText = document.getElementById("shareLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Link copiado!");
        }
    </script>
</body>
</html>
