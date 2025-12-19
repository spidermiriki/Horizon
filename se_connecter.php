<?php
include 'connexion_db.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Se connecter</title>
        <link rel="icon" href="assets/logo.png">
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <header>
            <a href="index.php"><h1>Horizon</h1></a>
            <h2>Vos vacances, nous on a la vision!</h2>
            <nav>
                <a href="inscription.php">S'inscrire</a>
            </nav>
        </header>
        <main>
            <form method="POST" action="se_connecter.php">
                <label>
                    <input type="email" placeholder="Entrez votre adresse email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </label>

                <label>
                    <input type="password" placeholder="Mot de passe" name="mdp" value="<?= htmlspecialchars($_POST['mdp'] ?? '') ?>" required>
                </label>

                <br><br>
                <input type="submit" name="se_connecter" value="Se connecter">
            </form>
            <?php

            // Vérifie si le formulaire a été soumis
            if (isset($_POST['se_connecter'])) {
                // Récupération des données du formulaire
                $email = $_POST['email'];
                $mdp = $_POST['mdp'];

                $req = $db->prepare('SELECT * FROM Utilisateur WHERE email = :email');
                $req->execute([':email'=>$email]);
                $req_prep = $req->fetch();

                if($email == $req_prep['email']){
                    ?>
                    <form method="POST" action="index.php">
                        <input type="hidden" name="prenom" value="<?=$req_prep['prenom_utilisateur']?>">
                        <input type="submit" name="retour" value="se connecter">
                    </form>
                    <?php
                }
                else {
                    echo "<p>Utilisateur inexistant!</p>";
                } 
            } 
        ?>
        </main>
    </body>
</html>