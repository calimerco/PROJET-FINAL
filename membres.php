<?php
session_start();
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
    <title>membres</title>
</head>
<body>
    <!-- afficher ous les membres enregistrés sur table membres. -->
    <?php
    // recuperer tous les membres dans une var
    $recupUsers = $bdd->query('SELECT * FROM membres');
    while($user = $recupUsers->fetch())
    {
        // echo $user['pseudo'];
        // pour afficher $user[pseudo] dans du html, on ferme la balise php et ouvre html
        ?>
        <p>
            <!-- echo $user['pseudo'] -->
            <?= $user['pseudo'];?><a href="suppression.php?id=<?= $user['id_membre']; ?>" style="color:red;">supprimer</a>  
        </p>
        <!-- on reouvre php apres fermeture du html-->
        <?php
    }
    ?>
    
</body>
</html>
