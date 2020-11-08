<?php

if (!empty($_FILES['file']['name'])) {
    if ($_FILES['file']['size'] < 1000000) {
        $mime = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['file']['type'], $mime)) {
            $uploadDir = __DIR__ . '/public/uploads';
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' .$extension;
            $uploadFile = $uploadDir . basename($filename);
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
        } else {
            echo "Erreur ! Type invalide.";
        }
    } else {
        echo "Erreur ! Fichier(s) trop volumineux.";
    }
}

$filesDesciption = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Challenge Laisse pas trainer ton file</title>
</head>
<body>
<h1>Challenge Laisse pas trainer ton file</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="upload">Fichiers à envoyer</label>
        <input type="file" name="file" id="upload">
    </div>
    <div>
        <button type="submit">Envoyer !</button>
    </div>
</form><?php
foreach ($filesDesciption as $description) {
    $description->getFilename(); ?>
    <figure>
    <img src="<?= $description->getFilename() ?>" alt="Picture">
    <p><?= $description->getFilename() ?></P>
    <button type="reset">Spprimer</button>
    </figure><?php
} ?>
</body>
</html>

