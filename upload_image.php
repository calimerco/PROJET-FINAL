<?php
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
                   // concatener $uniquename avec $extension
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
?>