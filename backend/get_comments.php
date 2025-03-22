<?php
include 'config.php';

if (!isset($_GET['portfolio_id'])) {
    die(json_encode(["error" => "ID do portfólio não fornecido"]));
}

$portfolio_id = $_GET['portfolio_id'];

$stmt = $conn->prepare("
    SELECT comments.comment, comments.created_at, users.username
    FROM comments
    JOIN users ON comments.user_id = users.id
    WHERE portfolio_id = :portfolio_id
    ORDER BY comments.created_at DESC
");
$stmt->bindParam(':portfolio_id', $portfolio_id);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($comments);
?>