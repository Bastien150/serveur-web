<?php
session_start();
require_once('./model.php');

$conn = connect();

if (isset($_POST['id'])) {
    $bdd = $_POST['bdd'];
    $_SESSION['bddactuelle'] = $bdd;
    $id = $_POST['id'];
    deleteCard($id, $conn, $bdd);
}

if (isset($_POST['add'])) {
    $front = $_POST['front'];
    $back = $_POST['back'];
    $bdd = $_POST['bdd'];
    $_SESSION['bddactuelle'] = $bdd;
    if (!empty($front) && !empty($back)) {
        saveFlashcard($conn, $front, $back, $bdd);
    } else {
        $_SESSION['error'] = "Les champs doivent être remplie";
    }
}

