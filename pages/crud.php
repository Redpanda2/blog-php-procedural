<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        echo "On est connecté";
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    // Ici on est connecté à la base de données
    // On peut alors faire des requêtes
    $query = $db->query('SELECT * FROM users');

    // On recupere les données (fetch ou fetchAll)
    $user = $query->fetch(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($user);
    echo "</pre>";

    // Ajouter un utilisateur
    $query = $db->query("INSERT INTO users (email, pass, roles) VALUES ('tessst@test.fr','azerty','ROLE_USER')");

    // Modifier un utilisateur
    $query = $db->query("UPDATE users SET pass = 'pourquoi' WHERE id = 1");

    // Supprimer un utilisateur
    $query = $db->query("DELETE FROM users WHERE id >= 3");

    ?>
</body>

</html>