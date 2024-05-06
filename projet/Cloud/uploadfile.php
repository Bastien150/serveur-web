<?php
session_start();

// Vérifier si le fichier a été envoyé correctement
if (isset($_FILES["file"]) && isset($_POST['path'])) {
    $uploadedFile = $_FILES["file"];
    $targetFilePath = $_POST['path'];

    // Construire le chemin complet du fichier
    $targetFilePath = $targetFilePath . '/' . $uploadedFile['name'];

    // Vérifier le type de fichier
    $fileExtension = strtolower(pathinfo($uploadedFile['name'], PATHINFO_EXTENSION));


    // Déplacer le fichier vers le dossier cible
    if (move_uploaded_file($uploadedFile['tmp_name'], $targetFilePath)) {
        // Le fichier a été enregistré avec succès
    } else {
        $_SESSION['error-del'] = "Erreur lors de l'enregistrement du fichier.";
    }
}

// Rediriger l'utilisateur vers la page index.php
header("Location: index.php");
exit();
