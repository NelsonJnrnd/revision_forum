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

$message = "Bonjour " . $infoUser["name"] . " " . $infoUser["surname"] . ", voici votre fil d'actualités";
$error = "";

$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

$posts = getPost();

if (filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING) == "Inserer") {

    if (str_replace(' ', '', $title) != "" && str_replace(' ', '', $description) != "") {
        if (insertPost($title, $description, $infoUser["idUser"]) == FALSE) {
            $error = "Le post n'a pas pu être inséré";
        } else {
            $error = "Publication réussie";
            $title = "";
            $description = "";
        }
    } else {
        $error = "Un post doit avoir un titre et une déscription";
    }
} else if (filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING) == "Déconnection") {
    logout();
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
            <h1><?php
                echo $message;
                ?></h1>
            <fieldset>
                <legend>Nouveau post</legend>
                Titre:<br>
                <input type="text" name="title" value="<?php
                if (!empty($title)) {
                    echo $title;
                }
                ?>" autofocus><br>
                Description:<br>
                <textarea name="description" maxlength="40000" rows="40" cols="125"><?php
                    if (!empty($description)) {
                        echo $description;
                    }
                    ?></textarea><br><br>
                <input type="submit" name="action" value="Inserer">
            </fieldset>  <br>
            <input type="submit" name="action" value="Déconnection">

            <p class="erreur"><?php
                echo $error;
                ?></p>
        </form>
        <?php
        for ($nbPost = 0; $nbPost < count($posts); $nbPost++) {

            $author = getUserById($posts[$nbPost]["idUser"]);

            $display = "<div><h1>" . $posts[$nbPost]["title"] . "</h1><br>";
            $display .= "<h5>" . "Auteur: " . $author["name"] . " "  . $author["surname"] . "</h5><br>";
            $display .= "<i>" . "Posté le " . $posts[$nbPost]["creationDate"] . ". Dernière modification le " . $posts[$nbPost]["lastEditDate"] . "</i><br>";
            $display .= "<p>" . $posts[$nbPost]["description"] . "</p>";

            if ($_SESSION["login"] == $author["login"]) {
               $display .= "<a href=\"updateNews.php?post=" . $posts[$nbPost]["idNews"] . "\">Modifier</a>" . " " .  "<a href=\"deleteNews.php?post=" . $posts[$nbPost]["idNews"] . "\">Supprimer</a>";
            }
            $display .= "</div>";
            echo $display;
        }
        ?>
    </body>
</html>
