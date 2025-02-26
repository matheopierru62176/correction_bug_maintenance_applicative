<?php
// Inclut le fichier de configuration pour la connexion à la base de données
include("includes/config.php");

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prépare et exécute la requête pour récupérer les informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Vérifie si l'utilisateur existe
    if ($user) {
        // Vérifie si le mot de passe est correct
        if (password_verify($password, $user['password'])) { // Vérification du mot de passe haché
            // Initialise les variables de session pour l'utilisateur connecté
            $_SESSION['user'] = $username;
            // Redirige l'utilisateur vers la page d'accueil
            header("Location: index.php");
            exit();
        } else {
            // Affiche une erreur si le mot de passe est incorrect
            $error = "Mot de passe incorrect.";
        }
    } else {
        // Affiche une erreur si le nom d'utilisateur est incorrect
        $error = "Nom d'utilisateur incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <!-- Inclut le fichier CSS pour le style -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Connexion</h2>
        <!-- Affiche un message d'erreur si nécessaire -->
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <!-- Formulaire de connexion -->
        <form method="post">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas de compte ? <a href="register.php">Créer un compte</a></p>
    </div>
</body>

</html>