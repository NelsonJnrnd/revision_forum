<?php

/*
  Titre: revision_forum

  Auteur: Jeanrenaud Nelson
  Description : Un site d’échange d’information basique, une sorte de petit forum, vous permettant de poster des nouvelles.
  Version: 1.0.0
  Date: 30.08.2018
  Copyright: Entreprise Ecole CFPT-I © 2018
  --------------------------------------------------------------------------------
  Fichier de fonction PHP à inclure dans toutes les pages PHP du site
 */
require_once 'dbconnection.php';

session_start();

function login($id, $pwd) {
    $identificationStatus = checkIdentification($id, $pwd);
    if (!$identificationStatus) {
        return false;
    }
    $_SESSION["login"] = $identificationStatus["login"];
    $_SESSION["logged"] = true;
    return true;
}

function logout() {
    $_SESSION = array();
    session_destroy();
    session_start();
    header("Location: ./index.php");
    exit;
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

function getUserByLogin($login) {
    $db = connectDb();
    $sql = "SELECT idUser, surname, name FROM users "
            . "WHERE login = :login";

    $request = $db->prepare($sql);
    if ($request->execute(array(
                'login' => $login))) {
        $result = $request->fetch(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return NULL;
    }
}

function createNewUser($id, $name, $surname, $pwd) {
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

function insertPost($title, $description, $idUser) {
    $db = connectDb();
    $sql = "INSERT INTO news(title, description, idUser) " .
            "VALUES (:title, :description, :idUser)";
    $request = $db->prepare($sql);
    if ($request->execute(array(
                'title' => $title,
                'description' => $description,
                'idUser' => $idUser))) {
        return $db->lastInsertID();
    } else {
        return FALSE;
    }
}

function getPost(){
       $db = connectDb();
    $sql = "SELECT * FROM news";
    $request = $db->prepare($sql);
    if ($request->execute(array())) {
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return NULL;
    }
}

function getUserById($idUser){
    $db = connectDb();
    $sql = "SELECT login, surname, name FROM users "
            . "WHERE idUser = :idUser";

    $request = $db->prepare($sql);
    if ($request->execute(array(
                'idUser' => $idUser))) {
        $result = $request->fetch(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return NULL;
    }
}
function getPostById(){
    
}