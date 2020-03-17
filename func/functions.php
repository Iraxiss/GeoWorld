<?php
require_once 'db.php';
session_start();

#if session start or not
#Admin
function adminLogged(){
    if(isset($_SESSION['admin'])){
        return 1;
    }else{
        return 0;
    }
}

#Teacher
function teacherLogged(){
    if(isset($_SESSION['teacher'])){
        return 1;
    }else{
        return 0;
    }
}

#----------- header.php countries.php -------------

// Récupère les continents
function getContinents(){
  global $dataDB;
  return $dataDB->query("SELECT continent FROM Country GROUP BY continent")->fetchAll();
}

// verifie si le continent existe
function verifContinent($continentName){
  global $dataDB;
  $prepare = $dataDB->prepare("SELECT continent FROM Country WHERE continent = :getcont GROUP BY continent");
  $prepare->bindValue(':getcont', $continentName, PDO::PARAM_STR);
  $prepare->execute();
  $continentExist = $prepare->rowCount();

  return $continentExist > 0;
}

// Obtenir la liste de tous les pays référencés d'un continent donné
function getCountriesByContinent($continent){
  global $dataDB;
  $prepare = $dataDB->prepare("SELECT * FROM Country WHERE continent = :cont");
  $prepare->bindValue(':cont', $continent, PDO::PARAM_STR);
  $prepare->execute();

  return $prepare->fetchAll();
}

// Obtenir la liste des pays
function getAllCountries(){
  global $dataDB;
  return $dataDB->query("SELECT * FROM Country;")->fetchAll();
}

#----------- View.php  --------------

// Savoir si le pays existe
function countryExist($idCountry){
    global  $dataDB;
    $prepare = $dataDB->prepare("SELECT * FROM Country WHERE id = :id");
    $prepare->bindValue(":id", $idCountry, PDO::PARAM_STR);
    $prepare->execute();

    return $prepare->rowCount() > 0;
}

function getCountryInfo($idCountry){
    global $dataDB;
    $prepare = $dataDB->prepare("SELECT * FROM Country WHERE id = :id");
    $prepare->bindValue(':id', $idCountry, PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetch();
}

function getCapital($idCountry){
    global $dataDB;
    $prepare = $dataDB->prepare("SELECT City.Name FROM City,Country WHERE City.id = Country.Capital AND Country.id = :id");
    $prepare->bindValue(':id', $idCountry, PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetch();
}

function getOfficialLanguage($idCountry){
    global $dataDB;
    $prepare = $dataDB->prepare("SELECT Language.Name FROM Language,CountryLanguage WHERE Language.id = CountryLanguage.idLanguage AND CountryLanguage.idCountry = :id AND CountryLanguage.IsOfficial = 'T'");
    $prepare->bindValue(':id', $idCountry, PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetchAll();
}

function getLanguages($idCountry){
    global $dataDB;
    $prepare = $dataDB->prepare("SELECT Language.Name, CountryLanguage.Percentage FROM Language,CountryLanguage WHERE Language.id = CountryLanguage.idLanguage AND CountryLanguage.idCountry = :id");
    $prepare->bindValue(':id', $idCountry, PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetchAll();
}

function getCityInfo($idCountry){
    global $dataDB;
    $prepare = $dataDB->prepare("SELECT id,idCountry,Name,Population FROM City WHERE idCountry = :id");
    $prepare->bindValue(':id', $idCountry, PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetchAll();
}

#----------- sqlQuery.php sqlResult.php --------------

// SqlQuery execute query
function sqlExecute($query){
    global $dataDB;
    return $dataDB->query("$query;");
}

// Vérifie si la requête a déja été save
function queryAlreadySave($session, $query){
    global $usersDB;
    $prepare = $usersDB->prepare("SELECT id_user,query FROM queries WHERE id_user = :id_user AND query = :query");
    $prepare->bindValue(":id_user", $session, PDO::PARAM_INT);
    $prepare->bindValue(":query", $query, PDO::PARAM_STR);
    $prepare->execute();
    $alreadySave = $prepare->rowCount();

    return $alreadySave > 0;
}

// Save la rêquete
function saveQuery($session, $query){
    global $usersDB;
    $prepare = $usersDB->prepare("INSERT INTO queries (id,id_user,query) VALUES(NULL,:id_user, :query)");
    $prepare->bindValue(":id_user", $session, PDO::PARAM_INT);
    $prepare->bindValue(":query", $query, PDO::PARAM_STR);
    $prepare->execute();
}

// Compter le nombres de requêtes déjà sauvegardées
function nbQueries($session){
    global $usersDB;
    $prepare = $usersDB->prepare("SELECT COUNT(*) as nb FROM queries WHERE id_user = :id");
    $prepare->bindValue(":id", $session, PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetch();
}

// Récupérer les requêtes sauvegardées
function recupQueries($session){
    global $usersDB;
    $prepare = $usersDB->prepare("SELECT * FROM queries WHERE id_user = :id");
    $prepare->bindValue(":id", $session, PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetchAll();
}

// Vérifier si la requête est bien celle de l'utilisateur
function verifQuery($queryID, $session){
    global $usersDB;
    $prepare = $usersDB->prepare("SELECT * FROM queries WHERE id = :id AND id_user = :id_user");
    $prepare->bindValue(':id', $queryID, PDO::PARAM_INT);
    $prepare->bindValue(':id_user', $session, PDO::PARAM_INT);
    $prepare->execute();
    $queryExist = $prepare->rowCount();

    return $queryExist > 0;
}

// Supprimer la requête
function deleteQuery($queryID, $session){
    global $usersDB;
    $prepare = $usersDB->prepare("DELETE FROM queries WHERE id = :id AND id_user = :id_user");
    $prepare->bindValue(':id', $queryID, PDO::PARAM_INT);
    $prepare->bindValue(':id_user', $session, PDO::PARAM_INT);
    $prepare->execute();
}

#----------- teacherRegister.php --------------

function emailExist($email){
    global $usersDB;
    $prepare = $usersDB->prepare("SELECT email FROM users WHERE email = :email");
    $prepare->bindValue(":email", $email, PDO::PARAM_STR);
    $prepare->execute();

    return $prepare->rowCount();
}

function addUser($firstName, $lastName, $email, $password){
    global $usersDB;
    $prepare = $usersDB->prepare("INSERT INTO users(id, firstname, lastname, email, password, role, confirm) VALUES(NULL, :firstName, :lastName, :email, :password, 0, 0)");
    $prepare->bindValue(":firstName", $firstName, PDO::PARAM_STR);
    $prepare->bindValue(":lastName", $lastName, PDO::PARAM_STR);
    $prepare->bindValue(":email", $email, PDO::PARAM_STR);
    $prepare->bindValue(":password", $password, PDO::PARAM_STR);
    $prepare->execute();
}

#----------- teacherLogin.php --------------

// Verifier si l'utilisateur existe dans la base de données
function verifUser($email, $password){
    global $usersDB;
    $prepare = $usersDB->prepare("SELECT email, password FROM users WHERE email = :email AND password = :password AND confirm = 1");
    $prepare->bindValue(':email', $email);
    $prepare->bindValue(':password', $password);
    $prepare->execute();
    $userExist = $prepare->rowCount();

    return $userExist > 0;
}

// Récupérer l'id et le role de l'utilisateur
function recupUserIdRole($email, $password){
    global $usersDB;
    $prepare = $usersDB->prepare("SELECT id,role FROM users WHERE email = :email AND password = :password AND confirm = 1");
    $prepare->bindValue(':email', $email);
    $prepare->bindValue(':password', $password);
    $prepare->execute();

    return $prepare->fetch();
}

#------ NotConfirm.php ---
// Recupère le nombre de comptes Unconfirm
function nbUnconfirmedAccount(){
    global $usersDB;
    $query = $usersDB->query("SELECT COUNT(*) as nbUnconfirmedAccount FROM users WHERE confirm = 0");

    return $query->fetch();
}

function getUnConfirmedUsers(){
    global $usersDB;
    $query = $usersDB->query("SELECT id,firstname, lastname, email FROM users WHERE confirm = 0");

    return $query->fetchAll();
}

function addusr($userid){
    global $usersDB;
    $prepare = $usersDB->prepare("UPDATE users SET confirm = 1 WHERE id = :id");
    $prepare->bindValue(":id", $userid, PDO::PARAM_INT);
    $prepare->execute();
}

function deleteusr($userid){
    global $usersDB;
    $prepare = $usersDB->prepare("DELETE FROM users WHERE id = :id");
    $prepare->bindValue(":id", $userid, PDO::PARAM_INT);
    $prepare->execute();
}

#------ Confirm.php ---

// Recupère le nombre de comptes confirm
function nbconfirmAccount(){
    global $usersDB;
    $query = $usersDB->query("SELECT COUNT(*) as nbconfirmAccount FROM users WHERE confirm = 1 AND role = 0");

    return $query->fetch();
}

function getConfirmedUsers(){
    global $usersDB;
    $query = $usersDB->query("SELECT id,firstname, lastname, email FROM users WHERE confirm = 1 AND role = 0");

    return $query->fetchAll();
}

#----------- unreadMessages.php --------------

function getUnreadMessages(){
    global $usersDB;
    $query = $usersDB->query("SELECT * FROM messages WHERE isread = 0 ORDER BY date DESC");

    return $query->fetchAll();
}

// Recupère le nombre de messages non lu
function nbUnreadMessages(){
    global $usersDB;
    $query = $usersDB->query("SELECT COUNT(*) as nbUnreadMessages FROM messages WHERE isread = 0");

    return $query->fetch();
}

function deletemsg($msgid){
    global $usersDB;
    $prepare = $usersDB->prepare("DELETE FROM messages WHERE id = :id");
    $prepare->bindValue(":id", $msgid, PDO::PARAM_INT);
    $prepare->execute();
}

function addmsg($msgid){
    global $usersDB;
    $prepare = $usersDB->prepare("UPDATE messages SET isread = 1 WHERE id = :id");
    $prepare->bindValue(":id", $msgid, PDO::PARAM_INT);
    $prepare->execute();
}

#----------- readMessages.php --------------

function getreadMessages(){
    global $usersDB;
    $query = $usersDB->query("SELECT * FROM messages WHERE isread = 1 ORDER BY date DESC");

    return $query->fetchAll();
}

function nbreadMessages(){
    global $usersDB;
    $query = $usersDB->query("SELECT COUNT(*) as nbreadMessages FROM messages WHERE isread = 1");

    return $query->fetch();
}

#----------- index.php --------------

// Récupérer les infos de l'enseignant en fonction de $_SESSION['teacher'] qui contient son id
function recupUserInfo($sessionTeacher){
    global $usersDB;
    $prepare = $usersDB->prepare("SELECT id,firstname,lastname,email,password FROM users WHERE id = :id");
    $prepare->bindValue(':id', $_SESSION['teacher'], PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetch();
}


#----------- update.php --------------

function updateInfo($surfaceArea, $population, $lifeExpectancy, $gnp, $gnpold, $headOfState, $idCountry){
    global $dataDB;
    $prepare = $dataDB->prepare("UPDATE Country SET SurfaceArea = :surfaceArea, Population = :population, LifeExpectancy = :lifeExpectancy, GNP = :gnp  , GNPOld = :gnpold, HeadOfState = :headOfState where id = :idCountry");
    $prepare->bindValue(":surfaceArea", $surfaceArea);
    $prepare->bindValue(":population", $population);
    $prepare->bindValue(":lifeExpectancy", $lifeExpectancy);
    $prepare->bindValue(":gnp", $gnp);
    $prepare->bindValue(":gnpold", $gnpold);
    $prepare->bindValue(":headOfState", $headOfState);
    $prepare->bindValue(":idCountry", $idCountry);
    $prepare->execute();
}

function sendMessage($iduser,$message){
    global $usersDB;
    $prepare = $usersDB->prepare("INSERT INTO messages(id, id_user, message, date, isread) VALUES(NULL, :iduser, :message, NOW(), 0)");
    $prepare->bindValue(":iduser", $iduser , PDO::PARAM_INT);
    $prepare->bindValue(":message", $message, PDO::PARAM_STR);
    $prepare->execute();
}
