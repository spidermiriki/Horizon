<?php   

/*visualisation des erreurs*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'connexion_db.php';

// Récupération de l'ID de l'offre
$id_offre = $_POST['id_offre'] ?? $_GET['id_offre'] ?? null;

// Variables pour l'offre
$pays_offre = '';
$ville_offre = '';
$description_offre = '';
$prix_offre = '';

// Récupération des données de l'offre depuis la DB
if ($id_offre) {
    $req = $db->prepare('SELECT * FROM Offre_voyage WHERE id_offre = :offre');
    $req->execute([':offre' => $id_offre]);
    $offre = $req->fetch();
    
    if ($offre) {
        $pays_offre = $offre['pays'];
        $ville_offre = $offre['ville'];
        $description_offre = $offre['description_offre'];
        $prix_offre = $offre['prix'] ?? '';
    }
}

// Traitement simple du formulaire
$confirmation = false;
if (isset($_POST['valider_reservation'])) {
    $confirmation = true;
    $email = htmlspecialchars($_POST['email']);
    $date_depart = $_POST['date_depart'];
    $date_retour = $_POST['date_retour'];
    $nb_personnes = $_POST['nb_personnes'];
    $id_offre = $_POST['id_offre']; // Garder l'ID pour la confirmation
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Réservation - Horizon</title>
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
        </header>
        <main>
            <?php if ($confirmation): ?>
                <div style="border: 2px solid green; padding: 20px; margin: 20px; background-color: #18e648ff;">  <!-- Confirmation de réservation --> 
                    <h2>✓ Réservation confirmée !</h2>
                    <p>Merci, votre réservation a bien été enregistrée.</p>
                    
                    <h3>Récapitulatif :</h3>
                    <ul style="list-style: none; padding: 0;">
                        <?php
                        $pays_offre  = $_POST['pays'] ?? '';
                        $ville_offre = $_POST['ville'] ?? '';
                        ?>
                        <li>Destination : <strong><?= $pays_offre ?><?= !empty($ville_offre) ? ' - ' . $ville_offre : '' ?></strong></li>
                        <li>Email : <?= $email ?></li>
                        <li>Départ : <?= date('d/m/Y', strtotime($date_depart)) ?></li>
                        <li>Retour : <?= date('d/m/Y', strtotime($date_retour)) ?></li>
                        <li>Personnes : <?= $nb_personnes ?></li>
                    </ul>
                    <!-- Bouton pour retourner à l'accueil (j'ai mis du style dans la balise comme je n'avais pas accès au css depuis mon ordinateur à moi) -->
                    <p><a href="index.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Retour à l'accueil</a></p>
                </div>
            <?php else: ?>
            
            <h2>Réservation de votre voyage</h2>
            
            <?php if (!empty($pays_offre)): ?>
            <div style="background-color: #f0f8ff; padding: 15px; margin: 20px 0; border-left: 4px solid #007bff;">
                <h3>Votre destination choisie :</h3>
                <p><strong>📍 <?= $pays_offre ?><?= !empty($ville_offre) ? ' - ' . $ville_offre : '' ?></strong></p>
                <?php if (!empty($description_offre)): ?>
                <p><?= $description_offre ?></p>
                <?php endif; ?>
                <?php if (!empty($prix_offre)): ?>
                <p><strong>Prix : <?= $prix_offre ?>€</strong></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="reservation.php">
                <!-- Champ caché pour garder l'ID de l'offre -->
                <input type="hidden" name="id_offre" value="<?= htmlspecialchars($id_offre) ?>">
                
                <fieldset>
                    <legend>Informations personnelles</legend>

                    <label>Email
                        <input type="email" placeholder="votre.email@exemple.com" name="email" required>
                    </label>
                    <br><br>

                </fieldset>
                <br>

                <fieldset>
                    <legend>Détails de la réservation</legend>
                    
                    <label>Date de départ
                        <input type="date" name="date_depart" required>
                    </label>
                    <br><br>

                    <label>Date de retour
                        <input type="date" name="date_retour" required>
                    </label>
                    <br><br>

                    <label>Nombre de personnes
                        <input type="number" name="nb_personnes" min="1" max="10" value="1" required>
                    </label>
                    <br><br>

                    <label>Commentaires / Demandes spéciales
                        <textarea name="commentaires" rows="4" placeholder="Vos demandes particulières..."></textarea>
                    </label>
                </fieldset>
                <br>

                <input type="submit" name="valider_reservation" value="Valider la réservation" style="background-color: #07396eff; color: white;border-radius: 5px;">
                <button type="button" onclick="window.location.href='index.php'" style="background-color: #07396eff; color: white;border-radius: 5px;">Annuler</button>
            </form>
            
            <?php 
                endif; ?>
        </main>
    </body>
</html>