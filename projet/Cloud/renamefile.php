<?php 
session_start();
function renommerFichier($cheminAncien, $Name, $NewName) {
    $cheminAncien = rtrim($cheminAncien, '/\\') . DIRECTORY_SEPARATOR . $Name;
    $cheminNouveau = dirname($cheminAncien) . DIRECTORY_SEPARATOR . $NewName;

    if (file_exists($cheminAncien)) {
        if (rename($cheminAncien, $cheminNouveau)) {
            echo "Le fichier '$Name' a été renommé en '$NewName' avec succès.";
        } else {
            $_SESSION['error-del'] = "Erreur lors du renommage du fichier '$Name' en '$NewName'.";
        }
    } else {
        $_SESSION['error-del'] = "Le fichier '$Name' n'existe pas.";
    }
}

$cheminAncien = $_GET['folderPath'];
$Name = $_GET['Name'];
$NewName = $_GET['NewName'];
renommerFichier($cheminAncien, $Name, $NewName);
