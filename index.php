<!DOCTYPE html>
<?php include 'connexion_db.php'; ?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Acceuil Horizon</title>
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
            </nav>
        </header>
        <main>
            <form method="POST" action="traitement.php">
                <p>Planification des vacances:</p>

                <label>Pays
                    <input type="text" placeholder="EX : France" name="pays" >
                </label>

                <label>Ville
                    <input type="text" placeholder="EX : Paris" name="ville" >
                </label>

                <label>Date de depart
                    <input type="date" name="depart" >
                </label>

                <label>Date de retour
                    <input type="date" name="retour" >
                </label>

                <br><br>
                <input type="submit" name="rechercher" value="rechercher">
            </div>
        </main>
    </body>
</html>