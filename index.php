<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <?php
  session_start();
  $_SESSION['file'] = "Accueil";
  include_once('./projet/header.php');
  unset($_SESSION['file']);
  ?>
  <main class="container">
    <div class="application">
      <?php
      $directory = './projet/';
      $files = scandir($directory);

      $count = 0;
      foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && $file !== 'header.php') {
          if ($count % 6 == 0) {
            echo "<div class='containeur'>";
          }
          echo "<div class='square'><a href='./projet/" . $file . "'><img src='./projet/" . $file . "/img.png' alt=" . $file . "></a></div>";
          $count++;

          if ($count % 6 == 0) {
            echo "</div>";
          }
        }
      }

      echo "</div>";

      ?>
    </div>
    </div>
    <div class="pagination">
    </div>
  </main>
</body>
<script src="./js/theme.js"></script>
<script src="./js/script.js"></script>

</html>