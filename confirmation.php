<?php
/*
  Auteur: Jeanrenaud Nelson
  Titre: revision_forum
  Description : Un site d’échange d’information basique, une sorte de petit forum, vous permettant de poster des nouvelles.
  Version: 1.0.0
  Date: 30.08.2018
  Copyright: Entreprise Ecole CFPT-I © 2018
 */

require_once "php/fonctions.php";

if (empty($_SESSION["login"])) {
    header("Location: ./index.php");
}

$infoUser = getUserByLogin($_SESSION['login']);

$message = "Bonjour " . $infoUser["name"] . " " . $infoUser["surname"] . " vous êtes connecté(e) !";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Bienvenue</title>
    </head>
    <body>
        <h1>  <?php
            echo $message;
            ?>
        </h1>
            <a href="main.php">Écrire un post</a>
    </body>
</html>
