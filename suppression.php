<?php
session_start();
$bdd = new PDO ('mysql:host=localhost;dbname=administration_troc;', 'root', '');
if(isset($_GET['id']) AND !empty($_GET['id']))
{    
    // verifier si existe un utilisateur avec l'id recupéré
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM membres WHERE id_membre = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0)
    {
        // supprimer l'utilisateur qui a l'id récupéré
        $supprimUser = $dbb->prepare('DELETE FROM membres WHERE id = ?');
        $supprimUser->execute(array($getid));
        header('Location: membres.php');

   
    }
    else
    {
        echo "aucun membre avec cet id n'a été trouvé .";
    }


}
else
{
    echo "L'identifiant n'a pas été récupéré";
}
?>