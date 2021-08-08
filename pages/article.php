<?php
// On preferera une version sans else donc ceci a eviter
// if (isset($_GET['id']) && !empty($_GET['id']))

//On verifie si on a un id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    //Je n'ai pas d'id, redirection ou message d'erreur
    //redirection vers articles.php
    header("Location: articles.php");
    exit;
}

// Je recupere l'id
$id = $_GET['id'];

// On se connecte a la db
require_once "includes/connect.php";

// On va chercher l'article dans la base
// On ecrit la requete
$sql = "SELECT * FROM articles WHERE id = :id";

// On prepare la requete
$query = $db->prepare($sql);

// On injecte les parametres
$query->bindValue(":id", $id, PDO::PARAM_INT); //on le transforme en int pour proteger contre xss

// On execute les parametres
$query->execute();

// On recupere l'article
$article = $query->fetch();

// On verifie si article est vide
if (!$article) {
    //pas d'article, erreur 404
    http_response_code(404); //pour donner le code d'erreur
    echo "Article inexistant";
    exit;
}

// Ici on a un article

//On definit le titre de la page
$titre = strip_tags($article['title']);

// On inclut le header
include "includes/header.php";

// On inclut la navbar
include "includes/navbar.php";

// On ecrit le contenu de la page
?>

<h1><?= strip_tags($article['title']) ?></h1>
<section>
    <article>
        <p>Publié le <?= $article['created_at'] ?></p>
        <div><?= strip_tags($article['content']) ?></div>
    </article>
</section>

<?php
// On inclut le footer
include "../includes/footer.php";
