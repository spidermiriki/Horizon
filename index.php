<?php    /*visualisation des erreurs*/
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

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
            </form>
            <?php

            $req = $db->prepare('SELECT COUNT(*) AS total FROM Offre_voyage');
            $req->execute();
            $nb_offre = $req->fetch();
            $nb_aleatoire_offre = rand(1,$nb_offre['total']);

            $req = $db->prepare('SELECT img, description_offre FROM Offre_voyage WHERE id_offre = :offre');
            $req->execute([':offre'=>$nb_aleatoire_offre]);
            $reponse_req = $req->fetch();
            ?>       

            <img src="assets/<?=$reponse_req['img']?>" id="img_presentation" alt="img d'example">
            <p><?=$reponse_req['description_offre']?></p>
        </main>
    </body>
</html>