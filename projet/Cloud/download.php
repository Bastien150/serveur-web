<?php
// Récupérer le nom du fichier à télécharger depuis l'URL
$filename = $_GET['file'];

// Définir le chemin complet du fichier
$filepath =  $filename;

// Vérifier que le fichier existe
if (file_exists($filepath)) {
    // Définir les en-têtes HTTP pour forcer le téléchargement
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));

    // Lire et envoyer le contenu du fichier
    readfile($filepath);
    exit;
} else {
    echo "Le fichier n'existe pas.";
}
?>