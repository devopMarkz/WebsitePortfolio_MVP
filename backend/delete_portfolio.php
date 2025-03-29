<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Acesso negado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $portfolio_id = $_POST['id'];

    // Deleta o portfólio
    $stmt = $conn->prepare("DELETE FROM portfolios WHERE id=:id AND user_id=:user_id");
    $stmt->bindParam(':id', $portfolio_id);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo "<script>
                alert('Portfólio excluído com sucesso!');
                window.location.href = '../users/index.php';
              </script>";
        exit();
    } else {
        echo "Erro ao excluir.";
    }
}
?>
