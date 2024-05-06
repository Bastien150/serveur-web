<?php
if (file_exists('../../model/model.php')) {
  require_once('../../model/model.php');
  $user = initialiseUser();
} else if (file_exists('../model/model.php')) {
  require_once('../model/model.php');
  $user = initialiseUser();
} else if (file_exists('./model/model.php')) {
  require_once('./model/model.php');
  $user = initialiseUser();
}
?>

<head>
  <!-- Pico.css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2.0.6/css/pico.min.css" />
  <title><?php if (isset($user->nf)) {
            echo $user->nf;
          } ?></title>
</head>


<header class="container">
  <div class="icon">
    <?php if (isset($user->nf) && $user->nf != 'Accueil') { ?>
      <a href="../../index.php">
        <svg width="46" height="46" fill="none" stroke-width="2" stroke="CurrentColor" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 9.5 12 4l9 5.5"></path>
          <path d="M19 13v6.4a.6.6 0 0 1-.6.6H5.6a.6.6 0 0 1-.6-.6V13"></path>
        </svg>
      </a>

    <?php } ?>

  </div>
  <hgroup>
    <h1><?php
        if (isset($user->nf)) {
          echo $user->nf;
        } ?></h1>
  </hgroup>
  <nav>
    <ul>
      <li>
        <details class="dropdown">
          <summary role="button" class="secondary">Theme</summary>
          <ul>
            <li><a href="#" data-theme-switcher="auto">Auto</a></li>
            <li><a href="#" data-theme-switcher="light">Light</a></li>
            <li><a href="#" data-theme-switcher="dark">Dark</a></li>
          </ul>
        </details>
      </li>
    </ul>
  </nav>
</header>