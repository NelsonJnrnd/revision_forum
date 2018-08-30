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

$id = trim(filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING));
$pwd = trim(filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_STRING));
$pwd2 = trim(filter_input(INPUT_POST, "pwd2", FILTER_SANITIZE_STRING));
$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
$surname = trim(filter_input(INPUT_POST, "surname", FILTER_SANITIZE_STRING));

$message = "";
$error = false;
if ($pwd != $pwd2) {
    $error = true;
    $message = "Les mots de passe pas ne sont pas identiques";
}
if (empty($id) || empty($pwd) || empty($pwd2) || empty($name) || empty($surname)) {
    $error = true;
    $message = "Tous les champs ne sont pas remplis";
}
if (!$error) {
    createNewAdmin($id, $name, $surname, $pwd);
    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="POST">
            <fieldset>
                <legend>Inscription</legend>
                Prénom:<br>
                <input type="text" name="name" value="<?php echo $name ?>"><br>
                Nom:<br>
                <input type="text" name="surname" value="<?php echo $surname ?>"><br>
                Identifiant:<br>
                <input type="text" name="id" value="<?php echo $id ?>"><br>
                Mot de passe:<br>
                <input type="password" name="pwd" value=""><br>
                Validation du mot de passe:<br>
                <input type="password" name="pwd2" value=""><br><br>
                <input type="submit" value="Valider">
            </fieldset>   
            <a href="index.php">Retour sur connexion</a>
            <p><?php
echo $message;
?></p>
        </form>
    </body>
</html>
