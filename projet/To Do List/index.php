<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>To do List</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300,600'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <link rel="stylesheet" href="./style.css">

</head>

<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "srvweb";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Requête SQL pour sélectionner les données
$sql = "SELECT * FROM todo";
$result = $conn->query($sql);

?>
<header>
  <div class="icon">
    <a href="../../index.php">
      <svg width="55" height="55" fill="none" stroke-width="2.5" stroke="#2A486B" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 9.5 12 4l9 5.5"></path>
        <path d="M19 13v6.4a.6.6 0 0 1-.6.6H5.6a.6.6 0 0 1-.6-.6V13"></path>
      </svg>
    </a>
</header>

<body>
  <div class="cont_principal">
    <div class="cont_centrar">

      <div class="cont_todo_list_top">
        <div class="cont_titulo_cont">
          <h3>PENSE BETE</h3>
        </div>
        <div class="cont_add_titulo_cont"><a href="#e" onclick="add_new()"><i class="material-icons">&#xE145;</i></a>
        </div>

      </div>
      <div class="cont_crear_new">
        <form action="./todoedit.php" method="post">
          <table class="table">
            <tr>
              <th>Genre</th>
              <th>Titre</th>
              <th>Date</th>
            </tr>
            <tr>
              <td>
                <select name="genre" id="action_select">
                  <option value="Activité">Activité</option>
                  <option value="Manger">Manger</option>
                  <option value="Travail">Travail</option>
                  <option value="Musique">Musique</option>
                  <option value="Course">Course</option>
                </select>
              </td>
              <td>
                <input type="text" name="titre" class="input_title_desc" />
              </td>
              <td>
                <input type="date" name="date" id="dateInput">
              </td>
            </tr>
            <tr>
              <th class="titl_description">Description</th>
            </tr>
            <tr>
              <td colspan="3">
                <input type="text" name="description" class="input_description" required />
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <button type="submit" class="btn_add_fin" name="addtodo">Ajouter</button>
              </td>
            </tr>
          </table>
        </form>
      </div>

      <div>
        <table class="table">
          <tr>
            <td>
              <form action="" method="post">
                <select name="types" class="select-opt" id="">
                  <option value="all">Tous</option>
                  <option value="Activité">Activité</option>
                  <option value="Manger">Manger</option>
                  <option value="Travail">Travail</option>
                  <option value="Musique">Musique</option>
                  <option value="Course">Course</option>
                </select>
              </form>
            </td>
          </tr>
        </table>
      </div>

      <div class="cont_princ_lists">
        <ul>
          <?php
          $i = 0;
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $i++;
          ?>
              <li class="list_shopping li_num_0_<?php echo $i; ?>" id="<?php echo $row["id"]; ?>">
                <div class="col_md_1_list">
                  <p><?php echo $row["genre"]; ?></p>
                </div>
                <div class="col_md_2_list">
                  <h4><?php echo $row["titre"]; ?></h4>
                  <p><?php echo $row["descr"]; ?></p>
                </div>
                <div class="col_md_3_list">
                  <div class="cont_text_date">
                    <p><?php echo $row["datefin"]; ?></p>
                  </div>
                  <div class="cont_btns_options">
                    <ul>

                      <li><a href="#" onclick="finish_action('0','0_<?php echo $i; ?>');"><i class="material-icons">&#xE5CA;</i></a></li>
                    </ul>
                  </div>
                </div>
              </li>
          <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <script src="./script.js"></script>
  <script>
// Récupérer toutes les cartes
let cards = document.querySelectorAll('.list_shopping');

// Récupérer le menu déroulant
let selectMenu = document.querySelector('.select-opt');

// Fonction pour filtrer les cartes
function filterCards() {
  let selectedOption = selectMenu.value;

  // Boucler sur toutes les cartes
  cards.forEach(card => {
    let cardType = card.querySelector('.col_md_1_list p').textContent.trim();

    // Vérifier si la carte correspond à l'option sélectionnée
    if (selectedOption === 'all' || cardType === selectedOption) {
      card.style.display = 'flex'; // Afficher la carte
    } else {
      card.style.display = 'none'; // Masquer la carte
    }
  });
}

// Ajouter un écouteur d'événement sur le menu déroulant
selectMenu.addEventListener('change', filterCards);
  </script>

  <script>
    setDefaultDate();

    function setDefaultDate() {
      let today = new Date();
      let year = today.getFullYear();
      let month = String(today.getMonth() + 1).padStart(2, '0');
      let day = String(today.getDate()).padStart(2, '0');
      let defaultDate = `${year}-${month}-${day}`;
      document.getElementById("dateInput").value = defaultDate;
    }
  </script>
</body>

</html>