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

$supression = filter_input(INPUT_POST, 'supression', FILTER_SANITIZE_STRING);

if ($infoPost["idUser"] != $infoUser["idUser"]) {
    header("Location: ./main.php");
    exit;
}

if ($supression == "oui") {
    deletePost($infoPost["idNews"]);
}
 elseif($supression == "non") {
            header("Location: ./main.php");
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
        <h1>Supression d'une nouvelle</h1>
        <p>Etes-vous sûr de vouloir supprimer le post intitulé: "<?php echo $infoPost["title"] ?>"?</p>
        <form>
  <input type="radio" name="supression" value="oui"> Oui
  <input type="radio" name="supression" value="non"> Non
            <input type="submit" name="action" value="Valider">
        </form>
    </body>
</html>
