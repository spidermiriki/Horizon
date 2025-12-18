<?php
include 'connexion_db.php';

var_dump($_POST);

if(isset($_POST['rechercher'])){
    echo'ok';
}
else{
    echo'non';
}
?>