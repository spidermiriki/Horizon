<!DOCTYPE html>
<?php include 'connexion_db.php'; ?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription</title>
        <link rel="icon" href="logo.png">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1>Horizon</h1>
            <h2>Vos vacances, nous on a la vision!</h2>
            <nav>
                <a href="index.php">Acceuil</a>
                <a href="reservation.php">Reservation</a>
                <a href="se_connecter.php">Se connecter</a>
                <a href="inscription.php">S'insrire</a>
            </nav>
        </header>
        <main>
            <form method="POST" action="traitement.php">
                <label>
                    <input type="text" placeholder="Enter votre prenom" name="prenom">
                </label>

                <label>
                    <input type="text" placeholder="Enter votre nom" name="nom">
                </label>

                <label>
                    <input type="text" placeholder="Enter votre adresse email" name="email">
                </label>

                <label>
                    <input type="text" placeholder="mot de passe" name="mdp">
                </label>

                <br><br>
                <input type="submit" name="inscription "value="inscription">
            </form>
        </main>
    </body>
</html>