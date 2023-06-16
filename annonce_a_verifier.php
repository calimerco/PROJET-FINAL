<?php
$bdd = new PDO ('mysql:host=localhost;dbname=administration_troc;', 'root', '');
// if(!$_SESSION['mdp'])
// {
//     header('Location: connexion.php');
// }

// recois (le titre de l'annonce + description annonce + photo article) de la page (publier_annonce)
// securise les donnees, if administrateur ok -> insert donnees dans table annonces
if(isset($_POST['envoi']))
{
    if(!empty($_POST['titre']) AND !empty($_POST['description']))
    {
        $titre = htmlspecialchars($_POST['titre']);
        $description = nl2br(htmlspecialchars($_POST['description']));
        // if admin clique sur ajouter l'annonce
        if($_POST['ajouter'])
        {
            $insererAnnonce = $bdd->prepare('INSERT INTO annoces(titre,description)VALUES(?, ?)');
            $insererAnnonce->execute(array($titre, $description));
            echo "Annonce ajoutée à la bdd"; 
        }
        else
        {
            echo "Annonce non validée par l'admininstrateur.";

        }
    }
    else
    {
        echo "Annonce non ajoutée";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce à verifier</title>
</head>
<body>
<div align="center">
       <h2>Annonce à vérifier</h2>
       <form method="post" action="">
          <table>
             <tr>
                 <td align="right"><label for="titre">titre :</label></td> 
                 <td><input type="text"  id="titre" name="titre" placeholder="<= $titre ?>"></td>
             </tr>
             <tr>
                 <td align="right"><label for="description">Description de l'annonce :</label></td> 
                 <td><textarea id="description" name="description" placeholder="<= $description ?>"></textarea></td>
             </tr>
             <!-- <tr>
                 <td align="right"><label for="photo">ajouter photo</label></td> 
                 <td><input id="photo" name="photo" placeholder="jpeg,png,pdf"></td>
             </tr> -->
             <tr>
                <td></td>
                <td align="center"></br><button type="submit" name="ajouter">ajouter l'annonce</button></td>
             </tr>
         </table>
      </form>
    </div>

    
</body>
</html>

