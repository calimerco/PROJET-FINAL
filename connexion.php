<?php
session_start();
if(isset($_POST['valider']))
{
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp']))
    {
        $pseudo_par_defaut = "admin";
        $mdp_par_defaut = "admin1234";

        $pseudo_saisi = htmlspecialchars($_POST['pseudo']);
        $mdp_saisi = htmlspecialchars($_POST['mdp']);

        if($pseudo_saisi == $pseudo_par_defaut AND $mdp_saisi == $mdp_par_defaut)
        // creer le varSESSION mdp ppour retser connecté sur les autres pages
        {
            $_SESSION['mdp'] = $mdp_saisi;
            // rediriger l'utilisateur vers l'espace administration
            header('Location: administration.php');
        }
        else
        {
            $erreur = "Vous n'avez pas le droit d'accés à l'espace administrateur!";
        }

    }
    else
    {
        $erreur = "Veuillez completer tous les champs!";
    }
}
else
{
    
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>espace connexion administrateur</title>
</head>
<body>
   <div align="center">
       <h2>Connexion</h2>
       <br/><br/>
       <form method="post" action="">
          <input type="text" name="pseudo" placeholder="Pseudo" autocomplete="off" />
          <input type="password" name="mdp" placeholder="Mot de passe" />
          <input type="submit" name="valider" value="Se connecter !" />
         
       </form>
       <br/><br/><br/><br/>
       <?php
       if(isset($erreur))
       {
        echo '<font color="red">'.$erreur."</font>";
       }
       ?>

    </div>
    
</body>
</html>