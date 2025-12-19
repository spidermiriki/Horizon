<?php
// Démarre la session pour pouvoir utiliser $_SESSION
session_start();

// Affichage des erreurs PHP pour le développement
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Vérifie si le formulaire a été soumis
if (isset($_POST['se_connecter'])) {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    
    // Vérification basique que les champs sont remplis
    if (!empty($email) && !empty($mdp)) {
        // Stockage des informations dans la session
        $_SESSION['user_id'] = 1; // ID fictif
        $_SESSION['email'] = $email;
        $_SESSION['connecte'] = true;
        
        // Redirection vers la page d'accueil
        header('Location: index.php');
        exit(); // Arrête l'exécution du script après la redirection
    } else {
        // Stockage du message d'erreur dans la session
        $_SESSION['error_login'] = "Veuillez remplir tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Se connecter</title>
        <link rel="icon" href="assets/logo.png">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1>Horizon</h1>
            <h2>Vos vacances, nous on a la vision!</h2>
            <nav>
                <a href="inscription.php">S'inscrire</a>
            </nav>
        </header>
        <main>
          <?php 
          // Affiche le message d'erreur s'il existe
          if (!empty($_SESSION['error_login'])): ?>
             <p class="error"><?= htmlspecialchars($_SESSION['error_login']) ?></p>
             <?php 
             // Supprime le message d'erreur après affichage
             unset($_SESSION['error_login']); 
             ?>
          <?php endif; ?>

            <!-- Formulaire de connexion -->
            <form method="POST" action="se_connecter.php">
                <label>
                    <input type="email" placeholder="Entrez votre adresse email" name="email" required>
                </label>

                <label>
                    <input type="password" placeholder="Mot de passe" name="mdp" required>
                </label>

                <br><br>
                <input type="submit" name="se_connecter" value="Se connecter">
            </form>
        </main>
    </body>
</html>