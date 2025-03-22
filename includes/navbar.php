<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Determinar o caminho base corretamente
$base_url = (strpos($_SERVER['PHP_SELF'], '/users/') !== false) ? '../' : '';
?>

<nav class="navbar">
    <div class="nav-container">
        <a href="<?= $base_url ?>users/index.php" class="nav-logo">Portfólio Digital</a>
        <ul class="nav-links">
            <li><a href="<?= $base_url ?>users/index.php">Dashboard</a></li>
            <li><a href="<?= $base_url ?>users/create_portfolio.php">Criar Portfólio</a></li>
            <li><a href="<?= $base_url ?>profile.php">Meu Perfil</a></li>
            <li><a href="<?= $base_url ?>backend/logout.php" class="logout-btn">Sair</a></li>
        </ul>
    </div>
</nav>
