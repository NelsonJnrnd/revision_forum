<?php
/*
  Auteur: Jeanrenaud Nelson
  Titre: revision_forum
  Description : Un site d’échange d’information basique, une sorte de petit forum, vous permettant de poster des nouvelles.
  Version: 1.0.0
  Date: 30.08.2018
  Copyright: Entreprise Ecole CFPT-I © 2018
 */

require_once 'php/fonctions.php';

$message = "Bonjour " . $_SESSION["name"] . " " . $_SESSION["surname"]  . " vous êtes connecté(e) !";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>  <?php
   echo $message;
        ?>
            </p>
    </body>
</html>
