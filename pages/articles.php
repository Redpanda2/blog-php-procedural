<?php
// On va chercher les articles dans la base
// On se connecte a la db
require_once "../includes/connect.php";

// On ecrit la requete
$sql = "SELECT * FROM articles ORDER BY created_at DESC";

// On prepare la requete
$query = $db->prepare($sql);

// On execute la requete
$query->execute();

// On recupere les données
$articles = $query->fetchAll();

//On definit le titre
$titre = "Liste des articles";

// On inclut le header
include "includes/header.php";

// On inclut la navbar
include "includes/navbar.php";

// On ecrit le contenu de la page
?>

<h1>Liste des articles</h1>

<?php foreach ($articles as $article) : ?>
    <section>
        <article>
            <h2><a href="article.php?id=<?= $article['id'] ?>"><?= $article['title'] ?></a></h2>
        </article>
    </section>

<?php endforeach ?>

<?php
// On inclut le footer
include "../includes/footer.php";
