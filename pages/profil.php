<?php
session_start();

require_once('../includes/header.php');
require_once('../includes/navbar.php');

?>

<h1>Profil de <?= $_SESSION['user']['username'] ?></h1>

<p>Pseudo de <?= $_SESSION['user']['username']  ?></p>
<p>Email : <?= $_SESSION['user']['email'] ?></p>

<?php
require_once('../includes/footer.php');
