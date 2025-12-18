<?php
include 'connexion_db.php';

$pays = $_POST['pays'];
$ville = $_POST['ville'];
$depart = $_POST['depart'];
$retour = $_POST['retour'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

echo $pays;
echo $ville;
echo $depart;
echo $retour;
echo $prenom;
echo $nom;
echo $email;
echo $mdp;

if(isset($_POST['se_connecter'])){
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
}
else{
    echo'nique sa mere';
}













?>