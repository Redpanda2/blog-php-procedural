<?php

// On traite le formulaire
if (!empty($_POST)) {
    // POST n'est pas vide, on verifie ensuite que toutes les données sont presentes
    if (isset($_POST['title'], $_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) {
        // Le formulaire est complet
        // On recupere les data en les protegeant (failles xss)
        // On retire toute balise du titre
        $title = strip_tags($_POST['title']);

        // On neutralise toute balise du content = on conserve mais on desactive
        $content = htmlspecialchars($_POST['content']);

        // On peut les enregistrer
        //On se connecte a la db
        require_once "../../includes/connect.php";

        // On ecrit la requete
        $sql = "INSERT INTO articles (title, content) VALUES (:title, :content)";

        // On prepare la requete
        $query = $db->prepare($sql);

        // On injecte les valeurs
        $query->bindValue(":title", $title, PDO::PARAM_STR);
        $query->bindValue(":content", $content, PDO::PARAM_STR);

        // On execute
        if (!$query->execute()) {
            die("Une erreur est survenue");
        }

        // On recupere l'id de l'article
        $id = $db->lastInsertId();

        die("Article ajouté sous le numero $id");
    } else die('Le formulaire est incomplet');
}

$titre = "Ajouter un article";

// On inclut le header
include_once "../../includes/header.php";
include_once "../../includes/navbar.php";
?>

<h1>Ajouter un article</h1>
<form action="#" method="post">
    <div>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title">
    </div>
    <div>
        <label for="content">Contenu</label>
        <textarea name="content" id="content"></textarea>
    </div>
    <input type="submit" value="Envoyer">

</form>
<?php

?>

<?php
include_once "../../includes/footer.php";
