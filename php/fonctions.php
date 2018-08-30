<?php

/*
  Titre: revision_forum

  Auteur: Jeanrenaud Nelson
  Description : Un site d’échange d’information basique, une sorte de petit forum, vous permettant de poster des nouvelles.
  Version: 1.0.0
  Date: 30.08.2018
  Copyright: Entreprise Ecole CFPT-I © 2018
  --------------------------------------------------------------------------------
  Fichier à inclure dans toutes les pages php du site
 */
require_once 'dbconnection.php';

session_start();

function login($id, $pwd) {
    $identificationStatus = checkIdentification($id, $pwd);
    if (!$identificationStatus) {
        return false;
    }
    $_SESSION["login"] = $identificationStatus["login"];
    $_SESSION["surname"] = $identificationStatus["surname"];
    $_SESSION["name"] = $identificationStatus["name"];

    $_SESSION["logged"] = true;
    return true;
}

function checkIdentification($id, $pwd) {
    $db = connectDb();
    $sql = "SELECT idUser, surname, name, login  FROM users "
            . "WHERE login = :id AND password = :pwd";

    $request = $db->prepare($sql);
    if ($request->execute(array(
                'id' => $id,
                'pwd' => sha1(trim($pwd))))) {
        $result = $request->fetch(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return NULL;
    }
}

function createNewAdmin($id, $name, $surname, $pwd) {
    $db = connectDb();
    $sql = "INSERT INTO users(surname, name, login, password) " .
            "VALUES (:surname, :name, :login, :password)";
    $request = $db->prepare($sql);
    if ($request->execute(array(
                'surname' => $surname,
                'name' => $name,
                'login' => $id,
                'password' => sha1($pwd)))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}
