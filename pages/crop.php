<?php

// Nom du l'image à redimensionner
$fichier = "4b5953b47af28b15bc0e1ee607aed94e.jpeg";

$image = __DIR__ . "/../uploads/" . $fichier;
$newPath = __DIR__ . "/../uploads/resized/crop-" . $fichier;


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

// On recadre l'image
$newImage = imagecrop($imageSource, [
    "x" => 200,
    "y" => 200,
    "width" => 300,
    "height" => 150
]);

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
imagedestroy($newImage);
