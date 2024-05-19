<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix thème révision</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2.0.6/css/pico.min.css" />
</head>

<body>
<header class="container">
  <div class="icon">
      <a href="../../index.php">
        <svg width="46" height="46" fill="none" stroke-width="2" stroke="CurrentColor" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 9.5 12 4l9 5.5"></path>
          <path d="M19 13v6.4a.6.6 0 0 1-.6.6H5.6a.6.6 0 0 1-.6-.6V13"></path>
        </svg>
      </a>
  </div>
</header>
    <main class="container">
        <section>
            <div class="menues">
                <h2>Choix Fiche de Révision :</h2>

                <div class="addbdd">
                    <form action="./flashcardmenue.php" method="post">
                        <fieldset role="group">
                            <input type="text" placeholder="Nouveau Thème" name="addnewtheme">
                            <button>
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)" stroke="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                    <g id="SVGRepo_iconCarrier">
                                        <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2.4" />
                                        <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="white" stroke-width="2.4" stroke-linecap="round" />
                                    </g>
                                </svg>
                            </button>
                        </fieldset>
                    </form>

                </div>

                </br>
                <?php
                // Connexion à la base de données
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "flashcard";

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Exécuter la requête SHOW TABLES
                    $sql = "SHOW TABLES";
                    $result = $conn->query($sql);

                    // Afficher les noms des tables
                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_NUM)) {
                ?>

                            <form action="./flashcardmenue.php" method="post">
                                <input type="hidden" name="themeac" value="<?php echo $row[0]; ?>">
                                <fieldset role="group">
                                    <button class="btname" name="theme"><?php echo $row[0]; ?></button>
                                    <button name="deltheme">
                                        <svg width="35" height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 12V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14 12V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M4 7H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </fieldset>
                            </form>
                <?php                         }
                    } else {
                        echo "Aucune table trouvée.";
                    }
                } catch (PDOException $e) {
                    echo "Erreur: ";
                }
                $conn = null;
                ?>
            </div>
        </section>
    </main>
</body>
<script src="../../js/theme.js"></script>

</html>