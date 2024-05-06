<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic meta info
  ==================== -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Recipe Book</title>

  <!-- Favicon
  ============ -->
  <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png" />
  <link rel="icon" type="image/png" sizes="192x192" href="images/favicon/android-icon-192x192.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png" />

  <!-- CSS files
  ============== -->
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"  />
  <link rel="stylesheet" type="text/css" href="css/animate.min.css" />
  <link rel="stylesheet" type="text/css" href="css/styles.css" />

  <!-- Modernizr file
  =================== -->
  <script charset="utf-8" type="text/javascript "src="js/modernizr.custom.js"></script>

</head>

<body>

  <!-- Splash Screen
  ================== -->
  <div id="splash"></div>

  <!-- Website Logo
  ================= -->
  <section id="logo">
    <div class="container text-center wow pulse">
      <img src="images/logo-white.svg" alt="logo" />
      <br />
      <h1>Livre de Recette de Moi!</h1>
    </div>
  </section>

  <!-- Recipes Categories
  ======================= -->
  <section id="categories">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Catégories</h2>
        </div>
      </div>
      <div class="row wow zoomIn">
        <!-- Breakfast - Category-->
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
          <div class="category-item text-center">
            <img src="images/icons/milk.png" alt="milk" width="48" height="48" />
            <br />
            Petit déj
          </div>
        </div>
        <!-- Meat - Category-->
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
          <div class="category-item text-center">
            <img src="images/icons/steak.png" alt="meat" width="48" height="48" />
            <br />
            Viande
          </div>
        </div>
        <!-- Seafood - Category-->
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
          <div class="category-item text-center">
            <img src="images/icons/fish.png" alt="fish" width="48" height="48" />
            <br />
            Poisson
          </div>
        </div>
        <!-- Snacks- Category-->
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
          <div class="category-item text-center">
            <img src="images/icons/peanuts.png" alt="peanuts" width="48" height="48"/>
            <br />
            Snacks
          </div>
        </div>
        <!-- Spicy - Category-->
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
          <div class="category-item text-center">
            <img src="images/icons/chili.png" alt="chili" width="48" height="48" />
            <br />
            Epicé
          </div>
        </div>
        <!-- Vegetarian - Category-->
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
          <div class="category-item text-center">
            <img src="images/icons/vegan.png" alt="vegan" width="48" height="48" />
            <br />
            Vegetarien
          </div>
        </div>
      </div>
      <div class="row wow zoomIn">
        <div class="col-12 text-center show-all">
          <div class="category-item text-center">
            <i class="fa fa-cutlery fa-2x" aria-hidden="true"></i>
            <br />
            Tout voir
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Recipes Items
  ================== -->
  <section id="items">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Recettes</h2>
        </div>
      </div>
      <div id="recipe-container" class="row">
        <!-- recettes -->
        <?php
        $url = "https://www.themealdb.com/api/json/v1/1/search.php?s=";
        $search = "chicken"; // remplacez par votre recherche
        $response = file_get_contents($url . urlencode($search));
        $data = json_decode($response, true);
        if (isset($data['meals'])) {
          foreach ($data['meals'] as $meal) {
            echo '
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeIn">
              <div class="recipe-item text-center">
                <a href="' . $meal['strYoutube'] . '">
                  <img src="' . $meal['strMealThumb'] . '" alt="' . $meal['strMeal'] . '" />
                </a>
                <br />
                <h3>' . $meal['strMeal'] . '</h3>
              </div>
            </div>
            ';
          }
        } else {
          echo '<p>Aucune recette trouvée.</p>';
        }
        ?>

      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <!-- Author -->
        <div class="col-md-6 col-sm-12 text-center">
          <div class="footer-author">
            Fait par Bastien Forest
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- JavaScript files
  ===================== -->
  <script src="./js/api.js"></script>
  <script charset="utf-8" src="js/jquery-3.3.1.min.js"></script>
  <script charset="utf-8" src="js/bootstrap.min.js"></script>
  <script charset="utf-8" src="js/wow.min.js"></script>
  <script charset="utf-8" src="js/scripts.js"></script>
</body>

</html>
