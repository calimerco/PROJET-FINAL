<?php
$bdd = new pdo('mysql:host=localhost;dbname=ecf','root','');

// Acceder à la constante attr_errmode(qui correspond à un chiffre enregistré dans pdo) qui se situe dans lobjet pdo
// quand ya une erreur (=attr_errmode) tu m'envoie une exception

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer les données sous forme d'objets
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

?>