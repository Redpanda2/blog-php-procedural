<?php

// Nom du l'image à redimensionner
$fichier = "4b5953b47af28b15bc0e1ee607aed94e.jpeg";

$image = __DIR__ . "/../uploads/" . $fichier;
$newPath = __DIR__ . "/../uploads/resized/resized-" . $fichier;

// On recupere les informations de l'image
$infos = getimagesize($image);


$width = $infos[0];
$height = $infos[1];

// On crée une nouvelle image "vierge" en memoire;
$newImage = imagecreatetruecolor($width / 2, $height / 2);


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

// On copie toute l'image source dans la nouvelle image en la reduisant
imagecopyresampled(
    $newImage, // Image destination
    $imageSource, // Image source
    0, // Position x du coin haut gauche de l'image dans la nouvelle image
    0, // Position y du coin superieur droite de l'image dans la nouvelle image 
    0, // Position x du coin haut gauche de l'image dans l'image source
    0, // Position y du coin superieur droite de l'image dans l'image source
    $width / 2,
    $height / 2,
    $width,
    $height
);


// On enregistre la nouvelle image sur le serveur
switch ($infos["mime"]) {
    case "image/jpeg":
        imagejpeg($newImage, $newPath, 100);
        break;
    case "image/png":
        imagepng($newImage, $newPath);
        break;
}

// On detruit les images dans la memoire
imagedestroy($imageSource);
imagedestroy($newImage);
