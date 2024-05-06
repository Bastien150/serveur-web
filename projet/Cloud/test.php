<?php
// Fonction pour créer un dossier
function createFolder($folderName, $folderPath) {
    // Vérifier si le nom du dossier est valide
    if (empty($folderName) || preg_match('/[\/\\\\]/', $folderName)) {
        echo "Le nom du dossier '$folderName' n'est pas valide.";
        return;
    }

    $folderPath = rtrim($folderPath, '/\\') . '/' . $folderName;

    // Vérifier si le dossier existe déjà
    if (!file_exists($folderPath)) {
        // Créer le dossier
        mkdir($folderPath, 0777, true);
        echo "Le dossier '$folderPath' a été créé avec succès.";
    } else {
        echo "Le dossier '$folderPath' existe déjà.";
    }
}

// Récupérer les paramètres de la requête
$folderName = $_GET['folderName'];
$folderPath = isset($_GET['folderPath']) ? $_GET['folderPath'] : './cloud/';

// Appeler la fonction createFolder
createFolder($folderName, $folderPath);
?>
