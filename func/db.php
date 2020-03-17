<?php
ini_set('display_errors', 1);

define('DB_DATA', 'geoworld_data');
define('DB_DSN', 'mysql:host=localhost;dbname=' . DB_DATA . ';charset=utf8');

define('DB_USERS','geoworld_users');
define('DB_DSNS', 'mysql:host=localhost;dbname=' . DB_USERS . ';charset=utf8');

define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DEBUG', false);

$dbError = '';

function dataConnect()
{
    global $dbError;
    $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false
    );
    try {
        return new PDO(DB_DSN, DB_USER, DB_PASSWORD, $opt);
    } catch (PDOException $e) {
        $dbError = 'Oups ! Connexion SGBD impossible !';
        if (DEBUG) :
            $dbError .= "<br/>" . $e->getMessage();
        endif;
    }
}

function usersConnect()
{
    global $dbError;
    $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false
    );
    try {
        return new PDO(DB_DSNS, DB_USER, DB_PASSWORD, $opt);
    } catch (PDOException $e) {
        $dbError = 'Oups ! Connexion SGBD impossible !';
        if (DEBUG) :
            $dbError .= "<br/>" . $e->getMessage();
        endif;
    }
}

// initialisation de la variable globale $pdo
$dataDB = dataConnect();
$usersDB = usersConnect();

if ($dbError) {
    die('<div class="ui red inverted segment"> <p>' . $dbError . '</p></div></body></html>');
}