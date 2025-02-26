<?php include("includes/config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include("includes/header.php"); ?>
    <h1>Bienvenue sur notre site</h1>
    <?php if (isset($_SESSION['user'])): ?>
        <p>Vous êtes connecté en tant que <?php echo $_SESSION['user']; ?>.</p>
    <?php endif; ?>
</body>
</html>