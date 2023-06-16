<?php
session_start();
// sessionstart pemet de securiser la page administration, si non on peut y acceder en tapant 
// http://localhost/project%20final/administration.php dans la barre URL
// si $session[mpd] n'est pas declaree on redirige l'utilisateur vers page connexion.
$bdd = new PDO ('mysql:host=localhost;dbname=administration_troc;', 'root', '');
if(!$_SESSION['mdp'])
{
    header('Location: connexion.php');

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>espace administrateur</title>
</head>
<body>
    <a href="membres.php">Afficher tous les membres</a>
    
</body>
</html>