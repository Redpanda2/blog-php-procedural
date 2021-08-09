<?php

// On demarre la session PHP
session_start();

if (isset($_SESSION['user'])) {
    header('Location: ../profil.php');
    exit;
}


if (!empty($_POST)) {
    //si on entre ici c'est que le formulaire a été envoyé
    // On verifie que tous les champs sont remplis
    if (isset($_POST['username'], $_POST['email'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        // Le formulaire est complet
        // On recupere les data en les protegeant (failles xss)
        // On retire toute balise
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);
        $roles = "ROLE_USER";
        $_SESSION["error"] = [];

        if (strlen($username) < 3) {
            $_SESSION["error"][] = "Le nom d'utilisateur doit faire au moins 3 caractères";
        }

        if (strlen($_POST['password']) < 8) {
            $_SESSION["error"][] = "Le mot de passe doit faire au moins 8 caractères";
        }

        //validation email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //est ce que $_POST['email'] ou $email ne contient pas d'email
            $_SESSION["error"][] = "L'adresse email est incorrect";
        }

        if (empty($_SESSION["error"])) {
            // On va hasher le mot de passe
            $password = password_hash($_POST['password'], PASSWORD_ARGON2ID);

            // On enregistre en db
            require_once "../includes/connect.php";

            $sql = "INSERT INTO users (username, email, pass, roles) VALUES (:username, :email, '$password', :roles)";

            $query = $db->prepare($sql);

            $query->bindValue(":username", $username, PDO::PARAM_STR);
            $query->bindValue(":email", $email, PDO::PARAM_STR);
            $query->bindValue(":roles", $roles, PDO::PARAM_STR);

            $query->execute();

            // On recupere l'id de l'utilisateur inseré
            $id = $db->lastInsertId();

            // On connectera l'utilisateur

            // Ici l'utilisateur existe et le mot de passe est correct
            // On va donc l'enregistrer dans la session (connecter l'utilisateur)

            // On stocke dans la session les infos de l'utilisateur
            $_SESSION['user'] = [
                'id' => $id,
                'email' => $email,
                'username' => $username,
                'roles' => "ROLE_USER"
            ];

            // On redirige vers la page de profil (par exemple)
            header("Location: profil.php");
        }
    } else {
        $_SESSION["error"] = ["Le formulaire est incomplet"];
    }
}


//On definit le titre
$titre = "Liste des articles";

// On inclut le header
include_once "../includes/header.php";

// On inclut la navbar
include_once "../includes/navbar.php";

// On ecrit le contenu de la page
?>

<h1>Inscription</h1>

<?php
if (isset($_SESSION["error"])) {
    foreach ($_SESSION["error"] as $message) {
        echo "<div class=\"alert alert-danger\">$message</div>";
    }
    unset($_SESSION["error"]);
}

?>

<form action="#" method="post">
    <div>
        <label for="username">Pseudo</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit">M'inscrire</button>
</form>

<?php
// On inclut le footer
include_once "../includes/footer.php";
