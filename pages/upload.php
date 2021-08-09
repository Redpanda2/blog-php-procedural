<?php
// On verifie si un fichier a ete envoye
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    // On a recu l'image
    // On procede aux verifications
    // On verifie toujours l'extension et le type Mime
    $allowed = [
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "png" => "image/png"
    ];

    $file = $_FILES['image'];
    $filename = $file['name'];
    $type = $file['type'];
    $filesize = $file['size'];

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    // On verifie si l'extension est autorisee ou l'absence du type MIME dans les valeurs
    if (!array_key_exists($extension, $allowed) || !in_array($type, $allowed)) {
        // Ici soit l'extension n'est pas autorisee, soit le type MIME n'est pas autorise
        die("Erreur: format de fichier incorrect");
    }

    // Ici le type est correct
    // On verifie si la taille est inferieure a 1 Mo
    if ($filesize > 1048576) {
        die("Erreur: fichier trop volumineux");
    }

    // On verifie si le fichier n'est pas deja present dans le dossier
    // if (file_exists("./images/" . $filename)) {
    //     die("Erreur: fichier deja present");
    // }

    // On genere un nom de fichier unique
    // On le genere a partir du timestamp et de l'extension
    $newName = md5(uniqid(rand(), true)) . "." . $extension;

    //On genere le chemin complet
    $newFileName = __DIR__ . "/../uploads/" . $newName;

    // On deplace le fichier du dossier temporaire vers le dossier final en le renommant
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $newFileName)) {
        die("Erreur: L'upload a échoué");
    }

    // On interdit l'execution du fichier
    chmod($newFileName, 0644);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ajout de fichiers</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <div>
            <label for="file">Fichier</label>
            <input type="file" name="image" id="file">
        </div>
        <input type="submit" value="Envoyer">

    </form>
</body>

</html>