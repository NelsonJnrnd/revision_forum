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
$infoPost = getPostById($_GET['post']);

if ($infoPost["idUser"] != $infoUser["idUser"]) {
    header("Location: ./main.php");
    exit;
}


$error = "";

$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
if (empty($title) || empty($description)) {
    $title = $infoPost["title"];
    $description = $infoPost["description"];
}

if (filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING) == "Modifier") {

    if (str_replace(' ', '', $title) != "" && str_replace(' ', '', $description) != "") {
        if (updatePost($title, $description, $infoPost['idNews']) == FALSE) {
            $error = "Le post n'a pas pu être modifié";
        } else {
            header("Location: ./main.php");
            exit;
        }
    } else {
        $error = "Un post doit avoir un titre et une déscription";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title></title>
    </head>
    <body>
        <form action="" method="POST">
            <h1>Mise à jour d'une nouvelle</h1>
            <fieldset>
                <legend>Données du post</legend>
                Titre:<br>
                <input type="text" nae="title" value="<?php
                echo $infoPost["title"];
                ?>" autofocus><br>
                Description:<br>
                <textarea name="description" maxlength="40000" rows="40" cols="125"><?php
                    echo $infoPost["description"];
                    ?></textarea><br><br>
                <input type="submit" name="action" value="Modifier">
            </fieldset>  <br>
            <a href="main.php">Retour</a>
            <p class="erreur"><?php
                echo $error;
                ?></p>
        </form>
    </body>
</html>
