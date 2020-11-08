<?php

$filesDesciption = new FilesystemIterator('../../public/uploads/', FilesystemIterator::KEY_AS_FILENAME);

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['submit'])) {
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

            $errors = [];
            $mime = ['image/jpeg', 'image/png', 'image/gif'];

            if (empty($_FILES['file']['name'][$i])) {
                $errors[] = "Erreur! Aucun fichier(s) séléctionné.";
            }

            if ($_FILES['file']['size'][$i] > 1000000) {
                $errors[] = "Erreur! Fichier(s) trop volumineux.";
            }

            if (!in_array($_FILES['file']['type'][$i], $mime)) {
                $errors[] = "Erreur! Type de fichier(s) invalide.";
            }

            if (!empty($errors)) { ?>
                <ul> <?php
                    foreach ($errors as $error) { ?>
                        <li><?= $error;?></li> <?php
                    } ?>
                </ul> <?php
            } else {
                $uploadDir = '../../public/uploads/';
                $extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $extension;
                $uploadFile = $uploadDir . basename($filename);
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFile);
            }
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="../../public/assets/css/style.css">
    <title>Challenge Laisse pas trainer ton file</title>
</head>
<body>
<h1>Challenge Laisse pas trainer ton file</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="upload">Fichiers à envoyer</label>
        <input type="file" name="file[]" id="upload" multiple="multiple">
    </div>
    <div>
        <button type="submit">Envoyer !</button>
    </div>
</form><?php
foreach ($filesDesciption as $description) {
    $description->getFilename(); ?>
    <figure>
        <img src="<?= "../../public/uploads/" . $description->getFilename() ?>" alt="Picture">
        <p><?= $description->getFilename() ?></P>
    </figure><?php
} ?>
</body>
</html>

