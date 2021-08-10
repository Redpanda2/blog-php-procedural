<?php

// Nom du l'image à redimensionner
$fichier = "4b5953b47af28b15bc0e1ee607aed94e.jpeg";

$image = __DIR__ . "/../uploads/" . $fichier;
$newPath = __DIR__ . "/../uploads/resized/flip-" . $fichier;


// On recupere les informations de l'image
$infos = getimagesize($image);

switch ($infos["mime"]) {
    case "image/jpeg":
        // On ouvre l'image
        $imageSource = imagecreatefromjpeg($image);
        break;
    case "image/png":
        $imageSource = imagecreatefrompng($image);
        break;
    default:
        die("Erreur : format non supporté");
}

// On retourne l'image
imageflip($imageSource, IMG_FLIP_HORIZONTAL);

// On enregistre la nouvelle image sur le serveur
switch ($infos["mime"]) {
    case "image/jpeg":
        imagejpeg($imageSource, $newPath, 100);
        break;
    case "image/png":
        imagepng($imageSource, $newPath);
        break;
}

// On detruit les images dans la memoire
imagedestroy($imageSource);
