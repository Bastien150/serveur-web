<?php
session_start();
function deleteFile($fileName, $filePath) {
    $filePath = rtrim($filePath, '/\\') . DIRECTORY_SEPARATOR . $fileName;

    if (is_file($filePath)) {
        if (unlink($filePath)) {
            echo "Le fichier '$fileName' a été supprimé avec succès.";
        } else {
            $_SESSION['error-del'] ="Erreur lors de la suppression du fichier '$fileName'.";

        }
    } elseif (is_dir($filePath)) {
        if (rmdir($filePath)) {
            echo "Le dossier '$fileName' a été supprimé avec succès.";
        } else {
            $_SESSION['error-del'] = "Erreur lors de la suppression du dossier '$fileName'.";
        }
    } else {
        $_SESSION['error-del'] = "Le fichier ou dossier '$fileName' n'existe pas.";
    }
}



// Récupérer les paramètres de la requête
$fileName = $_POST['fileNamedele'];
$filePath = $_POST['filePathdele'];


// Appeler la fonction deleteFile
deleteFile($fileName, $filePath);

header("Location: index.php");
exit();
