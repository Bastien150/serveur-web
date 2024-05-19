<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
$_SESSION['file'] = basename(__DIR__);
include_once('../header.php');
unset($_SESSION['file']);
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vérificateur de Palindrome</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
  <main class="container">
    <div id="grid">

      <h1>Vérificateur de Palindrome</h1>
      <button class="contrast" data-target="modal-example" onclick="toggleModal(event)">
        ?
      </button>

    </div>
    <p for="textesaisi">Entrez un mot ou une phrase :</p>
    <input type="text" id="textesaisi" />
    <div id="resultat">Veuiller entrer un texte</div>

  </main>


  <dialog id="modal-example">
    <article>
      <header>
        <button aria-label="Close" rel="prev" data-target="modal-example" onclick="toggleModal(event)"></button>
        <h3>Qu'est ce qu'un palindrome</h3>
      </header>
      <p>
        Un palindrome est une séquence de caractères qui se lit
        de la même manière de gauche à droite et de droite à gauche.
      </p>
      <footer><button autofocus data-target="modal-example" onclick="toggleModal(event)">
          ok
        </button>
      </footer>
    </article>
  </dialog>
  <script src="js/modal.js"></script>
  <script src="js/javascript.js"></script>
  <script src="../../js/theme.js"></script>
</body>

</html>