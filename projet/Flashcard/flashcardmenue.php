<?php


// Assurez-vous que session_start() est appelé avant d'utiliser $_SESSION
session_start();
require_once('./model.php');

if (isset($_POST['addnewtheme'])) {
    $newtheme = $_POST['addnewtheme'];
    $conn = connecte();

    if ($conn) {
        // Utilisation de requête préparée pour éviter l'injection SQL
        $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS `$newtheme` (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            front VARCHAR(255) NOT NULL,
            back VARCHAR(255) NOT NULL
        )");
        $stmt->execute();
        echo "Table '$newtheme' créée avec succès.";
    }
    header('Location: index.php');
    exit;
}

if (isset($_POST['theme'])) {
    $_SESSION['bddactuelle'] = $_POST['themeac'];
    echo "tout baigne";
    echo $_POST['themeac'];

    header('Location: index.php');
    exit;
}

if (isset($_POST['deltheme'])) {
    $theme = $_POST['themeac'];
    $conn = connecte();

    if ($conn) {
        $stmt = $conn->prepare("DROP TABLE IF EXISTS `$theme`");
        $stmt->execute();
    }

    header('Location: menu.php');
    exit;
}