<?php
session_start();
$file = $_POST['filename'];
$lf = explode("/", $file);

if (isset($_POST['home'])) {
    unset($_SESSION['fileselect']);
    header("Location: ./index.php");
exit();
} else if (isset($_POST['back'])) {
    if (count($lf) > 1) {
        array_pop($lf);
        $chemin = implode("/", $lf);
        $_SESSION['fileselect'] = $chemin;
    } else {
        unset($_SESSION['fileselect']);
    }
    header("Location: ./index.php");
exit();
} else {
    /*     if (is_dir($cheminComplet)) {
        echo "$fichier est un dossier<br>";
        // Traitement supplémentaire pour les dossiers
    } */


    $fileselect = $_POST['filename'];
    $lastfileselect = $_POST['lastfilename'];
    echo $fileselect . "  ";
    echo $lastfileselect;
    if ($lastfileselect == '') {
        if (is_dir("./cloud/" . $fileselect)) {
            echo 'est un fichier';
            $_SESSION['fileselect'] = $fileselect;
            header("Location: ./index.php");
            exit();
        } else {
            $fileToDownload = "./cloud/" . $fileselect;
            $downloadUrl = 'download.php?file=' . urlencode($fileToDownload);
            header('Location: ' . $downloadUrl);
        }
    } else {
        if (is_dir("./cloud/" . $lastfileselect . "/" . $fileselect)) {
            echo 'oui';
            $_SESSION['fileselect'] = $lastfileselect . '/' . $fileselect;
            header("Location: ./index.php");
            exit();
        } else {
            $fileToDownload = "./cloud/" . $lastfileselect . "/" . $fileselect;
            $downloadUrl = 'download.php?file=' . urlencode($fileToDownload);
            header('Location: ' . $downloadUrl);
        }
    }
}
