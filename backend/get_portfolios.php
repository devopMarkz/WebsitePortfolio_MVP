<?php
include 'config.php';

$stmt = $conn->prepare("SELECT * FROM portfolios ORDER BY id DESC");
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
