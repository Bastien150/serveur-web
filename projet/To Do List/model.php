<?php
// Informations de connexion à la base de données

function connect()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "srvweb";

    // Créer la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    return $conn;
}

function insertData($title, $genre, $descr, $date)
{
    $conn = connect();

    $stmt = $conn->prepare("INSERT INTO todo (titre, genre, descr, datefin) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $genre, $descr, $date);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "La tâche a été ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la tâche: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function UpperCase($phrase)
{
    // Convertir la première lettre en majuscule
    $firstLetter = strtoupper(substr($phrase, 0, 1));

    // Concaténer la première lettre en majuscule avec le reste de la chaîne
    $restOfString = substr($phrase, 1);
    $uppercasedPhrase = $firstLetter . $restOfString;

    return $uppercasedPhrase;
}

function deleteTodo($id)
{
    $conn = connect();

    // Préparer la requête SQL avec une instruction préparée
    $sql = "DELETE FROM todo WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Lier les paramètres
    $stmt->bind_param("i", $id);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "La tâche a été supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la tâche: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
