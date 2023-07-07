<?php
$bdd = new PDO ('mysql:host=localhost;dbname=administration_troc;', 'root', '');
// if(!$_SESSION['mdp'])
// {
//     header('Location: connexion.php');
// }



// recois (le titre de l'annonce + description annonce + photo article) de la page (publier_annonce)
// securise les donnees, SI administrateur ok -> insert donnees dans table annonces
if(isset($_POST['envoi_file']))
{
    if(!empty($_POST['titre']) AND !empty($_POST['description']))
    {
        $titre = htmlspecialchars($_POST['titre']);
        $description = nl2br(htmlspecialchars($_POST['description']));

        var_dump($titre);
        var_dump($description);


        // récupérer et vérifier la photo envoyée par la page 'publier_annonce' dans la $FILES
        // recuperation de $_POST et $_FILES
        //  AFFICHAGE DES $_POST et $_FILES RECUES DE LA PAGE 'publier_annonce.php'
        var_dump($_POST);
        var_dump($_FILES);
        //  recuperer les donnees du tablo FILES et les stoquer dans une variable
        if(isset($_FILES['file']))
        {
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];
            $type = $_FILES['file']['type'];

            // verifier si le fichier est une image: en recuperant l'extension grace a la fct EXPLODE et stocker resultat dans 1 $
            // fct explode = exploser une chaine de cractere en fct d'1 delimiteur ,ici le point (.) (decouper la string à chaque point, et nous retourne 1tablo ['marseille', 'jpg'])
            $tabExtension = explode('.', $name);

            // récuperer le dernier element du tablo retourné par explode ici 'jpg'. grace à la fct end()
            // strtolower() : mettre le dernier element recuperé en miniscule
            $extension = strtolower(end($tabExtension));

            // créer 1 tablo des extensions autorisées 
            $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'gif'];
            $taillemax = 400000;

            // verifier si notre extension existe dans le tablo des extensions autorisées grace à la fct in_array()
            if(in_array($extension, $extensionsAutorisees))
            {
                // Vérifier la taille du fichier 
                if($size <= $taillemax)
                {
                    if($error == 0)
                    {
                        // générer 1 nom unique à chaque image 
                        $uniqueName = uniqid('', true);
                        // concatener $uniquename avec $extension pour obtenir LE NOM FINAL DE LA PHOTO
                        $fileName = $uniqueName.'.'.$extension;
                        var_dump($fileName);

                        // remplacer $name dans la fct move_uploaded_file($tmpName, './upload/'.$name); par $fileName
                        // uploader le fichier
                        move_uploaded_file($tmpName, './upload/'.$fileName);

                    }
                    else
                    {
                        echo "votre document n'a pas été accépté.";
                    }
                }
                else
                {
                    "fichier trop grand, veuillez le compresser.";
                }
            }
            else
            {
                echo "mauvaise extension de fichier";
            }
        }



        // Si admin clique sur ajouter l'annonce (ok) on a besoin de $_POST['ajouter'] qui provient de la page 'annonce_a_verifier'

        // if($_POST['ajouter'])
        // {
        //     $etat = 1;
        //     $insererAnnonce = $bdd->prepare('INSERT INTO annoces(id_user, titre, description, photo, etat)VALUES(?, ?, ?, ?, ?)');
        //     $insererAnnonce->execute(array($id_user, $titre, $description, $fileName, $etat ));
        //     echo "Annonce ajoutée à la bdd"; 
        // }
        // else
        // {
        //     echo "Annonce non validée par l'admininstrateur.";

        // }
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
                 <td><input type="text"  id="titre" name="titre" value="<?= $titre ?>"></td>
             </tr>
             <tr>
                 <td align="right"><label for="description">Description de l'annonce :</label></td> 
                 <td><textarea id="description" name="description" ><?= $description ?></textarea></td>
             </tr>
             <tr>
                 <td align="right"><label for="file">photo à valider</label></td> 
                 <td><a href="./upload/<?= $fileName ?>"><img src="./upload/<?= $fileName ?>" alt="photo à valider" width="300px"></a></td>
             </tr>
             <tr>
                <td></td>
                <td align="center"></br><button type="submit" name="ajouter">ajouter l'annonce</button></td>
             </tr>
         </table>
      </form>
    </div>

    
</body>
</html>

