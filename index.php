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

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
$pwd = filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_STRING);
$message = "";

if (login($id, $pwd)) {
    header("Location: confirmation.php");
    exit;
} elseif (!login($id, $pwd) && $id != "" || $pwd != "") {
    $message = "Identifiant ou mot de passe incorect";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
          <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Forum</title>
    </head>
    <body>
        <form action="" method="POST">
            <fieldset>
                <legend>Connexion</legend>
                Identifiant:<br>
                <input type="text" name="id" value="" required autofocus><br>
                Mot de passe:<br>
                <input type="password" name="pwd" value="" required><br><br>
                <input type="submit" value="Valider">
            </fieldset>   
            <a href="inscription.php">Pas encore inscrit?</a>
            <p><?php
echo $message;
?></p>
        </form>
    </body>
</html>
