<?php
// Constantes d'environnement
define('DB_HOST', 'localhost');
define('DB_NAME', 'exo1crud');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

// DSN de connexion dsn = data source name
//mysql:dbname=tutos-php;host=localhost;
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

//Connexion à la base de données
try {
    //On instance PDO
    $db = new PDO($dsn, DB_USER, DB_PASSWORD);

    //On s'assure d'envoyer les données en UTF8
    $db->exec('SET NAMES utf8');

    //On definit le mode de retour des données(fetch mode)
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // echo "On est connecté";
} catch (PDOException $e) {
    // On attrape l'erreur provoquée par le new PDO en
    die($e->getMessage());
}

    // Ici on est connecté à la base de données
    // On peut alors faire des requêtes