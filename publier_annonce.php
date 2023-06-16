<?php
$bdd = new PDO ('mysql:host=localhost;dbname=administration_troc;', 'root', '');
if(!$_SESSION['mdp'])
{
    header('Location: connexion.php');
}
?>
<!-- page html envoie (le titre de l'annonce + description annonce + photo article) a la page annonce_a_verifier -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce à publier</title>
</head>
<body>
    <div align="center">
       <h2>Créez votre annonce</h2>
       <form method="post" action="annonce_a_verifier.php">
          <table>
             <tr>
                 <td align="right"><label for="titre">titre :</label></td> 
                 <td><input type="text"  id="titre" name="titre" placeholder="titre"></td>
             </tr>
             <tr>
                 <td align="right"><label for="description">Description de l'annonce :</label></td> 
                 <td><textarea id="description" name="description" placeholder="décriez l'article en questions, et les modalités des transactions desirées"></textarea></td>
             </tr>
             <tr>
                 <td align="right"><label for="photo">ajouter photo</label></td> 
                 <td><input id="photo" name="photo" placeholder="jpeg,png,pdf"></td>
             </tr>
             <tr>
                <td></td>
                <td align="center"></br><button type="submit" name="envoi">envoyer</button></td>
             </tr>
         </table>
      </form>
    </div>
</body>
</html>
