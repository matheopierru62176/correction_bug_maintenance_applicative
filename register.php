<?php
// Inclut le fichier de configuration pour la connexion à la base de données
include("includes/config.php");

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $username = $_POST['username'];
    // Hachage du mot de passe
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prépare et exécute la requête pour vérifier si le nom d'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Vérifie si le nom d'utilisateur existe déjà
    if ($user) {
        $error = "Le nom d'utilisateur existe déjà.";
    } else {
        // Prépare et exécute la requête pour insérer le nouvel utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $password])) {
            // Redirige l'utilisateur vers la page de connexion après une inscription réussie
            header("Location: login.php");
            exit();
        } else {
            $error = "Une erreur est survenue lors de la création du compte.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <!-- Inclut le fichier CSS pour le style -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Inscription</h2>
        <!-- Affiche un message d'erreur si nécessaire -->
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <!-- Formulaire d'inscription -->
        <form method="post">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Créer un compte</button>
        </form>
        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </div>
</body>

</html>