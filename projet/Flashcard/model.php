<?php 

function connecte() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "flashcard";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Erreur de connexion : ". $e->getMessage();
        return null;
    }
}
function connect()
{
    $dns = 'mysql:host=localhost;dbname=flashcard';
    $username = "root";
    $password = "root";

    return new PDO($dns, $username, $password);
}

function deleteCard($id, $conn, $bdd)
{
    // Préparer la requête SQL avec une requête préparée
    $sql = "DELETE FROM `$bdd` WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Lier le paramètre ID à la requête préparée
    $stmt->bindParam(1, $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['error'] = "La carte a été supprimée avec succès.";
    } else {
        $_SESSION['error'] = "Une erreur s'est produite lors de la suppression de la carte.";
    }

    $stmt->closeCursor();
    header('Location: index.php');
    exit;
}

function saveFlashcard($conn, $front, $back, $bdd)
{
    $stmt = $conn->prepare("INSERT INTO `$bdd` (front, back) VALUES (:front, :back)");
    $stmt->bindParam(':front', $front);
    $stmt->bindParam(':back', $back);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
function getTableData($table)
{

  $conn = connecte();
  $sql = "SELECT * FROM $table";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $conn = null;

  return $data;
}
