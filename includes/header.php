<nav>
    <a href="index.php">Accueil</a>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="login.php">Connexion</a>
    <?php endif; ?>
</nav>
