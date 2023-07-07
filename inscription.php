<?php

$bdd = new pdo('mysql:host=localhost;dbname=administration_troc','root','');
if(isset($_POST['forminscription']))
{
    echo 'ok';

    //  creation des $ securisées   
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $tel = htmlspecialchars($_POST['tel']);
    $date = date('d m Y h:i:s');

    var_dump($nom);
    var_dump($prenom);
    var_dump($adresse);
    var_dump($tel);
    var_dump($date);

    // récuperer les 2 mdp 
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['mdp2'];
    var_dump($mdp);

    if(!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2']))
    {
        echo 'case rempli';
        
// CONTROLER LES $ RECUES DANS $_POST
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 255)
        {
            
        }
        else
        {
            $erreur = "votre pseudo ne doit pas depasser 255 carcteres!";
        }
        if($mail == $mail2)
        { 
              if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
              {
                 $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                 $reqmail->execute(array($mail));
                 $mailexist = $reqmail->rowCount();
                 if($mailexist == 0)
                 { 
                     if ($mdp = $mdp2) 
                     {
                        $mdpS = password_hash($mdp, PASSWORD_DEFAULT);
                        var_dump($mdpS);
                        $role = 2;
                     echo 'tout est bon';
                     //    inserer une ligne membre dans la bdd ($bdd)
                    //  $insertmbr = $bdd->prepare("INSERT INTO users(pseudo, mail, mdp, date_inscri, nom, prenom, adresse, tel, role, mdpNs) VALUES(?, ?, ?)");
                    //  $insertmbr->execute(array($pseudo, $mail, $mdpS, $date, $nom, $prenom, $adresse, $tel, $role, $mdp));
                     //    message de creation d'espace membre
                     $erreur = "votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</>";
                    //  header('location: connexion.php');
                     }
                     else
                     {
                     $erreur = "Vos mots de passe ne correspondent pas!";
                     }
                 }
                 else
                 {
                 $erreur = "Adresse mail déja utilisée!";  
                 }

               }
               else
               {
               $erreur = "Votre adresse mail n'est pas valide!";
               }
         }
         else
         {
         $erreur = "Vos adresses mail ne se correspondent pas.";
         }

    }
    else
    {
        echo 'case vide';
        $erreur = 'Tous les champs doivent étre complétés !';
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUTO PHP</title>
</head>
<body>
   <div align="center">
       <h2>Inscription</h2>
       <br/><br/>
       <form method="post" action="">
          <table>
            <tr>
                <td align="right"><label for="pseudo">Pseudo :</label></td> 
                <td><input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)){echo $pseudo;} ?>"></td>
            </tr>
            <tr>
                <td align="right"><label for="mail">Mail :</label></td>
                <td><input type="mail" placeholder="votre mail" id="mail" name="mail" value="<?php if(isset($mail)){echo $mail;} ?>"></td>
            </tr>
            <tr>
                <td align="right"><label for="mail2">Confirmation du mail :</label></td>
                <td><input type="mail" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)){echo $mail2;} ?>"></td>
            </tr>
            <tr>
                <td align="right"><label for="mdp">Mot de passe :</label></td>
                <td><input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"></td>
            </tr>
            <tr>
                <td align="right"><label for="mdp2">Confirmez votre mot de passe :</label></td>
                <td><input type="password" placeholder="Votre mot de passe" id="mdp2" name="mdp2"></td>
            </tr>
            <tr>
                <td></td>
            <tr>
                <td align="right"><label for="nom">Nom :</label></td>
                <td><input type="text" placeholder="Votre nom" id="nom" name="nom"></td>
            </tr>
            <tr>
                <td align="right"><label for="prenom">Prénom :</label></td>
                <td><input type="text" placeholder="Votre prénom" id="prenom" name="prenom"></td>
            </tr>
            <tr>
                <td align="right"><label for="adresse">Adresse :</label></td>
                <td><input type="text" placeholder="Votre adresse" id="adresse" name="adresse"></td>
            </tr>
            <tr>
                <td align="right"><label for="tel">Téléphone :</label></td>
                <td><input type="tel" placeholder="Votre numéro de téléphone" id="tel" name="tel" ></td>
            </tr>
            <tr>
                <td align="right"></td>
                <td><input type="submit" name="forminscription" value="Je m'inscris"></td>
            </tr>
            <tr>
                <td align="right"></td>
                <td><input type="reset" name="effacer" value="Effacer"></td>
            </tr>
          </table>
         
       </form>
       <?php
       if(isset($erreur))
       {
        echo '<font color="red">'.$erreur."</font>";
       }
       ?>

    </div>
    
</body>
</html>