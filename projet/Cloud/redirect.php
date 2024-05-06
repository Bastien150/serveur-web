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
            echo 'est un dossier';
            $_SESSION['fileselect'] = $fileselect;
            header("Location: ./index.php");
            exit();
        } else {
            $fileToDownload = "./cloud/" . $fileselect;
            if (pathinfo($fileToDownload, PATHINFO_EXTENSION) == 'pdf') {
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . basename($fileToDownload) . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($fileToDownload);
                exit();
            } else {
                $downloadUrl = 'download.php?file=' . urlencode($fileToDownload);
                header('Location: ' . $downloadUrl);
            }
        }
    } else {
        if (is_dir("./cloud/" . $lastfileselect . "/" . $fileselect)) {
            echo 'est un dossier';
            $_SESSION['fileselect'] = $lastfileselect . '/' . $fileselect;
            header("Location: ./index.php");
            exit();
        } else {
            $fileToDownload = "./cloud/" . $lastfileselect . "/" . $fileselect;
            if (pathinfo($fileToDownload, PATHINFO_EXTENSION) == 'pdf') {
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . basename($fileToDownload) . '"');
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                @readfile($fileToDownload);
                exit();
            } else {
                $downloadUrl = 'download.php?file=' . urlencode($fileToDownload);
                header('Location: ' . $downloadUrl);
            }
        }
    }
}
