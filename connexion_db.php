<?php

date_default_timezone_set('Europe/Brussels');

$hote='localhost';
$nomBD='horizon';
$user='alexis';     /*changer l'user en fonction des personnes qui se connectent!!!*/
$mdp='Horizon123*';
/*permet de se connecter a la db*/

try {
$db=new PDO('mysql:host='.$hote.';dbname='.$nomBD, $user, $mdp);
$db->exec("SET NAMES 'utf8'");
}

catch (Exception $e) {
die('Erreur de connexion à la BD : '.$e->getMessage() );
}

?>