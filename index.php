<?php

// On demarre la session PHP
session_start();

//On definit le titre

// On inclut le header
//le @ permet de cacher l'erreur si jamais le fichier n'est pas disponible
@include "includes/header.php";

//On inclut la navbar
include "includes/navbar.php";

// On ecrit le contenu de la page
?>
<p>Contenu de la page d'acceuil</p>

<?php
require_once "includes/connect.php";



// On inclut le footer
include "includes/footer.php";
