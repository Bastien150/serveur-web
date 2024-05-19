<?php
session_start();
$_SESSION['file'] = basename(__DIR__);
require_once('./model.php');
include_once('../header.php');
unset($_SESSION['file']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="../../css/style.css">
  <title>Révision</title>
</head>

<body>
  <main class="container">
    <?php 
    if (isset($_SESSION['bddactuelle'])) {
      $bdd = $_SESSION['bddactuelle'];
      unset($_SESSION['bddactuelle']);
    } else {
      $bdd = "";
      header('Location: menu.php');
    }?>

    <section class="head">
      <h4>Ajouter une nouvelle fiche :</h4>
      <form action="./card.php" method="post">

        <div class="grid">
          <input type="hidden" name="add">
          <input type="text" hidden name="bdd" value="<?php echo $bdd; ?>">
          <input type="text" placeholder="Avant" name="front">
          <input type="text" placeholder="Dernière" name="back">
          <input type="submit" value="Ajouter">
        </div>
      </form>
      <?php if (isset($_SESSION['error'])) { ?>
          <span id="error" class="error">
      <?php echo $_SESSION['error']; ?>
      </span>
      <?php unset($_SESSION['error']); }?>
    </section>


    <section>
      <ul class="flashcard-list" id="flashcard-list">

        <?php
        $cards = getTableData($bdd);
        foreach ($cards as $card) : ?>
          <li onclick="toggleCard(this)" class="cardlist">
            <form action="./card.php" method="post">
              <p class="card">
                <?php echo $card['front']; ?>
                <input type="hidden" name="id" value="<?php echo $card['id']; ?>">
                <input type="hidden" name="bdd" value="<?php echo $bdd; ?>">

                <span class="delete-card" onclick="deleteCard(this)">X</span>
              </p>
              <p class="card hidden">
                <?php echo $card['back']; ?>
                <span class="delete-card" onclick="deleteCard(this)">X</span>
              </p>
            </form>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>

    <script>
      function toggleCard(card) {
        card.classList.toggle('flip');
        const cardElements = card.querySelectorAll('.card');
        cardElements.forEach(function(cardElement) {
          if (cardElement.classList.contains('hidden')) {
            cardElement.classList.remove('hidden');
          } else {
            cardElement.classList.add('hidden');
          }
          setTimeout(() => {
            card.classList.remove('flip');
          }, 800);
        });
      }
    </script>
    <script>
      const deleteCardElements = document.querySelectorAll('.delete-card');

      deleteCardElements.forEach(function(element) {
        element.addEventListener('click', function(event) {
          event.preventDefault();
          //supprimer l'annimation :
          const flipElements = document.querySelectorAll('.flip');

          // Parcourir la liste et supprimer la classe "flip" de chaque élément
          flipElements.forEach(element => {
            element.classList.remove('flip');
          });

          // Trouver le formulaire parent le plus proche
          const form = this.closest('form');

          // Si un formulaire parent est trouvé, le soumettre
          if (form) {
            form.submit();
          }
        });
      });
    </script>
</body>
<script src="../../js/theme.js"></script>

</html>