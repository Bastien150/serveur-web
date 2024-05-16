<?php
require_once('./model.php');

if (isset($_POST["addtodo"])) {
    // Récupérer les données du formulaire
    $genre = $_POST["genre"];
    $titre = $_POST["titre"];
    $date = $_POST["date"];
    $description = $_POST["description"];

    insertData(UpperCase($titre), $genre, UpperCase($description), $date);

    // Rediriger vers index.php après l'insertion
    header("Location: index.php");
    exit();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        deleteTodo($id);

        // Rediriger vers index.php après la suppression
        header("Location: index.php");
        exit();
    } else {
        echo "Aucun ID fourni.";
    }
}