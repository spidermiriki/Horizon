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
        <link rel="icon" href="assets/logo.png">
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <header>
            <a href="index.php"><h1>Horizon</h1></a>
            <h2>Vos vacances, nous on a la vision!</h2>
            <nav>
                <a href="se_connecter.php">Se connecter</a>
            </nav>
            <form method="POST" action="index.php">
                <p>Planification des vacances:</p>

                <label>Pays
                    <input type="text" placeholder="EX : France" name="pays" value="<?= htmlspecialchars($_POST['pays'] ?? '') ?>">
                </label>

                <label>Ville
                    <input type="text" placeholder="EX : Paris" name="ville" value="<?= htmlspecialchars($_POST['ville'] ?? '') ?>">
                </label>

                <input type="submit" name="rechercher" value="rechercher">
            </form>
        </header>
        <main>
            <?php
            try{

                $sql = "SELECT * FROM Offre_voyage WHERE 1=1";
                $parametres = [];

                if (!empty($_POST['pays'])) {
                    $sql .= " AND pays = :pays";
                    $parametres['pays'] = $_POST['pays'];
                    $requete_complete = 1;
                }

                elseif (!empty($_POST['ville'])) {
                    $sql .= " AND ville = :ville";
                    $parametres['ville'] = $_POST['ville'];
                    $requete_complete = 1;
                }

                if(empty($_POST['pays']) && empty($_POST['ville'])) {

                    /*compte le nb de voyage dispo*/
                    $req = $db->prepare('SELECT COUNT(*) AS total FROM Offre_voyage');
                    $req->execute();
                    $nb_offre = $req->fetch();

                    /*cree un chiffre aleatoire dans le range du nb de voyage dispo*/
                    $nb_aleatoire_offre = rand(1,$nb_offre['total']);

                    /*affiche les images generee aleatoirement*/
                    $req = $db->prepare('SELECT * FROM Offre_voyage WHERE id_offre = :offre');
                    $req->execute([':offre'=>$nb_aleatoire_offre]);
                    $reponse_req = $req->fetch();
                    $offre1 = $reponse_req['img'];
                    
                    ?>
                    <div class="afficher_offre" id="offre1">
                        <img src="assets/<?=$reponse_req['img']?>" id="img_presentation" alt="img d'example">
                        <p><?=$reponse_req['description_offre']?></p>
                        <form action="reservation.php">
                            <input type="submit" name="reserver_offre1" value="reserver">
                        </form>
                        
                    </div>

                    <?php
                    $new_nb_aleatoire_offre = $nb_aleatoire_offre%2;
                    if($new_nb_aleatoire_offre == $nb_aleatoire_offre%2){
                        $new_nb_aleatoire_offre +=1;
                    }

                    $req = $db->prepare('SELECT img, description_offre FROM Offre_voyage WHERE id_offre = :offre');
                    $req->execute([':offre'=>$new_nb_aleatoire_offre]);
                    $reponse_req = $req->fetch();
                    $offre2 = $reponse_req['img'];
                    ?>

                    <div class="afficher_offre" id="offre2">
                        <img src="assets/<?=$reponse_req['img']?>" id="img_presentation" alt="img d'example">
                        <p><?=$reponse_req['description_offre']?></p>
                        <form action="reservation.php">
                            <input type="submit" name="reserver_offre2" value="reserver">
                        </form>
                    </div>
                    <?php
                    $requete_complete = 0;
                }

                /*sur base de la recherche,fait un requete preparee*/
                if($requete_complete == 1){
                    $req = $db->prepare($sql);
                    $req->execute($parametres);
                    $rech_via_pays = $req->fetch();

                    /*affiche l'imafe et la description associée*/
                    if(isset($rech_via_pays['img'])){
                        echo "<div class='afficher_offre' id='1'>";
                        echo "<img src='assets/",$rech_via_pays['img'],"'alt='img par rapport à la recherche'>";
                        echo "<p>",$rech_via_pays['description_offre'],"</p>";
                        echo "<form action='reservation.php'>";
                        echo "<input type='submit' name='reserver_offre1' value='reserver'>";
                        echo "</form>";
                        echo '</div>';
                    }
                    else{
                        /*affiche un text d'erreur au cas ou il y aurait un probleme!*/
                        echo"<h3>Oups, il n'y a pas de destination possible pour: ",$_POST['pays'],"</h3>";

                        /*redirection forcee vers la page principale*/
                        header("Location: index.php"); 
                        exit;
                    }
                }
            }
            catch(Exception $e){
                echo $e;
                echo'erreur';
            }
            ?>  
        </main>
    </body>
</html>