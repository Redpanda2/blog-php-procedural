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
    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        $email = strip_tags($_POST['email']);
        //validation email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //est ce que $_POST['email'] ou $email ne contient pas d'email
            die("L'adresse email est incorrect");
        }

        // On se connecte à la db
        require_once "../includes/connect.php";

        //On cherche si l'email existe dans la db
        $sql = "SELECT * FROM users WHERE email = :email";
        $query = $db->prepare($sql);

        $query->bindValue(":email", $email, PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch();

        if (!$user) {
            die("L'email et/ou le mot de passe est incorrect");
        }

        // Ici on a un user existant, on peut donc verifier le mot de passe
        if (password_verify($_POST['password'], $user['pass'])) {

            // Ici l'utilisateur existe et le mot de passe est correct
            // On va donc l'enregistrer dans la session (connecter l'utilisateur)

            // On stocke dans la session les infos de l'utilisateur
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['username'],
                'roles' => $user['roles']
            ];

            // On redirige vers la page de profil (par exemple)
            header("Location: profil.php");
        }
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

<h1>Connexion</h1>

<form action="#" method="post">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit">Me connecter</button>
</form>

<?php
// On inclut le footer
include_once "../includes/footer.php";
