<?php
include 'backend/config.php';
session_start();

$portfolio_id = $_GET['id'] ?? null;

if (!$portfolio_id) {
    die("Portfólio não encontrado.");
}

// Buscar detalhes do portfólio
$stmt = $conn->prepare("SELECT p.*, u.username FROM portfolios p JOIN users u ON p.user_id = u.id WHERE p.id = :id");
$stmt->bindParam(':id', $portfolio_id, PDO::PARAM_INT);
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
    <link rel="stylesheet" href="assets/css/portfolio.css">
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($portfolio['name']) ?></h1>
        <p>por <?= htmlspecialchars($portfolio['username']) ?></p>
    </header>

    <main>
        <img src="assets/img/<?= htmlspecialchars($portfolio['image']) ?>" alt="Imagem do Projeto" class="portfolio-img">
        <p><?= nl2br(htmlspecialchars($portfolio['description'])) ?></p>

        <!-- Compartilhamento -->
        <h3>Compartilhe este Portfólio:</h3>
        <input type="text" id="shareLink" value="http://localhost/portfolio-website/portfolio.php?id=<?= $portfolio_id; ?>" readonly>
        <button onclick="copyLink()">Copiar Link</button>

        <!-- Formulário de Comentários -->
        <h3>Deixe um Comentário:</h3>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form id="commentForm">
                <textarea name="comment" id="commentText" required placeholder="Escreva seu comentário..."></textarea>
                <input type="hidden" name="portfolio_id" value="<?= $portfolio_id ?>">
                <button type="submit">Enviar Comentário</button>
            </form>
        <?php else: ?>
            <p><a href="login.html">Faça login</a> para comentar.</p>
        <?php endif; ?>

        <!-- Lista de Comentários -->
        <h3>Comentários:</h3>
        <div id="commentsList"></div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const portfolioId = <?= $portfolio_id ?>;

            // Carregar comentários
            function loadComments() {
                fetch(`backend/get_comments.php?portfolio_id=${portfolioId}`)
                    .then(response => response.json())
                    .then(data => {
                        const commentsDiv = document.getElementById("commentsList");
                        commentsDiv.innerHTML = "";
                        data.forEach(comment => {
                            commentsDiv.innerHTML += `<p><strong>${comment.username}</strong>: ${comment.comment} <br><small>${comment.created_at}</small></p><hr>`;
                        });
                    });
            }

            loadComments();

            // Enviar novo comentário
            document.getElementById("commentForm")?.addEventListener("submit", function (event) {
                event.preventDefault();
                const commentText = document.getElementById("commentText").value;

                fetch("backend/add_comment.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `portfolio_id=${portfolioId}&comment=${encodeURIComponent(commentText)}`
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        document.getElementById("commentText").value = "";
                        loadComments();
                    } else {
                        alert(result.error);
                    }
                });
            });
        });

        // Função para copiar o link
        function copyLink() {
            var copyText = document.getElementById("shareLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Link copiado!");
        }
    </script>
</body>
</html>
