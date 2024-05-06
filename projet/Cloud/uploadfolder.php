<?php 
function createFolder($folderName, $folderPath)
{
    // Vérifier si le chemin d'accès existe
    if (!is_dir($folderPath)) {
        // Créer le chemin d'accès s'il n'existe pas
        if (!mkdir($folderPath, 0755, true)) {
            // Retourner une erreur si la création du chemin d'accès a échoué
            return "Erreur lors de la création du chemin d'accès : " . $folderPath;
        }
    }

    // Construire le chemin complet du nouveau dossier
    $newFolderPath = $folderPath . DIRECTORY_SEPARATOR . $folderName;

    // Créer le nouveau dossier
    if (mkdir($newFolderPath, 0755)) {
        // Retourner un message de succès
        return "Le dossier '" . $folderName . "' a été créé avec succès dans le chemin '" . $folderPath . "'.";
    } else {
        // Retourner une erreur si la création du dossier a échoué
        return "Erreur lors de la création du dossier '" . $folderName . "' dans le chemin '" . $folderPath . "'.";
    }
}

$folderName = $_GET['folderName'] ;
$folderPath = $_GET['folderPath'] ;
createFolder($folderName, $folderPath);