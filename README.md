# Documentation des Modifications

## Description

Ce document décrit les modifications apportées au projet pour corriger un bug et une faille de sécurité. Des commentaires ont également été ajoutés pour améliorer la lisibilité et la maintenabilité du code.

## Modifications Apportées

### 1. Correction de la Faille de Sécurité et du Bug

#### Problèmes

1. Les mots de passe des utilisateurs étaient stockés en clair dans la base de données, ce qui représente une faille de sécurité majeure.
2. Les utilisateurs pouvaient se connecter sans authentification valide car le système ne vérifiait pas les informations d'identification contre la base de données. Cela permettait à n'importe qui de se connecter sans fournir de mot de passe correct.

#### Solutions

Les mots de passe sont maintenant hachés avant d'être stockés dans la base de données. Lors de la connexion, les mots de passe hachés sont vérifiés à l'aide de la fonction `password_verify`.



**Fichiers Modifiés :**

- `register.php`
- `login.php`

**Exemple de Code :**

```php
// Hachage du mot de passe lors de l'inscription
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Vérification du mot de passe haché lors de la connexion
if (password_verify($password, $user['password'])) {
    // Initialisation des variables de session
    $_SESSION['user'] = $username;
    header("Location: index.php");
    exit();
} else {
    $error = "Mot de passe incorrect.";
}
```
### 2. Ajout de commentaires
Des commentaires ont été ajoutés dans le code pour expliquer les différentes parties et améliorer la lisibilité.
## Conclusion

Les modifications apportées ont permis de corriger une faille de sécurité critique et un bug dans le système de connexion. De plus, des commentaires ont été ajoutés pour améliorer la compréhension du code.
