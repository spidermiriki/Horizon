<?php    /*visualisation des erreurs*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'connexion_db.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription</title>
        <link rel="icon" href="assets/logo.png">
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <header>
            <a href="index.php"><h1>Horizon</h1></a>
            <h2>Vos vacances, nous on a la vision!</h2>
        </header>
        <main>
            <form method="POST" action="index.php">
                <label>
                    <input type="text" placeholder="Enter votre prenom" name="prenom" >
                </label>

                <label>
                    <input type="text" placeholder="Enter votre nom" name="nom">
                </label>

                <label>
                    <input type="text" placeholder="Enter votre adresse email" name="email">
                </label>

                <label>
                    <input type="password" placeholder="mot de passe" name="mdp">
                </label>

                <br><br>
                <input type="submit" name="inscription "value="inscription">
            </form>
        </main>
    </body>
</html>